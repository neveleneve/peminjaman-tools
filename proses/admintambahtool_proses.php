<?php
    if (count($_FILES) > 0 ) {
        if (is_uploaded_file($_FILES['foto_brg']['tmp_name'])) {
            require_once "../config/koneksi.php";
            $id_brg = $_POST['id_brg'];
            $nama_brg = $_POST['nama_brg'];
            $jenis_brg = $_POST['jenis_brg'];
            $stok_brg = $_POST['stok_brg'];
            $imgData = addslashes(file_get_contents($_FILES['foto_brg']['tmp_name']));
            $imgProperties = getimagesize($_FILES['foto_brg']['tmp_name']);
            $insertQuery = "insert into barang values ('{$id_brg}', '{$nama_brg}', '{$jenis_brg}', '{$stok_brg}', '{$imgData}')";
            $insert = $mysqli->query($insertQuery);
            if(isset($insert)) {
                header("location:../admintoolslist_page.php");
            }else{
                echo $ganti;
                echo "gagal mengubah data";
            }            
        }
    }else {
        echo "error";
    }
    // $format = ".jpg";
    // 
    // $tambah = $mysqli->query($ganti);
    
?>