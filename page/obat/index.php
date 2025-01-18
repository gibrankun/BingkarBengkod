<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manajemen Obat</h1> <!-- Judul halaman -->
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li> <!-- Navigasi breadcrumb -->
                    <li class="breadcrumb-item active">Obat</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Obat</h3> <!-- Judul tabel data obat -->

                        <div class="card-tools">
                            <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal"
                                data-target="#addModal">
                                Tambah
                            </button> <!-- Tombol untuk membuka modal tambah data obat -->
                            <!-- Modal Tambah Data Obat -->
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Tambah Data Obat</h5> <!-- Judul Modal -->
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form tambah data obat disini -->
                                            <form action="page/obat/tambahObat.php" method="post"> <!-- Form yang mengarah ke tambahObat.php -->
                                                <div class="form-group">
                                                    <label for="nama_obat">Nama Obat</label>
                                                    <input type="text" class="form-control" id="nama_obat"
                                                        name="nama_obat" required> <!-- Input nama obat -->
                                                </div>
                                                <div class="form-group">
                                                    <label for="kemasan">Kemasan</label>
                                                    <input type="text" class="form-control" id="kemasan" name="kemasan"
                                                        required> <!-- Input kemasan obat -->
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga</label>
                                                    <input type="text" class="form-control" id="harga" name="harga"
                                                        required> <!-- Input harga obat -->
                                                </div>
                                                <button type="submit" class="btn btn-primary">Tambah</button> <!-- Tombol submit -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th> <!-- Kolom untuk nomor -->
                                    <th>Nama Obat</th> <!-- Kolom untuk nama obat -->
                                    <th>Kemasan</th> <!-- Kolom untuk kemasan -->
                                    <th>Harga</th> <!-- Kolom untuk harga -->
                                    <th>Aksi</th> <!-- Kolom untuk aksi (edit/hapus) -->
                                </tr>
                            </thead>
                            <tbody>

                                <!-- TAMPILKAN DATA OBAT DI SINI -->
                                <?php
                            require 'koneksi.php'; // Menyertakan koneksi database
                            $no = 1; // Inisialisasi nomor urut
                            $query = "SELECT * FROM obat"; // Query untuk mengambil data obat
                            $result = mysqli_query($mysqli, $query); // Menjalankan query ke database

                            while ($data = mysqli_fetch_assoc($result)) { // Looping untuk setiap data obat
                                # code...
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td> <!-- Menampilkan nomor urut -->
                                    <td><?php echo $data['nama_obat'] ?></td> <!-- Menampilkan nama obat -->
                                    <td><?php echo $data['kemasan'] ?></td> <!-- Menampilkan kemasan obat -->
                                    <td><?php echo $data['harga'] ?></td> <!-- Menampilkan harga obat -->
                                    <td>
                                        <button type='button' class='btn btn-sm btn-warning edit-btn'
                                            data-toggle="modal"
                                            data-target="#editModal<?php echo $data['id'] ?>">Edit</button> <!-- Tombol Edit -->
                                        <button type='button' class='btn btn-sm btn-danger edit-btn' data-toggle="modal"
                                            data-target="#hapusModal<?php echo $data['id'] ?>">Hapus</button> <!-- Tombol Hapus -->
                                    </td>
                                    <!-- Modal Edit Data Obat -->
                                    <div class="modal fade" id="editModal<?php echo $data['id'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addModalLabel">Edit Data Obat</h5> <!-- Judul Modal Edit -->
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form edit data obat disini -->
                                                    <form action="page/obat/updateObat.php" method="post"> <!-- Form yang mengarah ke updateObat.php -->
                                                        <input type="hidden" class="form-control" id="id" name="id"
                                                            value="<?php echo $data['id'] ?>" required> <!-- Hidden input untuk id obat -->
                                                        <div class="form-group">
                                                            <label for="nama_obat">Nama Obat</label>
                                                            <input type="text" class="form-control" id="nama_obat"
                                                                name="nama_obat"
                                                                value="<?php echo $data['nama_obat'] ?>" required> <!-- Input untuk nama obat yang sudah ada -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kemasan">Kemasan</label>
                                                            <input type="text" class="form-control" id="kemasan"
                                                                name="kemasan" value="<?php echo $data['kemasan'] ?>"
                                                                required> <!-- Input untuk kemasan obat yang sudah ada -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="harga">Harga</label>
                                                            <input type="text" class="form-control" id="harga"
                                                                name="harga" value="<?php echo $data['harga'] ?>"
                                                                required> <!-- Input untuk harga obat yang sudah ada -->
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Simpan</button> <!-- Tombol untuk menyimpan perubahan -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Hapus Data Obat -->
                                    <div class="modal fade" id="hapusModal<?php echo $data['id'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addModalLabel">Hapus Data Obat</h5> <!-- Judul Modal Hapus -->
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form hapus data obat disini -->
                                                    <form action="page/obat/hapusObat.php" method="post"> <!-- Form yang mengarah ke hapusObat.php -->
                                                        <input type="hidden" class="form-control" id="id" name="id"
                                                            value="<?php echo $data['id'] ?>" required> <!-- Hidden input untuk id obat -->
                                                        <p>Apakah anda yakin untuk menghapus data obat? <span
                                                                class="font-weight-bold"><?php echo $data['nama_obat'] ?></span>
                                                        </p> <!-- Konfirmasi hapus -->
                                                        <button type="submit" class="btn btn-danger">Hapus</button> <!-- Tombol untuk menghapus data -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->