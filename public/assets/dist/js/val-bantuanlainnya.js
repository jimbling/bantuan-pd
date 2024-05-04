        $(document).ready(function() {
            // Tangkap event klik pada tombol submit
            $("#formTambahPeserta").submit(function(event) {
                // Hentikan perilaku default dari tombol submit
                event.preventDefault();

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
                showLoading();
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



        // Validasi Edit Peserta
        $(document).ready(function() {
          // Tangkap event klik pada tombol submit
          $("#formEditPeserta").submit(function(event) {
              // Hentikan perilaku default dari tombol submit
              event.preventDefault();

              // Validasi input sebelum mengirimkan formulir

              // Ambil nilai input
              var nama_pd_edit = $("#nama_pd_edit").val().trim();
              var nisn_edit = $("#nisn_edit").val().trim();
              var kelas_edit = $("#kelas_edit").val();
              var tempat_lahir_edit = $("#tempat_lahir_edit").val().trim();
              var tanggalLahir_edit = $("#tanggalLahir_edit").val().trim();
              var nik_edit = $("#nik_edit").val().trim();
              var jenis_kelamin_edit = $("#jenis_kelamin_edit").val();
              var nama_ayah_edit = $("#nama_ayah_edit").val().trim();
              var nama_ibu_kandung_edit = $("#nama_ibu_kandung_edit").val().trim();
              var jenis_bantuan_edit = $("#jenis_bantuan_edit").val();
              var tahap_id_edit = $("#tahap_id_edit").val().trim();
              var tanggalSk_edit = $("#tanggalSk_edit").val().trim();
              var nomor_sk_edit = $("#nomor_sk_edit").val().trim();
              var nama_rekening_edit = $("#nama_rekening_edit").val().trim();
              var no_rekening_edit = $("#no_rekening_edit").val().trim();
              var nominal_edit = $("#nominal_edit").val().trim();
              var informasi_edit = $("#informasi_edit").val().trim();



              // Lakukan validasi di sini
              if (nama_pd_edit === "") {
                  toastr.error("Nama Siswa harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }

              if (nisn_edit === "") {
                  toastr.error("NISN harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }

              if (kelas_edit === "Pilih kelas...") {
                  toastr.error("Kelas harus dipilih.");
                  return; // Hentikan eksekusi fungsi
              }

              if (tempat_lahir_edit === "") {
                  toastr.error("Tempat Lahir harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }


              // Periksa apakah nilai tanggal sudah diisi
              if (tanggalLahir_edit === "") {
                  toastr.error("Tanggal Lahir harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }

              if (nik_edit === "") {
                  toastr.error("NIK harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }

              if (jenis_kelamin_edit === "Pilih jenis kelamin...") {
                  toastr.error("Jenis Kelamin harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }

              if (nama_ayah_edit === "") {
                  toastr.error("Nama Ayah harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }

              if (nama_ibu_kandung_edit === "") {
                  toastr.error("Nama Ibu Kandung harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }

              if (jenis_bantuan_edit === "Pilih jenis bantuan...") {
                  toastr.error("Jenis Bantuan harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }



              if (tahap_id_edit === "") {
                  toastr.error("Tahap harus diisi, isikan - jika tidak ada tahap.");
                  return; // Hentikan eksekusi fungsi
              }

              if (tanggalSk_edit === "") {
                  toastr.error("Tanggal SK harus diisi.");
                  return; // Hentikan eksekusi fungsi
              }

              if (nomor_sk_edit === "") {
                  toastr.error("Nomor SK harus diisi, isikan - jika tidak ada tahap.");
                  return; // Hentikan eksekusi fungsi
              }

              if (nama_rekening_edit === "") {
                  toastr.error("Nama Rekening harus diisi, isikan - jika tidak ada.");
                  return; // Hentikan eksekusi fungsi
              }

              if (no_rekening_edit === "") {
                  toastr.error("Nomor Rekening harus diisi, isikan - jika tidak ada.");
                  return; // Hentikan eksekusi fungsi
              }

              if (nominal_edit === "") {
                  toastr.error("Nominal Bantuan harus diisi, isikan - jika tidak ada.");
                  return; // Hentikan eksekusi fungsi
              }

              if (informasi_edit === "") {
                  toastr.error("Keterangan harus diisi, isikan - jika tidak ada.");
                  return; // Hentikan eksekusi fungsi
              }

              // Siapkan data untuk dikirim ke server
              var formData = new FormData(this); // Form data dari form HTML
              showLoading();
              // Kirim data ke server menggunakan AJAX
              // Kirim data ke server menggunakan AJAX
        $.ajax({
          type: "POST",
          url: $(this).attr('action'), // Menggunakan action yang telah diperbarui
          data: formData,
          processData: false, // Tidak memproses data
          contentType: false, // Tidak menambahkan header Content-Type

          success: function(response) {
              // Tanggapan dari server jika request berhasil
              console.log("Data berhasil diubah:", response);
              // Tampilkan pesan SweetAlert berhasil
              Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: 'Data berhasil diubah!',
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







