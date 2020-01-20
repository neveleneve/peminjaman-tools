<?php
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('location:login_page.php');
    } else {
        $admin = $_SESSION['admin'];
        $namaadmin = $_SESSION['adminname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Karyawan</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/dist/css/global.css" rel="stylesheet">
    <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
        include "navbar_admin.php";
        require 'config/koneksi.php';
    ?>
    <div class="col-md-8 col-md-offset-2 main">
        <h1 class="page-header">Karyawan</h1>
        <div class="row">
            <div class="col-md-12">
                <h3>Tabel Data Karyawan</h3>
                <form class="input-group"action="adminkaryawanlist_page.php" method="get">
                    <input type="text" class="form-control" placeholder="Pencarian" name="cari">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" value="Cari"><i class="fa fa-search"></i></button>
                    </span>
                    </form>
                    <?php
                        if(isset($_GET['cari'])){
	                        $cari = $_GET['cari'];
                        }
                    ?>
                <br>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID Karyawan</th>
                            <th class="text-center">Nama Karyawan</th>
                            <th class="text-center">Divisi</th>
                            <th class="text-center">Proses</th>
                        </tr>
                    </thead>
                    <?php  
                        if(isset($_GET['cari'])){
                            $cari = $_GET['cari'];
                            $querykaryawan = $mysqli->query("SELECT * FROM anggota where id_karyawan like '%".$cari."%' or nama_karyawan like '%".$cari."%' or divisi like '%".$cari."%'");
                        }else{
                            $querykaryawan = $mysqli->query("SELECT * FROM anggota");
                        }
                    ?>
                    <tbody>
                    <?php
                        while ($lihat = mysqli_fetch_array($querykaryawan)){
                    ?>                    
                        <tr>
                            <td class="text-center"><?php echo $lihat['id_karyawan'];; ?></td>
                            <td class="text-center"><?php echo $lihat['nama_karyawan']; ?></td>
                            <td class="text-center"><?php echo $lihat['divisi'];?></td>
                            <td class="text-center">
                                <a href="admintambahpeminjamankaryawan_page.php?id=<?php echo $lihat['id_karyawan'] ?>" class="btn btn-warning fa fa-border fa-plus" data-toggler="tooltip" title="Tambah Peminjaman Karyawan"></a>
                                <a onClick="javascript: return confirm('Yakin Akan Menghapus Data?');" href="proses/admindeletekaryawan_proses.php?id=<?php echo $lihat['id_karyawan']?>" class="btn btn-danger fa fa-border fa-trash-o" data-toggler="tooltip" title="Hapus Data Karyawan"></a>
                            </td>
                        </tr>
                    <?php 
                        } 
                    ?>
                    </tbody>
                </table>
                <div class="col-md-4">
                    <a href="admintambahkaryawan_page.php" class="btn btn-primary fa fa-stack-1x fa-user-plus" data-toggler="tooltip" title="Tambah Data Karyawan"></a>
                </div>
            </div>
        </div>
    </div>
</body>
    <?php require_once "templates/footer.php"?>
</html>