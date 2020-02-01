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
    require_once 'templates/footer.php';
    ?>
    <div class="col-md-8 col-md-offset-2 main">
        <h1 class="page-header">Cetak Laporan</h1>
        <div class="row">
            <form action="cetak/reportpeminjaman.php" method="post">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Laporan Peminjaman</div>
                        <div class="panel-body">
                            <label for="tanggalawal1">Dari Tanggal</label>
                            <input name="tanggalawal1" id="tanggalawal1" type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime("-1 days")) ?>">
                            <br>
                            <label for="tanggalakhir">Sampai Tanggal</label>
                            <input name="tanggalakhir1" id="tanggalakhir1" type="date" class="form-control" value="<?php echo date("Y-m-d") ?>">
                            <br>
                            <input type="submit" class="btn btn-primary btn-block" value="Cetak Laporan Peminjaman">
                        </div>
                    </div>
                </div>
            </form>
            <form action="cetak/reportstok.php" method="post">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Laporan Stok Tools</div>
                        <div class="panel-body">
                            <input type="submit" class="btn btn-primary btn-block" value="Cetak Laporan Stok Tools">
                        </div>
                    </div>
                </div>
            </form>
            <form action="cetak/reportpengembalian.php" method="post">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Laporan Pengembalian</div>
                        <div class="panel-body">
                            <label for="tanggalawal2">Dari Tanggal</label>
                            <input name="tanggalawal2" id="tanggalawal2" type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime("-1 days")) ?>">
                            <br>
                            <label for="tanggalakhir2">Sampai Tanggal</label>
                            <input name="tanggalakhir2" id="tanggalakhir2" type="date" class="form-control" value="<?php echo date("Y-m-d") ?>" max="<?php echo date('Y-m-d') ?>">
                            <br>
                            <input type="submit" class="btn btn-primary btn-block" value="Cetak Laporan Pengembalian">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>