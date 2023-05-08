<?php
session_start();
include_once('database_connection.php');
$timkiem = isset($_POST['data']) ? $_POST['data'] : "";
$stt = 1;
$arr_search = array();
$sql1 = "SELECT * FROM taikhoan WHERE tk_taikhoan like '%$timkiem%'";
$query = mysqli_query($cn, $sql1);

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    if (!isset($arr_search[$row['tk_id']])) {
        $arr_search[$row['tk_id']] = array(
            'stt' => $stt++,
            'id' => $row['tk_id'],
            'tentaikhoan' => $row['tk_taikhoan'],
            'matkhau' => $row['tk_matkhau'],
            'loaitaikhoan' => $row['tk_loaitaikhoan']
        );
    }
}

foreach ($arr_search as $key => $value) { ?>

    <tr class="table-light">
        <td>1</td>
        <td>27</td>
        <td>Hành động</td>
        <td>
            <form action="quanly-admin.php" method="post">
                <button class="tablinks" type="submit" name="updateTK" value="<?php echo $value['id']; ?>">
                    <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                </button>
            </form>
        </td>
        <td>
            <form method="post">
                <button type="submit" name="xoaTK" value="<?php echo $value['id']; ?>">
                    <ion-icon name="close-circle-outline"></ion-icon>
                </button>
            </form>
        </td>
    </tr>

<?php } ?>