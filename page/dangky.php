<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <?php
    // $con = mysqli_connect('localhost', 'root', '', 'nienluan');
    // mysqli_set_charset($con, "utf8");
    ?> -->
    <?php session_start(); ?>
    <?php
    include_once('database_connection.php');

    $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : "";
    $hoten = trim(preg_replace('/\s+/', ' ', $hoten));
    $diachi = isset($_POST['diachi']) ? $_POST['hoten'] : "";
    $diachi = trim(preg_replace('/\s+/', ' ', $diachi));
    $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : "";
    $sdt = trim(preg_replace('/\s+/', ' ', $sdt));
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $email = trim(preg_replace('/\s+/', ' ', $email));
    $taikhoan = isset($_POST['taikhoan']) ? $_POST['taikhoan'] : "";
    $taikhoan = trim(preg_replace('/\s+/', ' ', $taikhoan));
    $matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : "";
    $matkhau = trim(preg_replace('/\s+/', ' ', $matkhau));
    $loaitaikhoan = isset($_POST['loaitk']) ? $_POST['loaitk'] : "";
    $erro = "";
    if (isset($_POST['submit'])) {
        if ($hoten == "" && !preg_match('/^\D\w$/', $hoten)) {
            $erro .= "<li>Ho ten không đúng định dạng</li>";
        }
        if ($diachi == "") {
            $erro .= "<li>Dia chi không đúng định dạng</li>";
        }
        if ($sdt == "" && !preg_match('/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/', $sdt)) {
            $erro .= "<li>Số điện thoại không đúng định dạng</li>";
        }
        if ($email == "" && !preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/', $email)) {
            $erro .= "<li>Email không đúng định dạng</li>";
        }
        if ($erro != "") {
            echo "<ul>" . $erro . "</ul>";
        } else {
            $Querry = mysqli_query($cn, "SELECT * from taikhoan where tk_taikhoan ='$taikhoan'");
            if (mysqli_num_rows($Querry) == 0) {
                if ($loaitaikhoan == "khach hang") {
                    mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','$loaitaikhoan')");
                    $id_tk = mysqli_insert_id($cn);
                    mysqli_query($cn, "INSERT INTO khachhang (kh_hoten,kh_diachi,kh_sdt,kh_email,tk_id) VALUE('$hoten','$diachi','$sdt','$email','$id_tk')");
                }

                if ($loaitaikhoan == "nha san xuat") {
                    mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','$loaitaikhoan')");
                    $id_tk = mysqli_insert_id($cn);
                    mysqli_query($cn, "INSERT INTO `nsx`(`nsx_id`, `nsx_ten`, `nsx_sdt`, `nsx_email`, `tk_id`) VALUES ('','$hoten','$sdt','$email','$id_tk')");
                }else {
                    mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','$loaitaikhoan')");
                }

                header("location:dangnhap.php");
            } else {
                echo '<script language="javascript">alert("Tên tài khoản bị trùng!")</script>';
            }
        }
    }


    ?>


    <form method="POST">

        <table>
            <tr>
                <td>Ho ten</td>
                <td><input type="text" name="hoten" value="<?php echo $hoten; ?>" placeholder="Nhap ho ten"></td>
            </tr>
            <tr>
                <td>Dia chi</td>
                <td><input type="text" name="diachi" value="<?php echo $diachi; ?>" placeholder="Nhap dia chi"></td>
            </tr>
            <tr>
                <td>Sdt</td>
                <td><input type="text" name="sdt" value="<?php echo $sdt; ?>" placeholder="Nhap sdt"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>" placeholder="Nhap email"></td>
            </tr>
            <?php
            if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] == "admin") {
                ?>
                <tr>
                    <td>Loai tk</td>
                    <td><select name="loaitk">
                            <option value="khach hang">khach hang</option>
                            <option value="nha san xuat">nha san xuat</option>
                            <option value="admin">admin</option>
                        </select>
                    </td>
                </tr>
                <?php
            }
            ?>
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

        </table>
        <input type="submit" name="submit" value="Dang ky" id="dangky">
    </form>
    
</body>

</html>