<?php 
session_start();
include_once('database_connection.php');

$idcn =  isset($_GET['idcn']) ? $_GET['idcn'] : "";
$idkcn =  isset($_GET['idkcn']) ? $_GET['idkcn'] : "";

if($idcn != ""){
    mysqli_query($cn,"UPDATE `sanpham` SET `sp_trangthai`='duyet' WHERE sp_id = $idcn");
    $_SESSION['Duyetyeucau'] = true;
    header("location: quanly-admin.php");
}
if($idkcn != ""){
    mysqli_query($cn,"DELETE FROM `sanpham` WHERE sp_id = $idkcn");
    $_SESSION['Duyetyeucau'] = true;
    header("location: quanly-admin.php");
}
?>