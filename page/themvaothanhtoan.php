<?php
session_start();
include_once('database_connection.php');

$idsp = $_GET['idsp'];

if (!isset($_SESSION['xulygiohang'])) {
    $_SESSION['xulygiohang'] = array();
}
if (isset($_SESSION['xulygiohang'][$idsp])) {
    $_SESSION['xulygiohang'][$idsp]['soluong'] += 1; 
} else {

    $sp = mysqli_query($cn, "SELECT * FROM sanpham,nsx WHERE sanpham.nsx_id = nsx.nsx_id AND sp_id = $idsp");
    $kq = mysqli_fetch_array($sp, MYSQLI_ASSOC);
    $_SESSION['xulygiohang'][$idsp] = array(
        'hinhsp' => $kq['sp_imgavt'],
        'tensp' => $kq['sp_tengame'],
        'dongia' => $kq['sp_gia'],
        'nsx' => $kq['nsx_ten'],
        'soluong' => 1
    );

    $query1 = mysqli_query($cn, "SELECT * from giamgia where sp_id =  $idsp");
    if (mysqli_num_rows($query1) > 0) {
        $row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC);
        if (strtotime($row1['gg_ngaybatdau']) <= strtotime($today) && strtotime($row1['gg_ngayketthuc']) >= strtotime($today)) {
            $_SESSION['xulygiohang'][$idsp]['dongia'] =
                $_SESSION['xulygiohang'][$idsp]['dongia'] -
                ($_SESSION['xulygiohang'][$idsp]['dongia'] * ($row1['gg_phantram'] / 100));
        }
    }

}
header("location:thanhtoan2.php");
?>