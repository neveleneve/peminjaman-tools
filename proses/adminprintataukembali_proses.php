<?php
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('location:login_page.php');
    } else {
        $admin = $_SESSION['admin'];
        $namaadmin = $_SESSION['adminname'];
        $id_pinjam = $_SESSION['idpinjam'];
        $id_kry= $_SESSION['idkry'];
    }    
    include '../config/koneksi.php';
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
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Bukti Pengembalian</title>
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../karyawan/style.css">
    <link rel="stylesheet" href="../bootstrap/dist/js/bootstrap.min.js">
    <link href="../bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <br>
        <h2 class="text-center">BUKTI PENGEMBALIAN BARANG</h2>
        <div class="col-md-8 col-md-offset-2">
            <?php
            //ambil data id peminjaman terakhir untuk id pengembalian baru
            $query = $mysqli->query("SELECT max(id) as a FROM pengembalian");
            $qq = mysqli_fetch_assoc($query);
            $nomor= $qq['a']+1;

            $query = $mysqli->query("Select * from anggota where id_karyawan = $id_kry");
            $getname = mysqli_fetch_assoc($query);
            
            $numb = 1;
            // echo 'nomor data baru = '.$nomor;
            // echo '<br>';
            // echo 'id karyawan = '.$id_kry;
            // echo '<br>';
            // echo 'id pinjam = '.$id_pinjam;
            // echo '<br>';
            //isset always get submit name
            if (isset($_POST['buttonprint'])) {
                $idbrgprint = $_POST['printcheck'];
                $jumlahdataprint = count($idbrgprint);
                $implodeselected = implode(",",$idbrgprint);
                // echo 'array list = '.$implodeselected;
                ?>                
                <div style="clear: both">
                    <h5 style="float:left;">Nama Karyawan&nbsp: <?php echo $getname['nama_karyawan']?></h5>
                </div>
                <div style="clear: both">
                    <h5 style="float:left;">ID Karyawan&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $id_kry ?></h5>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <th>No</th>
                        <th>No Pengembalian</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Pinjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                    </thead>
                
                <?php
                $xxx = $mysqli->query("SELECT * from pengembalian 
                join barang on pengembalian.id_brg=barang.id_brg 
                where id_peminjaman = $id_pinjam and pengembalian.id_brg in ($implodeselected)");
                while ($yyy = mysqli_fetch_array($xxx)) {?>
                    <tbody>
                        <td><?php echo $numb++ ?></td>            
                        <td><?php echo $yyy['id'] ?></td>
                        <td><?php echo $yyy['nama_brg'] ?></td>
                        <td><?php echo $yyy['jml_brg'] ?></td>
                        <td><?php echo strftime('%d %B %Y', strtotime($yyy['tgl_pinjam'])) ?></td>
                        <td><?php echo strftime('%d %B %Y', strtotime($yyy['tgl_pinjam'])) ?></td>
                    </tbody>    
                <?php } ?>
                </table>    
                <p style="margin-left:400px">Tertanda, &nbsp<?php echo tgl_indo(date('Y-m-d')) ?></p>
                <br><br><br><br>
                <p style="margin-left:400px"><?php echo $namaadmin?></p>
                <br><br>
                <?php                
                    echo '<a class="btn btn-danger fa fa-chevron-left noprint" href="../adminlihatpeminjamanuser_page.php?id='.$id_pinjam.'"></a>';
                    echo '<span> </span>';
                    echo '<a class="btn btn-primary fa fa-print noprint" href="javascript:window.print()"></a>';
                ?>
                <?php 
            } elseif (isset($_POST['buttonpengembalian'])) {
                $idbrg = $_POST['kembalicheck'];
                $jumlahdatakembali = count($idbrg);
                for ($i = 0; $i < $jumlahdatakembali; $i++) { 
                    echo 'id barang = '.$idbrg[$i];
                    echo '<br>';        
                    // ambil tgl_pinjam dari tabel peminjaman untuk insert ke pengembalian                    
                    $pilih = $mysqli->query("SELECT tgl_pinjam, jml_brg from peminjaman where id_peminjaman='$id_pinjam' and id_brg='$idbrg[$i]'");
                    $row = mysqli_fetch_assoc($pilih);
                    $jml_brg = $row['jml_brg'];
                    echo 'jml brg = '.$jml_brg;
                    echo '<br>';
                    $tglpnjm = $row['tgl_pinjam'];
                    echo 'tgl pinjam = '.$tglpnjm;
                    //update status peminjaman dari 0 -> 1
                    $ganti = "UPDATE peminjaman set status = 1 where id_peminjaman='$id_pinjam' AND id_brg='$idbrg[$i]'";
                    $update = $mysqli->query($ganti);
                    if ($update) {
                        $tambah = "INSERT INTO pengembalian (id, id_karyawan, id_peminjaman, id_brg, jml_brg, tgl_pinjam, tgl_kembali) 
                                VALUES($nomor, $id_kry, $id_pinjam, $idbrg[$i], $jml_brg, '$tglpnjm', now())";
                        $add = $mysqli->query($tambah);    
                        if($add) {
                            $updatestok = $mysqli->query("UPDATE barang set stok_brg = stok_brg + $jml_brg where id_brg = $idbrg[$i]");
                            header("location: ../adminlihatpeminjamanuser_page.php?id=$id_pinjam");
                        }else{
                            echo $tambah;
                            echo "gagal menambah data pengembalian";
                        }
                    }else {
                        echo $ganti;
                        echo $update;
                        echo "gagal mengubah data peminjaman";
                    }
                }
                
            }else{
                echo 'nothing';
            }?>
        </div>
    </div>
</body>
</html>
