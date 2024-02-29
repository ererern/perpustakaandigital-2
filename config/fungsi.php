<?php
require "config/koneksi.php";
$cek = new Koneksi;

class Fungsi
{
    //menampilkan kategori
    public function viewkategori()
    {
        $cek = new Koneksi;
        $sql = "SELECT * from kategoribuku  ORDER BY KategoriID DESC";
        $query = mysqli_query($cek->koneksi(), $sql);
        $select = [];
        while ($d = mysqli_fetch_assoc($query)) {
            $select[] = $d;
        }
        return $select;
    }
    //menambah kategori
    public function tambahKategori($NamaKategori)
    {
        $cek = new Koneksi;
        $sql = "INSERT INTO kategoribuku VALUES (null, '$NamaKategori')";
        $query = mysqli_query($cek->koneksi(), $sql);

        if ($query) {
            echo "<script>";
            echo 'alert("Kategori Berhasil Ditambah!");';
            echo 'window.location.href = "dashboard.php?page=kategoribuku";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Kategori Gagal Ditambah!");';
            echo 'window.location.href = "dashboard.php?page=kategoribuku";';
            echo '</script>';
        }
    }

    //untuk menampilkan kategori yang akan edit
    public function editKategori($KategoriID)
    {
        $cek = new Koneksi;
        $sql = "SELECT * FROM kategoribuku WHERE KategoriID = '$KategoriID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        $data = mysqli_fetch_assoc($query);
        return $data;
    }
    //untuk mengupdate/mengubah data kategori
    public function updateKategori($KategoriID, $NamaKategori)
    {
        $cek = new Koneksi;
        $sql = "UPDATE kategoribuku SET NamaKategori='$NamaKategori' WHERE KategoriID = '$KategoriID'";
        // var_dump($sql);
        $query = mysqli_query($cek->koneksi(), $sql);
        //jika query berjalan maka berhasil
        if ($query) {
            echo "<script>";
            echo 'window.location.href = "dashboard.php?page=kategoribuku";';
            echo '</script>';
            //jika gagal
        } else {
            echo "<script>";
            echo 'alert("kategori gagal diubah"); ';
            echo 'window.location.href = "dashboard.php?page=kategoribuku";';
            echo '</script>';
        }
    }
    public function hapusKategori($KategoriID)
    {
        $cek = new Koneksi;
        $sql = "DELETE FROM kategoribuku WHERE KategoriID = '$KategoriID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        echo "<script>";
        echo 'alert("kategori Berhasil dihapus"); ';
        echo 'window.location.href = "dashboard.php?page=kategoribuku";';
        echo '</script>';
    }

    //CRUD databuku
    //untuk menampilkan data buku
    public function viewDatabuku()
    {
        $cek = new Koneksi;
        $sql = "SELECT  * from buku ORDER BY BukuID DESC";
        $query = mysqli_query($cek->koneksi(), $sql);
        $select = [];
        while ($d = mysqli_fetch_assoc($query)) {
            $select[] = $d;
        }
        return $select;
    }

    //pilih kategoribuku
    public function katbuku($BukuID)
    {
        $cek = new Koneksi;
        $sql = "SELECT * FROM kategoribuku_relasi LEFT JOIN kategoribuku ON kategoribuku_relasi.KategoriID=kategoribuku.KategoriID WHERE kategoribuku_relasi.BukuID='$BukuID'";

        $query = mysqli_query($cek->koneksi(), $sql);
        $select = [];
        while ($d = mysqli_fetch_assoc($query)) {
            $select[] = $d;
        }
        return $select;
    }

