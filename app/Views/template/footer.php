</div>

<?php

use App\Services\PengaturanService;

$pengaturanService = new PengaturanService();

// Mendapatkan nama kampus dan website
$data_pengaturan = $pengaturanService->getNamaSatdik();
$nama_sp = $data_pengaturan['nama_sp'];
$website = $data_pengaturan['website'];
?>

<footer class="main-footer">
    <strong>Copyright &copy; 2023-<?= $currentYear; ?> <a href="<?= $website; ?>" target="_blank"><?= $nama_sp; ?></a>.</strong>
    dibuat dengan <i class='fas fa-heart' style='font-size:13px;color:red'></i> by jimbling
</footer>







<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../../assets/dist/js/adminlte.min.js?v=3.2.0"></script>
<script src="../../assets/dist/sweet/sweetalert2.all.min.js"></script>
<script src="../../assets/dist/js/alert.js"></script>
<script src="../../assets/dist/sweet/myscript.js"></script>
<script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../../assets/plugins/moment/moment.min.js"></script>
<script src="../../assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../../assets/dist/js/datatabel.js"></script>
<script src="../../assets/dist/js/tanggalWaktu.js"></script>
<script src="../../assets/dist/js/keluar.js"></script>
<script src="../../assets/plugins/toastr/toastr.min.js"></script>
<script src="../../assets/plugins/chart.js/Chart.min.js"></script>
<script src="../../assets/dist/js/grafik.js"></script>
<script src="../../assets/dist/js/val-bantuanlainnya.js"></script>



<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
    $(function() {
        $('[data-toggle="popover"]').popover()
    })
</script>


</body>

</html>