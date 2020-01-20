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
    <title>Setting</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/dist/css/global.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
        include "navbar_admin.php";
        require 'config/koneksi.php';
    ?>
    <div class="col-md-12">
        <div class="modal-dialog" style="margin-bottom:0;">
            <div class="modal-content" style="background-color: rgba(255, 255, 255, .85);">
                <div class="panel-heading">
                    <h2 class="panel-title" style="text-align:center;">Log In</h2>
                </div>
                <div class="panel-body">
                    <form action="proses/adminchangepassword_proses.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" name="username" type="text" value="<?php echo $admin?>" style="text-align:center;" disabled>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Old Password" name="oldpassword" type="password" style="text-align:center;">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="New Password" name="newpassword" type="password" style="text-align:center;">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <div class="buttonControl">
                                <button class="btn btn-md btn-success" type="submit" style="margin: 5px;">Ubah</button>
                                <input type="button" class="btn btn-md btn-danger" onclick="location.href='admindashboard_page.php'" value="Kembali">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once "templates/footer.php" ?>
</html>