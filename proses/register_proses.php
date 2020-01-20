<?php
session_start();
require_once "../config/koneksi.php";
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$password = $_POST['password'];
$div = $_POST['bagian'];
if ($nik==null || $nama == null || $password == null || $div == "0") {
    // echo "<script>alert('Data Register Tidak Lengkap');window.location.href = '../register_page.php';</script>";
}else {
    $query = $mysqli->query("INSERT INTO anggota values ('$nik', '{$nama}', '{$password}', '{$div}')");
    if (isset($query)) {
        header("location: ../login_page.php");
    }else {
        echo "error";
    }
}



