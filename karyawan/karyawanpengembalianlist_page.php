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
        <h1 class="page-header">Pengembalian</h1>
        <h3>Tabel Transaksi Pengembalian</h3>
        <form class="input-group" action="karyawanpengembalianlist_page.php" method="get">
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
                            <th class="text-center">Nomor</th>
                            <th class="text-center">Nomor Pengembalian</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Jumlah Peminjaman</th>
                            <th class="text-center">Tanggal Pinjam</th>
                            <th class="text-center">Tanggal Batas Peminjaman</th>
                            <th class="text-center">Tanggal Kembali</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 1;
                    if (isset($_GET['cari'])) {
                        $sql = "SELECT * from pengembalian
                            join barang on pengembalian.id_brg = barang.id_brg                         
                            WHERE id_karyawan = $idkaryawan
                            and (pengembalian.id like '%" . $cari . "%' 
                            or barang.nama_brg like '%" . $cari . "%')
                            order by pengembalian.id";
                    } else {
                        $sql = "SELECT * from pengembalian
                            join barang on pengembalian.id_brg = barang.id_brg                         
                            WHERE id_karyawan = $idkaryawan 
                            order by pengembalian.id";
                    } ?>
                    <tbody>
                        <?php $querytools = $mysqli->query($sql);
                        while ($show = mysqli_fetch_array($querytools)) {
                        ?>
                            <tr class="text-center">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $show['id'] ?></td>
                                <td><?php echo $show['nama_brg'] ?></td>
                                <td><?php echo $show['jml_brg'] ?></td>
                                <td><?php echo date('d M Y', strtotime($show['tgl_pinjam'])); ?></td>
                                <td><?php echo date('d M Y', strtotime($show['tgl_wajib_kembali'])); ?></td>
                                <td><?php echo date('d M Y', strtotime($show['tgl_kembali'])); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php require_once '../templates/footer.php' ?>

</html>