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
    <title>Dashboard</title>
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
        <h1 class="page-header">Dashboard</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>Data Administrasi</h3>
                <div class="panel panel-default">
                    <div class="panel-heading">Data Tools Tersedia</div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <i class="fa fa-book fa-4x"></i>
                        </div>
                        <?php
                            $query = $mysqli->query("SELECT count(id_brg) as a FROM barang WHERE stok_brg <> 0");
                            $data = mysqli_fetch_assoc($query);
                        ?>
                        <h2><?php echo $data['a']; ?> Tools</h2>
                    </div>
                </div>                
                <div class="panel panel-default">
                    <div class="panel-heading">Data Peminjaman Tools</div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <i class="fa fa-book fa-4x"></i>
                        </div>
                        <?php
                            require 'config/koneksi.php';
                            $query = $mysqli->query("SELECT count(id_peminjaman) as a FROM peminjaman WHERE status = 0");
                            $data = mysqli_fetch_assoc($query);
                        ?>
                        <h2><?php echo $data['a']; ?> Peminjaman</h2>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Data Pengembalian Tools</div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <i class="fa fa-book fa-4x"></i>
                        </div>
                        <?php
                            require 'config/koneksi.php';
                            $query = $mysqli->query("SELECT count(id) as a FROM pengembalian");
                            $data = mysqli_fetch_assoc($query);
                        ?>
                        <h2><?php echo $data['a']; ?> Pengembalian</h2>
                    </div>
                </div>                
            </div>
            <div class="col-md-6">
                <h3>Data Stok Tools</h3>
                <?php
                    $queryalat = $mysqli->query("SELECT * FROM barang");
                    while ($rowalat = mysqli_fetch_array($queryalat)) {                        
                ?>        
                <div class="panel panel-default">
                    <div class="panel-heading">Data Stok <?php echo $rowalat['nama_brg']; ?></div>
                    <div class="panel-body">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($rowalat['foto']).'" style="float:left; width:100px; height:100px;">' ?>
                        <h2>&nbsp;&nbsp;&nbsp;Stok Tools : <?php echo $rowalat['stok_brg']; ?></h2>
                    </div>
                </div>    
                <?php } ?>
                
            </div>
        </div>
    </div>

</body>
<?php require_once "templates/footer.php"?>
</html>