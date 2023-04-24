<?php session_start();
include_once('database_connection.php'); ?>

<?php
$hoten = isset($_POST['hoten1']) ? $_POST['hoten1'] : "";
$sdt = isset($_POST['sdt1']) ? $_POST['sdt1'] : "";
$email = isset($_POST['email1']) ? $_POST['email1'] : "";
$taikhoan = isset($_POST['taikhoan1']) ? $_POST['taikhoan1'] : "";
$matkhau = isset($_POST['matkhau1']) ? $_POST['matkhau1'] : "";

if ($hoten != "" && $sdt != "" && $email != "" && $taikhoan != "" && $matkhau != "") {
    mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','khach hang')");
    $id_tk = mysqli_insert_id($cn);
    mysqli_query($cn, "INSERT INTO khachhang (kh_hoten,kh_sdt,kh_email,kh_diemtichluy,tk_id) VALUE('$hoten','$sdt','$email','0','$id_tk')");
    $_SESSION['dangkythanhcong'] = true;
    header("location:dangky.php");
}

?>