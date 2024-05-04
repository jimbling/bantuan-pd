
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


        // Fungsi yang dijalankan saat halaman diload
        window.addEventListener('load', function() {
            // Sembunyikan tombol Update dan Batal saat halaman diload
            document.getElementById('updateButton').style.display = 'none';
            document.getElementById('batalButton').style.display = 'none';
        });

        document.getElementById('editButton').addEventListener('click', function() {
            event.preventDefault(); // Menghentikan default behavior dari tombol submit
            // Hapus atribut readonly dari elemen input yang diinginkan
            document.getElementById('nama_sp').removeAttribute('readonly');
            document.getElementById('npsn').removeAttribute('readonly');
            document.getElementById('dusun_sp').removeAttribute('readonly');
            document.getElementById('kapanewon_sp').removeAttribute('readonly');
            document.getElementById('kabupaten_sp').removeAttribute('readonly');
            document.getElementById('nama_ks').removeAttribute('readonly');
            document.getElementById('nip_ks').removeAttribute('readonly');
            document.getElementById('website').removeAttribute('readonly');


            // (Tambahkan kode serupa untuk elemen input lainnya)

            // Tampilkan tombol Batal dan Update
            document.getElementById('batalButton').style.display = 'block';
            document.getElementById('updateButton').style.display = 'block';
            // Sembunyikan tombol Edit
            this.style.display = 'none';
        });

        document.getElementById('batalButton').addEventListener('click', function() {
            // Tambahkan atribut readonly ke elemen input yang diinginkan
            document.getElementById('nama_sp').setAttribute('readonly', true);
            document.getElementById('npsn').setAttribute('readonly', true);
            document.getElementById('dusun_sp').setAttribute('readonly', true);
            document.getElementById('kapanewon_sp').setAttribute('readonly', true);
            document.getElementById('kabupaten_sp').setAttribute('readonly', true);
            document.getElementById('nama_ks').setAttribute('readonly', true);
            document.getElementById('nip_ks').setAttribute('readonly', true);
            document.getElementById('website').setAttribute('readonly', true);



            // (Tambahkan kode serupa untuk elemen input lainnya)

            // Tampilkan tombol Edit
            document.getElementById('editButton').style.display = 'block';
            // Sembunyikan tombol Update dan Batal
            document.getElementById('updateButton').style.display = 'none';
            this.style.display = 'none';
        });

        document.getElementById('updateButton').addEventListener('click', function() {
            // Tambahkan atribut readonly ke elemen input yang diinginkan
            document.getElementById('nama_sp').setAttribute('readonly', true);
            document.getElementById('npsn').setAttribute('readonly', true);
            document.getElementById('dusun_sp').setAttribute('readonly', true);
            document.getElementById('kapanewon_sp').setAttribute('readonly', true);
            document.getElementById('kabupaten_sp').setAttribute('readonly', true);
            document.getElementById('nama_ks').setAttribute('readonly', true);
            document.getElementById('nip_ks').setAttribute('readonly', true);
            document.getElementById('website').setAttribute('readonly', true);


            // (Tambahkan kode serupa untuk elemen input lainnya)

            // Tampilkan tombol Edit
            document.getElementById('editButton').style.display = 'block';
            // Sembunyikan tombol Update dan Batal
            document.getElementById('updateButton').style.display = 'none';
            document.getElementById('batalButton').style.display = 'none';
        });



        document.getElementById('updateButton').addEventListener('click', function() {
            var websiteInput = document.getElementById('website');
            var websiteValue = websiteInput.value;

            // Validasi apakah URL dimulai dengan "http://" atau "https://"
            if (!websiteValue.startsWith('http://') && !websiteValue.startsWith('https://')) {
                // Jika tidak, tampilkan pesan kesalahan menggunakan toastr
                toastr.error('URL harus dimulai dengan http:// atau https://');
                // Berhenti menjalankan fungsi
                return;
            }
            // Ambil data dari formulir
            var nama_sp = document.getElementById('nama_sp').value;
            var npsn = document.getElementById('npsn').value;
            var dusun_sp = document.getElementById('dusun_sp').value;
            var kapanewon_sp = document.getElementById('kapanewon_sp').value;
            var kabupaten_sp = document.getElementById('kabupaten_sp').value;
            var nama_ks = document.getElementById('nama_ks').value;
            var nip_ks = document.getElementById('nip_ks').value;
            var website = document.getElementById('website').value;

            // Log data yang akan dikirim ke konsol
            console.log('Data yang akan dikirim:', {
                nama_sp: nama_sp,
                npsn: npsn,
                dusun_sp: dusun_sp,
                kapanewon_sp: kapanewon_sp,
                kabupaten_sp: kabupaten_sp,
                nama_ks: nama_ks,
                nip_ks: nip_ks,
                website: website,
            });

            // Buat objek data yang akan dikirimkan melalui AJAX
            var data = {
                nama_sp: nama_sp,
                npsn: npsn,
                dusun_sp: dusun_sp,
                kapanewon_sp: kapanewon_sp,
                kabupaten_sp: kabupaten_sp,
                nama_ks: nama_ks,
                nip_ks: nip_ks,
                website: website,
            };
            // Tampilkan loading sebelum mengirimkan data
            showLoading();

            // Kirim data ke controller menggunakan AJAX
           // Kirim data ke controller menggunakan AJAX
              fetch(baseUrl + '/setting-sp/update', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                }
              })
              .then(response => {
                // tangani respons dari server
              })
              .catch(error => {
                // tangani kesalahan jika terjadi
              })
                .then(response => response.json())
                .then(data => {
                    // Sembunyikan loading setelah mendapatkan respons dari server
                    hideLoading();

                    // Handle respons dari server jika diperlukan
                    console.log('Respons dari server:', data);

                    // Tampilkan SweetAlert sukses dengan timer 5000 milidetik (5 detik)
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil dirubah.',
                        icon: 'success',
                        timer: 3000, // Durasi tampilan dalam milidetik (misalnya, 5000 milidetik = 5 detik)
                        showConfirmButton: false, // Sembunyikan tombol OK (jika tidak diinginkan)
                    }).then(() => {
                        // Arahkan pengguna ke halaman baru setelah SweetAlert ditutup
                        window.location.replace("/setting");
                    });
                })
                .catch(error => {
                    // Sembunyikan loading jika terjadi kesalahan
                    hideLoading();

                    console.error('Error:', error);

                    // Tampilkan SweetAlert sukses dengan jeda waktu 2000 milidetik (2 detik)
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Data berhasil diperbarui',
                        });
                    }, 2000);
                });
        });

        // Upload KOP Surat

        // Fungsi untuk menampilkan gambar previ saat gambar dipilih
        function showPreviewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }

            // Menampilkan nama file yang dipilih
            var fileName = input.files[0].name;
            $('#selectedFileName').text(fileName);
        }

        // Memanggil fungsi showPreviewImage saat input file berubah
        $('#customFile').change(function() {
            showPreviewImage(this);
        });


        const customFileInput = document.querySelector("#customFile");
        const previewImage = document.querySelector("#previewImage");

        customFileInput.addEventListener("change", function() {
            if (this.files.length > 0) {
                previewImage.style.display = "block";
            } else {
                previewImage.style.display = "none";
            }
        });



        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.querySelector("input[name='ctk_kopsurat']");
            const submitButton = document.querySelector("button[type='submit']");
            const selectedFileName = document.querySelector("#selectedFileName");
            const previewImage = document.querySelector("#previewImage");

            fileInput.addEventListener("change", function() {
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'svg'];
                const fileName = this.files[0].name;
                const fileExtension = fileName.split('.').pop().toLowerCase();

                if (allowedExtensions.includes(fileExtension)) {
                    selectedFileName.textContent = fileName;
                    previewImage.style.display = "block";
                    previewImage.src = URL.createObjectURL(this.files[0]);
                    submitButton.disabled = false;
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Jenis File Tidak Diijinkan!",
                        text: "Anda hanya dapat mengimpor file dengan ekstensi .jpg, .jpeg, .png, atau .svg."
                    });
                    this.value = ''; // Clear the file input
                    selectedFileName.textContent = "Pilih File Foto";
                    previewImage.style.display = "none";
                    submitButton.disabled = true;
                }
            });
        });



