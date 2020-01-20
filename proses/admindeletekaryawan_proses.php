<?php
    include '../config/koneksi.php';
    $idkaryawan = $_GET['id'];
    $checkquery = $mysqli->query("SELECT * FROM peminjaman where id_karyawan = $idkaryawan and status = 0");
    if (mysqli_num_rows($checkquery) == 0) {
        $hapus = $mysqli->query("DELETE FROM anggota WHERE id_karyawan = $idkaryawan");
        if($hapus){
            echo "<script>alert('Data karyawan berhasil dihapus!');history.go(-1);</script>";
        }else {
            echo "<script>alert('Data karyawan gagal dihapus!');history.go(-1);</script>";
        }
    }else {
        echo "<script>alert('Data karyawan gagal dihapus karena masih melakukan transaksi!');history.go(-1);</script>";
    }    
?>