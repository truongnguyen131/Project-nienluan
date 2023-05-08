<?php
session_start();
include_once('database_connection.php');
$timkiem = isset($_POST['data']) ? $_POST['data'] : "";
$stt = 1;
$arr_search = array();
$sql1 = "SELECT * FROM theloai WHERE tl_ten like '%$timkiem%'";
$query = mysqli_query($cn, $sql1);

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    if (!isset($arr_search[$row['tl_id']])) {
        $arr_search[$row['tl_id']] = array(
            'stt' => $stt++,
            'id' => $row['tl_id'],
            'tentl' => $row['tl_ten']
        );
    }
}

foreach ($arr_search as $key => $value) { ?>

    <tr class="table-light">
        <td><?php echo $value['stt']; ?></td>
        <td><?php echo $value['id']; ?></td>
        <td><?php echo $value['tentl']; ?></td>
        <td>
            <form action="quanly-admin.php" method="post">
                <button class="tablinks" type="submit" name="updateTL" value="<?php echo $value['id']; ?>">
                    <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                </button>
            </form>
        </td>
        <td>
            <form method="post">
                <button type="submit" name="xoaTL" value="<?php echo $value['id']; ?>">
                    <ion-icon name="close-circle-outline"></ion-icon>
                </button>
            </form>
        </td>
    </tr>

<?php } ?>