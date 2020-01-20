<?php
    session_start();
    if (!isset($_SESSION['nama_karyawan'])) {
        header('location:../login_page.php');
    } else {
        $karyawan = $_SESSION['nama_karyawan'];
        $idkaryawan = $_SESSION['id_karyawan'];
    }    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peminjaman</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/dist/css/global.css" rel="stylesheet">
    <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">    
    <link href="style.css" rel="stylesheet">    
    
</head>
<body>
    <script>
        function foo() {
            var confirmation = confirm("Masukkan Data Peminjaman Anda?");
            if(confirmation){
                return true;
            }else{
                return false;
            }            
        }
    </script>
    <?php
        include 'navbar_karyawan.php';
        require 'config/koneksi.php';
        $querycheckdata = $mysqli->query("select count(id_brg) as aaa from barang");
        $checkdata = mysqli_fetch_assoc($querycheckdata);
    ?>
    <div class="col-md-8 col-md-offset-2 main">
        <h1 class="page-header">Peminjaman</h1>
        <!-- <input class="form-control" type="number"> -->
        <form class="input-group" action="karyawanpinjam_page.php" method="get">
            <input type="text" class="form-control" placeholder="Pencarian" name="cari" <?php echo $checkdata['aaa'] == 0 ? 'disabled' : '' ?>>
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
        <div class="row">
            <form role="form" onsubmit="return foo();" enctype="multipart/form-data" action="proses/karyawanpinjam_proses.php" method="post">
                <?php
                    if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        $sql = "SELECT * FROM barang 
                        where id_brg like '%".$cari."%' 
                        or nama_brg like '%".$cari."%'  
                        or jenis_brg like '%".$cari."%' 
                        order by id_brg";
                    }else{
                        $sql = "SELECT * from barang";
                    }
                    $query = $mysqli->query($sql);
                    while($data = mysqli_fetch_assoc($query)){
                ?>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Data <?php echo $data['nama_brg']?></div>
                        <div class="panel-body">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($data['foto']).'" style="float:left; width:200px; height:200px; margin:4px;">' ?>
                            <h3 style="text-align:center;"><?php echo $data['nama_brg']?></h3>
                            <h5 style="text-align:center;"><?php echo $data['jenis_brg']?></h5>
                            <h5 style="text-align:center;">Tersedia : <?php echo $data['stok_brg']?></h5>
                            <input class="form-control" placeholder="<?php echo $data['stok_brg'] == 0 ? 'Stok Habis' : 'Jumlah Peminjaman'?>" type="number" min="0" max="<?php echo $data['stok_brg']?>" name="<?php echo $data['id_brg']?>" data-toggler="tooltip" title="Input Jumlah Peminjaman <?php echo $data['nama_brg']?>" <?php echo $data['stok_brg'] == 0 ? 'disabled' : '' ?>>
                        </div>
                    </div>
                </div>
                <?php }?>
                <div class="col-md-12">
                    <?php                        
                        if ($checkdata['aaa'] == 0) {
                    ?>    
                        <h3 style="text-align:center;">Data Tidak Ditemukan</h3>
                    <?php 
                        }else{
                    ?>  
                        <input class="btn btn-primary btn-block" type="submit" value="Pinjam" data-toggler="tooltip" title="Lanjutkan Peminjaman"/>
                        <br>                        
                    <?php
                        }
                    ?>
                </div>
            </form>            
        </div>
    </div>    
</body>

<?php require_once '../templates/footer.php'?>
</html>
