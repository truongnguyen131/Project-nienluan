<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dangky.css">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Document</title>
</head>
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
$nhaplai_matkhau = isset($_POST['matkhau_again']) ? $_POST['matkhau_again'] : "";
$nhaplai_matkhau = trim(preg_replace('/\s+/', ' ', $nhaplai_matkhau));
// $loaitaikhoan = isset($_POST['loaitk']) ? $_POST['loaitk'] : "";
$erro = "";
if (isset($_POST['submit'])) {
    if ($hoten == "" && !preg_match('/^\D\w$/', $hoten)) {
        $erro .= "<li>Họ tên không đúng định dạng</li>";
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
    if ($matkhau != $nhaplai_matkhau) {
        $erro .= "<li>Hai mật khẩu không khớp</li>";
    }
    if ($erro != "") {
        echo "<ul>" . $erro . "</ul>";
    } else {
        $Querry = mysqli_query($cn, "SELECT * from taikhoan where tk_taikhoan ='$taikhoan'");
        if (mysqli_num_rows($Querry) == 0) {
            mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','Khách hàng')");
            $id_tk = mysqli_insert_id($cn);
            mysqli_query($cn, "INSERT INTO khachhang (kh_hoten,kh_diachi,kh_sdt,kh_email,tk_id) VALUE('$hoten','$diachi','$sdt','$email','$id_tk')");
    
            header("location:dangnhap.php");
        }else {
            echo '<script language="javascript">alert("Tên tài khoản bị trùng!")</script>';
        }
    } 
}
?>
        // if (mysqli_num_rows($Querry) == 0) {
        //     if ($loaitaikhoan == "khach hang") {
        //         mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','$loaitaikhoan')");
        //         $id_tk = mysqli_insert_id($cn);
        //         mysqli_query($cn, "INSERT INTO khachhang (kh_hoten,kh_diachi,kh_sdt,kh_email,tk_id) VALUE('$hoten','$diachi','$sdt','$email','$id_tk')");
        //     }

        //     if ($loaitaikhoan == "nha san xuat") {
        //         mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','$loaitaikhoan')");
        //         $id_tk = mysqli_insert_id($cn);
        //         mysqli_query($cn, "INSERT INTO `nsx`(`nsx_id`, `nsx_ten`, `nsx_sdt`, `nsx_email`, `tk_id`) VALUES ('','$hoten','$sdt','$email','$id_tk')");
        //     }else {
        //         mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','$loaitaikhoan')");
        //     }

        // header("location:dangnhap.php");
        // } else {
        //             echo '<script language="javascript">alert("Tên tài khoản đã tồn tại!")</script>';
        //         }
    
<body>
    <form action="" method="post">
        <div class="register-form">
            <div class="register-title">
                ĐĂNG KÝ TÀI KHOẢN
            </div>
            <div class="register-item">
                <input type="text" class="register-input" placeholder=" " name="hoten" value="<?php echo $hoten; ?>">
                <span class="register-lable">Họ tên</span>
            </div>
            <div class="register-item">
                <input type="text" class="register-input" placeholder=" " name="diachi" value="<?php echo $diachi; ?>">
                <span class="register-lable">Địa chỉ</span>
            </div>
            <div class="register-item">
                <input type="text" class="register-input" placeholder=" " name="sdt" value="<?php echo $sdt; ?>">
                <span class="register-lable">Số điện thoại</span>
            </div>
            <div class="register-item">
                <input type="email" class="register-input" placeholder=" " name="email" value="<?php echo $email; ?>">
                <span class="register-lable">Email</span>
            </div>
            <div class="register-item">
                <input type="text" class="register-input" placeholder=" " name="taikhoan" value="<?php echo $taikhoan; ?>">
                <span class="register-lable">Tài khoản</span>
            </div>
            <div class="register-item">
                <input type="password" class="register-input input-pass" placeholder=" " name="matkhau" value="<?php echo $matkhau; ?>">
                <span class="register-lable">Mật khẩu</span>
                <ion-icon name="eye-off-outline" class="eye eye-close"></ion-icon>
                <ion-icon name="eye-outline" class="eye eye-open hidden"></ion-icon>
            </div>
            <div class="register-item">
                <input type="password" class="register-input input-pass-again" placeholder=" " name="matkhau_again">
                <span class="register-lable">Nhập lại mật khẩu</span>
                <ion-icon name="eye-off-outline" class="eye eye-close-again"></ion-icon>
                <ion-icon name="eye-outline" class="eye eye-open-again hidden"></ion-icon>
            </div>
            <div class="register-item register-btn">
                <button type="submit" name="submit" value="Dang nhap" id="dangnhap">Đăng ký</button>
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

<script>
    const input_again = document.querySelector(".input-pass-again");
    const openeye_again = document.querySelector(".eye-open-again");
    const closeeye_again = document.querySelector(".eye-close-again");

    closeeye_again.addEventListener("click", function() {
        closeeye_again.classList.add("hidden");
        openeye_again.classList.remove("hidden");
        input_again.setAttribute("type", "text");
    });
    openeye_again.addEventListener("click", function() {
        openeye_again.classList.add("hidden");
        closeeye_again.classList.remove("hidden");
        input_again.setAttribute("type", "password");
    });
</script>

</html>