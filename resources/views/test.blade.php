<!DOCTYPE html>
<html>
<head>
    <title>Test API</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body style="font-family: Arial; padding: 20px;">

    <h1>Test API CRUD</h1>

    <hr>

    <!-- GET USERS -->
    <h3>Get All Users</h3>
    <button onclick="getUsers()">Tampilkan Users</button>
    <pre id="users"></pre>

    <hr>

    <!-- GET CATATAN -->
    <h3>Get Catatan by User ID</h3>
    <input type="number" id="filterUserId" placeholder="Masukkan User ID">
    <button onclick="getCatatan()">Filter</button>
    <pre id="catatan"></pre>

    <hr>

    <!-- POST CATATAN -->
    <h3>Buat Catatan Baru</h3>
    <form id="catatanForm" onsubmit="buatCatatan(event)">
        <input type="number" id="user_id" placeholder="User ID" required><br><br>
        <input type="text" id="judul" placeholder="Judul" required><br><br>
        <textarea id="isi" placeholder="Isi catatan" required></textarea><br><br>
        <button type="submit">Simpan Catatan</button>
    </form>
    <pre id="newCatatan"></pre>

    <script>
        function getUsers() {
            fetch('/api/users')
                .then(res => res.json())
                .then(data => document.getElementById('users').textContent = JSON.stringify(data, null, 2));
        }

        function getCatatan() {
            let userId = document.getElementById('filterUserId').value;

            fetch('/api/catatan?user_id=' + userId)
                .then(res => res.json())
                .then(data => document.getElementById('catatan').textContent = JSON.stringify(data, null, 2));
        }

        function buatCatatan(e) {
            e.preventDefault();

            let payload = {
                user_id: document.getElementById('user_id').value,
                judul: document.getElementById('judul').value,
                isi: document.getElementById('isi').value,
            };

            fetch('/api/catatan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => document.getElementById('newCatatan').textContent = JSON.stringify(data, null, 2));
        }
    </script>

</body>
</html>
