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
    <title>List Peminjaman User</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/dist/css/global.css" rel="stylesheet">
    <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">    
</head>
<body>
    <?php
        include "navbar_admin.php";
        require 'config/koneksi.php';
        require "templates/footer.php";        
    ?>
    <div class="col-md-8 col-md-offset-2 main">
        <h1 class="page-header">List Peminjaman User</h1>
        <div class="row">
            <div class="col-md-12">
                <h3>Tabel Data Peminjaman User</h3>
                <form action="proses/adminprintataukembali_proses.php" method="POST" >
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Pinjam</th>
                                <th>Status</th>
                                <th>Pengembalian</th>
                                <th>Print</th>
                            </tr>
                        </thead>
                        <?php
                                $id_pinjam = $_GET['id'];
                                $_SESSION['idpinjam'] = $_GET['id'];
                                $querypinjam = $mysqli->query("SELECT * FROM peminjaman 
                                JOIN anggota on peminjaman.id_karyawan=anggota.id_karyawan 
                                JOIN barang on peminjaman.id_brg=barang.id_brg 
                                where id_peminjaman='$id_pinjam'");
                                $no = 1;
                                
                                while ($show = mysqli_fetch_array($querypinjam)){
                            ?>
                        <tbody>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $show['nama_brg']; ?></td>
                                <td><?php echo $show['jml_brg']; ?></td>
                                <td><button class="btn btn-<?php echo $show['status'] == 1 ? 'success' : 'danger' ?> fa fa-border fa-<?php echo $show['status'] == 1 ? 'check' : 'remove'; ?>" disabled></button></td>
                                <td>
                                    <input class="checkkembali" type="checkbox" name="kembalicheck[]" value="<?php echo $show['id_brg']?>" <?php echo $show['status'] == 1 ? 'disabled' : '' ?>/>                                        
                                </td>
                                <td>
                                    <input class="checkprint" type="checkbox" name="printcheck[]" value="<?php echo $show['id_brg']?>" <?php echo $show['status'] == 1 ? NULL : 'disabled' ?>/>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                        <?php 
                            $queryxxx = $mysqli->query("SELECT id_karyawan FROM peminjaman 
                            where id_peminjaman='$id_pinjam'");
                            $xxx = mysqli_fetch_assoc($queryxxx);
                            $_SESSION['idkry'] = $xxx['id_karyawan'];
                        ?>
                    </table>
                    <div style="clear:both">
                        <a style="float:left" href="adminpeminjamanlist_page.php"
                            class="btn btn-danger fa fa-chevron-left ">
                        </a>                    
                        <button type="submit" id="print" class="btn btn-primary fa fa-print" name="buttonprint" value="printing" style="float:right" data-toggler="tooltip" title="Cetak Bukti Pengembalian">
                        </button>
                        <button type="submit" id="pengembalian" class="btn btn-warning fa fa-file-text-o" name="buttonpengembalian" value="kembali" style="float:right; margin-right:5px" data-toggler="tooltip" title="Tambahkan Pengembalian Barang">
                        </button>
                    </div>                
                </form>
                <script>
                    $('#print').prop('disabled', true);
                    $('#pengembalian').prop('disabled', true);
                    $('input.checkprint').click(function() {
                        if ($(this).is(':checked')) {
                            $('#print').prop('disabled', false);
                        } else {
                            if ($('.checkprint').filter(':checked').length < 1) {
                                $('#print').attr('disabled', true);
                            }
                        }
                    });
                    $('input.checkkembali').click(function() {
                        if ($(this).is(':checked')) {
                            $('#pengembalian').prop('disabled', false);
                        } else {
                            if ($('.checkkembali').filter(':checked').length < 1) {
                                $('#pengembalian').attr('disabled', true);
                            }
                        }
                    });
                    </script>
            </div>
        </div>
    </div>
    <?php 
    // require_once 'templates/footer.php' 
    ?>
</body>

</html>