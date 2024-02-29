<div class="card">
  <div class="card-body">
    <h1>Detail Peminjaman</h1>
    <hr>
    <?php
    if ($_SESSION['data']['Role'] == 'petugas') { ?>
      <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <a href="dashboard.php?page=printlaporan" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-print"></i> Print</a>
      </div>
    <?php } ?>
    <table id="example2" class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Nama Peminjam</th>
          <th>Tanggal Peminjaman</th>
          <th>Tanggal Kembali</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($fung->viewpeminjamanbuku() as $a) {
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $a['Judul']; ?></td>
            <td><?= $a['NamaLengkap']; ?></td>
            <td><?= $a['TanggalPeminjaman']; ?></td>
            <td>
              <?php
              $time = strtotime(date('y-m-d'));
              $back = strtotime($a['TanggalPengembalian']);
              if ($time > $back) {
                echo "<span class='badge badge-danger'>Terlambat</span>";
              } else {
                echo $a['TanggalPengembalian'];
              }
              ?>
            </td>
            <td>
              <?php
              if ($a['StatusPeminjaman'] == 'wait') {
                echo "<span class='badge badge-warning'>Menunggu Persetujuan</span>";
              } elseif ($a['StatusPeminjaman'] == 'pinjam') {
                echo "<span class='badge badge-success'>Sedang dipinjam</span>";
              } else {
                echo "<span class='badge badge-primary'>Selesai</span>";
              }
              ?>
            </td>
            <td>
              <?php
              if ($a['StatusPeminjaman'] == 'wait') { ?>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#konfirmasi<?= $a['PeminjamanID'] ?>">Acc</button>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pengembalian<?= $a['PeminjamanID'] ?>" disabled>Kembali</button>
              <?php   } elseif ($a['StatusPeminjaman'] == 'pinjam') { ?>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#konfirmasi<?= $a['PeminjamanID'] ?>" disabled>Acc</button>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pengembalian<?= $a['PeminjamanID'] ?>">Kembali</button>
              <?php   } else { ?>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#konfirmasi<?= $a['PeminjamanID'] ?>" disabled>Acc</button>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pengembalian<?= $a['PeminjamanID'] ?>" disabled>Kembali</button>
              <?php  }
              ?>
              <a class="btn btn-danger btn-sm" href="dashboard.php?page=hapuspeminjam&PeminjamanID=<?= $a['PeminjamanID'] ?>" onclick="return confirm('Apakah anda yakin menghapus ini?')"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
        <?php   }
        ?>
        </td>

        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- konfirmasi peminjaman dari admin -->
<?php
foreach ($fung->viewpeminjamanbuku() as $c) { ?>
  <div class="modal fade" id="konfirmasi<?= $c['PeminjamanID'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Pinjaman</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="dashboard.php?page=konfirmasipinjaman" method="post">
          <div class="modal-body">
            <input type="text" name="PeminjamanID" value="<?= $c['PeminjamanID']; ?>" hidden>
            <input type="text" name="BukuID" value="<?= $c['BukuID']; ?>" hidden>
            <input type="text" name="UserID" value="<?= $c['UserID']; ?>" hidden>
            <div class="form-group">
              <label for="">Judul Buku</label>
              <input type="text" class="form-control" name="judul" value="<?= $c['Judul'] ?>" disabled>
            </div>
            <div class="form-group">
              <label for="">Nama Peminjam</label>
              <input type="text" class="form-control" name="NamaLengkap" value="<?= $c['NamaLengkap'] ?>" disabled>
            </div>
            <div class="form-group">
              <label for="">Tanggal Peminjaman</label>
              <input type="date" class="form-control" name="TanggalPeminjaman" value="<?= $c['TanggalPeminjaman'] ?>" disabled>
            </div>
            <div class="form-group">
              <label for="">Tanggal Pengembalian</label>
              <input type="date" class="form-control" name="TanggalPengembalian" value="<?= $c['TanggalPengembalian'] ?>">
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


<!-- pengembalian buku -->
<?php
foreach ($fung->viewpeminjamanbuku() as $c) { ?>
  <div class="modal fade" id="pengembalian<?= $c['PeminjamanID'] ?>">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pengembalian</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="dashboard.php?page=konfirmasipengembalian" method="post">
          <div class="modal-body">
            <input type="text" name="PeminjamanID" value="<?= $c['PeminjamanID']; ?>" hidden>
            <div class="form-group">
              <label for="">Judul Buku</label>
              <input type="text" class="form-control" name="judul" value="<?= $c['Judul'] ?>" disabled>
            </div>
            <div class="form-group">
              <label for="">Nama Peminjam</label>
              <input type="text" class="form-control" name="NamaLengkap" value="<?= $c['NamaLengkap'] ?>" disabled>
            </div>
            <div class="form-group">
              <label for="">Tanggal Peminjaman</label>
              <input type="date" class="form-control" name="TanggalPeminjaman" value="<?= $c['TanggalPeminjaman'] ?>" disabled>
            </div>
            <div class="form-group">
              <label for="">Tanggal Pengembalian</label>
              <input type="date" class="form-control" name="TanggalPengembalian" value="<?= $c['TanggalPengembalian'] ?>" disabled>
            </div>

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Konfirmasi Pengembalian</button>
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