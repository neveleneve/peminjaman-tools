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
    <title>Tambah Data Tools</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/dist/css/global.css" rel="stylesheet">
    <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
        include "navbar_admin.php";
        require 'config/koneksi.php';
    ?>
    <div class="col-md-8 col-md-offset-2 main">
        <h1 class="page-header">Tambah Data Tools</h1>
        <?php
            $query = $mysqli->query("SELECT max(id_brg) as a FROM barang");
            while ($qu = mysqli_fetch_array($query)){
        ?>
        <!-- form start -->
        <form role="form" enctype="multipart/form-data" action="proses/admintambahtool_proses.php" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputID">ID</label>
                    <input type="text" disable value="<?php echo $qu['a']+1; ?>" name="id_brg" class="form-control"
                        placeholder="" disabled>
                    <input type="hidden" value="<?= $qu['a']+1; ?>" name="id_brg">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Nama Tools</label>
                    <input type="text" value="" name="nama_brg" class="form-control"
                        placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputType">Jenis Tools</label>
                    <input type="text" value="" name="jenis_brg" class="form-control"
                        placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputStock">Stok Tools</label>
                    <input type="text" value="" name="stok_brg" class="form-control"
                        placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPhoto">Foto Tools</label>
                    <input name="foto_brg" type="file" value="" class="form-control"
                        placeholder="" required>
                </div>
                <?php
                    }
                ?>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="admintoolslist_page.php" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</body>
<?php require_once "templates/footer.php"?>
</html>