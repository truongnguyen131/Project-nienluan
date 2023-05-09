<?php session_start();
include_once('database_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>



    <?php
    foreach ($_SESSION['xulygiohang'] as $key => $value) {
        $tenGame = $value['tensp'];

        for ($i = 1; $i <= $value['soluong']; $i++) {
            echo "<li onclick='downloadSource(\"../uploads/GAME.zip\",\"$tenGame$i\")' id='$tenGame$i'>$tenGame$i </li>\n";
        }

    }
    ?>

    <script>
        function downloadSource(url, fileName) {
            let link = document.createElement("a")
            link.setAttribute("download", fileName)
            link.href = url
            document.body.appendChild(link)
            link.click()
            link.remove()
        }

        window.onload = function () {
            <?php

            foreach ($_SESSION['xulygiohang'] as $key => $value) {
                $tenGame = $value['tensp'];
                for ($i = 1; $i <= $value['soluong']; $i++) {
                    echo 'document.getElementById("' . $tenGame . $i . '").click()  
                    ';
                }

            }

            unset($_SESSION['thanhtoan']);
            unset($_SESSION['xulygiohang']);

            ?>
            window.location = "http://localhost/Project-nienluan/page/index2.php"
        }
    </script>

</body>

</html>