$(function() {
  if (window.location.pathname === '/bantuan/pip') {
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
