
        function showLoadingProses() {
            let timerInterval
            Swal.fire({
                title: 'Sedang memproses data ....',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                }
            });
        }

        function hideLoading() {
            Swal.close();
        }

        function simpan_editAkun() {
            var id = document.getElementById('edit-button-' + id).getAttribute('data-id');
            var username = document.getElementById('editNama').value;
            var nama = document.getElementById('editUserNama').value;
            var password = document.getElementById('editUserPass').value;
            showLoadingProses();

            // Kirim data ke controller dengan Ajax
            $.ajax({
                type: "POST",
                url: '/data/akun/update',
                data: {
                    id: id,
                    username: username,
                    nama: nama,
                    password: password
                },
                success: function(response) {
                    // Handle response dari controller
                    if (response.status === 'success') {
                        hideLoading();
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: response.message,
                        });

                        // Redirect setelah pesan ditampilkan
                        window.location.href = '/data/pengaturan';
                    } else {
                        hideLoading();
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Tangani kesalahan jika ada
                    console.error(xhr.responseText);
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim permintaan.',
                    });
                }
            });

            return false; // Mencegah formulir dikirim secara tradisional
        }
