<?php session_start();
include_once('database_connection.php'); ?>

<?php
$hoten = isset($_POST['hoten1']) ? $_POST['hoten1'] : "";
$sdt = isset($_POST['sdt1']) ? $_POST['sdt1'] : "";
$email = isset($_POST['email1']) ? $_POST['email1'] : "";
$taikhoan = isset($_POST['taikhoan1']) ? $_POST['taikhoan1'] : "";
$matkhau = isset($_POST['matkhau1']) ? $_POST['matkhau1'] : "";
$page = isset($_POST['page']) ? $_POST['page'] : "";

if($page =="themNSX"){
mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','nha san xuat')");
$id_tk = mysqli_insert_id($cn);
mysqli_query($cn, "INSERT INTO `nsx`(`nsx_ten`, `nsx_sdt`, `nsx_email`, `tk_id`) VALUES ('$hoten','$sdt','$email','$id_tk')");

}else{
    mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','khach hang')");
    $id_tk = mysqli_insert_id($cn);
    mysqli_query($cn, "INSERT INTO khachhang (kh_hoten,kh_sdt,kh_email,kh_diemtichluy,tk_id) VALUE('$hoten','$sdt','$email','0','$id_tk')");    
}

if($page == "dangky"){
    $_SESSION['dangkythanhcong'] = "dangky";
    header("location:dangky.php");
}if($page == "themKH"){
    $_SESSION['dangkythanhcong'] = "ThemKH";
    header("location:quanly-admin.php");
}if($page == "themNSX"){
    $_SESSION['dangkythanhcong'] = "ThemNSX";
    header("location:quanly-admin.php");
}



?>