<div class="card">
    <div class="card-body">
        <h1>Daftar Buku</h1>
        <hr>
        <?php
        if ($_SESSION['data']['Role'] == 'admin' || $_SESSION['data']['Role'] == 'petugas') { ?>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahbuku">
                    <i class="fas fa-plus fa-sm text-white-50"></i>Tambah Buku</button>
            </div>
        <?php } ?>
        <div class="table-responsive">
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
                            <td>
                                <?php
                                foreach ($fung->katbuku($d['BukuID']) as $f) {
                                ?>
                                    <span class="badge badge-primary"><?= $f['NamaKategori'] ?></span>
                                <?php } ?>
                            </td>
                            <td>
                                <!-- if -->

                                <?php
                                $cek = new Koneksi();
                                $UserID = $_SESSION['data']['UserID'];
                                $BukuID = $f['BukuID'];
                                $sql = "SELECT * FROM peminjaman WHERE  BukuID='$BukuID'  and UserID='$UserID' and StatusPeminjaman<>'selesai'";
                                $result = mysqli_query($cek->koneksi(), $sql);
                                $hitung = mysqli_num_rows($result);


                                ?>
                                <?php
                                if ($_SESSION['data']['Role'] == 'user') { ?>
                                    <?php
                                    if ($hitung > 0) { ?>
                                        <button type="button" class="btn btn-info btn-sm" disabled>Pinjam</button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ulas<?= $d['BukuID'] ?>">Ulas</button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#pinjam<?= $d['BukuID'] ?>">Pinjam</button>
                                        <button type="button" class="btn btn-warning btn-sm" disabled>Ulas</button>
                                    <?php }
                                    ?>

                                <?php } ?>

                                <?php
                                if ($_SESSION['data']['Role'] == 'admin' || $_SESSION['data']['Role'] == 'petugas') { ?>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $d['BukuID'] ?>"><i class="fa fa-edit fa-sm text-white"></i></button>

                                    <a href="dashboard.php?page=hapusBuku&BukuID=<?= $d['BukuID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin menghapus Buku <?= $d['Judul'] ?>?')"><i class="fa fa-trash"></i> </a>
                                <?php } ?>

                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahbuku">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah data buku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="dashboard.php?page=postdatabuku" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Judul Buku</label>
                        <input type="text" class="form-control" name="Judul" placeholder="Masukan Judul Buku" required="">
                    </div>
                    <div class="form-group">
                        <label for="">Penulis</label>
                        <input type="text" class="form-control" name="Penulis" placeholder="Masukan Penulis" required="">
                    </div>
                    <div class="form-group">
                        <label for="">Penerbit</label>
                        <input type="text" class="form-control" name="Penerbit" placeholder="Masukan Penerbit" required="">
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Terbit</label>
                        <input type="text" class="form-control" name="TahunTerbit" placeholder="Masukan Tahun Terbit" required="">
                    </div>
                    <div class="form-group">
                        <label for="">Kategori </label>
                        <?php
                        foreach ($fung->viewkategori() as $d) { ?>

                            <input type="checkbox" name="kategori[<?= $d['KategoriID'] ?>]" value="<?= $d['KategoriID'] ?>"><?= $d['NamaKategori'] ?>

                        <?php } ?>
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

<!-- edit -->
<?php
foreach ($fung->viewDatabuku() as $s) { ?>
    <div class="modal fade" id="edit<?= $s['BukuID'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Buku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="dashboard.php?page=updatedatabuku" method="post">
                    <div class="modal-body">

                        <input type="text" name="BukuID" value="<?= $s['BukuID']; ?>" hidden>
                        <div class="form-group">
                            <label for="">Judul Buku</label>
                            <input type="text" class="form-control" name="Judul" value="<?= $s['Judul']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Penulis</label>
                            <input type="text" class="form-control" name="Penulis" value="<?= $s['Penulis']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input type="text" class="form-control" name="Penerbit" value="<?= $s['Penerbit']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Tahun Terbit</label>
                            <input type="text" class="form-control" name="TahunTerbit" value="<?= $s['TahunTerbit']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <?php

                                foreach ($fung->viewkategori() as $d) { ?>
                                    <div><input type="checkbox" name="kategori[<?= $d['KategoriID'] ?>]" value="<?= $d['KategoriID'] ?>"><?= $d['NamaKategori'] ?></div>
                                <?php } ?>
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
    </div>
<?php  }
?>

<!-- modal ulasan -->
<?php
foreach ($fung->viewDatabuku() as $c) { ?>
    <div class="modal fade" id="ulas<?= $c['BukuID'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pinjam Buku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="dashboard.php?page=postulasan" method="post">
                    <div class="modal-body">
                        <input type="text" name="BukuID" value="<?= $c['BukuID']; ?>" hidden>
                        <input type="text" value="<?= $_SESSION['data']['UserID']; ?>" name="UserID" hidden>
                        <input type="text" value="<?= date('Y-m-d h:i:s') ?>" name="TanggalPeminjaman" hidden>
                        <div class="form-group">
                            <label for="">Judul Buku</label>
                            <input type="text" class="form-control" name="Judul" value="<?= $c['Judul'] ?>" disabled>
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
                                <option value="5">5</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
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

<!-- modal pinjam -->
<?php
foreach ($fung->viewDatabuku() as $e) { ?>
    <div class="modal fade" id="pinjam<?= $e['BukuID'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pinjam Buku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="dashboard.php?page=ajukanpinjam" method="post">
                    <div class="modal-body">
                        <input type="text" name="BukuID" value="<?= $e['BukuID']; ?>" hidden>
                        <input type="text" value="<?= $_SESSION['data']['UserID']; ?>" name="UserID" hidden>
                        <input type="text" value="<?= date('Y-m-d h:i:s') ?>" name="TanggalPeminjaman" hidden>
                        <div class="form-group">
                            <label for="">Judul Buku</label>
                            <input type="text" class="form-control" name="Judul" value="<?= $e['Judul'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Penulis</label>
                            <input type="text" class="form-control" name="Penulis" value="<?= $e['Penulis'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input type="text" class="form-control" name="Penerbit" value="<?= $e['Penerbit'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="number" class="form-control" name="TahunTerbit" value="<?= $e['TahunTerbit'] ?>" disabled>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ajukan Pinjam Buku</button>
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