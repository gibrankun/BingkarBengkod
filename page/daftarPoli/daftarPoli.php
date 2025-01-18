<?php
// Menghubungkan ke database menggunakan file koneksi
require '../../koneksi.php';

// Jika metode HTTP yang digunakan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $no_rm = $_POST['no_rm']; // Nomor Rekam Medis
    $idJadwal = $_POST['jadwal']; // ID jadwal yang dipilih
    $keluhan = $_POST['keluhan']; // Keluhan pasien
    $noAntrian = 0; // Nomor antrian awal

    // Mengecek data pasien berdasarkan nomor rekam medis
    $cariPasien = "SELECT * FROM pasien WHERE no_rm = '$no_rm'";
    $query = mysqli_query($mysqli, $cariPasien);
    $data = mysqli_fetch_assoc($query);
    $idPasien = $data['id']; // Mengambil ID pasien dari hasil query

    // Mengecek data di tabel daftar_poli
    $cekData = "SELECT * FROM daftar_poli";
    $queryCekData = mysqli_query($mysqli, $cekData);

    // Jika data ada di tabel daftar_poli
    if (mysqli_num_rows($queryCekData) > 0) {
        // Mendapatkan nomor antrian terakhir berdasarkan jadwal yang dipilih
        $cekNoAntrian = "SELECT * FROM daftar_poli WHERE id_jadwal = '$idJadwal' ORDER BY no_antrian DESC LIMIT 1";
        $queryNoAntrian = mysqli_query($mysqli, $cekNoAntrian);
        $dataPoli = mysqli_fetch_assoc($queryNoAntrian);
        $antrianTerakhir = (int)$dataPoli['no_antrian']; // Nomor antrian terakhir
        $antrianBaru = $antrianTerakhir + 1; // Menambah nomor antrian baru

        // Memasukkan data baru ke tabel daftar_poli
        $daftarPoli = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian, status_periksa) 
                       VALUES ('$idPasien', '$idJadwal', '$keluhan', '$antrianBaru', '0')";
        $queryDaftarPoli = mysqli_query($mysqli, $daftarPoli);
        if ($queryDaftarPoli) {
            // Menampilkan pesan berhasil dan mengarahkan ke halaman daftar poliklinik
            echo '<script>alert("Berhasil mendaftar poli");window.location.href="../../daftarPoliklinik.php";</script>';
        } else {
            // Menampilkan pesan gagal
            echo '<script>alert("Gagal mendaftar poli");window.location.href="../../daftarPoliklinik.php";</script>';
        }
    } else {
        // Jika belum ada data, mulai dengan nomor antrian 1
        $noAntrian = 1;
        $daftarPoli = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian, status_periksa) 
                       VALUES ('$idPasien', '$idJadwal', '$keluhan', '$noAntrian', '0')";
        $queryDaftarPoli = mysqli_query($mysqli, $daftarPoli);
        if ($queryDaftarPoli) {
            // Menampilkan pesan berhasil
            echo '<script>alert("Berhasil mendaftar poli");window.location.href="../../daftarPoliklinik.php";</script>';
        } else {
            // Menampilkan pesan gagal
            echo '<script>alert("Gagal mendaftar poli");window.location.href="../../daftarPoliklinik.php";</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Poli</title>
    <!-- Menghubungkan file CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Memuat library jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Form Pendaftaran Poli</h1>
    <!-- Form pendaftaran -->
    <form action="daftarPoli.php" method="POST">
        <div class="form-group">
            <!-- Input untuk Nomor Rekam Medis -->
            <label for="no_rm">Nomor Rekam Medis</label>
            <input type="text" name="no_rm" id="no_rm" class="form-control" required>
        </div>
        <div class="form-group">
            <!-- Dropdown untuk memilih Poli -->
            <label for="poli">Poli</label>
            <select name="poli" id="poli" class="form-control" required>
                <option value="" disabled selected>Pilih Poli</option>
                <?php
                // Mengisi dropdown dengan data Poli
                while ($poli = mysqli_fetch_assoc($resultPoli)) {
                    echo '<option value="' . $poli['id'] . '">' . $poli['nama'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <!-- Dropdown untuk memilih jadwal -->
            <label for="jadwal">Jadwal Periksa</label>
            <select name="jadwal" id="jadwal" class="form-control" required>
                <option value="" disabled selected>Pilih Jadwal</option>
            </select>
        </div>
        <div class="form-group">
            <!-- Input keluhan pasien -->
            <label for="keluhan">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required></textarea>
        </div>
        <!-- Tombol untuk submit form -->
        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>

    <!-- Script jQuery untuk mengisi dropdown jadwal berdasarkan Poli -->
    <script>
        $(document).ready(function() {
            // Ketika dropdown Poli berubah
            $('#poli').change(function() {
                var poliId = $(this).val();
                if (poliId) {
                    // Mengambil data jadwal menggunakan AJAX
                    $.ajax({
                        url: 'getJadwal.php', // File tujuan untuk mendapatkan data jadwal
                        method: 'POST', // Metode HTTP
                        data: { poliId: poliId }, // Data yang dikirim
                        success: function(data) {
                            // Mengisi dropdown jadwal dengan data yang diterima
                            $('#jadwal').html(data);
                        }
                    });
                } else {
                    // Reset dropdown jadwal jika Poli tidak dipilih
                    $('#jadwal').html('<option value="" disabled selected>Pilih Jadwal</option>');
                }
            });
        });
    </script>
</body>
</html>