<?php
// Menyertakan file koneksi untuk menghubungkan dengan database
include '../../koneksi.php';

// Memulai sesi untuk mengambil data sesi
session_start();

// Mengecek apakah form disubmit menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
    $idPoli = $_SESSION['id_poli']; // Mengambil id poli dari sesi yang sudah diset sebelumnya
    $idDokter = $_SESSION['id']; // Mengambil id dokter dari sesi yang sudah diset sebelumnya
    $hari = $_POST["hari"]; // Mengambil nilai hari dari form
    $jamMulai = $_POST["jamMulai"]; // Mengambil nilai jam mulai dari form
    $jamSelesai = $_POST["jamSelesai"]; // Mengambil nilai jam selesai dari form

    // Query untuk memeriksa apakah ada jadwal yang tumpang tindih pada hari yang sama untuk dokter ini
    //$queryOverlap = "SELECT * FROM jadwal_periksa INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id INNER JOIN poli ON dokter.id_poli = poli.id WHERE id_poli = '$idPoli' AND hari = '$hari' AND ((jam_mulai < '$jamSelesai' AND jam_selesai > '$jamMulai') OR (jam_mulai < '$jamMulai' AND jam_selesai > '$jamMulai'))";

    // Query untuk memeriksa apakah dokter yang sama sudah memiliki jadwal pada hari tersebut
    $queryOverlap = "SELECT * FROM jadwal_periksa INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id INNER JOIN poli ON dokter.id_poli = poli.id WHERE id_poli = '$idPoli' AND hari = '$hari' AND id_dokter='$idDokter'";

    // Menjalankan query untuk cek apakah jadwal tumpang tindih
    $resultOverlap = mysqli_query($mysqli,$queryOverlap);
    
    // Mengecek apakah ada jadwal yang tumpang tindih
    if (mysqli_num_rows($resultOverlap)>0) {
        // Jika ada jadwal yang tumpang tindih, tampilkan pesan peringatan dan redirect ke halaman jadwalPeriksa.php
        echo '<script>alert("Dokter lain telah mengambil jadwal ini");window.location.href="../../jadwalPeriksa.php";</script>';
    }
    else{
        // Jika tidak ada jadwal yang tumpang tindih, lanjutkan dengan menambahkan jadwal baru ke database
        $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES ('$idDokter', '$hari', '$jamMulai', '$jamSelesai')";

        // Eksekusi query untuk menambahkan data jadwal ke database
        if (mysqli_query($mysqli, $query)) {
            // Jika berhasil menambahkan jadwal, tampilkan pesan berhasil dan redirect kembali ke halaman jadwalPeriksa.php
            echo '<script>';
            echo 'alert("Jadwal berhasil ditambahkan!");';
            echo 'window.location.href = "../../jadwalPeriksa.php";';
            echo '</script>';
            exit();
        } else {
            // Jika gagal, tampilkan pesan error
            echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
        }
    }
}

// Menutup koneksi ke database setelah proses selesai
mysqli_close($mysqli);
?>