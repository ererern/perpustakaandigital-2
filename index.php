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
        $cek->register($data);
    }
}

require('layouts/auth/footer.php');
