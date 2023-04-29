<?php
session_start();
include_once('database_connection.php');
$timkiem = isset($_POST['data']) ? $_POST['data'] : "";
$page = isset($_POST['page']) ? $_POST['page'] : "";
$stt = 1;
$_SESSION['timkiem'] = array();
$sql = "SELECT * FROM taikhoan tk,khachhang kh WHERE kh.tk_id = tk.tk_id and tk.tk_taikhoan like '%$timkiem%'";
$sql1 = "SELECT * FROM taikhoan tk,nsx nsx WHERE nsx.tk_id = tk.tk_id and tk.tk_taikhoan like '%$timkiem%'";
if ($page == "KH") {
    $query = mysqli_query($cn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

            if (!isset($_SESSION['timkiem'][$row['tk_id']])) {
                $_SESSION['timkiem'][$row['tk_id']] = array(
                    'stt' => $stt++,
                    'idkh' => $row['kh_id'],
                    'idtkkh' => $row['tk_id'],
                    'hoten' => $row['kh_hoten'],
                    'sdt' => $row['kh_sdt'],
                    'email' => $row['kh_email'],
                    'dtl' => $row['kh_diemtichluy'],
                    'taikhoan' => $row['tk_taikhoan'],
                    'matkhau' => $row['tk_matkhau']
                );
            }
        }
    }
} else {
    $query = mysqli_query($cn, $sql1);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            if (!isset($_SESSION['timkiem'][$row['tk_id']])) {
                $_SESSION['timkiem'][$row['tk_id']] = array(
                    'stt' => $stt++,
                    'idkh' => $row['nsx_id'],
                    'idtkkh' => $row['tk_id'],
                    'hoten' => $row['nsx_ten'],
                    'sdt' => $row['nsx_sdt'],
                    'email' => $row['nsx_email'],
                    'taikhoan' => $row['tk_taikhoan'],
                    'matkhau' => $row['tk_matkhau']
                );
            }
        }
    }
}

foreach ($_SESSION['timkiem'] as $key => $value) { ?>
    <tr class="table-light">
        <td>
            <?php echo $value['stt']; ?>
        </td>
        <td>
            <?php echo $value['idkh']; ?>
        </td>
        <td>
            <?php echo $value['hoten']; ?>
        </td>
        <td>
            <?php echo $value['sdt']; ?>
        </td>
        <td>
            <?php echo $value['email']; ?>
        </td>
        <?php if ($page == "KH") { ?>
            <td>
                <?php echo $value['dtl']; ?>
            </td>
        <?php } ?>
        <td>
            <?php echo $value['taikhoan']; ?>
        </td>
        <td>
            <?php echo $value['matkhau']; ?>
        </td>
        <?php if ($page == "KH") { ?>
            <td><form action="quanly-admin.php" method="post">
                <button class="tablinks" type="submit" name="updateKH" onclick="openCity(event, 'add-client')" value="<?php echo $value['idtkkh']; ?>">
                    <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                </button></form>
            </td>
        <?php } else { ?>
            <td><form action="quanly-admin.php" method="post">
                <button class="tablinks" type="submit" name="updateNSX" onclick="openCity(event, 'add-nsx')" value="<?php echo $value['idtkkh']; ?>">
                    <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                </button></form>
            </td>
        <?php } ?>
        <td>
            <form method="post">
                <button type="submit" name="xoa" value="<?php echo $value['idtkkh']; ?>">
                    <ion-icon name="close-circle-outline"></ion-icon>
                </button>
            </form>
        </td>
    </tr>

<?php } ?>