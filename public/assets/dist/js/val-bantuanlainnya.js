
        $(document).ready(function() {
            // Tangkap event klik pada tombol submit
            $("#formTambahPeserta").submit(function(event) {
                // Hentikan perilaku default dari tombol submit
                event.preventDefault();


                 // Tampilkan loading sebelum melakukan permintaan AJAX
        showLoading();
                // Validasi input sebelum mengirimkan formulir

                // Ambil nilai input
                var nama_pd = $("#nama_pd").val().trim();
                var nisn = $("#nisn").val().trim();
                var kelas = $("#kelas").val();
                var tempat_lahir = $("#tempat_lahir").val().trim();
                var tanggal_lahir = $("#tanggal_lahir").val().trim();
                var nik = $("#nik").val().trim();
                var jenis_kelamin = $("#jenis_kelamin").val();
                var nama_ayah = $("#nama_ayah").val().trim();
                var nama_ibu_kandung = $("#nama_ibu_kandung").val().trim();
                var jenis_bantuan = $("#jenis_bantuan").val();
                var tahap_id = $("#tahap_id").val().trim();
                var tanggal_sk = $("#tanggal_sk").val().trim();
                var nomor_sk = $("#nomor_sk").val().trim();
                var nama_rekening = $("#nama_rekening").val().trim();
                var no_rekening = $("#no_rekening").val().trim();
                var nominal = $("#nominal").val().trim();
                var informasi = $("#informasi").val().trim();



                // Lakukan validasi di sini
                if (nama_pd === "") {
                    toastr.error("Nama Siswa harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }

                if (nisn === "") {
                    toastr.error("NISN harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }

                if (kelas === "Pilih kelas...") {
                    toastr.error("Kelas harus dipilih.");
                    return; // Hentikan eksekusi fungsi
                }

                if (tempat_lahir === "") {
                    toastr.error("Tempat Lahir harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }


                // Periksa apakah nilai tanggal sudah diisi
                if (tanggal_lahir === "") {
                    toastr.error("Tanggal Lahir harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }

                if (nik === "") {
                    toastr.error("NIK harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }

                if (jenis_kelamin === "Pilih jenis kelamin...") {
                    toastr.error("Jenis Kelamin harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }

                if (nama_ayah === "") {
                    toastr.error("Nama Ayah harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }

                if (nama_ibu_kandung === "") {
                    toastr.error("Nama Ibu Kandung harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }

                if (jenis_bantuan === "Pilih jenis bantuan...") {
                    toastr.error("Jenis Bantuan harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }



                if (tahap_id === "") {
                    toastr.error("Tahap harus diisi, isikan - jika tidak ada tahap.");
                    return; // Hentikan eksekusi fungsi
                }

                if (tanggal_sk === "") {
                    toastr.error("Tanggal SK harus diisi.");
                    return; // Hentikan eksekusi fungsi
                }

                if (nomor_sk === "") {
                    toastr.error("Nomor SK harus diisi, isikan - jika tidak ada tahap.");
                    return; // Hentikan eksekusi fungsi
                }

                if (nama_rekening === "") {
                    toastr.error("Nama Rekening harus diisi, isikan - jika tidakk ada.");
                    return; // Hentikan eksekusi fungsi
                }

                if (no_rekening === "") {
                    toastr.error("Nomor Rekening harus diisi, isikan - jika tidakk ada.");
                    return; // Hentikan eksekusi fungsi
                }

                if (nominal === "") {
                    toastr.error("Nominal Bantuan harus diisi, isikan - jika tidakk ada.");
                    return; // Hentikan eksekusi fungsi
                }

                if (informasi === "") {
                    toastr.error("Keterangan harus diisi, isikan - jika tidakk ada.");
                    return; // Hentikan eksekusi fungsi
                }

                // Siapkan data untuk dikirim ke server
                var formData = new FormData(this); // Form data dari form HTML

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    type: "POST",
                    url: "/danalain/simpan", // Ganti dengan URL endpoint Anda
                    data: formData,
                    processData: false, // Tidak memproses data
                    contentType: false, // Tidak menambahkan header Content-Type
                    success: function(response) {
                        // Tanggapan dari server jika request berhasil
                        console.log("Data berhasil disimpan:", response);
                        // Tampilkan pesan SweetAlert berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan!',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            // Setelah pengguna menekan OK, reload halaman
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Tanggapan dari server jika request gagal
                        console.error("Gagal menyimpan data:", error);
                        hideLoading();
                        // Tambahkan logika lain jika diperlukan setelah data gagal disimpan
                    }
                });

            });

        });
