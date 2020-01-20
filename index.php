<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    
    <script language="Javascript" type="text/javascript">
        var txt = "SELAMAT DATANG DI SISTEM INFORMASI PEMINJAMAN DAN PENGEMBALIAN TOOLS PT.ESCO BINTAN INDONESIA | ";
        var speed = 100;
        var refresh = null;

        function move() {
            document.title = txt;
            txt = txt.substring(1, txt.length) + txt.charAt(0);
            refresh = setTimeout("move()", speed);
        }
        move();
    </script>
</head>

<body>
    <?php
        include "navbar.php";
        include "carousel.php";
    ?>
</body>
<?php require_once "templates/footer.php"?>
<script type="text/javascript">
    $('.carousel').carousel();
</script>

</html>