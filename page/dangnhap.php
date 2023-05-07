<?php session_start();
include_once('database_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dangnhap.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Đăng nhập</title>
</head>

<body>
    <?php
    if (isset($_SESSION['dangnhapthanhcong']) && $_SESSION['dangnhapthanhcong'] == "khongthanhcong") {
        unset($_SESSION['dangkythanhcong']);
        echo "<script>
            $('#mk').addClass('is-invalid');
            $('#loimk').html('Mật khẩu không hợp lệ');
            $('#tk').addClass('is-invalid');
            $('#loitk').html('Tài khoản không hợp lệ');
        </script>";
    }
    if (isset($_SESSION['dangnhapthanhcong']) && $_SESSION['dangnhapthanhcong'] == "thanhcong") {
        unset($_SESSION['dangkythanhcong']);
        echo ' <script>window.location="http://localhost/Project-nienluan/page/index2.php"</script>';
    }
    if (isset($_SESSION['dangnhapthanhcong']) && $_SESSION['dangnhapthanhcong'] == "thanhtoan") {
        unset($_SESSION['dangkythanhcong']);
        echo ' <script>window.location="http://localhost/Project-nienluan/page/thanhtoan2.php"</script>';
    }

    if (isset($_COOKIE['taikhoan']) && isset($_COOKIE['matkhau'])) {
        $tk = $_COOKIE['taikhoan'];
        $mk = $_COOKIE['matkhau'];
        echo '<script>  window.onload = function(){
        document.getElementById("tk").value = "'.$tk.'";
        document.getElementById("mk").value = "'.$mk.'";}
        </script>';
    }

    ?>

    <form action="" method="post">
        <div class="login-form">
            <div class="login-title">
                ĐĂNG NHẬP
            </div>
            <div class="login-item">
                <input type="text" class="login-input" placeholder=" " name="taikhoan" id="tk">
                <span class="login-lable">Tài khoản</span>
                <div class="loi" id="loitk"></div>
            </div>
            <div class="login-item">
                <input type="password" class="login-input input-pass" placeholder=" " name="matkhau" id="mk">
                <span class="login-lable">Mật khẩu</span>
                <div class="loi" id="loimk"></div>
                <ion-icon name="eye-off-outline" class="eye eye-close"></ion-icon>
                <ion-icon name="eye-outline" class="eye eye-open hidden"></ion-icon>
            </div>
            <div class="login-item login-remember">
                <div class="item-remember">
                    <span>Nhớ tài khoản</span>
                    <input type="checkbox" id="ntk" name="nhotk">
                </div>
                <div class="item-dangky">
                    <a href="dangky.php">Đăng ký tài khoản</a>
                </div>
            </div>
            <div class="login-item login-btn">
                <button onclick="kiemtraloi()" type="button">Đăng nhập</button>
                <button type="button" onclick="Huy()">Hủy</button>
            </div>
        </div>
    </form>

</body>
<!-- Javascript files-->
<script src="../js/dangnhap.js"></script>
<script src="../js/jquery.min.js"></script>

<
</html>