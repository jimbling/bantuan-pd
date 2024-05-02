<?php echo view('template/header.php'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Edit Data Peserta Didik</h5>
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

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">

                <div class="card-body">
                    <form id=editSiswa action="/pip/update" method="post">
                        <input type="hidden" name="id" value="<?= $pip['id']; ?>">

                        <div class="form-group row">
                            <label for="nama_pd" class="col-sm-2 col-form-label">Nama Siswa:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_pd" name="nama_pd" value="<?= $pip['nama_pd']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $pip['tempat_lahir']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggalLahir_edit" class="col-sm-2 col-form-label">Tanggal Lahir: </label>
                            <div class="col-sm-2">
                                <?php
                                // Ubah format tanggal menjadi format Indonesia
                                $tanggalLahirIndonesia = date("d F Y", strtotime($pip['tanggal_lahir']));
                                ?>
                                <input type="text" class="form-control" value="<?= $tanggalLahirIndonesia; ?>" readonly>

                            </div>
                            <div class="col-sm-8">
                                <div class="input-group date" id="tanggalLahir" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#tanggalLahir" name="tanggal_lahir" id="tanggalLahir" placeholder="Ubah Tanggal Lahir">
                                    <div class="input-group-append" data-target="#tanggalLahir" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-calendar-plus"></i></div>
                                    </div>
                                </div>
                            </div>

                        </div>



                        <div class="form-group row">
                            <label for="nisn" class="col-sm-2 col-form-label">NISN:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $pip['nisn']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rombel" class="col-sm-2 col-form-label">Rombel:</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="rombel" style="width: 100%;">
                                    <option value="<?php echo $pip['rombel']; ?>" selected><?php echo $pip['rombel']; ?></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_rekening" class="col-sm-2 col-form-label">NO. Rekening:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="<?= $pip['no_rekening']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="virtual_acc" class="col-sm-2 col-form-label">Virtual Account:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="virtual_acc" name="virtual_acc" value="<?= $pip['virtual_acc']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_ayah" class="col-sm-2 col-form-label">Nama Ayah:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $pip['nama_ayah']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_ibu_kandung" class="col-sm-2 col-form-label">Nama Ibu:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_ibu_kandung" name="nama_ibu_kandung" value="<?= $pip['nama_ibu_kandung']; ?>">
                            </div>
                        </div>

                        <!-- Tambahkan elemen form lainnya di sini -->

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
                                <button type="button" class="btn btn-warning" onclick="window.location.href='/bantuan/pip'">Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <?php echo view('template/footer.php'); ?>


    <script src="../../assets/dist/js/jquery.validate.min.js"></script>
    <script>
        $(function() {
            let timerInterval; // Deklarasikan timerInterval di luar fungsi

            $.validator.setDefaults({
                submitHandler: function() {
                    showLoading(); // Tampilkan indikator loading saat data dikirim
                    sendFormData();
                }
            });
            $('#editSiswa').validate({
                rules: {
                    nama_pd: "required",
                    tempat_lahir: "required",
                    nisn: "required",
                    rombel: "required",
                    no_rekening: "required",
                    virtual_acc: "required",
                    nama_ayah: "required",
                    nama_ibu_kandung: "required",
                },
                messages: {
                    nama_pd: "Pilih Golongan Darah",
                    tempat_lahir: "Isikan penyakit yang pernah diderita",
                    nisn: "Isikan tinggi badan (cm)",
                    rombel: "Isikan berat badan (kg)",
                    no_rekening: "Isikan lingkar kepala (cm)"
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.next('.text-muted').html(error).css('font-size', '20px');
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            function sendFormData() {
                var formData = new FormData(document.getElementById("editSiswa"));
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/pip/update", true);
                xhr.onload = function() {
                    hideLoading(); // Sembunyikan indikator loading setelah pengiriman selesai
                    if (xhr.status === 200) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data siswa baru diubah',
                            icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/bantuan/pip';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Ada kesalahan dalam menyimpan data siswa.',
                            icon: 'error'
                        });
                    }
                };
                xhr.send(formData);
            }

            function showLoading() {
                Swal.fire({
                    title: 'Sedang memproses data ....',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const b = Swal.getHtmlContainer().querySelector('b');
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft();
                        }, 100);
                    }
                });
            }

            function hideLoading() {
                clearInterval(timerInterval); // Hentikan interval penghitung waktu
                Swal.close();
            }
        });
    </script>