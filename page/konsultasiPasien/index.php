<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Konsultasi</h1>
            </div>
            <div class="col-sm-6">
                <!-- Breadcrumb navigasi -->
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Konsultasi</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Bagian utama konten -->
<section class="content">
    <div class="row">
        <!-- Kolom pertama: Form konsultasi dengan dokter -->
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Konsultasi Dokter</h3>
                </div>
                <div class="card-body">
                    <!-- Form konsultasi -->
                    <form action="page/konsultasiPasien/kirimPesan.php" method="post">
                        <!-- Dropdown untuk memilih Dokter -->
                        <div class="form-group">
                            <label for="dokter">Pilih Dokter</label>
                            <select class="form-control" id="dokter" name="dokter" required>
                                <option value="" disabled selected>Pilih Dokter</option>
                                <?php
                                // Mengambil data dokter dari database
                                require 'koneksi.php';
                                $query = "SELECT * FROM dokter";
                                $result = mysqli_query($mysqli, $query);
                                while ($dataDokter = mysqli_fetch_assoc($result)) {
                                ?>
                                    <!-- Menampilkan data Dokter dalam dropdown -->
                                    <option value="<?php echo $dataDokter['id'] ?>">
                                        <?php echo $dataDokter['nama'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Masukkan subject" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="pesan">Pesan</label>
                            <textarea class="form-control" rows="3" id="pesan" name="pesan" required></textarea>
                        </div>
                        <!-- Tombol untuk submit form -->
                        <button type="submit" class="btn btn-block btn-primary">
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kolom kedua: Tabel daftar konsultasi -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Konsultasi</h3>
                </div>
                <div class="card-body">
                    <!-- Tabel untuk menampilkan data konsultasi -->
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Konsultasi</th>
                                <th>Nama Dokter</th>
                                <th>Subject</th>
                                <th>Pertanyaan</th>
                                <th>Tanggapan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'koneksi.php';
                            
                            // Pastikan sesi berisi id_pasien
                            if (!isset($_SESSION['id_pasien'])) {
                                exit;
                            }
                            
                            $idPasien = $_SESSION['id_pasien'];

                            $query = "
                                SELECT 
                                    konsultasi.id AS idKonsultasi,
                                    dokter.nama AS namaDokter,
                                    konsultasi.subject,
                                    konsultasi.pesan,
                                    konsultasi.jawaban,
                                    konsultasi.tanggal_kirim
                                FROM konsultasi
                                INNER JOIN dokter ON konsultasi.id_dokter = dokter.id
                                WHERE konsultasi.id_pasien = '{$_SESSION['id_pasien']}'
                                ORDER BY konsultasi.tanggal_kirim DESC";
                            $result = mysqli_query($mysqli, $query);

                            // Loop untuk menampilkan data pada tabel
                            while ($data = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $data['tanggal_kirim']; ?></td>
                                    <td><?php echo $data['namaDokter']; ?></td>
                                    <td><?php echo $data['subject']; ?></td>
                                    <td><?php echo $data['pesan']; ?></td>
                                    <td><?php echo $data['jawaban'] ?? 'Belum dijawab'; ?></td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="editKonsultasi.php?id=<?php echo $data['idKonsultasi']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <!-- Tombol Delete -->
                                        <a href="hapusKonsultasi.php?id=<?php echo $data['idKonsultasi']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus konsultasi ini?');">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
