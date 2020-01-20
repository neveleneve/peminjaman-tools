<?php
    include "../config/koneksi.php";
    // get all id that using on this procc
    $id_barg = $_GET['idbarang'];
    $id_pnjm = $_GET['idpinjam'];
    $id_kry = $_GET['idkaryawan'];
    $jml_brg = $_GET['jmlbrg'];
    //ambil data id peminjaman terakhir
    $query = $mysqli->query("SELECT max(id) as a FROM pengembalian");
    $qq = mysqli_fetch_assoc('$query');
    $nomor= $qq['a']+1;
    // select tgl_pinjam from another table
    $update = $mysqli->query("SELECT tgl_pinjam from peminjaman where id_peminjaman='$id_pnjm'");
    $row = mysqli_fetch_assoc($update);
    $tglpnjm = $row['tgl_pinjam'];
    
    // updating the table to change the status
    $ganti = "UPDATE peminjaman set status = 1 where id_peminjaman='$id_pnjm' AND id_brg='$id_barg'";
    $update = $mysqli->query($ganti);
    if($update) {
        $tambah = "INSERT INTO pengembalian (id, id_karyawan, id_peminjaman, id_brg, jml_brg, tgl_pinjam, tgl_kembali) 
                    VALUES($nomor, $id_kry, $id_pnjm, $id_barg, $jml_brg, '$tglpnjm', now())";
        $add = $mysqli->query($tambah);    
        if($add) {
            $updatestok = $mysqli->query("UPDATE barang set stok_brg = stok_brg + $jml_brg where id_brg = $id_barg");
            header("location: ../adminlihatpeminjamanuser_page.php?id=$id_pnjm");
        }else{
            echo $tambah;
            echo "gagal menambah data pengembalian";
        }
    }else{
        echo $ganti;
        echo "gagal mengubah data peminjaman";
    }

    
?>