    //untuk menambah data buku
    public function tambahBuku($Judul, $Penulis, $Penerbit, $TahunTerbit, $kategori)
    {
        $cek = new Koneksi;
        $sql = "INSERT INTO buku VALUES (null , '$Judul', '$Penulis', '$Penerbit', '$TahunTerbit')";
        if ($kategori == NULL) {
            echo "<script>";
            echo 'alert("Gagal Tambah Data euy"); ';
            echo 'window.location.href = "dashboard.php?page=databuku";';
            echo '</script>';
            exit();
        }
        $query = mysqli_query($cek->koneksi(), $sql);
        $baru = "SELECT * FROM buku ORDER BY BukuID DESC limit 1";
        $query2 = mysqli_query($cek->koneksi(), $baru);
        $data = mysqli_fetch_assoc($query2);
        $id_buku = $data['BukuID'];
        // var_dump($kategori);

        foreach ($kategori as $k) {
            $sql2 = "INSERT INTO kategoribuku_relasi VALUES (NULL, '$id_buku', '$k')";
            $query2 = mysqli_query($cek->koneksi(), $sql2);
        }
        if ($query2) {
            echo "<script>";
            echo 'alert("Berhasil Tambah Data"); ';
            echo 'window.location.href = "dashboard.php?page=databuku";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Gagal Tambah Data"); ';
            echo 'window.location.href = "dashboard.php?page=databuku";';
            echo '</script>';
        }
    }

    //untuk menampilkan data buku yang akan edit
    public function editdataBuku($BukuID)
    {
        $cek = new Koneksi;
        $sql = "SELECT * FROM buku WHERE BukuID = '$BukuID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        $data = mysqli_fetch_assoc($query);
        return $data;
    }
    //untuk mengupdate/mengubah data buku
    public function updatedatabuku($BukuID, $Judul, $Penulis, $Penerbit, $TahunTerbit)
    {
        $cek = new Koneksi;
        $sql = "UPDATE buku SET Judul='$Judul', Penulis='$Penulis', Penerbit='$Penerbit', TahunTerbit='$TahunTerbit'  WHERE BukuID = '$BukuID'";
        //var_dump($sql);
        $query = mysqli_query($cek->koneksi(), $sql);
        //jika query berjalan maka berhasil
        if ($query) {
            echo "<script>";
            echo 'alert("Buku Berhasil diubah"); ';
            echo 'window.location.href = "dashboard.php?page=databuku";';
            echo '</script>';
            //jika gagal
        } else {
            echo "<script>";
            echo 'alert("Buku gagal diubah"); ';
            echo 'window.location.href = "dashboard.php?page=databuku";';
            echo '</script>';
        }
    }

    //menghapus data buku berdasarkan id buku
    public function hapusbuku($BukuID)
    {
        $cek = new Koneksi;
        $sql = "DELETE FROM buku WHERE BukuID = '$BukuID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        echo "<script>";
        echo 'alert("Buku Berhasil dihapus"); ';
        echo 'window.location.href = "dashboard.php?page=databuku";';
        echo '</script>';
    }

    //melakukan peminjaman
    public function ajukanpinjam($UserID, $BukuID, $TanggalPeminjaman)
    {
        $TanggalPengembalian = date('Y-m', strtotime($TanggalPeminjaman)) . '-' . date('d', strtotime($TanggalPeminjaman)) + 3;
        $cek = new Koneksi;
        $sql = "INSERT into peminjaman VALUES (NULL, '$UserID', '$BukuID', '$TanggalPeminjaman', '$TanggalPengembalian', 'wait')";
        $query = mysqli_query($cek->koneksi(), $sql);
        if ($query) {
            echo "<script>";
            echo 'alert("Berhasil Pinjam Buku Menunggu Persetujuan !");';
            echo 'window.location.href = "dashboard.php?page=databuku";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Gagal Meminjam Buku!");';
            echo 'window.location.href = "dashboard.php?page=databuku";';
            echo '</script>';
        }
    }
    //tampil data peminjaman buku
    public function viewpeminjamanbuku()
    {
        $cek = new Koneksi;
        $sql = "SELECT * FROM peminjaman LEFT JOIN user ON peminjaman.UserID=user.UserID LEFT JOIN buku ON peminjaman.BukuID=buku.BukuID ORDER BY PeminjamanID DESC";
        $query = mysqli_query($cek->koneksi(), $sql);
        $select = [];
        while ($d = mysqli_fetch_assoc($query)) {
            $select[] = $d;
        }
        return $select;
    }



