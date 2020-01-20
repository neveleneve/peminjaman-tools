<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
    <?php 
        require 'templates/footer.php' 
    ?>

    <input class="checks" type="checkbox" name="football" value="football" />
    Football<br />
    <input class="checks" type="checkbox" name="cricket" value="cricket" />
    Cricket<br />
    <input class="checks" type="checkbox" name="hockey" value="hockey" />
    Hockey<br /><br />
    <button id="submitxxx">Submit</button>

    <script>
    $('#submitxxx').prop("disabled", true);
    $('input:checkbox').click(function() {
        if ($(this).is(':checked')) {
            $('#submitxxx').prop("disabled", false);
        } else {
            if ($('.checks').filter(':checked').length < 1) {
                $('#submitxxx').attr('disabled', true);
            }
        }
    });
    </script>
</body>

</html>