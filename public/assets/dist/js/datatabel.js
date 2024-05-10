$(function() {
    if (window.location.pathname === '/bantuan/pip') {
    var table = $('#BantuanPipTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    // Fungsi untuk menginisialisasi tooltips
    function initTooltips() {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // Panggil fungsi initTooltips saat tabel di-*draw* ulang
    table.on('draw.dt', function() {
        initTooltips();
    });

    // Inisialisasi tooltips pertama kali
    initTooltips();
}
  if (window.location.pathname === '/bantuan/pip/filterData') {
      $('#BantuanPipTable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "responsive": true,
      });
  }
  if (window.location.pathname === '/bantuan/lainnya') {
      $('#DanaLainTable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
      });
  }
  if (window.location.pathname === '/surat/suket_wali') {
    $('#datatables-siswa-cetak').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,

    });

}


});
