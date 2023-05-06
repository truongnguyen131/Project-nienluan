<?php session_start(); ?> 
<?php
include_once('database_connection.php');
if (isset($_GET['id'])) {
    $sp_id = $_GET['id'];
    
    $Sanpham =  mysqli_query($cn, "SELECT * FROM sanpham as sp
        LEFT JOIN sanphamtheloai as sptl ON sptl.sp_id = sp.sp_id 
        LEFT JOIN theloai as tl ON tl.tl_id = sptl.tl_id
        LEFT JOIN nsx as nsx ON sp.nsx_id = nsx.nsx_id
    WHERE sp.sp_id = $sp_id ");
    $KQ = mysqli_fetch_array($Sanpham,MYSQLI_ASSOC);
    if (!isset($_SESSION['xulygiohang'][$sp_id])) {
        $_SESSION['xulygiohang'][$sp_id] = array(
            'hinhsp' => $KQ['sp_imgavt'],
            'tensp' => $KQ['sp_tengame'],
            'dongia' => $KQ['sp_gia'],
            'nsx' => $KQ['nsx_ten'],
            'soluong' => 1
        );
    }
     header("location: giohang2.php");
} 
?>

