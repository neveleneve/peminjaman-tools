<?php
session_start();
$namaadmin = $_SESSION['adminname'];
require '../config/koneksi.php';
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
    <title>Cetak Laporan Stok</title>
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../karyawan/style.css">
    <link rel="stylesheet" href="../bootstrap/dist/js/bootstrap.min.js">
    <link href="../bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <br>
        <h2 class="text-center">LAPORAN STOK BARANG</h2>
        <div class="col-md-8 col-md-offset-2">
            <div style="clear: both">
                <h5>Stok Barang Tanggal <?php echo tgl_indo(date('Y-m-d')) ?></h5>
            </div>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>No Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok Barang</th>
                </thead>
                <tbody>
                    <?php
                    $q = $mysqli->query("select * from barang");
                    while ($show = mysqli_fetch_array($q)) {
                    ?>
                        <tr>
                            <td><?php echo $show['id_brg'] ?></td>
                            <td><?php echo $show['nama_brg'] ?></td>
                            <td><?php echo $show['stok_brg'] ?></td>
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