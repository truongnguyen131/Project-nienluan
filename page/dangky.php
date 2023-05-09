<?php session_start();
include_once('database_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dangky.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Đăng ký</title>
</head>

<body>
    <?php
    if (isset($_SESSION['dangkythanhcong']) &&  $_SESSION['dangkythanhcong'] == "dangky") {
        echo "<script>alert('Đăng ký thành công!!')</script>";
        unset($_SESSION['dangkythanhcong']);
    }
    ?>

    <form action="" method="post">
        <div class="register-form">
            <div class="register-title">
                <a class="home" href="index2.php" title="Trang chủ">
                    <i class='bx bxs-home-smile'></i>
                </a>
                ĐĂNG KÝ TÀI KHOẢN
                <script>
                    let listTK = [];
                </script>
                <?php
                $query = mysqli_query($cn, "SELECT * FROM taikhoan");
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                    <script>
                        listTK.push("<?php echo $row['tk_taikhoan']; ?>")
                    </script>
                <?php }
                ?>
                <a class="login" href="dangnhap.php" title="Đăng nhập">
                <i class='bx bx-log-in'></i>
                </a>
            </div>
            <div class="register-item">
                <input type="text" class="register-input" id="hoten" placeholder=" " name="hoten">
                <span class="register-lable">Họ tên</span>
                <div class="loi" id="loihoten"></div>
            </div>
            <div class="register-item">
                <input type="text" class="register-input" id="sdt" name="sdt" placeholder=" ">
                <span class="register-lable">Số điện thoại</span>
                <div class="loi" id="loisdt"></div>
            </div>
            <div class="register-item">
                <input type="email" class="register-input" id="email" name="email" placeholder=" ">
                <span class="register-lable">Email</span>
                <div class="loi" id="loiemail"></div>
            </div>
            <div class="register-item">
                <input type="text" class="register-input" id="tk" placeholder=" " name="taikhoan">
                <span class="register-lable">Tài khoản</span>
                <div class="loi" id="loitk"></div>
            </div>
            <div class="register-item">
                <input type="password" class="register-input input-pass" placeholder=" " id="mk" name="matkhau">
                <span class="register-lable">Mật khẩu</span>
                <div class="loi" id="loimk"></div>
                <ion-icon name="eye-off-outline" class="eye eye-close"></ion-icon>
                <ion-icon name="eye-outline" class="eye eye-open hidden"></ion-icon>
            </div>
            <div class="register-item">
                <input type="password" class="register-input input-pass-again" placeholder=" " id="nlmk" name="matkhau_again">
                <span class="register-lable">Nhập lại mật khẩu</span>
                <div class="loi" id="loinlmk"></div>
                <ion-icon name="eye-off-outline" class="eye eye-close-again"></ion-icon>
                <ion-icon name="eye-outline" class="eye eye-open-again hidden"></ion-icon>
            </div>
            <div class="register-item register-btn">
                <button onclick="kiemtraloi()" type="button">Đăng ký</button>
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
<script src="../js/dangky.js"></script>


</html>