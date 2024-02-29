<?php
require('config/auth.php');
$cek = new Auth;

require('layouts/auth/header.php');
if (!isset($_GET['page'])) {
    echo "<script>";
    echo 'alert("Silahkan Login Terlebih dahulu!"); ';
    echo "window.location.href = 'index.php?page=logRegist';";
    echo "</script>";
}

if ($_GET['page'] == 'logRegist') {
    require('logregist.php');
} elseif ($_GET['page'] == 'postRegist') {
    $data['Username'] = $_POST['Username'];
    $data['Password'] = $_POST['Password'];
    $data['Email'] = $_POST['Email'];
    $data['telp'] = $_POST['telp'];
    $data['NamaLengkap'] = $_POST['NamaLengkap'];
    $data['Alamat'] = $_POST['Alamat'];
    $cek->register($data);
} elseif ($_GET['page'] == 'postlogin') {
    $cek->login($_POST['Username'], $_POST['Password']);
} elseif ($_GET['page'] == 'logout') {
    $cek->logout();
}

require('layouts/auth/footer.php');
