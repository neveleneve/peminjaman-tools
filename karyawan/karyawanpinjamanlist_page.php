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
    <title>Pinjaman</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/dist/css/global.css" rel="stylesheet">
    <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php    
    include 'navbar_karyawan.php';
    require 'config/koneksi.php';
    $querycheckdata = $mysqli->query("select count(id_brg) as aaa from barang");
    $checkdata = mysqli_fetch_assoc($querycheckdata);
    ?>
    <div class="col-md-8 col-md-offset-2 main">
        <h1 class="page-header">Pinjaman</h1>
        <h3>Tabel Transaksi Peminjaman</h3>
        <form class="input-group" action="karyawanpinjamanlist_page.php" method="get">
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
            <div class="col-md-12">

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No Peminjaman</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Peminjaman</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status Peminjaman</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($_GET['cari'])) {
                        $sql = "SELECT peminjaman.id_peminjaman, barang.nama_brg, 
                            peminjaman.jml_brg, peminjaman.tgl_pinjam, peminjaman.status 
                            from peminjaman 
                            join barang 
                            on peminjaman.id_brg = barang.id_brg 
                            WHERE peminjaman.id_karyawan = '" . $idkaryawan . "' 
                            and (nama_brg like '%" . $cari . "%'
                            or id_peminjaman like '%" . $cari . "%')                            
                            order by id_peminjaman asc";
                    } else {
                        $sql = "SELECT peminjaman.id_peminjaman, barang.nama_brg, 
                            peminjaman.jml_brg, peminjaman.tgl_pinjam, peminjaman.status 
                            from peminjaman 
                            join barang 
                            on peminjaman.id_brg = barang.id_brg 
                            WHERE peminjaman.id_karyawan = $idkaryawan
                            order by id_peminjaman asc";
                    }
                    ?>
                    <tbody>
                        <?php $querytools = $mysqli->query($sql);
                        while ($show = mysqli_fetch_array($querytools)) {
                        ?>
                            <tr>
                                <td><?php echo $show['id_peminjaman'] ?></td>
                                <td><?php echo $show['nama_brg'] ?></td>
                                <td><?php echo $show['jml_brg'] ?></td>
                                <td><?php echo date('d M Y', strtotime($show['tgl_pinjam'])); ?></td>
                                <td class="text-center"><span class="btn btn-<?php echo $show['status'] == 1 ? 'success' : 'danger' ?> fa fa-border fa-<?php echo $show['status'] == 1 ? 'check' : 'remove' ?>" disabled></span></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php require_once 'templates/footer.php' ?>

</html>