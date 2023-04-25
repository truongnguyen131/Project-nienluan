<?php session_start();
include_once('database_connection.php'); ?>

<?php
$ntk = isset($_POST['ntk1']) ? $_POST['ntk1'] : "";
$taikhoan = isset($_POST['taikhoan1']) ? $_POST['taikhoan1'] : "";
$matkhau = isset($_POST['matkhau1']) ? $_POST['matkhau1'] : "";

if ($ntk == "checked") {
    setcookie("taikhoan", $taikhoan, time() + 60);
    setcookie("matkhau", $matkhau, time() + 60);
}
if (isset($_COOKIE['taikhoan']) && isset($_COOKIE['matkhau'])) {
    $taikhoan = $_COOKIE['taikhoan'];
    $matkhau = $_COOKIE['matkhau'];
}

$Result = mysqli_query($cn, "SELECT * FROM taikhoan WHERE tk_taikhoan='$taikhoan' AND tk_matkhau='$matkhau'");
if (mysqli_num_rows($Result) == 1) {
    $_SESSION["tentaikhoan"] = $taikhoan;
    while ($row = mysqli_fetch_array($Result, MYSQLI_ASSOC)) {
        $_SESSION["idtaikhoan"] = $row['tk_id'];
        $_SESSION["loaitaikhoan"] = $row['tk_loaitaikhoan'];
    }
    if (isset($_SESSION["idsanpham"]) && $_SESSION["idsanpham"] != "") {
        $idsp = $_SESSION["idsanpham"];
        header("location:chitietsanpham.php?idsp=$idsp");
    } else {
        // header("location:thanhtoan.php");
        header("location:../index.php");
    }
} else {
    $_SESSION['dangnhapthanhcong'] = false;
    header("location:dangnhap.php");
}


?>