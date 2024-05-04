
        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.getElementById("excel_file");
            const importButton = document.getElementById("importButton");
            const loading = document.getElementById("loading");
            const processText = document.getElementById("processText"); // Teks "Proses kirim data..."
            const fileNameDisplay = document.getElementById("file_name_display"); // Menambahkan elemen untuk menampilkan nama file

            fileInput.addEventListener("change", function() {
                if (fileInput.files.length > 0) {
                    // Menampilkan nama file yang dipilih dalam elemen label
                    fileNameDisplay.textContent = `File terpilih: ${fileInput.files[0].name}`;
                } else {
                    // Mengosongkan teks elemen label jika tidak ada file yang dipilih
                    fileNameDisplay.textContent = "";
                }
            });

            importButton.addEventListener("click", function() {
                if (fileInput.files.length > 0) {
                    const allowedFileTypes = ["application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
                    const selectedFileType = fileInput.files[0].type;

                    if (allowedFileTypes.includes(selectedFileType)) {
                        // Jenis file diijinkan, lanjutkan dengan pengiriman
                        loading.style.display = "inline-block"; // Menampilkan spinner
                        processText.style.display = "inline-block"; // Menampilkan teks "Proses kirim data..."

                        const formData = new FormData();
                        formData.append("excel_file", fileInput.files[0]);
                        // Set teks pada elemen dengan ID "file_name_display"

                        const fileNameDisplay = document.getElementById("excel_file");
                        fileNameDisplay.textContent = `File terpilih: ${fileInput.files[0].name}`;

                        fetch("/siswapip/importData", {
                                method: "POST",
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data); // Tampilkan data JSON ke dalam konsol
                                loading.style.display = "none"; // Menyembunyikan spinner
                                processText.style.display = "none"; // Menyembunyikan teks "Proses kirim data..."

                                if (data.status === "success") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "File Berhasil Diimpor!",
                                        text: data.message,
                                        timer: 5000, // Durasi tampilan dalam milidetik (misalnya, 5000 milidetik = 5 detik)
                                        showConfirmButton: false, // Sembunyikan tombol OK (jika tidak diinginkan)
                                    }).then(() => {
                                        // Refresh halaman setelah pengguna menutup SweetAlert
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Gagal Impor File!",
                                        text: data.message,
                                        timer: 5000, // Durasi tampilan dalam milidetik (misalnya, 5000 milidetik = 5 detik)
                                        showConfirmButton: false, // Sembunyikan tombol OK (jika tidak diinginkan)
                                    });
                                }
                            })
                            .catch(error => {
                                loading.style.display = "none"; // Menyembunyikan spinner
                                processText.style.display = "none"; // Menyembunyikan teks "Proses kirim data..."
                                console.error(error);

                                // Tampilkan pesan kesalahan kustom
                                Swal.fire({
                                    icon: "error",
                                    title: "Terjadi Kesalahan!",
                                    text: "Terjadi kesalahan saat mengimpor file. Pastikan file yang Anda unggah adalah file Excel yang valid.",
                                });
                            });

                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Jenis File Tidak Diijinkan!",
                            text: "Anda hanya dapat mengimpor file dengan format XLS atau XLSX.",
                        });
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "File Belum Dipilih!",
                        text: "Anda harus memilih file terlebih dahulu sebelum mengimpor.",
                    });
                }
            });
        });

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
                        url: '/siswapip/ambilbank/' + data_id,
                        success: function(response) {
                            // Sembunyikan pesan loading saat permintaan selesai
                            hideLoading();

                            // Nonaktifkan tombol Ambil
                            $('#btnAmbil').prop('disabled', true);

                            // Tampilkan SweetAlert sukses dengan timer 5000 milidetik (5 detik)
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Dana PIP sudah diambil Siswa.',
                                icon: 'success',
                                timer: 2000, // Durasi tampilan dalam milidetik (misalnya, 5000 milidetik = 5 detik)
                                showConfirmButton: false, // Sembunyikan tombol OK (jika tidak diinginkan)
                            }).then(() => {
                                // Arahkan pengguna ke halaman baru setelah SweetAlert ditutup
                                window.location.replace("/bantuan/pip");
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
                        url: '/siswapip/hapus/' + data_id, // Ganti URL sesuai dengan URL yang benar
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
                                window.location.replace("/bantuan/pip");
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

        var jumlahKlik = {};

        function hitungCetak(id) {
            if (!jumlahKlik[id]) {
                jumlahKlik[id] = 1;
            } else {
                jumlahKlik[id]++;
            }

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                type: "POST",
                url: "/siswapip/suket/hitung-cetak/" + id,
                data: {
                    jumlahKlik: jumlahKlik[id]
                },
                dataType: "json",
                success: function(response) {
                    // Respon dari server (jika diperlukan)
                    console.log(response);
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });

            // Tampilkan jumlah klik (opsional)
            console.log("Button Cetak dengan ID " + id + " telah diklik sebanyak " + jumlahKlik[id] + " kali.");
        }



        $(document).ready(function() {
            // Fungsi untuk memperbarui opsi tahap_id berdasarkan tahun yang dipilih
            function updateTahapOptions(selectedYear) {
                // Periksa apakah tahun yang dipilih bukanlah string kosong
                if (selectedYear !== '') {
                  $.ajax({
                  type: 'GET',
                  url: baseUrl + '/bantuan/pip/getTahapsByYear/' + selectedYear,
                  dataType: 'json',
                  success: function(data) {
                      // Menghapus opsi tahap_id yang ada
                      $('#selectTahap').empty();

                      // Menambahkan opsi baru berdasarkan data yang diterima dari server
                      $('#selectTahap').append('<option value="">Semua</option>');
                      $.each(data, function(key, value) {
                          $('#selectTahap').append('<option value="' + value.tahap_id + '">' + value.tahap_id + '</option>');
                      });
                  }
              });
                }
            }

            // Event handler ketika tahun dipilih
            $('#selectYear').change(function() {
                // Mendapatkan nilai tahun yang dipilih
                var selectedYear = $(this).val();

                // Memperbarui opsi tahap_id sesuai dengan tahun yang dipilih
                updateTahapOptions(selectedYear);
            });

            // Otomatis memanggil event change saat halaman dimuat untuk mengisi dropdown tahap sesuai tahun awal
            $('#selectYear').change();
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('copyNISN')) {
                var nisnElement = event.target.closest('td').querySelector('.nisn');
                var nisn = nisnElement.innerText;

                var tempInput = document.createElement('input');
                tempInput.value = nisn;
                document.body.appendChild(tempInput);

                tempInput.select();
                document.execCommand('copy');

                document.body.removeChild(tempInput);

                // Tampilkan pesan ToastR
                toastr.success('NISN telah disalin: ' + nisn);
            }
        });

        $(document).ready(function() {
            $('#petunjukPopover').popover({
                trigger: 'hover',
                title: 'Petunjuk Import File',
                html: true,
                content: "Untuk memasukkan data penerima PIP hasil unduhan dari web <a href='https://pip.kemdikbud.go.id/home_v1' class='font-weight-bold' target='_blank'>pip.kemdikbud.go.id</a>, silahkan unggah file excelnya menggunakan fasilitas Import Excel dibawah ini.<br><br>Gunakan Form Import untuk melakukan copy-paste data dari hasil unduhan PIP ke dalam format excel yang akan diimport. Sebelum diimport, pastikan tidak ada isian yang kosong, jika memang kosong bisa diberi tanda strip &quot;-&quot;, dan sesuaikan data dengan judul kolom, pastikan tidak tertukar."
            });
        });

        $(document).ready(function() {
            $('[data-toggle="petunjukUnggah"]').popover({
                trigger: 'hover',
                title: 'Petunjuk Unggah File',
                html: true,
                content: "Unggah File Buku Tabungan, Halaman Identitas dan Halaman Mutasi Terakhir dengan Format .pdf dan Maksimal ukuran 150 KB"
            });
        });

        $(document).ready(function() {
            // Inisialisasi DataTables
            var table = $('.table-bordered').DataTable({
                responsive: true,
                ordering: false
            });

            // Set ulang tooltips setiap kali tabel dirender ulang
            table.on('draw.dt', function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        });

        $(document).ready(function() {
            // Inisialisasi DataTables jika belum diinisialisasi sebelumnya
            if (!$.fn.DataTable.isDataTable('.table-bordered')) {
                var table = $('.table-bordered').DataTable({
                    responsive: true,
                    ordering: false
                });
            }

            // Fungsi untuk melakukan validasi setiap kali tabel digambar ulang
            function validateFileUpload() {
                $('form').submit(function(e) {
                    var fileSize = this.buku_tabungan.files[0].size; // Ukuran file dalam bytes
                    var fileExtension = this.buku_tabungan.files[0].name.split('.').pop().toLowerCase();

                    if (fileSize > 150 * 1024) { // 150 KB dalam bytes
                        e.preventDefault(); // Mencegah pengiriman formulir
                        Swal.fire({
                            icon: 'error',
                            title: 'Maaf...',
                            text: 'Ukuran file melebihi batas maksimum (150 KB)!',
                        });
                    } else if (fileExtension !== 'pdf') {
                        e.preventDefault(); // Mencegah pengiriman formulir
                        Swal.fire({
                            icon: 'error',
                            title: 'Maaf...',
                            text: 'Hanya file .pdf yang diijinkan!',
                        });
                    }
                });
            }

            // Memanggil fungsi validateFileUpload saat tabel digambar ulang
            $('.table-bordered').on('draw.dt', function() {
                validateFileUpload();
            });

            // Memanggil fungsi validateFileUpload untuk pertama kali
            validateFileUpload();
        });
        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus buku tabungan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna menekan tombol "OK", submit form untuk menghapus buku tabungan
                    document.querySelector('form#hapusBukuTabungan' + id).submit();
                }
            });
        }