    public function konfirmasipinjaman($PeminjamanID, $TanggalPengembalian, $UserID, $BukuID)
    {
        $cek = new Koneksi;
        $sql = "UPDATE peminjaman SET TanggalPengembalian='$TanggalPengembalian', StatusPeminjaman='pinjam' WHERE PeminjamanID='$PeminjamanID'";
        $query = mysqli_query($cek->koneksi(), $sql);

        $sql2 = "INSERT into koleksipribadi VALUES (NULL, '$UserID', '$BukuID')";
        $query2 = mysqli_query($cek->koneksi(), $sql2);

        if ($query2) {
            echo "<script>";
            echo 'alert("Berhasil konfirmasi peminjaman buku!");';
            echo 'window.location.href = "dashboard.php?page=datapeminjaman";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Gagal konfirmasi!");';
            echo 'window.location.href = "dashboard.php?page=datapeminjaman";';
            echo '</script>';
        }
    }
    //admin mengonfirmasi peminjaman buku
    public function konfirmasipengembalian($PeminjamanID)
    {
        $cek = new Koneksi;
        $sql = "UPDATE peminjaman SET StatusPeminjaman='selesai' WHERE PeminjamanID='$PeminjamanID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        if ($query) {
            echo "<script>";
            echo 'alert("Berhasil  konfirmasi Pengemabalian!");';
            echo 'window.location.href = "dashboard.php?page=datapeminjaman";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Gagal konfirmasi!");';
            echo 'window.location.href = "dashboard.php?page=datapeminjaman";';
            echo '</script>';
        }
    }

    //menampilkan tampilan ulasan
    public function viewulasan()
    {
        $cek = new Koneksi;
        $sql = "SELECT * from ulasanbuku LEFT JOIN user ON ulasanbuku.UserID=user.UserID LEFT JOIN buku ON ulasanbuku.BukuID=buku.BukuID";
        $query = mysqli_query($cek->koneksi(), $sql);
        $select = [];
        while ($d = mysqli_fetch_assoc($query)) {
            $select[] = $d;
        }
        return $select;
    }

    //ulasan
    public function postulasan($UserID, $BukuID, $Ulasan, $Rating)
    {
        $cek = new Koneksi;
        $sql = "INSERT into ulasanbuku VALUES (NULL, '$UserID', '$BukuID', '$Ulasan', '$Rating')";
        $query = mysqli_query($cek->koneksi(), $sql);
        if ($query) {
            echo "<script>";
            echo 'alert("Berhasil memberikan ulasan!");';
            echo 'window.location.href = "dashboard.php?page=databuku";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Gagal memberikan ulasan!");';
            echo 'window.location.href = "dashboard.php?page=databuku";';
            echo '</script>';
        }
    }

    public function hapuspeminjam($PeminjamanID)
    {
        $cek = new Koneksi;
        $sql = "DELETE from peminjaman WHERE PeminjamanID='$PeminjamanID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        if ($query) {
            echo "<script>";
            echo 'alert("Berhasil Hapus Data!");';
            echo 'window.location.href = "dashboard.php?page=datapeminjaman";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Gagal Hapus Data!");';
            echo 'window.location.href = "dashboard.php?page=datapeminjaman";';
            echo '</script>';
        }
    }

    //hapus ulasan dari admin
    public function hapusulasan($UlasanID)
    {
        $cek = new Koneksi;
        $sql = "DELETE from ulasanbuku WHERE UlasanID='$UlasanID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        if ($query) {
            echo "<script>";
            echo 'alert("Berhasil Hapus Data!");';
            echo 'window.location.href = "dashboard.php?page=ulasanbuku";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Gagal Hapus Data!");';
            echo 'window.location.href = "dashboard.php?page=ulasanbuku";';
            echo '</script>';
        }
    }

    //melihat tampilan koleksi
    public function viewkoleksi()
    {
        $cek = new Koneksi;
        $UserID = $_SESSION['data']['UserID'];
        $sql = "SELECT * from koleksipribadi LEFT JOIN user ON koleksipribadi.UserID=user.UserID LEFT JOIN buku ON koleksipribadi.BukuID=buku.BukuID LEFT JOIN peminjaman ON koleksipribadi.UserID=peminjaman.UserID WHERE koleksipribadi.UserID='$UserID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        $select = [];
        while ($d = mysqli_fetch_assoc($query)) {
            $select[] = $d;
        }
        return $select;
    }

    //melihat data petugas
    public function datapetugas()
    {
        $cek = new Koneksi;
        $sql = "SELECT * from user WHERE Role='petugas' ORDER BY UserID DESC";
        $query = mysqli_query($cek->koneksi(), $sql);
        $select = [];
        while ($d = mysqli_fetch_assoc($query)) {
            $select[] = $d;
        }
        return $select;
    }

    public function registerPetugas($data)
    {
        $cek = new Koneksi;
        $Username = $data['Username'];
        $Password = password_hash($data['Password'], PASSWORD_BCRYPT);
        $Email = $data['Email'];
        $telp = $data['telp'];
        $NamaLengkap = $data['NamaLengkap'];
        $Alamat = $data['Alamat'];
        $sql = "INSERT INTO user VALUES (NULL, '$Username','$Password','$Email', '$telp' ,'$NamaLengkap','$Alamat','petugas')";
        $query = mysqli_query($cek->koneksi(), $sql);
        if ($query) {
            echo "<script>";
            echo 'alert("Berhasil Daftar Akun Petugas ");';
            echo 'window.location.href = "dashboard.php?page=petugas";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Pendaftaran Gagal Akun Petugas.");';
            echo 'window.location.href = "dashboard.php?page=petugas";';
            echo '</script>';
        }
    }
    //edit petugas
    public function editpetugas($UserID)
    {
        $cek = new Koneksi;
        $sql = "SELECT * FROM user WHERE UserID = '$UserID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        $data = mysqli_fetch_assoc($query);
        return $data;
    }
    //untuk mengupdate/mengubah data buku
    public function updatepetugas($UserID, $Username, $Password, $Email, $telp, $NamaLengkap, $Alamat)
    {
        $cek = new Koneksi;
        $Password = password_hash($_POST['Password'], PASSWORD_BCRYPT);
        $sql = "UPDATE user SET Username='$Username', Password='$Password', Email='$Email', telp='$telp' , NamaLengkap='$NamaLengkap' , Alamat='$Alamat' WHERE UserID = '$UserID'";
        //var_dump($sql);
        $query = mysqli_query($cek->koneksi(), $sql);
        //jika query berjalan maka berhasil
        if ($query) {
            echo "<script>";
            echo 'alert("Data Petugas berhasil diubah"); ';
            echo 'window.location.href = "dashboard.php?page=petugas";';
            echo '</script>';
            //jika gagal
        } else {
            echo "<script>";
            echo 'alert(" Data Petugas gagal diubah"); ';
            echo 'window.location.href = "dashboard.php?page=petugas";';
            echo '</script>';
        }
    }
    //hapus petugas
    public function hapuspetugas($UserID)
    {
        $cek = new Koneksi;
        $sql = "DELETE from user WHERE UserID='$UserID'";
        $query = mysqli_query($cek->koneksi(), $sql);
        if ($query) {
            echo "<script>";
            echo 'alert("Berhasil Hapus Petugas!");';
            echo 'window.location.href = "dashboard.php?page=petugas";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Gagal Hapus Data Petugas!");';
            echo 'window.location.href = "dashboard.php?page=petugas";';
            echo '</script>';
        }
    }

    public function resetPassword($UserID)
    {
        $cek = new Koneksi;
        $hashedPassword = password_hash('12345', PASSWORD_BCRYPT);
        $sql = "UPDATE user SET Password='$hashedPassword' WHERE UserID = '$UserID'";
        //  var_dump($UserID);
        $query = mysqli_query($cek->koneksi(), $sql);

        if ($query) {
            echo "<script>";
            echo 'alert("Berhasil Mengatur ulang kata sandi menjadi 12345"); ';
            echo 'window.location.href = "dashboard.php?page=petugas";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Gagal mereset password"); ';
            echo 'window.location.href = "dashboard.php?page=petugas";';
            echo '</script>';
        }
    }
}
