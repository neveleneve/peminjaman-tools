<?php
session_start();
require_once "../config/koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
switch ($level) {
    case 'admin':
        $query = $mysqli->query("SELECT * FROM admin WHERE username ='$username' AND password='$password'");
        if (mysqli_num_rows($query) == 0) {
            echo '<script>alert("Data login anda salah! Silahkan Ulangi!");window.location.href="../login_page.php";</script>';
        } else {
            $row = mysqli_fetch_assoc($query);
            if ($row) {
                $_SESSION['admin'] = $username;
                $_SESSION['adminname'] = $row['nama'];
                header("Location:../admindashboard_page.php");
            }
        }
        break;
    case 'karyawan':
        $query = $mysqli->query("SELECT * FROM anggota WHERE id_karyawan ='$username' AND password='$password'");
        if (mysqli_num_rows($query) == 0) {
            echo '<script>alert("Data login anda salah! Silahkan Ulangi!");window.location.href="../login_page.php";</script>';
        } else {
            $row = mysqli_fetch_assoc($query);
            if ($row) {
                $_SESSION['nama_karyawan'] = $row['nama_karyawan'];
                $_SESSION['id_karyawan'] = $row['id_karyawan'];
                header("Location:../karyawan/karyawandashboard_page.php");
            }
        }
        break;
}
