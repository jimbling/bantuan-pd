$(document).ready(function() {
  // Tangkap klik pada ikon power-off
  $('.nav-items').click(function(e) {
      e.preventDefault(); // Menghentikan tindakan default link

      // Tampilkan SweetAlert konfirmasi
      Swal.fire({
          title: 'Konfirmasi',
          text: 'Apakah Anda yakin ingin keluar?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
      }).then((result) => {
          // Jika pengguna menekan tombol 'Ya', arahkan ke link keluar
          if (result.isConfirmed) {
              window.location.href = '/masuk/keluar';
          }
      });
  });
});
