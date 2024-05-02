<?php echo view('template/header.php'); ?>

<div class="content-wrapper">

    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Rekapitulasi Peserta Didik Penerima Bantuan Dana Pendidikan</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Pada halaman ini, menampilkan data peserta didik yang telah menerima bantuan dana selama tahun berjalan. Untuk digunakan
                    sebagai arsip cetak sekolah.
                </p>


                <form method="get" action="<?= base_url('rekap'); ?>" id="rekapForm">
                    <div class="form-group row">
                        <label for="pilihTahap" class="col-sm-auto col-form-label">Pilih Tahun</label>
                        <div class="col-md-2">
                            <select class="form-control" name="tahun" id="tahun">
                                <?php
                                $currentYear = date('Y');
                                $startYear = 2023;

                                for ($year = $startYear; $year <= $currentYear; $year++) {
                                    echo '<option value="' . $year . '">' . $year . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success" id="lihatButton"><i class='fas fa-eye'></i></button>
                            <!-- Tombol "Cetak Surat" dengan target _blank -->
                            <button type="button" id="cetakSuratButton" class="btn btn-primary mx-auto" target="_blank">Cetak Rekap</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h6 class="m-0" id="tahunJudul">Rekap penerima dana PIP Tahun: <?= $tahun; ?></h6>
                    </div>
                    <div class="card-body">
                        <table id="rekapPipTable" class="table-bordered table-striped table-responsive table-sm">
                            <thead class="thead-grey" style="font-size: 14px;">
                                <tr>
                                    <th width='3%'>No</th>
                                    <th style="text-align: center;">Nama Siswa</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Tanggal SK</th>
                                    <th>Tahap</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($dataSiswaPip)) {
                                    echo '<tr><td colspan="6" style="text-align:center;">Tidak ada data yang ditampilkan, silahkan memilih tahun</td></tr>';
                                } else {
                                    $no = 1;
                                    foreach ($dataSiswaPip as $siswaPip) {
                                        echo '<tr>';
                                        echo '<td style="text-align:center; font-size: 14px;">' . $no++ . '</td>';
                                        echo '<td style="font-size: 14px;">' . $siswaPip['nama_pd'] . '</td>';
                                        echo '<td style="font-size: 14px;">' . $siswaPip['nisn'] . '</td>';
                                        echo '<td style="text-align:center; font-size: 14px;">' . $siswaPip['kelas'] . '</td>';
                                        echo '<td style="font-size: 14px;">' . $siswaPip['tanggal_sk'] . '</td>';
                                        echo '<td style="text-align:center; font-size: 14px;">' . $siswaPip['tahap_id'] . '</td>';

                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header bg-info">
                        <h6 class="m-0" id="tahunJudul">Rekap penerima dana Lainnya Tahun: <?= $tahun; ?></h6>
                    </div>
                    <div class="card-body">
                        <table id="rekapDanaLainTable" class="table-bordered table-striped table-responsive table-sm">
                            <thead class="thead-grey" style="font-size: 14px;">
                                <tr>
                                    <th width='3%'>No</th>
                                    <th style="text-align: center;">Nama Siswa</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Tanggal SK</th>
                                    <th>Tahap</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($dataSiswaDanalain)) {
                                    echo '<tr><td colspan="6" style="text-align:center;">Tidak ada data yang ditampilkan, silahkan memilih tahun</td></tr>';
                                } else {
                                    $no = 1;
                                    foreach ($dataSiswaDanalain as $siswa) {
                                        echo '<tr>';
                                        echo '<td style="text-align:center; font-size: 14px;">' . $no++ . '</td>';
                                        echo '<td style="font-size: 14px;">' . $siswa['nama_pd'] . '</td>';
                                        echo '<td style="font-size: 14px;">' . $siswa['nisn'] . '</td>';
                                        echo '<td style="text-align:center; font-size: 14px;">' . $siswa['kelas'] . '</td>';
                                        echo '<td style="font-size: 14px;">' . $siswa['tanggal_sk'] . '</td>';
                                        echo '<td style="text-align:center; font-size: 14px;">' . $siswa['tahap_id'] . '</td>';

                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>




    <?php echo view('template/footer.php'); ?>
    <script>
        $(function() {

            $('#rekapPipTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(function() {

            $('#rekapDanaLainTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        document.getElementById('tahun').addEventListener('change', function() {
            var selectedYear = this.value;
            document.getElementById('selectedYearLabel').innerText = 'Rekap penerima dana PIP Tahun : ' + selectedYear;
        });
    </script>

    <script>
        document.getElementById('cetakSuratButton').addEventListener('click', function() {
            // Ambil nilai tahun dari pilihan yang dipilih
            var selectedYear = document.getElementById('tahun').value;

            // Redirect ke halaman cetak dengan membuka tab baru dan menambahkan parameter tahun
            window.open('<?= base_url('rekapitulasi/'); ?>/' + selectedYear, '_blank');
        });
    </script>