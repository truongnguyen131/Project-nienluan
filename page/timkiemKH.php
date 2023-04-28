<?php
session_start();
include_once('database_connection.php');
$timkiem = isset($_POST['data']) ? $_POST['data'] : "";
$sql = "SELECT * FROM taikhoan tk,khachhang kh WHERE kh.tk_id = tk.tk_id and tk.tk_taikhoan like '%$timkiem%'";
$query = mysqli_query($cn, $sql);
$stt = 1;
$_SESSION['timkiemKH'] = array();

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        if (!isset($_SESSION['timkiemKH'][$row['tk_id']])) {
            $_SESSION['timkiemKH'][$row['tk_id']] = array(
                'stt' => $stt++,
                'id' => $row['kh_id'],
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

foreach ($_SESSION['timkiemKH'] as $key => $value) { ?>
    <tr class="table-light">
        <td><?php echo $value['stt']; ?></td>
        <td><?php echo $value['id']; ?></td>
        <td><?php echo $value['hoten']; ?></td>
        <td><?php echo $value['sdt']; ?></td>
        <td><?php echo $value['email']; ?></td>
        <td><?php echo $value['dtl']; ?></td>
        <td><?php echo $value['taikhoan']; ?></td>
        <td><?php echo $value['matkhau']; ?></td>
        <td>
            <button class="tablinks" onclick="openCity(event, 'add-client')">
                <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
            </button>
        </td>
        <td>
            <form method="post">
            <button type="submit" name="xoaKH" value="<?php echo $value['id']; ?>">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
            </form>
        </td>
    </tr>

<?php } ?>

<?php if (isset($_POST['xoaKH'])) {
    $idtk = $_POST['xoaKH'];
    mysqli_query($cn, "DELETE FROM `taikhoan` WHERE tk_id = $idtk");
    echo "<script>alert('Xóa thành công!!')</script>";
    } ?>
