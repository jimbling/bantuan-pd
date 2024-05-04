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

                <div class="card shadow">
                    <div class="card-header py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">Setting Akun</h6>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped text-gray-900" id="penggunaTabel" width="100%" cellspacing="0">
                                    <thead class="text-gray-900 thead-dark">
                                        <tr>
                                            <th>Nama Pengguna</th>
                                            <th>username</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($set_pengguna as $akun) : ?>
                                            <tr>
                                                <td class="text-left"><?= $akun['nama']; ?></td>

                                                <td><?= $akun['username']; ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-xs btn-primary mx-auto text-white" id="edit-button-<?= $akun['id']; ?>" data-toggle="modal" data-target="#editModal<?= $akun['id']; ?>" data-id="<?= $akun['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                                                    <!-- Tambah modal untuk edit di sini -->
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

    <?php foreach ($set_pengguna as $akun) : ?>
        <!-- Modal untuk edit -->
        <div class="modal fade" id="editModal<?= $akun['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $akun['id']; ?>" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel<?= $akun['id']; ?>">Edit Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editAKun" method="post" action="/data/akun/update">

                            <div class="form-group row">
                                <label for="editNama" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editNama" name="nama" value="<?= $akun['nama']; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="editUserNama" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editUserNama" name="username" value="<?= $akun['username']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="editUserPass" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editUserPass" name="password">
                                </div>
                            </div>
                            <input type="hidden" id="akunId" name="id" value="<?= $akun['id']; ?>">
                            <button type="submit" class="btn btn-primary btn-sm" onclick="simpan_editAkun()">Simpan</button>

                        </form>



                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php echo view('template/footer.php'); ?>
    <script src="../../assets/dist/js/atur.js"></script>

    <script>
        const baseUrl = '<?= base_url() ?>';
    </script>