<?php session_start();
include_once('database_connection.php'); ?>

<?php
$loaitaikhoan = isset($_POST['loaitaikhoan1']) ? $_POST['loaitaikhoan1'] : "";
$hoten = isset($_POST['hoten1']) ? $_POST['hoten1'] : "";
$sdt = isset($_POST['sdt1']) ? $_POST['sdt1'] : "";
$email = isset($_POST['email1']) ? $_POST['email1'] : "";
$taikhoan = isset($_POST['taikhoan1']) ? $_POST['taikhoan1'] : "";
$matkhau = isset($_POST['matkhau1']) ? $_POST['matkhau1'] : "";
$page = isset($_POST['page']) ? $_POST['page'] : "";
$tenTL = isset($_POST['tenTL']) ? $_POST['tenTL'] : "";

if ($page == "themTL") {
    mysqli_query($cn, "INSERT INTO `theloai`(`tl_ten`) VALUES ('$tenTL')");
}

if ($page == "themTK") {
    if($loaitaikhoan == "admin"){
        mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','$loaitaikhoan')");
        $id_tk = mysqli_insert_id($cn);
        mysqli_query($cn, "INSERT INTO `nsx`(`nsx_ten`, `tk_id`) VALUES ('$taikhoan',$id_tk)");
    }else{
        mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','$loaitaikhoan')");
    }
}
if ($page == "capNhatTK") {
    $TKcanupdate = $_SESSION['taikhoanUpdate'];
    mysqli_query($cn, "UPDATE `taikhoan` SET `tk_taikhoan`='$taikhoan',`tk_matkhau`='$matkhau',`tk_loaitaikhoan`='$loaitaikhoan' WHERE tk_id = $TKcanupdate");
    unset($_SESSION['taikhoanUpdate']);
}

if ($page == "capNhatKH") {
    $TKcanupdate = $_SESSION['taikhoanUpdate'];
    $KHcanupdate = $_SESSION['KHUpdate'];
    mysqli_query($cn, "UPDATE `taikhoan` SET `tk_taikhoan`='$taikhoan',`tk_matkhau`='$matkhau' WHERE tk_id = $TKcanupdate");
    mysqli_query($cn, "UPDATE `khachhang` SET `kh_hoten`='$hoten',`kh_sdt`='$sdt',`kh_email`='$email' WHERE kh_id = $KHcanupdate");
    unset($_SESSION['taikhoanUpdate']);
    unset($_SESSION['KHUpdate']);
}

if ($page == "capNhatNSX") {
    $TKcanupdate = $_SESSION['taikhoanUpdate'];
    $NSXcanupdate = $_SESSION['nsxUpdate'];
    mysqli_query($cn, "UPDATE `taikhoan` SET `tk_taikhoan`='$taikhoan',`tk_matkhau`='$matkhau' WHERE tk_id = $TKcanupdate");
    mysqli_query($cn, "UPDATE `nsx` SET `nsx_ten`='$hoten',`nsx_sdt`='$sdt',`nsx_email`='$email' WHERE nsx_id = $NSXcanupdate");
    unset($_SESSION['taikhoanUpdate']);
    unset($_SESSION['nsxUpdate']);
}

if ($page == "themKH") {
    mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','khach hang')");
    $id_tk = mysqli_insert_id($cn);
    mysqli_query($cn, "INSERT INTO khachhang (kh_hoten,kh_sdt,kh_email,kh_diemtichluy,tk_id) VALUE('$hoten','$sdt','$email','0','$id_tk')");
}

if ($page == "themNSX") {
    mysqli_query($cn, "INSERT INTO taikhoan (tk_taikhoan,tk_matkhau,tk_loaitaikhoan) VALUE('$taikhoan','$matkhau','nha san xuat')");
    $id_tk = mysqli_insert_id($cn);
    mysqli_query($cn, "INSERT INTO `nsx`(`nsx_ten`, `nsx_sdt`, `nsx_email`, `tk_id`) VALUES ('$hoten','$sdt','$email','$id_tk')");
}


if ($page == "dangky") {
    $_SESSION['dangkythanhcong'] = "dangky";
    header("location:dangky.php");
}
if ($page == "themTK") {
    $_SESSION['dangkythanhcong'] = "ThemTK";
    header("location:quanly-admin.php");
}
if ($page == "themKH") {
    $_SESSION['dangkythanhcong'] = "ThemKH";
    header("location:quanly-admin.php");
}
if ($page == "themNSX") {
    $_SESSION['dangkythanhcong'] = "ThemNSX";
    header("location:quanly-admin.php");
}
if ($page == "themTL") {
    $_SESSION['dangkythanhcong'] = "ThemTL";
    header("location:quanly-admin.php");
}
if ($page == "capNhatKH") {
    $_SESSION['dangkythanhcong'] = "capNhatKH";
    header("location:quanly-admin.php");
}
if ($page == "capNhatNSX") {
    $_SESSION['dangkythanhcong'] = "capNhatNSX";
    header("location:quanly-admin.php");
}
if ($page == "capNhatTK") {
    $_SESSION['dangkythanhcong'] = "capNhatTK";
    header("location:quanly-admin.php");
}



?>