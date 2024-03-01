<div class="card">
    <div class="card-body">
        <?php
        if ($_SESSION['data']['Role'] == 'admin' || $_SESSION['data']['Role'] == 'petugas') {
            echo "<script>";
            echo 'alert("Anda tidak punya akses!");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        }
        ?>

        <h1>Koleksi Pribadi </h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped" id="example2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>TahunTerbit Terbit</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($fung->viewKoleksi() as $d) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $d['Judul']; ?></td>
                            <td><?= $d['Penulis']; ?></td>
                            <td><?= $d['Penerbit']; ?></td>
                            <td><?= $d['TahunTerbit']; ?></td>
                            <td><?php
                                foreach ($fung->katbuku($d['BukuID']) as $k) { ?>
                                    <span class="badge badge-primary"><?= $k['NamaKategori']; ?></span>

                                <?php    }
                                ?>
                            </td>

                        </tr>
                    <?php   }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>