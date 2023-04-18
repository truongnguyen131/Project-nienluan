<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/dangnhap.css">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <?php
            include_once('database_connection.php');

            $taikhoan = isset($_POST['taikhoan']) ? $_POST['taikhoan'] : "";
            $taikhoan = trim(preg_replace('/\s+/', ' ', $taikhoan));
            $matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : "";
            $matkhau = trim(preg_replace('/\s+/', ' ', $matkhau));
            $erro = "";
            $Nhodangnhap = "";
            if (isset($_POST['submit'])) {

                if ($taikhoan == "") {
                    $erro .= "<li>Tai khoan khong dc rong</li>";
                }
                if ($matkhau == "" && !preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/', $email)) {
                    $erro .= "<li>Mat khau</li>";
                }
                if ($erro != "") {
                    echo "<ul>" . $erro . "</ul>";
                }
                $taikhoan = mysqli_real_escape_string($cn, $taikhoan);
                if (isset($_POST['nhotk'])) {
                    setcookie("taikhoan", $taikhoan, time() + 60);
                    setcookie("matkhau", $matkhau, time() + 60);
                }

                $Result = mysqli_query($cn, "SELECT * FROM taikhoan WHERE tk_taikhoan='$taikhoan' AND tk_matkhau='$matkhau'");
                if (mysqli_num_rows($Result) == 1) {
                    $_SESSION["tentaikhoan"] = $taikhoan;
                    while ($row = mysqli_fetch_array($Result, MYSQLI_ASSOC)) {
                        $_SESSION["idtaikhoan"] = $row['tk_id'];
                        $_SESSION["loaitaikhoan"] = $row['tk_loaitaikhoan'];
                        $_SESSION["nametaikhoan"] = $row['tk_taikhoan'];
                    }
                    header("location:../index.php");
                } else {
                    echo "Đăng nhập không thành công";
                }
            }

            if (isset($_COOKIE['taikhoan']) && isset($_COOKIE['matkhau'])) {
                $taikhoan = $_COOKIE['taikhoan'];
                $matkhau = $_COOKIE['matkhau'];
                $Nhodangnhap = true;
            }

    ?>

            <div class="login-form">
                <div class="login-title">
                    ĐĂNG NHẬP
                </div>
                <div class="login-item">
                    <input type="text" class="login-input" placeholder=" " name="taikhoan" value="<?php echo $taikhoan; ?>">
                    <span class="login-lable">Tài khoản</span>
                </div>
                <div class="login-item">
                    <input type="password" class="login-input input-pass" placeholder=" " name="matkhau" value="<?php echo $matkhau; ?>">
                    <span class="login-lable">Mật khẩu</span>
                    <ion-icon name="eye-off-outline" class="eye eye-close"></ion-icon>
                    <ion-icon name="eye-outline" class="eye eye-open hidden"></ion-icon>
                </div>
                <div class="login-item login-remember">
                    <div class="item-remember">
                        <span>Nhớ tài khoản</span>
                        <input type="checkbox" <?php echo $Nhodangnhap ? "checked" : ""; ?> name="nhotk">
                    </div>
                    <div class="item-dangky">
                        <a href="dangky.php">Đăng ký tài khoản</a>
                    </div>
                </div>
                <div class="login-item login-btn">
                    <button type="submit" name="submit" value="Dang nhap" id="dangnhap">Đăng nhập</button>
                    <button type="reset">Hủy</button>
                </div>
            </div>
    </form>
</body>


<script>
    const input = document.querySelector(".input-pass");
    const openeye = document.querySelector(".eye-open");
    const closeeye = document.querySelector(".eye-close");

    closeeye.addEventListener("click", function() {
        closeeye.classList.add("hidden");
        openeye.classList.remove("hidden");
        input.setAttribute("type", "text");
    });
    openeye.addEventListener("click", function() {
        openeye.classList.add("hidden");
        closeeye.classList.remove("hidden");
        input.setAttribute("type", "password");
    });
</script>

</html>