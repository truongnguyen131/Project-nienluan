<?php
session_start();
include_once('database_connection.php');
$idtk = $_SESSION["idtaikhoan"];
$timkiem = isset($_POST['data']) ? $_POST['data'] : "";
$stt = 1;
$arr_search = array();

$q1 = mysqli_query($cn, "SELECT nsx_id from nsx WHERE tk_id = $idtk");
$r1 = mysqli_fetch_array($q1);
$idnsx = $r1['nsx_id'];

$sql1 = "SELECT * FROM sanpham,nsx  WHERE  sanpham.nsx_id = nsx.nsx_id AND nsx.nsx_id = $idnsx  AND sanpham.sp_tengame like '%$timkiem%'";
$query = mysqli_query($cn, $sql1);

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    if (!isset($arr_search[$row['sp_id']])) {
        $arr_search[$row['sp_id']] = array(
            'stt' => $stt++,
            'id' => $row['sp_id'],
            'tensp' => $row['sp_tengame'],
            'gia' => $row['sp_gia'],
            'nph' => $row['sp_ngayphathanh'],
            'nsx' => $row['nsx_ten'],
        );
    }
}

?>

<table border="1" id="inforgamess" style="display:table" class="table table-inforgame">
    <tr class="table-primary">
    <th scope="col">STT</th>
                        <th scope="col">ID</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Ngày phát hành</th>
                        <th scope="col">Nhà sản xuất</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Xóa</th>
    </tr>
    <?php foreach ($arr_search as $key => $value) { ?>
        <tr class="table-light">
            <td>
                <?php echo $value['stt']; ?>
            </td>
            <td>
                <?php echo $value['id']; ?>
            </td>
            <td>
                <?php echo $value['tensp']; ?>
            </td>
            <td>
                <?php echo $value['nph']; ?>
            </td>
            <td>
                <?php echo $value['nsx']; ?>
            </td>
            <td>
                <?php echo $value['gia']; ?>
            </td>
            <td>
                <form method="post">
                    <button type="submit" name="xoaSP" value="<?php echo $value['id']; ?>">
                        <ion-icon name="close-circle-outline"></ion-icon>
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>