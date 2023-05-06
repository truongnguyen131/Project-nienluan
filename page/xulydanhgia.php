<?php session_start();
include_once('database_connection.php'); ?>

<?php
$comment =  isset($_POST['cmt1']) ? $_POST['cmt1'] : "";
$id_of_sp =  isset($_POST['id1']) ? $_POST['id1'] : "";
$id_of_tk =  isset($_POST['tk1']) ? $_POST['tk1'] : "";
$number_of_star =  isset($_POST['star1']) ? $_POST['star1'] : "";
$page = isset($_POST['page']) ? $_POST['page'] : "";
$today = date('Y-m-d');
$idtk = $_SESSION["idtaikhoan"];

if ($page == "chitietsp") {
    mysqli_query($cn, "INSERT INTO danhgia (dg_sao,dg_binhluan,dg_ngaydanhgia,sp_id,tk_id) VALUE('$number_of_star','$comment','$today','$id_of_sp','$id_of_tk')");
    header("location:chitietsp.php?idsp=$id_of_sp");
    
}
?>