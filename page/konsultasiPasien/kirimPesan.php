<?php
// Menghubungkan ke database
require '../../koneksi.php';

// Mengecek apakah metode HTTP yang digunakan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $id_dokter = $_POST['dokter']; // ID dokter yang dipilih
    $pesan = $_POST['pesan']; // Pesan konsultasi
    $id_pasien = $_SESSION['id_pasien']; // ID pasien (diasumsikan sudah disimpan di sesi)

    // Validasi data input
    if (empty($id_dokter) || empty($pesan)) {
        echo '<script>alert("Semua field harus diisi!");window.location.href="../../page/konsultasiPasien/";</script>';
        exit();
    }

    // Menyimpan data konsultasi ke database
    $query = "INSERT INTO konsultasi (id_pasien, id_dokter, pesan) 
              VALUES ('$id_pasien', '$id_dokter', '$pesan')";
    $result = mysqli_query($mysqli, $query);

    // Mengecek apakah data berhasil disimpan
    if ($result) {
        echo '<script>alert("Pesan berhasil dikirim!");window.location.href="../../page/konsultasiPasien/index.php";</script>';
    } else {
        echo '<script>alert("Gagal mengirim pesan! Silakan coba lagi.");window.location.href="../../page/konsultasiPasien/index.php";</script>';
    }
}
?>
