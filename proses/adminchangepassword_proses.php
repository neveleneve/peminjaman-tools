<?php
    require_once "../config/koneksi.php";

    $username = "admin";
    $oldpass = $_POST['oldpassword'];
    $newpass = $_POST['newpassword'];

    $query = $mysqli->query("SELECT * from admin where name = '$username'");
    $row = mysqli_fetch_assoc($query);
    if ($row['password'] == $oldpass) {
        $queryupdate = $mysqli->query("UPDATE admin set password = '{$newpass}' where name = '{$username}'");        
        if (isset($queryupdate)) {
            echo "testo error";
            header("Location:../admindashboard_page.php");
        }else {
            echo "this is an error";
        }
    }else {
        echo $username;
        echo $oldpass;
        echo $newpass;
        echo "error, old password is wrong";
        // header("Location:../adminsetting_page.php");
    }
?>