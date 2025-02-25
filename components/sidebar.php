<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Tambahkan validasi session_start() -->
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_name('adminlte_session'); // Nama unik untuk session
            session_start();
        }

        // Validasi session dan role pengguna
        if (!isset($_SESSION['akses']) || !isset($_SESSION['username'])) {
            // Redirect ke halaman login jika session tidak ada
            header('Location: login.php');
            exit();
        }

        $role = $_SESSION['akses'];
        $username = $_SESSION['username'];
        ?>

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo htmlspecialchars($username); ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Menu berdasarkan role pengguna -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Menu<i class="right fas fa-angle-left"></i></p>
                    </a>

                    <?php if ($role === "admin") { ?>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="dashboard_admin.php" class="nav-link">
                                    <i class="fas fa-th nav-icon"></i>
                                    <p>Dashboard <span class="right badge badge-danger">Admin</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="dokter.php" class="nav-link">
                                    <i class="fas fa-user-nurse nav-icon"></i>
                                    <p>Dokter <span class="right badge badge-danger">Admin</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="poli.php" class="nav-link">
                                    <i class="fas fa-hospital nav-icon"></i>
                                    <p>Poli <span class="right badge badge-danger">Admin</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="obat.php" class="nav-link">
                                    <i class="fas fa-tablets nav-icon"></i>
                                    <p>Obat <span class="right badge badge-danger">Admin</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pasien.php" class="nav-link">
                                    <i class="fas fa-user nav-icon"></i>
                                    <p>Pasien <span class="right badge badge-danger">Admin</span></p>
                                </a>
                            </li>
                        </ul>
                    <?php } 
                    else if ($role === "dokter") { ?>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="dashboard_dokter.php" class="nav-link">
                                    <i class="fas fa-th nav-icon"></i>
                                    <p>Dashboard <span class="right badge badge-success">Dokter</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="jadwalPeriksa.php" class="nav-link">
                                    <i class="fas fa-hospital-user nav-icon"></i>
                                    <p>Jadwal Praktek Dokter <span class="right badge badge-success">Dokter</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="periksaPasien.php" class="nav-link">
                                    <i class="fas fa-stethoscope nav-icon"></i>
                                    <p>Periksa Pasien <span class="right badge badge-success">Dokter</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="riwayatPasien.php" class="nav-link">
                                    <i class="fas fa-book-medical nav-icon"></i>
                                    <p>Riwayat Pasien <span class="right badge badge-success">Dokter</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="konsultasiDokter.php" class="nav-link">
                                    <i class="fab fa-rocketchat"></i>
                                    <p>Konsultasi <span class="right badge badge-success">Dokter</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="profileDokter.php" class="nav-link">
                                    <i class="fas fa-user-md nav-icon"></i>
                                    <p>Profil Dokter <span class="right badge badge-success">Dokter</span></p>
                                </a>
                            </li>
                        </ul>
                    <?php } 
                    else if ($role === "pasien") { ?>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="dashboard_pasien.php" class="nav-link">
                                    <i class="fas fa-hospital-user nav-icon"></i>
                                    <p>Dashboard <span class="right badge badge-info">Pasien</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="daftarPoliklinik.php" class="nav-link">
                                    <i class="fas fa-stethoscope nav-icon"></i>
                                    <p>Daftar Poli <span class="right badge badge-info">Pasien</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="konsultasiPasien.php" class="nav-link">
                                    <i class="fas fa-book-medical nav-icon"></i>
                                    <p>Konsultasi Pasien <span class="right badge badge-info">Pasien</span></p>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </li>

                <!-- Menu Logout -->
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
