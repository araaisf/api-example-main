<!-- Tombol Tambah Catatan -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCatatanModal">
    Tambah Catatan
</button>

<!-- Modal -->
<div class="modal fade" id="addCatatanModal" tabindex="-1" aria-labelledby="addCatatanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formAddCatatan">
        <div class="modal-header">
          <h5 class="modal-title" id="addCatatanModalLabel">Tambah Catatan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" value="1"> <!-- ganti sesuai user login -->
          <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
          </div>
          <div class="mb-3">
            <label for="isi" class="form-label">Isi</label>
            <textarea class="form-control" id="isi" name="isi"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#formAddCatatan').submit(function(e) {
        e.preventDefault();

        let formData = {
            user_id: $('input[name="user_id"]').val(),
            judul: $('#judul').val(),
            isi: $('#isi').val()
        };

        $.ajax({
            url: '/api/catatan', // route API
            type: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message); // popup sukses
                $('#addCatatanModal').modal('hide');
                $('#formAddCatatan')[0].reset();
                // optional: refresh table/list catatan
                loadCatatan(); 
            },
            error: function(xhr) {
                alert('Terjadi error: ' + xhr.responseJSON.message);
            }
        });
    });

    // Fungsi untuk load semua catatan (opsional)
    function loadCatatan() {
        $.get('/api/catatan', function(data) {
            console.log(data); // nanti bisa tampilkan di tabel
        });
    }

    loadCatatan();
});
</script>
