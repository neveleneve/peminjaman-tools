<?php
    include '../config/koneksi.php';
    $id_brg = $_GET['id'];
    $hapus = $mysqli->query("DELETE FROM barang WHERE id_brg=$id_brg");
    if($hapus){
        header("location:../admintoolslist_page.php");
        $message = "Berhasil Menghapus Data Tool";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }else{
        header("location:../admintoolslist_page.php");
        $message = "Gagal Menghapus Data Tool";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
?>