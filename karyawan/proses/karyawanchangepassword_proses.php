<?php

    session_start();
    if (!isset($_SESSION['nama_karyawan'])) {
        header('location:../login_page.php');
    } else {
        $karyawan = $_SESSION['nama_karyawan'];
        $idkaryawan = $_SESSION['id_karyawan'];
    }
    require_once "../config/koneksi.php";

    
    $oldpass = $_POST['oldpassword'];
    $newpass = $_POST['newpassword'];

    $query = $mysqli->query("SELECT * from anggota where id_karyawan = '$idkaryawan'");
    $row = mysqli_fetch_assoc($query);
    if ($row['password'] == $oldpass) {
        $queryupdate = $mysqli->query("UPDATE anggota set password = '{$newpass}' where id_karyawan = '{$idkaryawan}'");        
        if (isset($queryupdate)) {
            echo "testo error";
            header("Location:../karyawandashboard_page.php");
        }else {
            echo "this is an error";
        }
    }else {
        echo $idkaryawan;
        echo $oldpass;
        echo $newpass;
        echo "error, old password is wrong";
        // header("Location:../adminsetting_page.php");
    }
?>