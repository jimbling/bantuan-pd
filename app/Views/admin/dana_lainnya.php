<?php echo view('template/header.php'); ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bantuan Siswa Miskin (BSM)</span>
                        <span class="info-box-number">
                            <h1><?= $jmlBSM ?></h1>
                        </span>
                    </div>
                </div>

            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">SIABAZKu | Baznas Kulon Progo</span>
                        <span class="info-box-number">
                            <h1><?= $jmlSiabazku ?></h1>
                        </span>
                    </div>

                </div>
            </div>


            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bantuan Lainnya</span>
                        <span class="info-box-number">
                            <h1><?= $jmlLainnya ?><h1>
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="clearfix hidden-md-up"></div>
    <div class="container-fluid">
        <div class="alert alert-warning" role="alert">
            Siswa yang sudah mengambil Dana di Bank, tidak dapat dihapus !
        </div>
    </div>

    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Siswa Penerima Bantuan Pendidikan Lainnya</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Pada halaman ini menampilkan dan mengelola data siswa yang menerima bantuan dana pendidikan selain dari PIP.
                    Bantuan pendidikan yang diperoleh bisa berupa BSM (Bantuan Siswa Miskin), SIABAZKu dari BAZNAS Kulon Progo, dan lainnya.
                </p>

                <div class="btn-group mr-2" role="group" aria-label="Second group">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDanaLainModal">
                        <i class='fas fa-sign-in-alt' style="margin-right: 10px;"></i>Tambah Data
                    </button>
                </div>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-body">
                <table id="DanaLainTable" class="table-bordered table-striped table-responsive table-sm">
                    <thead class="thead-grey" style="font-size: 14px;">
                        <tr>
                            <th width='3%'>No</th>
                            <th style="text-align: center;">Nama Siswa</th>
                            <th>NISN</th>
                            <th>Kelas</th>
                            <th>Nama Ibu</th>
                            <th>Tanggal SK</th>
                            <th>Jenis Bantuan</th>
                            <th>Informasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php
                        foreach ($dana_lain as $ssw) : ?>
                            <tr>
                                <th class="text-center" scope="row" style="font-size: 14px;"><?= $i++; ?></th>
                                <td style="text-align: left; font-size: 14px; text-transform: uppercase;">
                                    <?= $ssw['nama_pd']; ?>
                                </td>
                                <td width='10%' style="vertical-align: middle; font-size: 14px;"><?= $ssw['nisn']; ?></td>
                                <td width='5%' style="vertical-align: middle; font-size: 14px;">Kelas <?= $ssw['kelas']; ?></td>
                                <td width='15%' style="text-align: center; vertical-align: middle; font-size: 14px;"><?= $ssw['nama_ibu_kandung']; ?></td>

                                <?php
                                // Array untuk nama bulan dalam bahasa Indonesia
                                $bulanIndonesia = [
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember',
                                ];

                                // Ubah format tanggal ke format Indonesia
                                $tanggal_sk = date('d', strtotime($ssw['tanggal_sk'])); // Ambil hari
                                $bulan_sk = date('n', strtotime($ssw['tanggal_sk'])); // Ambil bulan (dalam format angka)
                                $tahun_sk = date('Y', strtotime($ssw['tanggal_sk'])); // Ambil tahun

                                // Buat tanggal dengan format Indonesia
                                $tanggalFormatIndonesia = $tanggal_sk . ' ' . $bulanIndonesia[$bulan_sk] . ' ' . $tahun_sk;
                                ?>

                                <td width='12%' style="vertical-align: middle; font-size: 14px;">
                                    <?= $tanggalFormatIndonesia; ?>
                                </td>

                                <td width='5%' style="text-align: center; vertical-align: middle; font-size: 14px;"><?= $ssw['jenis_bantuan']; ?></td>
                                <td style="text-align: left; vertical-align: middle; font-size: 14px;">
                                    <?= $ssw['informasi']; ?>
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
                                    <a onclick="ambil_bank('<?= $ssw['id']; ?>')" class="btn btn-xs btn-warning mx-auto <?= $ambilAktif ? '' : 'disabled'; ?>" id="btnAmbil" <?= $ambilAktif ? '' : 'disabled'; ?>>Ambil Dana</a>

                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-info btn-xs edit-btn <?= $ambilAktif ? '' : 'disabled'; ?>" onclick="openEditModal(<?= $ssw['id']; ?>)" <?= $ambilAktif ? '' : 'style="display: none;"'; ?>>Edit</button>


                                    <!-- Tombol Hapus -->
                                    <a onclick="hapus_data('<?= $ssw['id']; ?>')" class="btn btn-xs btn-danger mx-auto text-white <?= $ambilAktif ? '' : 'disabled'; ?>" id="button">Hapus</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>







    <div class="modal fade" id="addDanaLainModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Siswa Penerima Bantuan Lainnya</h5>
                </div>
                <div class="modal-body">
                    <form action="/danalain/simpan" method="post" id="formTambahPeserta">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= $csrfToken ?>">
                        <div class="form-group row">
                            <label for="nama_pd" class="col-sm-3 col-form-label">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_pd" name="nama_pd">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kelas">Kelas</label>
                                <select id="kelas" class="form-control" name="kelas">
                                    <option selected>Pilih kelas...</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                    <option value="4">Kelas 4</option>
                                    <option value="5">Kelas 5</option>
                                    <option value="6">Kelas 6</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Lahir</label>
                                <div class="input-group date" id="tanggalLahir" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="tanggal_lahir" data-target="#tanggalLahir" name="tanggal_lahir" />
                                    <div class="input-group-append" data-target="#tanggalLahir" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" class="form-control" name="jenis_kelamin">
                                    <option selected>Pilih jenis kelamin...</option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_ibu_kandung">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu_kandung" name="nama_ibu_kandung">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jenis_bantuan">Jenis Bantuan</label>
                                <select id="jenis_bantuan" class="form-control" name="jenis_bantuan">
                                    <option selected>Pilih jenis bantuan...</option>
                                    <option value="BSM">BSM</option>
                                    <option value="SIABAZKu">SIABAZKu</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tahap_id">Tahap</label>
                                <input type="text" class="form-control" id="tahap_id" name="tahap_id">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tanggal SK</label>
                                <div class="input-group date" id="tanggalSk" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="tanggal_sk" data-target="#tanggalSk" name="tanggal_sk" />
                                    <div class="input-group-append" data-target="#tanggalSk" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nomor_sk">Nomor SK</label>
                                <input type="text" class="form-control" id="nomor_sk" name="nomor_sk">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nama_rekening">Nama Bank</label>
                                <input type="text" class="form-control" id="nama_rekening" name="nama_rekening">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="no_rekening">No Rekening</label>
                                <input type="text" class="form-control" id="no_rekening" name="no_rekening">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nominal">Nominal</label>
                                <input type="text" class="form-control" id="nominal" name="nominal" oninput="validateNumberInput(this)">
                                <small class="text-danger" id="nominalError"></small>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="informasi" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="informasi" name="informasi"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal Edit Data -->
    <div class="modal fade" id="editDanaLainModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Siswa Penerima Bantuan Lainnya</h5>

                </div>
                <div class="modal-body">
                    <form action="/danalain/update" method="post" id="formEditPeserta">
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= $csrfToken ?>">
                        <!-- Ganti ID dan Name dengan ID yang sesuai dengan data yang ingin diisi -->
                        <div class="form-group row">
                            <label for="nama_pd_edit" class="col-sm-3 col-form-label">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_pd_edit" name="nama_pd_edit">
                            </div>
                        </div>
                        <!-- Ganti ID dan Name dengan ID yang sesuai dengan data yang ingin diisi -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nisn_edit">NISN</label>
                                <input type="text" class="form-control" id="nisn_edit" name="nisn_edit">
                            </div>
                            <!-- Ganti ID dan Name dengan ID yang sesuai dengan data yang ingin diisi -->
                            <div class="form-group col-md-6">
                                <label for="kelas_edit">Kelas</label>
                                <select id="kelas_edit" class="form-control" name="kelas_edit">
                                    <option selected>Pilih kelas...</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                    <option value="4">Kelas 4</option>
                                    <option value="5">Kelas 5</option>
                                    <option value="6">Kelas 6</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir_edit" name="tempat_lahir_edit">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Lahir</label>
                                <div class="input-group date" id="tanggalLahir" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="tanggalLahir_edit" data-target="#tanggalLahir_edit" name="tanggalLahir_edit" />
                                    <div class="input-group-append" data-target="#tanggalLahir_edit" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik_edit" name="nik_edit">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jenis_kelamin_edit">Jenis Kelamin</label>
                                <select id="jenis_kelamin_edit" class="form-control" name="jenis_kelamin_edit">
                                    <option selected>Pilih jenis kelamin...</option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_ayah_edit">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah_edit" name="nama_ayah_edit">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_ibu_kandung">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu_kandung_edit" name="nama_ibu_kandung_edit">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jenis_bantuan_edit">Jenis Bantuan</label>
                                <select id="jenis_bantuan_edit" class="form-control" name="jenis_bantuan_edit">
                                    <option selected>Pilih jenis bantuan...</option>
                                    <option value="BSM">BSM</option>
                                    <option value="SIABAZKu">SIABAZKu</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tahap_id">Tahap</label>
                                <input type="text" class="form-control" id="tahap_id_edit" name="tahap_id_edit">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tanggal SK</label>
                                <div class="input-group date" id="tanggalSk" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="tanggalSk_edit" data-target="#tanggalSk_edit" name="tanggalSk_edit" />
                                    <div class="input-group-append" data-target="#tanggalSk_edit" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nomor_sk">Nomor SK</label>
                                <input type="text" class="form-control" id="nomor_sk_edit" name="nomor_sk_edit">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nama_rekening">Nama Bank</label>
                                <input type="text" class="form-control" id="nama_rekening_edit" name="nama_rekening_edit">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="no_rekening_edit">No Rekening</label>
                                <input type="text" class="form-control" id="no_rekening_edit" name="no_rekening_edit">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nominal">Nominal</label>
                                <input type="text" class="form-control" id="nominal_edit" name="nominal_edit" oninput="validateNumberInput(this)">
                                <small class="text-danger" id="nominalError_edit"></small>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="informasi" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="informasi_edit" name="informasi_edit"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Edit Data -->

    <script src="../../assets/dist/js/dana-lainnya.js"></script>
    <?php echo view('template/footer.php'); ?>