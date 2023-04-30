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
    <style>
        .is-invalid {
            border: 1px solid red;
            vertical-align: center;
        }

        .loi {
            color: red;
        }
    </style>
    <title>Document</title>
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
        echo ' <script>window.location="http://localhost/Project-nienluan/index.php"</script>';
    }
    if (isset($_SESSION['dangnhapthanhcong']) && $_SESSION['dangnhapthanhcong'] == "thanhtoan") {
        unset($_SESSION['dangkythanhcong']);
        echo ' <script>window.location="http://localhost/Project-nienluan/page/thanhtoan.php"</script>';
    }
    if (isset($_SESSION['dangnhapthanhcong']) && $_SESSION['dangnhapthanhcong'] == "chitietsp") {
        unset($_SESSION['dangkythanhcong']);
        $idsp = $_SESSION["idsanpham"];
        echo ' <script>window.location="http://localhost/Project-nienluan/page/chitietsanpham.php?idsp=' . $idsp . '"</script>';
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
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery-3.0.0.min.js"></script>
<script>

    function Huy() {
        document.getElementById('tk').value = "";
        document.getElementById('mk').value = "";
    }

    function kiemtraloi() {
        var check = 0
        var tk = $('#tk').val()
        var mk = $('#mk').val()
        var ntk = "unchecked"
        if (mk.length == 0) {
            check -= 1
            $('#mk').addClass('is-invalid');
            $('#loimk').html("Mật khẩu không được rỗng")
        } else {
            $('#mk').removeClass('is-invalid')
            $('#loimk').html("")
            check += 1
        }

        if (tk.length == 0) {
            check -= 1
            $('#tk').addClass('is-invalid');
            $('#loitk').html("Tài khoản không được rỗng")
        } else {
            $('#tk').removeClass('is-invalid')
            $('#loitk').html("")
            check += 1
        }

        if (document.getElementById('ntk').checked) {
            ntk = "checked";
        }



        if (check == 2) {
            $.post('xulydangnhap.php', {
                ntk1: ntk,
                taikhoan1: tk,
                matkhau1: mk
            }, function (data) {
                $('body').html(data);
            })

        }

    }
</script>


<script>
    const input = document.querySelector(".input-pass");
    const openeye = document.querySelector(".eye-open");
    const closeeye = document.querySelector(".eye-close");

    closeeye.addEventListener("click", function () {
        closeeye.classList.add("hidden");
        openeye.classList.remove("hidden");
        input.setAttribute("type", "text");
    });
    openeye.addEventListener("click", function () {
        openeye.classList.add("hidden");
        closeeye.classList.remove("hidden");
        input.setAttribute("type", "password");
    });
</script>

</html>