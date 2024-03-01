<?php
require('config/auth.php');
$cek = new Auth;

require('layouts/auth/header.php');
if (!isset($_GET['page'])) {
    echo "<script>";
    echo "window.location.href = 'index.php?page=logRegist';";
    echo "</script>";
}

if ($_GET['page'] == 'logRegist') {
    require('logregist.php');
} elseif ($_GET['page'] == 'postlogin') {
    $cek->login($_POST['Username'], $_POST['Password']);
} elseif ($_GET['page'] == 'logout') {
    $cek->logout();
}
if ($_GET['page'] == 'postRegist') {
    if ($_POST['NamaLengkap'] == null) {
        echo "<script>window.location='index.php'</script>";
    } else {
        $data['Username'] = $_POST['Username'];
        $data['Password'] = $_POST['Password'];
        $data['Email'] = $_POST['Email'];
        $data['telp'] = $_POST['telp'];
        $data['NamaLengkap'] = $_POST['NamaLengkap'];
        $data['Alamat'] = $_POST['Alamat'];
        if (isset($_POST['register']) && !empty($data)) {
            $cek->register($data);
        } else {

            echo "<script>";
            echo 'alert("Silahkan Daftar akun terlebih dahulu"); ';
            // echo 'window.location.href = "index.php?page=logRegist";';
            echo '</script>';

            // echo "<script>alert('Silahkan Daftar akun terlebih dahulu');window.location.href ='index.php?page=logregist'</script>";
        }
    }
}

require('layouts/auth/footer.php');
