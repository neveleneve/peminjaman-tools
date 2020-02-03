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
    <title>Peminjaman</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/dist/css/global.css" rel="stylesheet">
    <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    require 'config/koneksi.php';
    include "navbar_admin.php";
    $checkpinjamandekat = "select * from peminjaman where status = 0 and tgl_wajib_kembali between DATE(NOW()) and DATE(NOW()) + INTERVAL 3 DAY";
    $checkpinjamanlewat = "select * from peminjaman where status = 0 and tgl_wajib_kembali < DATE(NOW())";
    $exepinjamandekat = $mysqli->query($checkpinjamandekat);
    $exepinjamanlewat = $mysqli->query($checkpinjamanlewat);
    if (mysqli_num_rows($exepinjamanlewat) != 0) {
        include 'notifdeadlinelewat.php';
    } elseif (mysqli_num_rows($exepinjamandekat) != 0) {
        include 'notifdeadlinedekat.php';
    }
    ?>
    <div class="col-md-8 col-md-offset-2 main">
        <h1 class="page-header">Peminjaman Tools</h1>
        <div class="row">
            <div class="col-md-12">
                <h3>Tabel Data Peminjaman</h3>
                <form class="input-group" action="adminpeminjamanlist_page.php" method="get">
                    <input type="text" class="form-control" placeholder="Pencarian" name="cari">
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
                <table class="table table-bordered table-striped table-hover table-resonsive">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Karyawan</th>
                            <th class="text-center">Tanggal Pinjam</th>
                            <th class="text-center">Tanggal Wajib Kembali</th>
                            <th class="text-center">Action</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <?php
                    // $querytools = $mysqli->query("SELECT * FROM peminjaman JOIN anggota on peminjaman.id_karyawan=anggota.id_karyawan group by id_peminjaman");
                    if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        $querytools = $mysqli->query("SELECT * FROM peminjaman 
                            JOIN anggota on peminjaman.id_karyawan = anggota.id_karyawan
                            JOIN barang on peminjaman.id_brg = barang.id_brg
                            where (peminjaman.id_karyawan like '%" . $cari . "%' 
                            or anggota.nama_karyawan like '%" . $cari . "%' 
                            or peminjaman.id_peminjaman like '%" . $cari . "%' 
                            or barang.nama_brg like '%" . $cari . "%')
                            order by peminjaman.id_peminjaman asc");
                    } else {
                        $querytools = $mysqli->query("SELECT * FROM peminjaman 
                            JOIN anggota on peminjaman.id_karyawan = anggota.id_karyawan
                            JOIN barang on peminjaman.id_brg = barang.id_brg
                            group by id_peminjaman
                            order by peminjaman.id_peminjaman asc");
                    } ?>
                    <tbody>
                        <?php
                        while ($lihat = mysqli_fetch_array($querytools)) {
                        ?>
                            <tr>
                                <td class="text-center vertical-center">
                                    <?php
                                    echo $lihat['id_peminjaman'];
                                    $idpinjam = $lihat['id_peminjaman'];
                                    ?>
                                </td>
                                <td class="text-center"><?php echo $lihat['nama_karyawan']; ?></td>
                                <td class="text-center"><?php echo date('d M Y', strtotime($lihat['tgl_pinjam'])); ?></td>
                                <td class="text-center"><?php echo date('d M Y', strtotime($lihat['tgl_wajib_kembali'])); ?></td>
                                <!-- <td><a class="btn btn-default" href="proses/adminpeminjamanbarangkembali_proses.php?idbarang=<?php echo $lihat['id_brg'] ?>&idpinjam=<?php echo $lihat['id_peminjaman'] ?>&idkaryawan=<?php echo $lihat['id_karyawan'] ?>&jmlbrg=<?php echo $lihat['jml_brg'] ?>">Pengembalian</a></td> -->
                                <td class="text-center">
                                    <a class="btn btn-warning fa fa-border fa-list" href="adminlihatpeminjamanuser_page.php?id=<?php echo $lihat['id_peminjaman'] ?>" data-toggler="tooltip" title="Lihat Peminjaman User"></a>
                                    <a class="btn btn-primary fa fa-border fa-print" href="cetak/bukti_peminjaman.php?idpinjam=<?php echo $lihat['id_peminjaman'] ?>&idkaryawan=<?php echo $lihat['id_karyawan'] ?>" data-toggler="tooltip" title="Cetak Bukti Peminjaman"></a>
                                </td>
                                <?php
                                $querytotalsudah = $mysqli->query("SELECT count(id_peminjaman) as aaa From peminjaman where id_peminjaman=$idpinjam and status=1");
                                $querytotal = $mysqli->query("SELECT count(id_peminjaman) as aaa From peminjaman where id_peminjaman=$idpinjam");
                                $xxx = mysqli_fetch_assoc($querytotal);
                                $yyy = mysqli_fetch_assoc($querytotalsudah);?>
                                <td class="text-center"><a class="btn btn-<?php echo $xxx['aaa'] == $yyy['aaa'] ? 'success' : 'danger' ?> fa fa-border fa-<?php echo $xxx['aaa'] == $yyy['aaa'] ? 'check' : 'remove' ?>" data-toggler="tootltip" title="<?php echo $xxx['aaa'] == $yyy['aaa'] ? 'Sudah Mengembalikan Semua Barang' : 'Masih Dalam Peminjaman' ?>"></a>
                                <?php
                                if ((strtotime($lihat['tgl_wajib_kembali']) < time()) && $lihat['status'] == 0) { ?>
                                    <span class="btn btn-danger fa fa-border fa-warning" data-toggler="tooltip" title="Peminjaman Sudah Melewati Batas Waktu Peminjaman"></span>
                                <?php
                                } elseif ((strtotime('+3 day', time()) > strtotime($lihat['tgl_wajib_kembali'])) && $lihat['status'] == 0) { ?>
                                    <span class="btn btn-warning fa fa-border fa-warning" data-toggler="tooltip" title="Peminjaman Akan Melewati Batas Waktu Peminjaman"></span>
                                <?php } ?>                                
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div><br><br>
    </div>
</body>
<?php require_once "templates/footer.php" ?>
</html>