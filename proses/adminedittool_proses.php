<?php
    include "../config/koneksi.php";
    $id_brg = $_POST['id_brg'];
    $nama_brg = $_POST['nama_brg'];
    $jenis_brg = $_POST['jenis_brg'];
    $stok_brg = $_POST['stok_brg'];    
    $ganti = "update barang set id_brg='$id_brg', nama_brg='$nama_brg', jenis_brg='$jenis_brg', stok_brg='$stok_brg' where id_brg='$id_brg'";
    $update = $mysqli->query($ganti);
    // kekurangan -> tambah proses edit untuk mengubah nama file gambar di directory
    if($update) {
        header("location: ../admintoolslist_page.php");
    }else{
        echo $ganti;
        echo "gagal mengubah data";
    }
?>