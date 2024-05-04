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
    <script src="../../assets/dist/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/dist/js/bantuan.pip.js"></script>
    <script>
        const baseUrl = '<?= base_url() ?>';
    </script>




    <?php echo view('template/footer.php'); ?>