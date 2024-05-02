<?php echo view('template/header.php'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= (session()->getFlashData('pesanAkun')); ?>"></div><!-- Page Heading -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>Data Satuan Pendidikan</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Data Satuan Pendidikan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">Atur Satuan Pendidikan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row-md-12">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-warning btn-icon-split btn-sm float-right" class="btn btn-secondary btn-icon-split btn-sm" id="editButton">
                                    <span class="icon text-white-100">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                    <span class="text">Edit Data</span>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-icon-split btn-sm" class="btn btn-secondary btn-icon-split btn-sm" id="updateButton">
                                    <span class="icon text-white-100">
                                        <i class="fas fa-sync-alt"></i>
                                    </span>
                                    <span class="text">Update Data</span>
                                </button>
                            </div>

                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger btn-icon-split btn-sm" class="btn btn-secondary btn-icon-split btn-sm" id="batalButton">
                                    <span class="icon text-white-100">
                                        <i class="fas fa-times-circle"></i>
                                    </span>
                                    <span class="text">Batal</span>
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="container">
                        <table class="table table-hover tabel-cetak table-borderless table-sm font">

                            <tbody>
                                <tr>

                                    <td>1. Satuan Pendidikan </td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control form-control-sm" id="nama_sp" name="nama_sp" value="<?php echo $dataCetak['nama_sp']; ?>" readonly></td>
                                </tr>
                                <tr>

                                    <td>2. NPSN </td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control form-control-sm" id="npsn" name="npsn" value="<?php echo $dataCetak['npsn']; ?>" readonly></td>
                                </tr>
                                <tr>

                                    <td>3. Dusun</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control form-control-sm" id="dusun_sp" name="dusun_sp" value="<?php echo $dataCetak['dusun_sp']; ?>" readonly></td>
                                </tr>
                                <tr>

                                    <td>4. Kapanewon </td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control form-control-sm" id="kapanewon_sp" name="kapanewon_sp" value="<?php echo $dataCetak['kapanewon_sp']; ?>" readonly></td>
                                </tr>
                                <tr>

                                    <td>5. Kabupaten </td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control form-control-sm" id="kabupaten_sp" name="kabupaten_sp" value="<?php echo $dataCetak['kabupaten_sp']; ?>" readonly></td>
                                </tr>
                                <tr>

                                    <td>6. Kepala Sekolah </td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control form-control-sm" id="nama_ks" name="nama_ks" value="<?php echo $dataCetak['nama_ks']; ?>" readonly></td>
                                </tr>
                                <tr>

                                    <td>7. NIP </td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control form-control-sm" id="nip_ks" name="nip_ks" value="<?php echo $dataCetak['nip_ks']; ?>" readonly></td>
                                </tr>
                                <tr>

                                    <td>8. Website </td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control form-control-sm" id="website" name="website" value="<?php echo $dataCetak['website']; ?>" readonly></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">Atur Kop Sekolah</h6>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/upload/kopsurat" enctype="multipart/form-data">
                            <!-- Form fields for other data -->
                            <div class="form-group row">
                                <label for="foto_siswa" class="col-sm-6 col-form-label">Upload file Kop Sekolah</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="ctk_kopsurat" id="customFile" required>
                                        <label class="custom-file-label" for="selectedFileName" id="selectedFileName">Pilih File Foto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid mb-3">
                                <img id="previewImage" src="#" alt="Preview Image" style="max-width: 100%; max-height: 200px; display: none;">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-block">Simpan Kop Sekolah</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">Tampilan Kop Sekolah</h6>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="col-sm-12">
                                <img src="../../assets/dist/img/kdrj/<?php echo $dataCetak['ctk_kopsurat']; ?>" class="img-fluid rounded align-center" alt="Tampilan Kop Sekolah">
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>



    <?php echo view('template/footer.php'); ?>


    <script>
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
    </script>

    <script>
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
            fetch('<?= base_url('/setting-sp/update') ?>', {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                    }
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
    </script>


    <script>
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
    </script>
    <script>
        const customFileInput = document.querySelector("#customFile");
        const previewImage = document.querySelector("#previewImage");

        customFileInput.addEventListener("change", function() {
            if (this.files.length > 0) {
                previewImage.style.display = "block";
            } else {
                previewImage.style.display = "none";
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert library -->

    <script>
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
    </script>