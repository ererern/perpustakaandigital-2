<?php
require('config/koneksi.php');
session_start();
$cek = new Koneksi;
class Auth
{
    public function register($data)
    {
        $cek = new Koneksi;
        $Username = $data['Username'];
        $Password = password_hash($data['Password'], PASSWORD_BCRYPT);
        $Email = $data['Email'];
        $telp = $data['telp'];
        $NamaLengkap = $data['NamaLengkap'];
        $Alamat = $data['Alamat'];
        $sql = "INSERT INTO user VALUES (NULL, '$Username','$Password','$Email', $telp ,'$NamaLengkap','$Alamat','user')";
        $query = mysqli_query($cek->koneksi(), $sql);
        if ($query) {
            echo "<script>";
            echo 'alert("Berhasil Daftar Akun ");';
            echo 'window.location.href = "index.php?page=logRegist";';
            echo '</script>';
        } else {
            echo "<script>";
            echo 'alert("Pendaftaran Gagal.");';
            echo 'window.location.href = "index.php?page=logRegist";';
            echo '</script>';
        }
    }

    public function login($username, $password)
    {
        $cek = new Koneksi;
        $sql = "SELECT * FROM user WHERE Username = '$username'";
        $query = mysqli_query($cek->koneksi(), $sql);
        $data = mysqli_fetch_assoc($query);

        $datapassword = isset($data['Password']) ? $data['Password'] : "";
        if (password_verify($password, $datapassword)) {

            if ($data['Role'] == 'admin') {
                $_SESSION['data'] = $data;
                echo "<script>";
                echo 'alert("Login berhasil."); ';
                echo 'window.location.href = "dashboard.php?page=dashboard";';
                echo '</script>';
            } elseif ($data['Role'] == 'petugas') {
                $_SESSION['data'] = $data;
                echo "<script>";
                echo 'alert("Login berhasil."); ';
                echo 'window.location.href = "dashboard.php?page=dashboard";';
                echo '</script>';
            } else {
                $_SESSION['data'] = $data;
                echo "<script>";
                echo 'alert("Login berhasil."); ';
                echo 'window.location.href = "dashboard.php?page=dashboard";';
                echo '</script>';
            }
        } else {
            echo "<script>";
            echo 'alert("Login Gagal."); ';
            echo 'window.location.href = "index.php?page=logRegist";';
            echo '</script>';
        }
    }
    public function logout()
    {
        session_destroy();
        echo "<script>";
        echo 'alert("Logout Berhasil."); ';
        echo 'window.location.href = "index.php?page=logRegist";';
        echo '</script>';
    }
}
