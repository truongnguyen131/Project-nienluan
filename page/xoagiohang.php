<?php session_start();?>
<?php 
if (isset($_GET['id'])) {
    $sp_id = $_GET['id'];
    unset($_SESSION['xulygiohang'][$sp_id]);
    header("location:giohang.php");
}
?>