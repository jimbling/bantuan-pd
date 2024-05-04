
        function showLoading() {
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

        function ambil_bank(data_id) {
            Swal.fire({
                title: 'Konfirmasi?',
                text: "Apakah benar siswa sudah mengambil Dana di Bank?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Benar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan pesan loading saat permintaan sedang dijalankan
                    showLoading();

                    // Lakukan permintaan penghapusan ke server, misalnya dengan AJAX.
                    // Jika penghapusan berhasil, maka lakukan redirect ke halaman /siswa.
                    // Contoh penggunaan jQuery untuk permintaan penghapusan:
                    $.ajax({
                        type: 'POST',
                        url: '/danalain/ambilbank/' + data_id, // Ganti URL sesuai dengan URL yang benar
                        success: function(response) {
                            // Sembunyikan pesan loading saat permintaan selesai
                            hideLoading();

                            // Nonaktifkan tombol Ambil
                            $('#btnAmbil').prop('disabled', true);

                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Dana sudah diambil Siswa.',
                                icon: 'success',
                                timer: 2000, // Durasi tampilan dalam milidetik (misalnya, 5000 milidetik = 5 detik)
                                showConfirmButton: false, // Sembunyikan tombol OK (jika tidak diinginkan)
                            }).then(() => {
                                // Arahkan pengguna ke halaman baru setelah SweetAlert ditutup
                                window.location.replace("/bantuan/lainnya");
                            });
                        },
                        error: function(xhr, status, error) {
                            // Sembunyikan pesan loading saat ada kesalahan dalam penghapusan
                            hideLoading();
                            // Handle error here, jika ada kesalahan dalam penghapusan
                            console.log(error);
                        }
                    });
                }
            });
        }

        function showLoading() {
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

        function hapus_data(data_id) {
            Swal.fire({
                title: 'HAPUS?',
                text: "Yakin akan menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan pesan loading saat permintaan sedang dijalankan
                    showLoading();
                    // Lakukan permintaan penghapusan ke server, misalnya dengan AJAX.
                    // Jika penghapusan berhasil, maka lakukan redirect ke halaman /siswa.
                    // Contoh penggunaan jQuery untuk permintaan penghapusan:
                    $.ajax({
                        type: 'POST',
                        url: '/siswadanalain/hapus/' + data_id, // Ganti URL sesuai dengan URL yang benar
                        success: function(response) {
                            // Sembunyikan pesan loading saat permintaan selesai
                            hideLoading();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil dihapus.',
                                icon: 'success',
                                timer: 2000, // Durasi tampilan dalam milidetik (misalnya, 5000 milidetik = 5 detik)
                                showConfirmButton: false, // Sembunyikan tombol OK (jika tidak diinginkan)
                            }).then(() => {
                                // Arahkan pengguna ke halaman baru setelah SweetAlert ditutup
                                window.location.replace("/bantuan/lainnya");
                            });
                        },
                        error: function(xhr, status, error) {
                            // Sembunyikan pesan loading saat ada kesalahan dalam penghapusan
                            hideLoading();
                            // Handle error here, jika ada kesalahan dalam penghapusan
                            console.log(error);
                        }
                    });
                }
            });
        }




        function openEditModal(id) {
            // Set nilai input hidden dengan ID yang diambil dari tombol edit
            document.getElementById('edit_id').value = id;

            // Perbarui aksi formulir sesuai dengan ID
            document.getElementById('formEditPeserta').action = "/danalain/update/" + id;
            // Fetch data using AJAX
            $.ajax({
                url: '/danalain/get_detail/' + id,
                method: 'GET',
                success: function(data) {
                    console.log(data); // Periksa data yang diterima di konsol browser
                    // Populate the modal with the fetched data
                    $('#editDanaLainModal').modal('show');
                    populateEditModal(data);

                    // Set nilai input tersembunyi dengan nilai 'id'
                    $('#editId').val(id);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }



        function populateEditModal(data) {
            // Populate the form fields with the fetched data
            $('#nama_pd_edit').val(data.nama_pd);
            $('#nisn_edit').val(data.nisn);
            $('#kelas_edit').val(data.kelas);
            $('#tempat_lahir_edit').val(data.tempat_lahir);
            // Ubah format tanggal untuk tanggal_lahir
            $('#tanggalLahir_edit').val(moment(data.tanggal_lahir, 'YYYY-MM-DD').format('YYYY-MM-DD'));
            $('#nik_edit').val(data.nik);
            $('#jenis_kelamin_edit').val(data.jenis_kelamin);
            $('#nama_ayah_edit').val(data.nama_ayah);
            $('#nama_ibu_kandung_edit').val(data.nama_ibu_kandung);
            $('#jenis_bantuan_edit').val(data.jenis_bantuan);
            $('#tahap_id_edit').val(data.tahap_id);
            // Ubah format tanggal untuk tanggal_sk
            $('#tanggalSk_edit').val(moment(data.tanggal_sk, 'YYYY-MM-DD').format('YYYY-MM-DD'));
            $('#nomor_sk_edit').val(data.nomor_sk);
            $('#nama_rekening_edit').val(data.nama_rekening);
            $('#no_rekening_edit').val(data.no_rekening);
            $('#nominal_edit').val(data.nominal);
            $('#informasi_edit').val(data.informasi);
        }

        function validateNumberInput(inputElement) {
            // Bersihkan teks non-angka dari nilai input
            inputElement.value = inputElement.value.replace(/\D/g, '');

            // Tampilkan pesan kesalahan jika nilai input tidak hanya terdiri dari angka
            var errorElement = document.getElementById('nominalError');
            if (!/^\d+$/.test(inputElement.value)) {
                errorElement.textContent = 'Masukkan hanya angka.';
                inputElement.setCustomValidity('Masukkan hanya angka.');
            } else {
                errorElement.textContent = '';
                inputElement.setCustomValidity('');
            }
        }
