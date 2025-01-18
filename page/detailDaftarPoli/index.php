<?php
// Menghubungkan ke database menggunakan file koneksi
require 'koneksi.php';

// Mengambil ID dari parameter URL
$id = $_GET['id'];

// Query untuk mengambil detail periksa berdasarkan ID daftar_poli
$ambilDetail = mysqli_query($mysqli, "
    SELECT 
        dp.id AS idDetailPeriksa, -- ID detail periksa
        daftar_poli.id AS idDaftarPoli, -- ID daftar poli
        poli.nama_poli, -- Nama poli
        dokter.nama AS namaDokter, -- Nama dokter
        jadwal_periksa.hari, -- Hari jadwal periksa
        DATE_FORMAT(jadwal_periksa.jam_mulai, '%H:%i') AS jamMulai, -- Jam mulai periksa
        DATE_FORMAT(jadwal_periksa.jam_selesai, '%H:%i') AS jamSelesai, -- Jam selesai periksa
        daftar_poli.no_antrian, -- Nomor antrian pasien
        p.id AS idPeriksa, -- ID periksa
        p.tgl_periksa, -- Tanggal periksa
        p.catatan, -- Catatan pemeriksaan
        p.biaya_periksa, -- Biaya pemeriksaan
        GROUP_CONCAT(o.id) AS idObat, -- ID obat (jika ada) dalam bentuk string yang digabung
        GROUP_CONCAT(o.nama_obat SEPARATOR ', ') AS namaObat -- Nama obat yang digabung sebagai string
    FROM daftar_poli
    INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id -- Relasi dengan tabel jadwal periksa
    INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id -- Relasi dengan tabel dokter
    INNER JOIN poli ON dokter.id_poli = poli.id -- Relasi dengan tabel poli
    LEFT JOIN periksa p ON daftar_poli.id = p.id_daftar_poli -- Relasi opsional dengan tabel periksa
    LEFT JOIN detail_periksa dp ON p.id = dp.id_periksa -- Relasi opsional dengan tabel detail periksa
    LEFT JOIN obat o ON dp.id_obat = o.id -- Relasi opsional dengan tabel obat
    WHERE daftar_poli.id = '$id' -- Filter berdasarkan ID daftar poli
    GROUP BY daftar_poli.id -- Mengelompokkan hasil berdasarkan ID daftar poli
");

// Fetch data hasil query
$data = mysqli_fetch_assoc($ambilDetail);

// Jika data tidak ditemukan, tampilkan pesan dan kembali ke halaman sebelumnya
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href = 'daftarPoliklinik.php';</script>";
    exit;
}
?>

<!-- Tampilan detail periksa dalam bentuk card -->
<div class="card card-solid">
    <div class="card-body pb-0">
        <div class="row">
            <div class="col-12 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                    <!-- Header card -->
                    <div class="card-header text-muted border-bottom-0">
                        Detail Periksa
                    </div>
                    <!-- Body card -->
                    <div class="card-body pt-0">
                        <div class="row">
                            <!-- Bagian kiri card -->
                            <div class="col-7">
                                <!-- Nama dokter -->
                                <h2 class="lead"><b><?php echo htmlspecialchars($data['namaDokter']); ?></b></h2>
                                <!-- Informasi poli -->
                                <h6 class="text-muted text-lg">Poli: <?php echo htmlspecialchars($data['nama_poli']); ?></h6>
                                <!-- Informasi hari jadwal -->
                                <h6 class="text-muted text-lg">Hari: <?php echo htmlspecialchars($data['hari']); ?></h6>
                                <!-- Informasi jam periksa -->
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="large">
                                        <span class="fa-li"><i class="fas fa-lg fa-clock"></i></span>
                                        <?php echo htmlspecialchars($data['jamMulai']) . " - " . htmlspecialchars($data['jamSelesai']); ?>
                                    </li>
                                </ul>
                                <br>
                                <!-- Informasi obat -->
                                <p class="text-muted text-lg">
                                    Obat:<br>
                                    <?php
                                    if (!empty($data['namaObat'])) {
                                        // Menampilkan daftar obat jika tersedia
                                        $namaObatArray = explode(', ', $data['namaObat']);
                                        foreach ($namaObatArray as $index => $namaObat) {
                                            echo ($index + 1) . ". " . htmlspecialchars($namaObat) . "<br>";
                                        }
                                    } else {
                                        // Menampilkan pesan jika tidak ada obat
                                        echo "Tidak ada obat yang diresepkan.";
                                    }
                                    ?>
                                </p>
                                <!-- Informasi biaya periksa -->
                                <h5 class="text-muted text-lg">
                                    <strong>Biaya Periksa: <?php echo number_format($data['biaya_periksa'], 0, ',', '.'); ?> IDR</strong>
                                </h5>
                            </div>
                            <!-- Bagian kanan card -->
                            <div class="col-5 d-flex justify-content-center align-items-center flex-column">
                                <h2 class="lead"><b>No Antrian</b></h2>
                                <!-- Tampilan nomor antrian -->
                                <div class="rounded-lg d-flex justify-content-center align-items-center"
                                    style="height: 60px; width: 60px; background-color: #0284c7; color: white; padding-top: 6px;">
                                    <h1><?php echo htmlspecialchars($data['no_antrian']); ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer card -->
                    <div class="card-footer">
                        <div class="text-left">
                            <!-- Tombol kembali ke halaman daftar poliklinik -->
                            <a href="daftarPoliklinik.php" class="btn btn-md btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>