<?php echo view('template/header.php'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <div class="alert alert-warning" role="alert">
                Siswa yang sudah mengambil Dana di Bank, data tidak dapat dihapus !!
            </div>

        </div>

    </div>

    <div class="content">
        <div class="container-fluid">

            <div class="card row-12">
                <h5 class="card-header">Import Data Penerima PIP <i id="petunjukPopover" class='fas fa-bullhorn' data-trigger="focus"></i></h5>
                <div class="card-body">

                    <div class="btn-group col-mr-4" role="group" aria-label="Third group">
                        <a href="/download" class="btn btn-warning btn-sm"> <i class='fas fa-download' style="margin-right: 10px;"></i> Form Import</a>
                    </div>
                    <div class="btn-group col-mr-4" role="group" aria-label="Second group">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <i class='fas fa-upload' style="margin-right: 10px;"></i>Import Excel
                        </button>
                    </div>

                    <!-- <div class="btn-group col-mr-4" role="group" aria-label="Third group">
                        <a href="/siswa/export" class="btn btn-success btn-sm"> <i class='fas fa-download' style="margin-right: 10px;"></i></a>
                    </div> -->
                </div>
            </div>

            <form action="<?= base_url('bantuan/pip/filterData') ?>" method="get">
                <input type="hidden" name="csrf_token" value="<?= session()->get('csrf_token') ?>">
                <div class="col">
                    <div class="form-group row">
                        <label for="pilihTahun" class="col-sm-auto col-form-label">Pilih Tahun</label>
                        <div class="col-md-2">

                            <select class="custom-select custom-select" name="selectYear" id="selectYear">
                                <option value="">Semua</option>
                                <?php
                                // Menampilkan hasil tahun unik dalam opsi select
                                foreach ($uniqueYears as $year) {
                                    $selected = ($year['tahun'] == $selectedYear) ? 'selected' : '';
                                    echo "<option value='" . $year['tahun'] . "' $selected>" . $year['tahun'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <label for="pilihDana" class="col-sm-auto col-form-label">Pilih Dana</label>
                        <div class="col-md-2">
                            <select class="custom-select custom-select" name="selectDana">
                                <option value="">Semua</option>
                                <option value="Sudah diambil" <?= ($selectedDana == 'Sudah diambil') ? 'selected' : ''; ?>>Sudah diambil</option>
                                <option value="Belum diambil" <?= ($selectedDana == 'Belum diambil') ? 'selected' : ''; ?>>Belum diambil</option>
                            </select>
                        </div>

                        <label for="pilihTahap" class="col-sm-auto col-form-label">Pilih Tahap</label>
                        <div class="col-md-2">
                            <select class="custom-select custom-select" name="selectTahap" id="selectTahap">
                                <option value="">Semua</option>
                                <?php
                                foreach ($uniqueTahaps as $tahap) {
                                    $selected = ($tahap['tahap_id'] == $selectedTahap) ? 'selected' : '';
                                    echo "<option value='" . $tahap['tahap_id'] . "' $selected>" . $tahap['tahap_id'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                    <!-- <span class="small">Tahun Default adalah Tahun Berjalan </span> -->
                </div>
            </form>


            <div class="card card-primary card-outline">
                <div class="card-body">

                    <table class="table-bordered table-striped table-responsive table-sm">
                        <thead class="thead-grey" style="font-size: 14px;">
                            <tr style="text-align: center;">
                                <th width='3%'>No</th>
                                <th>Siswa</th>
                                <th>Tahap</th>
                                <th>Tanggal SK</th>
                                <th>No Rekening</th>
                                <th>Virtual Account</th>
                                <th>Nama Ibu</th>
                                <th>Informasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php
                            foreach ($siswa_pip as $ssw) : ?>
                                <tr>
                                    <th class="text-center" scope="row" style="font-size: 14px;"><?= $i++; ?></th>
                                    <td width='20%' style="text-align: left; font-size: 14px;">
                                        NISN: <span class="nisn"><?= $ssw['nisn']; ?></span> <i class='far fa-copy copyNISN' data-toggle="tooltip" data-placement="top" title="Copy NISN"></i>
                                        <br>
                                        <?= $ssw['nama_pd']; ?>

                                        <!-- Tambahkan kondisi untuk badge "Nominasi" -->
                                        <?php if ($ssw['sk'] == 'nominasi') : ?>
                                            <span class="badge badge-success">Nominasi</span>
                                        <?php endif; ?>

                                        <br>
                                        <?= $ssw['rombel']; ?>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?php if (!empty($ssw['buku_tabungan'])) : ?>
                                                    <!-- Jika kolom 'buku_tabungan' sudah berisi, tampilkan tombol Unduh -->
                                                    <a href="<?= base_url('pip/download_buku_tabungan/' . $ssw['buku_tabungan']); ?>" class="btn btn-success btn-xs btn-block"><i class='fas fa-download spaced-icon'></i>Unduh Buku</a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?php if (!empty($ssw['buku_tabungan'])) : ?>
                                                    <!-- Jika kolom 'buku_tabungan' sudah berisi, tampilkan tombol Hapus -->
                                                    <button class="btn btn-danger btn-xs btn-block" onclick="confirmDelete(<?= $ssw['id']; ?>)">
                                                        <i class="fa fa-trash spaced-icon"></i> Hapus Buku
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Tombol unggah di luar col-6 -->
                                        <div class="row">
                                            <div class="col-12">
                                                <?php if (empty($ssw['buku_tabungan'])) : ?>
                                                    <!-- Jika kolom 'buku_tabungan' masih kosong, tampilkan tombol Unggah -->
                                                    <form action="<?= base_url('/tabungan/unggah'); ?>" method="post" enctype="multipart/form-data">
                                                        <input type="file" name="buku_tabungan" accept=".pdf, .doc, .docx"> <!-- Accept only PDF, DOC, DOCX files -->
                                                        <input type="hidden" name="siswa_id" value="<?= $ssw['id']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger btn-block btn-xs" data-toggle="petunjukUnggah">Unggah Buku Tabungan</button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if (!empty($ssw['buku_tabungan'])) : ?>
                                            <form id="hapusBukuTabungan<?= $ssw['id']; ?>" action="<?= base_url('/tabungan/hapus_buku_tabungan'); ?>" method="post">
                                                <input type="hidden" name="siswa_id" value="<?= $ssw['id']; ?>">
                                            </form>
                                        <?php endif; ?>

                                    </td>



                                    <td width='5%' style="text-align: center; vertical-align: middle; font-size: 14px;"><?= $ssw['tahap_id']; ?></td>
                                    <td width='12%' style="vertical-align: middle; font-size: 14px;">
                                        <?php
                                        // Tanggal dari format database
                                        $tanggal_database = $ssw['tanggal_sk'];

                                        // Array nama bulan dalam bahasa Indonesia
                                        $bulan_indonesia = [
                                            'January' => 'Januari',
                                            'February' => 'Februari',
                                            'March' => 'Maret',
                                            'April' => 'April',
                                            'May' => 'Mei',
                                            'June' => 'Juni',
                                            'July' => 'Juli',
                                            'August' => 'Agustus',
                                            'September' => 'September',
                                            'October' => 'Oktober',
                                            'November' => 'November',
                                            'December' => 'Desember'
                                        ];

                                        // Konversi tanggal ke format Indonesia
                                        $tanggal_indonesia = date("d F Y", strtotime($tanggal_database));

                                        // Ganti nama bulan dalam bahasa Indonesia
                                        foreach ($bulan_indonesia as $english => $indonesia) {
                                            $tanggal_indonesia = str_replace($english, $indonesia, $tanggal_indonesia);
                                        }

                                        // Tampilkan tanggal dalam format Indonesia
                                        echo $tanggal_indonesia;
                                        ?>
                                    </td>

                                    <td style="text-align: center; vertical-align: middle; font-size: 14px;"><?= $ssw['no_rekening']; ?></td>
                                    <td style="text-align: center; vertical-align: middle; font-size: 14px;"><?= $ssw['virtual_acc']; ?></td>
                                    <td width='10%' style="vertical-align: middle; font-size: 14px;"><?= $ssw['nama_ibu_kandung']; ?></td>
                                    <td width='15%' style="vertical-align: middle; font-size: 14px;">
                                        Cetak Surat :
                                        <?php if ($ssw['jumlah_cetak'] == '0') : ?>
                                            <span class="badge badge-pill badge-danger"> Belum </span>
                                        <?php else : ?>
                                            <span class="badge badge-pill badge-success"> <?= $ssw['jumlah_cetak']; ?> kali</span>
                                        <?php endif; ?>

                                        <br>Ambil Dana :
                                        <?php if ($ssw['ambil_dibank'] == 'Belum diambil') : ?>
                                            <span class="badge badge-pill badge-warning"> <?= $ssw['ambil_dibank']; ?> </span>
                                        <?php elseif ($ssw['ambil_dibank'] == 'Sudah diambil') : ?>
                                            <span class="badge badge-pill badge-success"> <?= $ssw['ambil_dibank']; ?> </span>
                                        <?php else : ?>
                                            <span class="badge badge-pill badge-secondary"> <?= $ssw['ambil_dibank']; ?> </span>
                                        <?php endif; ?>
                                    </td>
                                    <td width='10%' class="text-center">
                                        <?php
                                        $ambilAktif = ($ssw['ambil_dibank'] == 'Belum diambil');
                                        ?>

                                        <!-- Tautan untuk mengarahkan ke halaman edit -->
                                        <a href="<?= base_url('/pip/edit/' . $ssw['id']); ?>" class="btn btn-xs btn-info mx-auto <?= $ambilAktif ? '' : 'disabled'; ?>" <?= $ambilAktif ? '' : 'disabled'; ?>>Edit</a>

                                        <!-- Tombol untuk mencetak surat -->
                                        <?php if ($ssw['sk'] == 'nominasi') : ?>
                                            <a href="<?= base_url('/siswapip/suket_aktivasi/' . $ssw['id']); ?>" id="btnCetak<?= $ssw['id']; ?>" class="btn btn-xs btn-success mx-auto" onclick="hitungCetak(<?= $ssw['id']; ?>)" target="_blank">Suket Aktivasi</a>
                                        <?php else : ?>
                                            <a href="<?= ('/siswapip/surat_keterangan/' . $ssw['id']); ?>" id="btnCetak<?= $ssw['id']; ?>" class="btn btn-xs btn-primary mx-auto" onclick="hitungCetak(<?= $ssw['id']; ?>)" target="_blank">Cetak Surat</a>
                                        <?php endif; ?>

                                        <!-- Tombol untuk mengambil -->
                                        <a onclick="ambil_bank('<?= $ssw['id']; ?>')" class="btn btn-xs btn-warning mx-auto <?= $ambilAktif ? '' : 'disabled'; ?>" id="btnAmbil" <?= $ambilAktif ? '' : 'disabled'; ?>>Ambil</i></a>

                                        <!-- Tombol untuk menghapus -->
                                        <a onclick="hapus_data('<?= $ssw['id']; ?>')" class="btn btn-xs btn-danger mx-auto text-white <?= $ambilAktif ? '' : 'disabled'; ?>" id="button">Hapus</a>
                                    </td>



                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>





    <!-- Modal untuk fasilitas upload -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Siswa Penerima PIP</h5>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="/siswa/importData" method="post" enctype="multipart/form-data" id="uploadForm">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="excel_file" aria-describedby="excel_file" name="excel_file">
                                    <label class="custom-file-label" for="excel_file">Pilih file Excel</label>
                                </div>
                            </div>
                            <span id="excel_file"></span>
                            <!-- Tambahkan elemen ini untuk menampilkan nama file -->
                            <span id="file_name_display"></span>
                        </form>

                        <div class="alert alert-info mt-3" role="alert">
                            <p><strong>Informasi</strong></p>
                            <p>Gunakan hanya file ber ekstensi <strong>.xls</strong> atau <strong>.xlsx </strong>. </p>
                            <p><span>Pastikan tidak ada kolom dengan nilai kosong, jika memang tidak ada isinya bisa diberikan tanda strip (-) </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="input-group-append">
                        <style>
                            button {
                                margin-right: 10px;
                                /* Atur jarak kanan antara tombol */
                            }
                        </style>
                        <button type="button" class="btn btn-warning mt-2" data-dismiss="modal"><i class='fas fa-reply-all' style="margin-right: 5px;"></i></i>Batal</button>
                        <button class="btn btn-outline-primary mt-2" type="button" id="importButton"><i class='fas fa-upload' style="margin-right: 5px;"></i> Impor</button>
                        <div class="spinner-container">
                            <div id="loading" class="spinner-border text-primary" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span id="processText" style="display: none;">Proses kirim data...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
    </script>

    <script>
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
    </script>


    <script>
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
    </script>

    <!-- Akhir untuk fasilitas upload -->

    <script>
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
    </script>

    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Script untuk mengganti opsi tahap_id berdasarkan tahun -->
    <script>
        $(document).ready(function() {
            // Fungsi untuk memperbarui opsi tahap_id berdasarkan tahun yang dipilih
            function updateTahapOptions(selectedYear) {
                // Periksa apakah tahun yang dipilih bukanlah string kosong
                if (selectedYear !== '') {
                    $.ajax({
                        type: 'GET',
                        url: '<?= base_url('/bantuan/pip/getTahapsByYear') ?>/' + selectedYear,
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
    </script>

    <script>
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
    </script>

    <script>
        $(document).ready(function() {
            $('#petunjukPopover').popover({
                trigger: 'hover',
                title: 'Petunjuk Import File',
                html: true,
                content: "Untuk memasukkan data penerima PIP hasil unduhan dari web <a href='https://pip.kemdikbud.go.id/home_v1' class='font-weight-bold' target='_blank'>pip.kemdikbud.go.id</a>, silahkan unggah file excelnya menggunakan fasilitas Import Excel dibawah ini.<br><br>Gunakan Form Import untuk melakukan copy-paste data dari hasil unduhan PIP ke dalam format excel yang akan diimport. Sebelum diimport, pastikan tidak ada isian yang kosong, jika memang kosong bisa diberi tanda strip &quot;-&quot;, dan sesuaikan data dengan judul kolom, pastikan tidak tertukar."
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="petunjukUnggah"]').popover({
                trigger: 'hover',
                title: 'Petunjuk Unggah File',
                html: true,
                content: "Unggah File Buku Tabungan, Halaman Identitas dan Halaman Mutasi Terakhir dengan Format .pdf dan Maksimal ukuran 150 KB"
            });
        });
    </script>

    <script>
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
    </script>

    <script>
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
    </script>

    <script>
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
    </script>




    <?php echo view('template/footer.php'); ?>