<?php
    session_start();
    $idkry = $_SESSION['idkry'];
    include "../config/koneksi.php";
    $idpinjamgeneratequery = $mysqli->query("SELECT max(id_peminjaman) as a FROM peminjaman");
    $idpinjam = mysqli_fetch_assoc($idpinjamgeneratequery);
    $tgl = date('Y-m-d');
    // generate new id_peminjaman
    echo $idpinjam['a']+1;
    $id_pinjam = $idpinjam['a']+1;
    $checkquery = $mysqli->query("SELECT * FROM barang");
    while ($data = mysqli_fetch_assoc($checkquery)) {
        $jumlah = $_POST[$data['id_brg']];
        $idbrg = $data['id_brg'];
        if ($jumlah == 0) {            
        }else {
            $addquery = $mysqli->query("INSERT INTO peminjaman values ($id_pinjam, $idbrg, $idkry, $jumlah, '$tgl', 0)");
            $updatestock = $mysqli->query("UPDATE barang SET stok_brg = stok_brg - $jumlah WHERE id_brg = $idbrg");
        }
    }
    echo "<script>alert('Data Berhasil Ditambah!');window.location.href = '../adminkaryawanlist_page.php';</script>";
?>