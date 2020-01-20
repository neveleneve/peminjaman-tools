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
    <title>Cetak Laporan</title>
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
        <h1 class="page-header">Cetak Laporan</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Laporan Peminjaman</div>
                    <div class="panel-body">
                        <label for="tanggalawal">Dari Tanggal</label>
                        <input name="tanggalawal" id="tanggalawal" type="date" class="form-control" value="<?php echo date('Y-m-d',strtotime("-1 days"))?>">
                        <br>
                        <label for="tanggalakhir">Sampai Tanggal</label>
                        <input name="tanggalakhir" id="tanggalakhir" type="date" class="form-control" value="<?php echo date("Y-m-d")?>">
                        <br>
                        <a class="btn btn-primary btn-block" href="">Cetak Laporan Peminjaman</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Laporan Stok Tools</div>
                    <div class="panel-body">
                        <a class="btn btn-primary btn-block" href="">Cetak Laporan Stok Tools</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Laporan Pengembalian</div>
                    <div class="panel-body">
                        <label for="tanggalawal">Dari Tanggal</label>
                        <input name="tanggalawal" id="tanggalawal" type="date" class="form-control" value="<?php echo date('Y-m-d',strtotime("-1 days"))?>">
                        <br>
                        <label for="tanggalakhir">Sampai Tanggal</label>
                        <input name="tanggalakhir" id="tanggalakhir" type="date" class="form-control" value="<?php echo date("Y-m-d")?>" max="<?php echo date('Y-m-d')?>">
                        <br>
                        <a class="btn btn-primary btn-block" href="">Cetak Laporan Peminjaman</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>