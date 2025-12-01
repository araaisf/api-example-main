<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CRUD Users & Catatan By Ara</title>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
body {
    font-family: Arial, sans-serif;
    margin:0; padding:20px;
    background: linear-gradient(135deg,#6a0dad,#ff6600);
    color: #fff;
}
h2 { text-align:center; margin-bottom:20px; }
.card {
    background: rgba(255,255,255,0.95);
    color: #333;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
table { width:100%; border-collapse:collapse; margin-top:10px; }
th, td { padding:8px; border-bottom:1px solid #ddd; text-align:left; }
th { background: linear-gradient(90deg,#6a0dad,#ff6600); color:#fff; }
button {
    background: #6a0dad; color:#fff;
    border:none; padding:6px 12px; border-radius:5px; cursor:pointer;
    transition: 0.3s;
}
button:hover { transform: scale(1.05); opacity:0.85; }

.modal {
    display:none; position:fixed; top:0; left:0;
    width:100%; height:100%;
    background:rgba(0,0,0,0.5);
    justify-content:center; align-items:center; animation:fadeIn 0.3s;
}
@keyframes fadeIn { from {opacity:0} to {opacity:1} }

.modal-content {
    background:#fff; color:#333; padding:20px; border-radius:10px; width:400px; position:relative; animation:slideDown 0.3s;
}
@keyframes slideDown { from {transform: translateY(-50px)} to {transform: translateY(0)} }

.close { position:absolute; top:10px; right:15px; font-size:22px; cursor:pointer; }

input, select, textarea { width:100%; padding:6px; margin:5px 0; border-radius:5px; border:1px solid #ccc; }

.toast {
    position:fixed; bottom:20px; right:20px;
    background:#6a0dad; color:#fff; padding:10px 20px;
    border-radius:5px; opacity:0; transition:0.5s;
}
.toast.show { opacity:1; }
</style>
</head>
<body>

<h2>CRUD Users & Catatan By Ara </h2>

<div class="card">
    <h3>Users</h3>
    <button onclick="openModal('user')">Tambah User</button>
    <table id="user_table">
        <thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Aksi</th></tr></thead>
        <tbody></tbody>
    </table>
</div>

<div class="card">
    <h3>Catatan</h3>
    <button onclick="openModal('catatan')">Tambah Catatan</button>
    <select id="filter_user" onchange="fetchCatatan()">
        <option value="">-- Filter by User --</option>
    </select>
    <table id="catatan_table">
        <thead><tr><th>ID</th><th>User</th><th>Judul</th><th>Isi</th><th>Aksi</th></tr></thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal" id="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 id="modal_title"></h3>
        <div id="modal_body"></div>
        <button onclick="saveModal()">Simpan</button>
    </div>
</div>

<div class="toast" id="toast"></div>

<script>
const apiUrl = "http://127.0.0.1:8000/api";
let currentModal='', editId=null;

function showToast(msg){
    const toast = document.getElementById('toast');
    toast.innerText=msg; toast.classList.add('show');
    setTimeout(()=>{toast.classList.remove('show')},2000);
}

function openModal(type,id=null,data={}){
    currentModal=type; editId=id;
    document.getElementById('modal').style.display='flex';
    document.getElementById('modal_title').innerText = type==='user'?'Tambah / Edit User':'Tambah / Edit Catatan';
    let html='';
    if(type==='user'){
        html=`<input id="modal_name" placeholder="Nama" value="${data.name||''}">
              <input id="modal_email" placeholder="Email" value="${data.email||''}">`;
    } else {
        html=`<select id="modal_user_id"></select>
              <input id="modal_judul" placeholder="Judul" value="${data.judul||''}">
              <textarea id="modal_isi" placeholder="Isi">${data.isi||''}</textarea>`;
        axios.get(`${apiUrl}/users`).then(res=>{
            const sel=document.getElementById('modal_user_id');
            sel.innerHTML='';
            res.data.forEach(u=>{
                sel.innerHTML+=`<option value="${u.id}" ${u.id==data.user_id?'selected':''}>${u.name}</option>`;
            });
        });
    }
    document.getElementById('modal_body').innerHTML=html;
}
function closeModal(){ document.getElementById('modal').style.display='none'; editId=null; }

async function saveModal(){
    try{
        if(currentModal==='user'){
            const name=document.getElementById('modal_name').value;
            const email=document.getElementById('modal_email').value;
            if(editId) await axios.put(`${apiUrl}/users/${editId}`,{name,email});
            else await axios.post(`${apiUrl}/users`,{name,email});
            fetchUsers();
        } else {
            const user_id=document.getElementById('modal_user_id').value;
            const judul=document.getElementById('modal_judul').value;
            const isi=document.getElementById('modal_isi').value;
            if(editId) await axios.put(`${apiUrl}/catatan/${editId}`,{user_id,judul,isi});
            else await axios.post(`${apiUrl}/catatan`,{user_id,judul,isi});
            fetchCatatan();
        }
        showToast('Berhasil disimpan!');
        closeModal();
    }catch(e){ showToast('Terjadi error!'); console.error(e);}
}

async function fetchUsers(){
    const res = await axios.get(`${apiUrl}/users`);
    const tbody = document.querySelector('#user_table tbody');
    const filterUser=document.getElementById('filter_user');
    tbody.innerHTML=''; filterUser.innerHTML='<option value="">-- Filter by User --</option>';
    res.data.forEach(u=>{
        tbody.innerHTML+=`<tr>
            <td>${u.id}</td><td>${u.name}</td><td>${u.email}</td>
            <td>
                <button onclick="openModal('user',${u.id},{name:'${u.name}',email:'${u.email}'})">Edit</button>
                <button onclick="deleteUser(${u.id})">Hapus</button>
            </td>
        </tr>`;
        filterUser.innerHTML+=`<option value="${u.id}">${u.name}</option>`;
    });
}

async function deleteUser(id){ await axios.delete(`${apiUrl}/users/${id}`); fetchUsers(); fetchCatatan(); showToast('User dihapus!'); }

async function fetchCatatan(){
    const user_id=document.getElementById('filter_user').value;
    const res=await axios.get(`${apiUrl}/catatan`,{params:{user_id}});
    const tbody=document.querySelector('#catatan_table tbody'); tbody.innerHTML='';
    res.data.forEach(c=>{
        tbody.innerHTML+=`<tr>
            <td>${c.id}</td><td>${c.user_id}</td><td>${c.judul}</td><td>${c.isi}</td>
            <td>
                <button onclick="openModal('catatan',${c.id},{user_id:${c.user_id},judul:'${c.judul}',isi:'${c.isi}'})">Edit</button>
                <button onclick="deleteCatatan(${c.id})">Hapus</button>
            </td>
        </tr>`;
    });
}

async function deleteCatatan(id){ await axios.delete(`${apiUrl}/catatan/${id}`); fetchCatatan(); showToast('Catatan dihapus!'); }

fetchUsers(); fetchCatatan();
</script>

</body>
</html>
