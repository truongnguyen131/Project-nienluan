<?php
session_start();
include_once('database_connection.php');
$timkiem = isset($_POST['data']) ? $_POST['data'] : "";
$sql = "SELECT * FROM sanpham WHERE sp_tengame like '%$timkiem%'";
$query = mysqli_query($cn, $sql);

$stt = 1;
$arr_sp = array();

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    if (!isset($arr_sp[$row['sp_id']])) {
        $arr_sp[$row['sp_id']] = array(
            'stt' => $stt++,
            'id' => $row['sp_id'],
            'tensp' => $row['sp_tengame'],
            'giacu' => $row['sp_gia'],
            'giamoi' => 0,
            'nbd' => "",
            'nkt' => "",
            'pt' => 0
        );
    }
    $idsp = $row['sp_id'];
    $sql1 = "SELECT * FROM sanpham sp, giamgia gg WHERE sp.sp_id = gg.sp_id AND sp.sp_id = $idsp";
    $query1 = mysqli_query($cn, $sql1);
    while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
        if ($row['sp_id'] == $row1['sp_id']) {
            $giamoi = $row['sp_gia'] - ($row['sp_gia'] * $row1['gg_phantram'] / 100);
            $arr_sp[$row['sp_id']]['giamoi'] = $giamoi;
            $arr_sp[$row['sp_id']]['nbd'] = $row1['gg_ngaybatdau'];
            $arr_sp[$row['sp_id']]['nkt'] = $row1['gg_ngayketthuc'];
            $arr_sp[$row['sp_id']]['pt'] = $row1['gg_phantram'];
        }
    }


}

foreach ($arr_sp as $key => $value) { ?>

    <tr class="table-light">
        <td><?php echo $value['stt']; ?></td>
        <td><?php echo $value['id']; ?></td>
        <td><?php echo $value['tensp']; ?></td>
        <td><?php echo $value['pt']; ?>%</td>
        <td><?php echo $value['giacu']; ?></td>
        <td><?php echo $value['giamoi']; ?></td>
        <td><?php echo $value['nbd']; ?></td>
        <td><?php echo $value['nkt']; ?></td>
        <td><input type="checkbox" name="chon_gg" value="<?php echo $value['id']; ?>"></td>
    </tr>

<?php } ?>