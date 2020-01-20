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
    <title>Data Tools</title>
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
        <h1 class="page-header">Data Tools</h1>
        <div class="row">
            <div class="col-md-12">
                <h3>Tabel Data Tools</h3>
                <form class="input-group"action="admintoolslist_page.php" method="get">
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
                            <th class="text-center">Kode Tools</th>
                            <th class="text-center">Nama Tools</th>
                            <th class="text-center">Jenis Tools</th>
                            <th class="text-center">Stok Tools</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <?php                        
                        if(isset($_GET['cari'])){
                            $cari = $_GET['cari'];
                            $querytools = $mysqli->query("SELECT * FROM barang where id_brg like '%".$cari."%' or nama_brg like '%".$cari."%' or jenis_brg like '%".$cari."%'");
                        }else{
                            $querytools = $mysqli->query("SELECT * FROM barang");
                        }
                    ?>
                    <tbody>
                    <?php
                        while ($lihat = mysqli_fetch_array($querytools)){
                    ?>                    
                        <tr>
                            <td class="text-center"><?php echo $lihat['id_brg']; ?></td>
                            <td class="text-center"><?php echo $lihat['nama_brg']; ?></td>
                            <td class="text-center"><?php echo $lihat['jenis_brg'];?></td>
                            <td class="text-center"><?php echo $lihat['stok_brg']; ?></td>
                            <td class="text-center"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($lihat['foto']).'" style="width:50px; height:50px;">' ?></td>
                            <td class="text-center"> 
                                <a href="adminedittool_page.php?id=<?php echo $lihat['id_brg']; ?>" class="btn btn-default fa fa-border fa-edit"></a>
                                <a href="proses/admindeletetool_proses.php?id=<?php echo $lihat['id_brg']; ?>" class="btn btn-danger fa fa-border fa-trash-o"></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="col-md-4">
                    <a href="admintambahtool_page.php" class="btn btn-primary fa fa-stack-1x fa-plus" data-toggler="tooltip" title="Tambah Data Tool"></a>
                </div>
                <br><br>
            </div>
        </div>        
    </div>
</body>
<?php require_once "templates/footer.php"?>
</html>