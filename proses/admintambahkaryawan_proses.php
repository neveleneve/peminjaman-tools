<?php
    include "../config/koneksi.php";
    $id_peg = $_POST['id_peg'];
    $nama_peg = $_POST['nama_peg'];
    $pswd = "12345678";
    $divisi = $_POST['divisi'];
    $ganti = "insert into anggota values('{$id_peg}', '{$nama_peg}', '{$pswd}', '{$divisi}')";
    $update = $mysqli->query($ganti);
    // kekurangan -> tambah proses edit untuk mengubah nama file gambar di directory
    if($update) {
        header("location: ../adminkaryawanlist_page.php");
    }else{
        echo $ganti;
        echo "gagal mengubah data";
    }
?>