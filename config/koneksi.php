<?php
$host = "localhost:3306";
$username = "root";
$password = "";
$db = "peminjaman";
$mysqli = new mysqli($host,$username,$password, $db) or die('koneksi error');
?>