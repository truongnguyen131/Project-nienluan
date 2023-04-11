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

    <form method="POST">

        <?php
        // $con = mysqli_connect('localhost', 'root', '', 'nienluan');
        // mysqli_set_charset($con, "utf8");
        ?>

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

        <table>
            <tr>
                <td>Tai khoan</td>
                <td><input type="text" name="taikhoan" value="<?php echo $taikhoan; ?>"
                        placeholder="Nhap ten tai khoan"></td>
            </tr>
            <tr>
                <td>Mat khau</td>
                <td><input type="password" name="matkhau" value="<?php echo $matkhau; ?>" placeholder="Nhap mat khau">
                </td>
            </tr>
            <tr>
                <td>Nho tai khoan</td>
                <td><input type="checkbox" <?php echo $Nhodangnhap ? "checked" : ""; ?> name="nhotk"></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Dang nhap" id="dangnhap">
    </form>
    <a href="dangky.php">Đăng ký</a>
</body>

</html>