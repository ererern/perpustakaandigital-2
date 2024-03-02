<div class="card">
    <div class="card-body">
        <h1>Data Buku</h1>
        <hr>
        <?php
        if ($_SESSION['data']['Role'] == 'admin' || $_SESSION['data']['Role'] == 'petugas') {
        ?>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahbuku">
                    <i class="fas fa-plus fa-sm text-white-50"></i>Tambah Buku</button>
            </div> <?php } ?>
        <table class="table table-striped" id="example2">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($fung->viewDatabuku() as $d) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['Judul'] ?></td>
                        <td><?= $d['Penulis'] ?></td>
                        <td><?= $d['Penerbit'] ?></td>
                        <td><?= $d['TahunTerbit'] ?></td>
                        <td><?php
                            foreach ($fung->katbuku($d['BukuID']) as $d) { ?>
                                <span class="badge badge-primary"><?= $d['NamaKategori']; ?></span>
                            <?php    }
                            ?>
                        </td>
                        <td>
                            <!-- if -->
                            <?php
                            $cek = new Koneksi();
                            $UserID = $_SESSION['data']['UserID'];
                            $BukuID = $d['BukuID'];
                            $sql = "SELECT * FROM peminjaman WHERE  BukuID='$BukuID'  and UserID='$UserID' and StatusPeminjaman<>'selesai'";
                            $sql2 = "SELECT * FROM peminjaman WHERE BukuID='$BukuID' and UserID='$UserID'";
                            $result = mysqli_query($cek->koneksi(), $sql);
                            $result2 = mysqli_query($cek->koneksi(), $sql2);
                            $hitung = mysqli_num_rows($result);
                            // var_dump($hitung);
                            $ok = mysqli_fetch_assoc($result2);
                            //  var_dump($ok);
                            ?>
                            <?php
                            if ($_SESSION['data']['Role'] == 'user') { ?>
                                <?php
                                if ($hitung > 0) { ?>
                                    <button type="button" class="btn btn-info btn-sm" disabled>Pinjam</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#pinjam<?= $d['BukuID'] ?>">Pinjam</button>
                                <?php }
                                ?>
                                <?php
                                if (!empty($ok)) { // Mengubah pengecekan ini
                                    if ($ok['StatusPeminjaman'] == 'selesai') { ?>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ulas<?= $d['BukuID'] ?>">Ulas</button>
                                    <?php
                                    }
                                    ?>
                                <?php }
                                ?>

                            <?php } // Ini adalah penutup blok untuk peran 'user' 
                            ?>

                            <?php
                            if ($_SESSION['data']['Role'] == 'admin' || $_SESSION['data']['Role'] == 'petugas') { ?>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $d['BukuID'] ?>"><i class="fa fa-edit fa-sm text-white"></i></button>
                                <a href="dashboard.php?page=hapusBuku&BukuID=<?= $d['BukuID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin menghapus Buku ini ? ') "> <i class="fa fa-trash"></i> </a>
                            <?php }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <!-- tambah buku -->
        <div class="modal fade" id="tambahbuku">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="dashboard.php?page=postdatabuku" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Judul Buku</label>
                                <input type="text" class="form-control" name="Judul" required>
                            </div>
                            <div class="form-group">
                                <label for="">Penulis</label>
                                <input type="text" class="form-control" name="Penulis" required>
                            </div>
                            <div class="form-group">
                                <label for="">Penerbit</label>
                                <input type="text" class="form-control" name="Penerbit" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tahun</label>
                                <input type="number" class="form-control" name="TahunTerbit" required>
                            </div>
                            <div class="form-group">
                                <?php
                                foreach ($fung->viewKategori() as $d) { ?>
                                    <div><input type="checkbox" name="kategori[<?= $d['KategoriID'] ?>]" value="<?= $d['KategoriID'] ?>"> <?= $d['NamaKategori'] ?></div>
                                <?php  }
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <?php
        foreach ($fung->viewDataBuku() as $d) { ?>
            <div class="modal fade" id="edit<?= $d['BukuID'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="dashboard.php?page=updatedatabuku" method="post">
                            <div class="modal-body">
                                <input type="text" name="BukuID" value="<?= $d['BukuID']; ?>" hidden>
                                <div class="form-group">
                                    <label for="">Judul Buku</label>
                                    <input type="text" class="form-control" name="Judul" value="<?= $d['Judul'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Penulis</label>
                                    <input type="text" class="form-control" name="Penulis" value="<?= $d['Penulis'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Penerbit</label>
                                    <input type="text" class="form-control" name="Penerbit" value="<?= $d['Penerbit'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tahun</label>
                                    <input type="number" class="form-control" name="TahunTerbit" value="<?= $d['TahunTerbit'] ?>" required>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        <?php  }
        ?>


        <?php
        foreach ($fung->viewDataBuku() as $d) { ?>
            <div class="modal fade" id="pinjam<?= $d['BukuID'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pinjam Buku</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="dashboard.php?page=ajukanpinjam" method="post">
                            <div class="modal-body">
                                <input type="text" name="BukuID" value="<?= $d['BukuID']; ?>" hidden>
                                <input type="text" value="<?= $_SESSION['data']['UserID']; ?>" name="UserID" hidden>
                                <input type="text" value="<?= date('Y-m-d h:i:s') ?>" name="TanggalPeminjaman" hidden>

                                <div class="form-group">
                                    <label for="">Judul Buku</label>
                                    <input type="text" class="form-control" name="Judul" value="<?= $d['Judul'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Penulis</label>
                                    <input type="text" class="form-control" name="Penulis" value="<?= $d['Penulis'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Penerbit</label>
                                    <input type="text" class="form-control" name="Penerbit" value="<?= $d['Penerbit'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Tahun</label>
                                    <input type="number" class="form-control" name="TahunTerbit" value="<?= $d['TahunTerbit'] ?>" disabled>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Ajukan Pinjam Buku</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        <?php  }
        ?>


        <?php
        foreach ($fung->viewDataBuku() as $d) { ?>
            <div class="modal fade" id="ulas<?= $d['BukuID'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ulasan Buku</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="dashboard.php?page=postulasan" method="post">
                            <div class="modal-body">
                                <input type="text" name="BukuID" value="<?= $d['BukuID']; ?>" hidden>
                                <input type="text" value="<?= $_SESSION['data']['UserID']; ?>" name="UserID" hidden>
                                <input type="text" value="<?= date('Y-m-d h:i:s') ?>" name="TanggalPeminjaman" hidden>
                                <div class="form-group">
                                    <label for="">Judul Buku</label>
                                    <input type="text" class="form-control" name="Judul" value="<?= $d['Judul'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Ulasan</label>
                                    <textarea name="Ulasan" class="form-control" cols="30" rows="10" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Rating</label>
                                    <select name="Rating" class="form-control" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php  }
        ?>
