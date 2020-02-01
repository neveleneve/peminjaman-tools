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
    <title>Dashboard</title>
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap/dist/css/global.css" rel="stylesheet">
    <link href="../bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    require 'config/koneksi.php';
    $checkpinjaman = "select * from peminjaman where id_karyawan='$idkaryawan' and status=0";
    $exepinjaman = $mysqli->query($checkpinjaman);
    include 'notifdeadlinelewat.php';
    include 'navbar_karyawan.php';
    $querycheckdata = $mysqli->query("select count(id_brg) as aaa from barang");
    $checkdata = mysqli_fetch_assoc($querycheckdata);
    ?>
    <div class="col-md-8 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>
        <h3>Data Tools</h3>
        <form class="input-group" action="karyawandashboard_page.php" method="get">
            <input type="text" class="form-control" placeholder="Pencarian" name="cari" <?php echo $checkdata['aaa'] == 0 ? 'disabled' : '' ?>>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" value="Cari"><i class="fa fa-search"></i></button>
            </span>
        </form>
        <?php
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
        ?>
        <br>
        <div class="row">
            <?php
            if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $sql = "SELECT * from barang 
                    where id_brg like '%" . $cari . "%' 
                    or nama_brg like '%" . $cari . "%'  
                    or jenis_brg like '%" . $cari . "%' 
                    order by id_brg";
            } else {
                $sql = "SELECT * from barang";
            }
            $query = $mysqli->query($sql);
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $data['nama_brg'] ?></div>
                        <div class="panel-body">
                            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($data['foto']) . '" style="margin:4px; width:200px; height:200px;">' ?>
                            <h4>Jenis Barang : <?php echo $data['jenis_brg'] ?></h4>
                            <h4>Stok Tools : <?php echo $data['stok_brg'] ?></h4>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
<?php require_once 'templates/footer.php' ?>

</html>