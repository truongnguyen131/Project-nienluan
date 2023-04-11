<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="../uploads/website.zip" id="dl"></a>
    <script>
      window.onload = function(){
            document.getElementById('dl').click();
        }
    </script>
    <?php
    echo $_GET['idsp'];
    echo $_SESSION['idtaikhoan'];
    ?>

    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
</body>

</html>