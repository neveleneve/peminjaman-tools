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
    <title>Edit Tools</title>
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
        <h1 class="page-header">Edit Data Tools</h1>
        <?php
            $id_brg = $_GET['id'];
            $query = $mysqli->query("SELECT * FROM barang where id_brg='$id_brg'");
            while ($qu = mysqli_fetch_array($query)){
        ?>
        <!-- form start -->
        <form role="form" action="proses/adminedittool_proses.php" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="text" disable value="<?php echo $qu['id_brg'] ?>" name="id_brg" class="form-control"
                        placeholder="" disabled>
                    <input type="hidden" value="<?= $qu['id_brg']; ?>" name="id_brg">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama Barang</label>
                    <input type="text" value="<?php echo $qu['nama_brg'] ?>" name="nama_brg" class="form-control"
                        placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Jenis Barang</label>
                    <input type="text" value="<?php echo $qu['jenis_brg'] ?>" name="jenis_brg" class="form-control"
                        placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Stok Barang</label>
                    <input type="text" value="<?php echo $qu['stok_brg'] ?>" name="stok_brg" class="form-control"
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