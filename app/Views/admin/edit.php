<!-- Isi Form Edit dalam Modal -->
<form id="editForm">
    <input type="hidden" name="id" value="<?= $ssw['id']; ?>">

    <!-- Tambahkan input fields sesuai kebutuhan -->
    <label for="nama_pd">Nama PD:</label>
    <input type="text" name="nama_pd" value="<?= $ssw['nama_pd']; ?>" required>

    <!-- Tambahkan input fields lainnya -->

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

<script>
    $(document).ready(function() {
        // Submit form melalui AJAX
        $('#editForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'url_ke_controller_method_update', // Gantilah dengan URL yang benar
                data: $(this).serialize(),
                success: function(response) {
                    // Handle respons setelah berhasil disimpan
                    // Tutup modal jika diperlukan
                    $('#editModal').modal('hide');
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });
    });
</script>