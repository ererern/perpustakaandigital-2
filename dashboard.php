<?php
session_start();
require('config/fungsi.php');
$fung = new Fungsi();
if (!isset($_SESSION['data'])) {
    echo "<script>";
    echo 'alert("Silahkan Login Terlebih dahulu!"); ';
    echo 'window.location.href = "index.php?page=logRegist";';
    echo '</script>';
}

include 'layouts/dashboard/header.php';
include 'layouts/dashboard/navbar.php';
include 'layouts/dashboard/sidebar.php';

// dashboard
if ($_GET['page'] == 'dashboard') {
    include('auth/dashboard.php');
}
//kategori
elseif ($_GET['page'] == 'kategoribuku') {
    include('auth/kategoribuku.php');
} elseif ($_GET['page'] == 'viewkategori') {
    $fung->viewkategori($query);
} elseif ($_GET['page'] == 'postKategori') {
    $NamaKategori = $_POST['NamaKategori'];
    $fung->tambahKategori($NamaKategori);
} elseif ($_GET['page'] == 'editkategori') {
    $KategoriID = $_POST['KategoriID'];
    $fung->editKategori($KategoriID);
} elseif ($_GET['page'] == 'updatekategori') {
    $KategoriID = $_POST['KategoriID'];
    $NamaKategori = $_POST['NamaKategori'];
    $fung->updateKategori($KategoriID, $NamaKategori);
} elseif ($_GET['page'] == 'hapusKategori') {
    $fung->hapusKategori($_GET['KategoriID']);
}

//databuku
elseif ($_GET['page'] == 'databuku') {
    include('auth/databuku.php');
} elseif ($_GET['page'] == 'viewbuku') {
    $fung->viewDatabuku($query);
} elseif ($_GET['page'] == 'postdatabuku') {
    $Judul = $_POST['Judul'];
    $Penulis = $_POST['Penulis'];
    $Penerbit = $_POST['Penerbit'];
    $TahunTerbit = $_POST['TahunTerbit'];
    $kategori = $_POST['kategori'];

    $fung->tambahBuku($Judul, $Penulis, $Penerbit, $TahunTerbit, $kategori);
} elseif ($_GET['page'] == 'editbuku') {
    $BukuID = $_POST['BukuID'];
    $fung->editdatabuku($BukuID);
} elseif ($_GET['page'] == 'updatedatabuku') {
    $BukuID = $_POST['BukuID'];
    $Judul = $_POST['Judul'];
    $Penulis = $_POST['Penulis'];
    $Penerbit = $_POST['Penerbit'];
    $TahunTerbit = $_POST['TahunTerbit'];
    // $kategori = $_POST['kategori'];

    $fung->updatedatabuku($BukuID, $Judul, $Penulis, $Penerbit, $TahunTerbit);
} elseif ($_GET['page'] == 'hapusBuku') {
    $fung->hapusbuku($_GET['BukuID']);
}

//ulasan buku
elseif ($_GET['page'] == 'ulasanbuku') {
    include('auth/ulasanbuku.php');
} elseif ($_GET['page'] == 'postulasan') {
    $fung->postulasan($_POST['UserID'], $_POST['BukuID'], $_POST['Ulasan'], $_POST['Rating']);
} elseif ($_GET['page'] == 'hapusulasan') {
    $fung->hapusulasan($_GET['UlasanID']);
}


//peminjaman
elseif ($_GET['page'] == 'datapeminjaman') {
    include('auth/peminjaman.php');
}
//mengirim persetujuan ke admin
elseif ($_GET['page'] == 'ajukanpinjam') {
    $fung->ajukanpinjam($_POST['UserID'], $_POST['BukuID'], $_POST['TanggalPeminjaman']);
}
//admin mengkonfirmasi peminjaman buku
elseif ($_GET['page'] == 'konfirmasipinjaman') {
    $fung->konfirmasipinjaman($_POST['PeminjamanID'], $_POST['TanggalPengembalian'], $_POST['UserID'], $_POST['BukuID']);
}
//admin mengkonfirmasi pengembalian buku
elseif ($_GET['page'] == 'konfirmasipengembalian') {
    $fung->konfirmasipengembalian($_POST['PeminjamanID']);
} elseif ($_GET['page'] == 'hapuspeminjam') {
    $fung->hapuspeminjam($_GET['PeminjamanID']);
}

//koleksi buku = > tampilan user
elseif ($_GET['page'] == 'koleksi') {
    include('auth/koleksi.php');
}

// petugas
elseif ($_GET['page'] == 'petugas') {
    include('auth/petugas.php');
} elseif ($_GET['page'] == 'datapetugas') {
    $fung->datapetugas($query);
} elseif ($_GET['page'] == 'registerPetugas') {
    $data['Username'] = $_POST['Username'];
    $data['Password'] = $_POST['Password'];
    $data['Email'] = $_POST['Email'];
    $data['telp'] = $_POST['telp'];
    $data['NamaLengkap'] = $_POST['NamaLengkap'];
    $data['Alamat'] = $_POST['Alamat'];
    $fung->registerPetugas($data);
} elseif ($_GET['page'] == 'edipetugas') {
    $UserID = $_POST['UserID'];
    $fung->editpetugas($UserID);
} elseif ($_GET['page'] == 'updatepetugas') {
    $UserID = $_POST['UserID'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Email = $_POST['Email'];
    $telp = $_POST['telp'];
    $NamaLengkap = $_POST['NamaLengkap'];
    $Alamat = $_POST['Alamat'];
    $fung->updatepetugas($UserID, $Username, $Password, $Email, $telp, $NamaLengkap, $Alamat);
} elseif ($_GET['page'] == 'hapuspetugas') {
    $fung->hapuspetugas($_GET['UserID']);
}

//reset password
elseif ($_GET['page'] == 'resetpassword') {

    $fung->resetPassword($_POST['UserID']);
}

//print laporan
elseif ($_GET['page'] == 'printlaporan') {
    include('auth/printpdf.php');
}

//profil
elseif ($_GET['page'] == 'profil') {
    include('auth/profil.php');
}



include 'layouts/dashboard/footer.php';
