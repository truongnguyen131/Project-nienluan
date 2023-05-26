<?php session_start();
include_once('database_connection.php'); ?>

<?php
$comment = isset($_POST['cmt1']) ? $_POST['cmt1'] : "";
$id_of_sp = isset($_POST['id1']) ? $_POST['id1'] : "";
$number_of_star = isset($_POST['star1']) ? $_POST['star1'] : "";
$today = date('Y-m-d');
if (isset($_SESSION["idtaikhoan"])) {
    $idtk = $_SESSION["idtaikhoan"];
    mysqli_query($cn, "INSERT INTO danhgia (dg_sao,dg_binhluan,dg_ngaydanhgia,sp_id,tk_id) VALUE('$number_of_star','$comment','$today','$id_of_sp','$idtk')");
    echo ' <script>window.location="http://localhost/Project-nienluan/page/chitietsp.php?idsp='.$id_of_sp.'&danhgia=ok#danhgia"</script>';
} else {
    $_SESSION["danhgia"] = $id_of_sp;
    echo ' <script>window.location="http://localhost/Project-nienluan/page/dangnhap.php"</script>';
}
?>
