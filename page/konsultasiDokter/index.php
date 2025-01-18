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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Konsultasi Pasien</h3>
                </div>
                <div class="card-body">
                    <!-- Tabel daftar konsultasi -->
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Konsultasi</th>
                                <th>Nama Pasien</th>
                                <th>Subject</th>
                                <th>Pertanyaan</th>
                                <th>Tanggapan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Menghubungkan ke database
                            require 'koneksi.php';

                            // Query untuk mengambil data konsultasi berdasarkan dokter
                            $idDokter = 1; // Ganti dengan ID dokter yang sedang login
                            $query = "SELECT k.*, p.nama AS nama_pasien 
                                      FROM konsultasi k 
                                      JOIN pasien p ON k.id_pasien = p.id 
                                      WHERE k.id_dokter = '$idDokter'";
                            $result = mysqli_query($mysqli, $query);
                            $no = 1;

                            // Menampilkan data konsultasi
                            while ($data = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['tanggal_kirim']; ?></td>
                                    <td><?php echo $data['nama_pasien']; ?></td>
                                    <td><?php echo $data['subject']; ?></td>
                                    <td><?php echo $data['pesan']; ?></td>
                                    <td>
                                        <?php if (empty($data['jawaban'])) { ?>
                                            <!-- Tampilkan tombol Tanggapi jika belum ada jawaban -->
                                            <a href="tanggapiPesan.php?id=<?php echo $data['id']; ?>" class="btn btn-success btn-sm">
                                                Tanggapi
                                            </a>
                                        <?php } else { ?>
                                            <!-- Tampilkan jawaban jika sudah ada -->
                                            <?php echo $data['jawaban']; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit Pesan -->
                                        <a href="editPesan.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">
                                            Edit Pesan
                                        </a>
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
