function showLoading() {
  let timerInterval;
  Swal.fire({
    title: "Sedang memproses data ....",
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
      const b = Swal.getHtmlContainer().querySelector("b");
      timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft();
      }, 100);
    },
  });
}

function hideLoading() {
  Swal.close();
}

const flashData = $(".flash-data").data("flashdata");
if (flashData) {
  if (flashData === "Login gagal. Periksa Username dan Password anda.") {
    Swal.fire({
      title: "Gagal",
      text: flashData,
      icon: "error",
      confirmButtonText: "OK",
    });
  } else {
    Swal.fire({
      title: "Berhasil",
      text: flashData,
      icon: "success",
      confirmButtonText: "OK",
    });
  }
}

$(".tombol-hapus").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Anda akan menghapus data ini!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Hapus!",
  }).then((result) => {
    if (result.isConfirmed) {
      showLoading(); // Menampilkan indikator loading setelah pengguna mengkonfirmasi

      // Arahkan pengguna ke tautan penghapusan setelah konfirmasi
      document.location.href = href;
    }
  });
});
