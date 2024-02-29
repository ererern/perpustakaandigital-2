<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="container">
        <a href="" class="brand-link">

            <span class="brand-text font-weight-light"> <img src="adminv/book2.png" width="20%" style="border-radius: 100%;" alt="logo Perpustakaan">Perpustakaan Digital</span>
        </a>
    </div>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- <li class="nav-header">Navigasi</li> -->
                <li class="nav-item">
                    <a href="dashboard.php?page=dashboard" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dashboard.php?page=databuku" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Daftar Buku
                        </p>
                    </a>
                </li>
                <?php
                if ($_SESSION['data']['Role'] == 'admin' || $_SESSION['data']['Role'] == 'petugas') { ?>
                    <li class="nav-item">
                        <a href="dashboard.php?page=kategoribuku" class="nav-link">
                            <i class="nav-icon fa fa-list"></i>
                            <p>
                                Kategori Buku
                            </p>
                        </a>
                    </li>
                <?php   }
                ?>
                <?php
                if ($_SESSION['data']['Role'] == 'user') { ?>
                    <li class="nav-item">
                        <a href="dashboard.php?page=koleksi" class="nav-link">
                            <i class="nav-icon fas fa-bookmark"></i>
                            <p>
                                Riwayat Peminjaman
                            </p>
                        </a>
                    </li>
                <?php   }
                ?>
                <?php
                if ($_SESSION['data']['Role'] == 'admin' || $_SESSION['data']['Role'] == 'petugas') { ?>
                    <li class="nav-item">
                        <a href="dashboard.php?page=datapeminjaman" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>
                                Detail Peminjaman
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <a href="dashboard.php?page=ulasanbuku" class="nav-link">
                        <i class="nav-icon 	fas fa-comment-dots"></i>
                        <p>
                            Ulasan Buku
                        </p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>

</aside>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">

            </div>
        </div>
    </section>
    <section class="content">