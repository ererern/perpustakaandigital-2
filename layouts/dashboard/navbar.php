<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">

                    <div class="text-dark text-start p-2 d-none d-sm-inline-block">Halo, <?php echo $_SESSION['data']['Role'] . '!'; ?></div>
                </li>

            </ul>

            <style>
                .nav-link i {
                    margin-right: 5px;
                    /* Jarak antara ikon dan teks */
                }
            </style>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown">
                        <i class="fas fa-user-cog"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="dashboard.php?page=profil">
                                <i class="fas fa-address-card"></i> Info Akun
                            </a>
                        </li>
                        <?php if ($_SESSION['data']['Role'] == 'admin') { ?>
                            <li>
                                <a class="dropdown-item" href="dashboard.php?page=petugas">
                                    <i class="fa fa-users"></i> Petugas
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php?page=logout" onclick="return confirm('Apa anda yakin akan Logout?')">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>