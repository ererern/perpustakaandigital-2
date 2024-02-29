<div class="card">

    <div class="card-body">
        <h1>Ulasan Buku</h1>
        <hr>
        <table id="example2" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                    <?php
                    if ($_SESSION['data']['Role'] == 'admin' || $_SESSION['data']['Role'] == 'petugas') { ?>
                        <th>Aksi</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($fung->viewulasan() as $d) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['NamaLengkap']; ?></td>
                        <td><?= $d['Judul']; ?></td>
                        <td><?= $d['Rating']; ?></td>
                        <td><?= $d['Ulasan']; ?></td>
                        <?php
                        if ($_SESSION['data']['Role'] == 'admin' || $_SESSION['data']['Role'] == 'petugas') { ?>
                            <td>
                                <a class="btn btn-danger btn-sm" href="dashboard.php?page=hapusulasan&UlasanID=<?= $d['UlasanID'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fa fa-trash"></i></a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php   }
                ?>
            </tbody>
        </table>
    </div>