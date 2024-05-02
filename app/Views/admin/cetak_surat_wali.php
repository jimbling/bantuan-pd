<?php echo view('template/header.php'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= (session()->getFlashData('pesanAkun')); ?>"></div><!-- Page Heading -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>Surat Keterangan Pengambilan PIP oleh Wali</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Surat Keterangan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-md-4 col-xs-4 col-lg-4">
                <div class="card card-primary">
                    <div class="card-header">
                        Data Wali Peserta Didik
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" id="form-cetak-keterangan-wali">
                            <input type="hidden" id="selectedSiswaId" name="selectedSiswaId" value="">
                            <div class="form-group">
                                <label for="nama_wali">Nama Wali</label>
                                <input type="text" id="nama_wali" name="nama_wali" class="form-control input-sm required" required="" />
                            </div>
                            <div class="form-group">
                                <label for="alamat_wali">Alamat Wali</label>
                                <input type="text" id="alamat_wali" name="alamat_wali" class="form-control input-sm required" required="" />
                            </div>
                            <div class="form-group">
                                <label for="hubungan_pd">Hubungan dengan PD</label>
                                <input type="text" id="hubungan_pd" name="hubungan_pd" class="form-control input-sm required" required="" />
                            </div>

                            <button type="submit" class="btn btn-primary" target="_blank">Cetak</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-8 col-lg-8">
                <div class="card card-info">
                    <div class="card-header">
                        Data Siswa
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('/surat/suket_wali') ?>" method="get" id="filterForm">
                            <input type="hidden" name="csrf_token" value="<?= session()->get('csrf_token') ?>">
                            <div class="col">
                                <div class="form-group row">
                                    <label for="pilihTahun" class="col-sm-auto col-form-label">Pilih Tahun</label>
                                    <div class="col-md-2">
                                        <select class="custom-select custom-select" name="selectYear" id="selectYear">
                                            <option value="">Semua</option>
                                            <?php foreach ($uniqueYears as $year) : ?>
                                                <?php $selected = ($year['tahun'] == $selectedYear) ? 'selected' : ''; ?>
                                                <option value="<?= $year['tahun'] ?>" <?= $selected ?>><?= $year['tahun'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table" id="datatables-siswa-cetak" width="100%">
                            <thead>
                                <tr style="text-align: center; vertical-align: middle; font-size: 13px;">
                                    <th>Pilih</th>
                                    <th>NO</th>
                                    <th>NISN</th>
                                    <th>Siswa</th>
                                    <th>Nama Ibu</th>
                                    <th>Kelas</th>
                                    <th>Tanggal SK</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($siswa_pip as $ssw) : ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <input type="radio" name="selectedSiswa" value="<?= $ssw['id'] ?>">
                                        </td>
                                        <th class="text-center" scope="row" style="font-size: 13px;"><?= $i++; ?></th>
                                        <td style="text-align: center; vertical-align: middle; font-size: 13px;"><?= $ssw['nisn']; ?></td>
                                        <td style="text-align: center; vertical-align: middle; font-size: 13px;"><?= $ssw['nama_pd']; ?></td>
                                        <td style="text-align: center; vertical-align: middle; font-size: 13px;"><?= $ssw['nama_ibu_kandung']; ?></td>
                                        <td style="text-align: center; vertical-align: middle; font-size: 13px;"><?= $ssw['kelas']; ?></td>
                                        <td style="text-align: center; vertical-align: middle; font-size: 13px;"><?= $ssw['tanggal_sk']; ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>






    <?php echo view('template/footer.php'); ?>
    <script>
        $(document).ready(function() {
            $('#form-cetak-keterangan-wali').submit(function(event) {
                event.preventDefault();

                var selectedSiswaId = $('input[name="selectedSiswa"]:checked').val();
                var namaWali = $('#nama_wali').val();
                var alamatWali = $('#alamat_wali').val();
                var hubunganPd = $('#hubungan_pd').val();

                if (!selectedSiswaId) {
                    alert('Silakan pilih siswa terlebih dahulu.');
                    return;
                }

                // Mengarahkan pengguna ke halaman baru dengan membawa data sebagai parameter URL
                window.location.href = "<?= base_url('/siswapip/cetaksuketWali/') . '/' ?>" + selectedSiswaId +
                    "?nama_wali=" + encodeURIComponent(namaWali) +
                    "&alamat_wali=" + encodeURIComponent(alamatWali) +
                    "&hubungan_pd=" + encodeURIComponent(hubunganPd);
            });
        });
    </script>