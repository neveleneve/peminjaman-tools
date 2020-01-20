<?php   
    session_start();
    include '../config/koneksi.php';
    $namaadmin = $_SESSION['adminname'];
    $idpinjam = $_GET['idpinjam'];
    $idkry = $_GET['idkaryawan'];
    $query = $mysqli->query("Select * from anggota where id_karyawan = $idkry");
    $queryx = $mysqli->query("Select * from peminjaman where id_peminjaman = $idpinjam");
    $getname = mysqli_fetch_assoc($query);
    $getnamex = mysqli_fetch_assoc($queryx);
    setlocale(LC_ALL, 'IND');
    function tgl_indo($tanggal){
        $bulan = array (
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
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Bukti Peminjaman</title>
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../karyawan/style.css">
    <link rel="stylesheet" href="../bootstrap/dist/js/bootstrap.min.js">
    <link href="../bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <br>
        <h2 class="text-center">BUKTI PEMINJAMAN BARANG</h2>
        <div class="col-md-8 col-md-offset-2">
            <div style="clear: both">
                <h5 style="float:left;">Nama Karyawan&nbsp: <?php echo $getname['nama_karyawan']?></h5>
                <h5 style="float:right;">ID : <?php echo $idpinjam?></h5>
            </div>
            <div style="clear:both">
                <h5 style="float:left;">ID Karyawan&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $getname['id_karyawan']?></h5>
            </div>            
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>Nama Barang</th>
                    <th>Jumlah Peminjaman</th>
                </thead>
                <?php
                    $itempinjamq = $mysqli->query("select * from peminjaman 
                    join barang on peminjaman.id_brg = barang.id_brg 
                    where id_peminjaman = $idpinjam");
                    while ($show = mysqli_fetch_array($itempinjamq)) {
                ?>
                <tbody>
                    <td><?php echo $show['nama_brg']?></td>
                    <td><?php echo $show['jml_brg']?></td>
                </tbody>
                <?php 
                    }                
                ?>
            </table>
            
            <p style="margin-left:400px">Tertanda, &nbsp<?php echo tgl_indo(date('Y-m-d'))?></p>
            <br><br><br><br>
            <p style="margin-left:400px"><?php echo $namaadmin?></p>
            <br><br>
            <?php                
                echo '<a class="btn btn-danger fa fa-chevron-left noprint" href="../adminpeminjamanlist_page.php"></a>';
                echo '<span> </span>';
                echo '<a class="btn btn-primary fa fa-print noprint" href="javascript:window.print()"></a>';
            ?>
        </div>
    </div>
</body>
</html>