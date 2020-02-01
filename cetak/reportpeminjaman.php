<?php
session_start();
$namaadmin = $_SESSION['adminname'];
$tanggalawal = $_POST['tanggalawal1'];
$tanggalakhir = $_POST['tanggalakhir1'];
// echo str_replace('-', '/', $tanggalawal);
// echo $tanggalawal;
// echo $tanggalakhir;
setlocale(LC_ALL, 'IND');
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Peminjaman</title>
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../karyawan/style.css">
    <link rel="stylesheet" href="../bootstrap/dist/js/bootstrap.min.js">
    <link href="../bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    require '../config/koneksi.php';
    ?>
    <div class="container">
        <br>
        <h2 class="text-center">LAPORAN PEMINJAMAN</h2>
        <div class="col-md-8 col-md-offset-2">
            <div style="clear:both">
                <h5>Jangka Waktu : <?php echo tgl_indo($tanggalawal) ?> - <?php echo tgl_indo($tanggalakhir) ?></h5>
            </div>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>No Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Total Pinjam</th>
                    <th>Tanggal Pinjam</th>
                </thead>
                <tbody>
                    <?php
                    $q = $mysqli->query("select * from peminjaman 
                            join barang on peminjaman.id_brg = barang.id_brg
                            join anggota on peminjaman.id_karyawan = anggota.id_karyawan
                            where tgl_pinjam between '$tanggalawal' and '$tanggalakhir'
                            order by id_peminjaman");
                    while ($show = mysqli_fetch_array($q)) {
                    ?>
                        <tr>
                            <td><?php echo $show['id_peminjaman'] ?></td>
                            <td><?php echo $show['nama_karyawan'] ?></td>
                            <td><?php echo $show['nama_brg'] ?></td>
                            <td><?php echo $show['jml_brg'] ?></td>
                            <td><?php echo tgl_indo($show['tgl_pinjam']) ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <p style="margin-left:400px">Tertanda, &nbsp<?php echo tgl_indo(date('Y-m-d')) ?></p>
            <br><br><br><br>
            <p style="margin-left:400px"><?php echo $namaadmin ?></p>
            <br><br>
            <?php
            echo '<a class="btn btn-danger fa fa-chevron-left noprint" href="../adminreport_page.php"></a>';
            echo '<span> </span>';
            echo '<a class="btn btn-primary fa fa-print noprint" href="javascript:window.print()"></a>';
            ?>
            <br><br>
        </div>
    </div>
</body>

</html>