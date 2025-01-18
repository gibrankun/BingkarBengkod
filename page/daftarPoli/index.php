<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- Judul halaman -->
                <h1>Daftar Poli</h1>
            </div>
            <div class="col-sm-6">
                <!-- Breadcrumb navigasi -->
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Poli</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Bagian utama konten -->
<section class="content">
    <div class="row">
        <!-- Kolom pertama: Form pendaftaran poli -->
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Daftar Poli</h3>
                </div>
                <div class="card-body">
                    <!-- Form pendaftaran -->
                    <form action="page/daftarPoli/daftarPoli.php" method="post">
                        <!-- Input Nomor Rekam Medis -->
                        <div class="form-group mb-3">
                            <label for="no_rm font-weight-bold">No Rekam Medis</label>
                            <input type="text" class="form-control" name="no_rm"
                                value="<?php echo $_SESSION['no_rm'] ?>" readonly required>
                        </div>
                        <!-- Dropdown untuk memilih Poli -->
                        <div class="form-group">
                            <label for="poli">Pilih Poli</label>
                            <select class="form-control" id="poli" name="poli" required>
                                <option value="" disabled selected>Pilih Poli</option>
                                <?php
                                // Mengambil data Poli dari database
                                require 'koneksi.php';
                                $query = "SELECT * FROM poli";
                                $result = mysqli_query($mysqli, $query);
                                while ($dataPoli = mysqli_fetch_assoc($result)) {
                                ?>
                                    <!-- Menampilkan data Poli dalam dropdown -->
                                    <option value="<?php echo $dataPoli['id'] ?>">
                                        <?php echo $dataPoli['nama_poli'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Dropdown untuk memilih jadwal berdasarkan Poli -->
                        <div class="form-group mb-3">
                            <label for="no_rm font-weight-bold">Pilih Jadwal</label>
                            <select class="form-control" id="jadwal" name="jadwal" required>
                                <!-- Data jadwal akan dimuat menggunakan AJAX -->
                            </select>
                        </div>
                        <!-- Input keluhan pasien -->
                        <div class="form-group mb-3">
                            <label for="keluhan">Keluhan</label>
                            <textarea class="form-control" rows="3" id="keluhan" name="keluhan" required></textarea>
                        </div>
                        <!-- Tombol untuk submit form -->
                        <button type="submit" class="btn btn-block btn-primary">
                            Daftar
                        </button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!-- Kolom kedua: Riwayat daftar Poli -->
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Daftar Poli</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <!-- Tabel riwayat daftar poli -->
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Hari</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Antrian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Menampilkan data riwayat daftar poli pasien dari database
                            require 'koneksi.php';
                            $no = 1; // Nomor urut
                            $query = "
                                SELECT 
                                    daftar_poli.id as idDaftarPoli, 
                                    poli.nama_poli, 
                                    dokter.nama, 
                                    jadwal_periksa.hari, 
                                    jadwal_periksa.jam_mulai, 
                                    jadwal_periksa.jam_selesai, 
                                    daftar_poli.no_antrian 
                                FROM daftar_poli 
                                INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id 
                                INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id 
                                INNER JOIN poli ON dokter.id_poli = poli.id 
                                WHERE daftar_poli.id_pasien = '$idPasien'";
                            $result = mysqli_query($mysqli, $query);

                            while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                <!-- Menampilkan setiap baris data riwayat -->
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['nama_poli'] ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['hari'] ?></td>
                                    <td><?php echo $data['jam_mulai'] ?></td>
                                    <td><?php echo $data['jam_selesai'] ?></td>
                                    <td><?php echo $data['no_antrian'] ?></td>
                                    <td>
                                        <!-- Tombol untuk melihat detail riwayat -->
                                        <a href="detailDaftarPoli.php?id=<?php echo $data['idDaftarPoli'] ?>"
                                            class='btn btn-sm btn-success edit-btn'>Detail</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>