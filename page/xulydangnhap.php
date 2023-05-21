<?php session_start();
include_once('database_connection.php'); ?>

<?php
$ntk = isset($_POST['ntk1']) ? $_POST['ntk1'] : "";
$taikhoan = isset($_POST['taikhoan1']) ? $_POST['taikhoan1'] : "";
$matkhau = isset($_POST['matkhau1']) ? $_POST['matkhau1'] : "";
setcookie("ntk", "chuacheck", time() + 60);
if ($ntk == "checked") {
    setcookie("ntk", "dacheck", time() + 60);
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
    if (isset($_SESSION["chuadangnhapthanhtoan"]) && $_SESSION["chuadangnhapthanhtoan"] == false) {
        $_SESSION['dangnhapthanhcong'] = "thanhtoan";
        unset($_SESSION["chuadangnhapthanhtoan"]);
        header("location:dangnhap.php");
    }
    if (isset($_SESSION["danhgia"]) && $_SESSION["danhgia"] != "") {
        $_SESSION['dangnhapthanhcong'] = "danhgia";
        header("location:dangnhap.php");
    } else {
        $_SESSION['dangnhapthanhcong'] = "thanhcong";
        header("location:dangnhap.php");
    }
} else {
    $_SESSION['dangnhapthanhcong'] = "khongthanhcong";
    header("location:dangnhap.php");
}


?>