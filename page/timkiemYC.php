<?php
session_start();
include_once('database_connection.php');
$timkiem = isset($_POST['data']) ? $_POST['data'] : "";
$stt = 1;
$arr_search = array();
$sql1 = "SELECT * FROM sanpham,nsx WHERE sanpham.nsx_id = nsx.nsx_id and sanpham.sp_tengame != '' and sanpham.sp_trangthai = 'chua duyet' and sp_tengame like '%$timkiem%'";
$query = mysqli_query($cn, $sql1);

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    if (!isset($arr_search[$row['sp_id']])) {
        $arr_search[$row['sp_id']] = array(
            'stt' => $stt++,
            'id' => $row['sp_id'],
            'tensp' => $row['sp_tengame'],
            'tennsx' => $row['nsx_ten'],
            'nph' => $row['sp_ngayphathanh'],
            'gia' => $row['sp_gia']
        );
    }
}

foreach ($arr_search as $key => $value) { ?>
    <tr class="table-light">
        <td><?php echo $value['stt']; ?></td>
        <td><?php echo $value['id']; ?></td>
        <td><?php echo $value['tennsx']; ?></td>
        <td><?php echo $value['tensp']; ?></td>
        <td>
        <?php echo $value['nph']; ?>
        </td>
        <td>
        <?php echo $value['gia']; ?>
        </td>

        <td>
            <a href="duyetYC.php?idcn=<?php echo $value['id']; ?>">
                <ion-icon name="bag-check-outline"></ion-icon>
            </a>
        </td>
        <td>
            <a href="duyetYC.php?idkcn=<?php echo $value['id']; ?>">
                <ion-icon name="close-circle-outline"></ion-icon>
            </a>
        </td>
    </tr>

<?php } ?>