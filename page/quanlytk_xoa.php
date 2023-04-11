<?php
// $con = mysqli_connect('localhost', 'root', '', 'nienluan');
// mysqli_set_charset($con, "utf8");
include_once('database_connection.php');
?>
<?php
include_once('Connection.php');
if (isset($_GET['hdIdXoa'])) {
    $tk_id = $_GET['hdIdXoa'];
    $dele = mysqli_query($cn, "DELETE from taikhoan where tk_id=$tk_id");
    header("location:quanlytk.php");
} else {
    echo "Không tìm thấy xóa được";
}
?>