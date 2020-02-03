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
    require 'config/koneksi.php';
    include 'navbar_karyawan.php';
    $checkpinjamandekat = "select * from peminjaman where id_karyawan='$idkaryawan' and status=0 and tgl_wajib_kembali between DATE(NOW()) and DATE(NOW()) + INTERVAL 3 DAY";
    $checkpinjamanlewat = "select * from peminjaman where id_karyawan='$idkaryawan' and status=0 and tgl_wajib_kembali < DATE(NOW())";
    $exepinjamandekat = $mysqli->query($checkpinjamandekat);
    $exepinjamanlewat = $mysqli->query($checkpinjamanlewat);
    if (mysqli_num_rows($exepinjamanlewat) != 0) {
        include 'notifdeadlinelewat.php';
    } elseif (mysqli_num_rows($exepinjamandekat) != 0) {
        include 'notifdeadlinedekat.php';
    }
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
                            <th class="text-center">Nomor Peminjaman</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Jumlah Peminjaman</th>
                            <th class="text-center">Tanggal Pinjam</th>
                            <th class="text-center">Tanggal Wajib Kembali</th>
                            <th class="text-center">Status Peminjaman</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($_GET['cari'])) {
                        $sql = "SELECT peminjaman.id_peminjaman, barang.nama_brg, 
                            peminjaman.jml_brg, peminjaman.tgl_pinjam, peminjaman.status, peminjaman.tgl_wajib_kembali
                            from peminjaman 
                            join barang 
                            on peminjaman.id_brg = barang.id_brg 
                            WHERE peminjaman.id_karyawan = '" . $idkaryawan . "' 
                            and (nama_brg like '%" . $cari . "%'
                            or id_peminjaman like '%" . $cari . "%')                            
                            order by id_peminjaman asc";
                    } else {
                        $sql = "SELECT peminjaman.id_peminjaman, barang.nama_brg, 
                            peminjaman.jml_brg, peminjaman.tgl_pinjam, peminjaman.status, peminjaman.tgl_wajib_kembali
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
                            <tr class="text-center">
                                <td><?php echo $show['id_peminjaman'] ?></td>
                                <td><?php echo $show['nama_brg'] ?></td>
                                <td><?php echo $show['jml_brg'] ?></td>
                                <td><?php echo date('d M Y', strtotime($show['tgl_pinjam'])); ?></td>
                                <td><?php echo date('d M Y', strtotime($show['tgl_wajib_kembali'])); ?></td>
                                <td>
                                    <span class="btn btn-<?php echo $show['status'] == 1 ? 'success' : 'danger' ?> fa fa-border fa-<?php echo $show['status'] == 1 ? 'check' : 'remove' ?>" disabled></span>
                                    <?php
                                    if (strtotime($show['tgl_wajib_kembali']) < time()) { ?>
                                        <span class="btn btn-danger fa fa-border fa-warning" data-toggler="tooltip" title="Peminjaman Sudah Melewati Batas Waktu Peminjaman" disabled></span>
                                    <?php
                                    } elseif (strtotime('+3 day', time()) > strtotime($show['tgl_wajib_kembali'])) { ?>
                                        <span class="btn btn-warning fa fa-border fa-warning" data-toggler="tooltip" title="Peminjaman Akan Melewati Batas Waktu Peminjaman" disabled></span>
                                    <?php } ?>
                                </td>
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