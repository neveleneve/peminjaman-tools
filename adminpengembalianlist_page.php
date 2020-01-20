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
    <title>Pengembalian</title>
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
        <h1 class="page-header">Pengembalian Tools</h1>
        <div class="row">
            <div class="col-md-12">
                <h3>Tabel Data Pengembalian</h3>
                <form class="input-group" action="adminpengembalianlist_page.php" method="get">
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
                        <th class="text-center">No Pengembalian</th>
                        <th class="text-center">Nama Peminjam</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Tanggal Pinjam</th>
                        <th class="text-center">Tanggal Kembali</th>
                    </thead>
                    <?php                        
                        if(isset($_GET['cari'])){
                            $cari = $_GET['cari'];
                            $sql = "SELECT pengembalian.id, pengembalian.tgl_kembali, barang.nama_brg, 
                            pengembalian.jml_brg, pengembalian.tgl_pinjam, 
                            anggota.nama_karyawan FROM pengembalian 
                            JOIN anggota ON pengembalian.id_karyawan=anggota.id_karyawan 
                            JOIN barang ON barang.id_brg = pengembalian.id_brg 
                            where pengembalian.id like '%".$cari."%' 
                            or anggota.nama_karyawan like '%".$cari."%' 
                            or anggota.id_karyawan like '%".$cari."%' 
                            order by pengembalian.id asc";
                        }else{
                            $sql = "SELECT pengembalian.id, pengembalian.tgl_kembali, barang.nama_brg, 
                            pengembalian.jml_brg, pengembalian.tgl_pinjam, 
                            anggota.nama_karyawan FROM pengembalian 
                            JOIN anggota ON pengembalian.id_karyawan=anggota.id_karyawan 
                            JOIN barang ON barang.id_brg = pengembalian.id_brg 
                            order by pengembalian.id asc";
                        }
                    ?>
                    <tbody>
                    <?php
                        $query = $mysqli->query($sql);
                        while ($lihat=mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $lihat['id'] == 0 ? 'X' : $lihat['id'] ?></td>
                            <td class="text-center"><?php echo $lihat['nama_karyawan'];?></td>
                            <td class="text-center"><?php echo $lihat['nama_brg'];?></td>
                            <td class="text-center"><?php echo $lihat['jml_brg'];?></td>
                            <td class="text-center"><?php echo date('d M Y',strtotime($lihat['tgl_pinjam'])); ?></td>
                            <td class="text-center"><?php echo date('d M Y',strtotime($lihat['tgl_kembali'])); ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</body>
<?php require_once "templates/footer.php"?>
</html>