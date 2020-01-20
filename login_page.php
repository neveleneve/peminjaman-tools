<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Log In</title>
</head>
<body class="example">
    <div style="background-color: #e3f2fd; border-radius: 4px; text-align:center; padding:10px;">
        <a href="login_page.php" style="font-size:25px; text-decoration:none; ">PT. ESCO BINTAN INDONESIA</a>
    </div>
    <br><br><br><br><br><br>
    <?php
        require 'config/koneksi.php';
        if (!isset($_session['admin'])) {
            $_session['admin'] = "";
        }
        echo $_session['admin'];
    ?>
    <div class="col-md-12">
        <div class="modal-dialog" style="margin-bottom:0;">
            <div class="modal-content" style="background-color: rgba(255, 255, 255, .85);">
                <div class="panel-heading">
                    <h2 class="panel-title" style="text-align:center;">Log In</h2>
                </div>
                <div class="panel-body">
                    <form action="proses/login_proses.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus="" style="text-align:center; background-color: rgba(255, 255, 255, .6);">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" style="text-align:center; background-color: rgba(255, 255, 255, .6);">
                            </div>
                            <div class="form-group">
                                <select class="form-control" style="text-align-last:center; background-color: rgba(255, 255, 255, .6);" name="level">
                                    <option value="admin">Admin</option>
                                    <option value="karyawan">Karyawan</option>
                                </select>
                            </div>                            
                            <!-- Change this to a button or input when using this as a form -->
                            <div class="buttonControl">
                                <button class="btn btn-md btn-success" type="submit" style="margin: 5px;">Masuk</button>
                                <input type="button" class="btn btn-md btn-danger" onclick="location.href='index.php'" value="Kembali">
                            </div>
                            <div class="buttonControl">
                                <a href="register_page.php" data-toggler="tooltip" title="Register Now">Belum Mempunyai Akun? Register!</a>
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