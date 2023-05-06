<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include_once('database_connection.php');

    if (!isset($_SESSION["idtaikhoan"])) {
        $_SESSION["idsanpham"] = $idsp;
        header("location:dangnhap.php");
    }
    $idsp = "";
    $today = date('Y-m-d');
    if (!isset($_SESSION["idtaikhoan"])) {
        $_SESSION["idsanpham"] = $idsp;
        header("location:dangnhap.php");
    } else {
        if (!isset($_SESSION['xulygiohang'])) {
            $_SESSION['xulygiohang'] = array();
        }
        if (isset($_GET['idsp'])) {
            $idsp = $_GET['idsp'];
            if (isset($_SESSION['xulygiohang'][$idsp])) {
                $_SESSION['xulygiohang'][$idsp]['soluong'] += 1;
                header('Location:giohang.php');
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

            if (isset($_GET['action'])){
                header('Location:thanhtoan.php');
            }
        }
    }

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case "delete":
                if (isset($_GET['id'])) {
                    unset($_SESSION['xulygiohang'][$_GET['id']]);
                    header('Location:giohang.php');
                }
                break;
        }
    }
    ?>
    <!-- section -->
    <section>
        <form method="POST">
            <table class="table table-bordered">
                <colgroup>
                    <col width="80" span="2">
                    <col width="150" span="1">
                    <col width="200" span="1">
                    <col width=auto span="1">
                    <col width="200" span="1">
                </colgroup>
                <tr class="table-danger">
                    <th>STT</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Nhà sản xuất</th>
                    <th>Xoá</th>
                </tr>
                <?php
                $tt = 0;
                $num = 1;
                if (!empty($_SESSION['xulygiohang'])) {
                    foreach ($_SESSION['xulygiohang'] as $key => $value) {

                        $tt = $tt + ($value['dongia'] * $value['soluong']);
                        ?>
                        <tr class="table-info">
                            <td>
                                <?php echo $num++; ?>
                            </td>
                            <td><img style="height: 100px;" src="../uploads/<?php echo $value['hinhsp'] ?>" /></td>
                            <td>
                                <?php echo $value['tensp'] ?>
                            </td>
                            <td>
                                <?php echo $value['dongia'] ?>đ
                            </td>
                            <td>
                                <form action="giohang.php" method="post">
                                    <input type="submit" name="-<?php echo $key; ?>" value="-">
                                    <input type="text" name="soluong" style="width: 20px" readonly
                                        value="<?php echo $value['soluong'] ?>">
                                    <input type="submit" name="+<?php echo $key; ?>" value="+">
                                </form>
                                <?php
                                if (isset($_POST["+$key"])) {
                                    header('Location:giohang.php?idsp=' . $key . '');
                                }
                                if (isset($_POST["-$key"])) {
                                    if ($value['soluong'] > 1) {
                                        $_SESSION['xulygiohang'][$key]['soluong'] -= 1;
                                        header('Location:giohang.php');
                                    }
                                    if ($value['soluong'] == 1) {
                                        header('Location:giohang.php?action=delete&id=' . $key . '');
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $value['nsx'] ?>
                            </td>
                            <td><a href="giohang.php?action=delete&id=<?php echo $key ?>" class="xoa">
                                    <i class="fa fa-trash fa-2x" aria-hidden="true"></i>Xóa</a></td>
                        </tr>
                        <?php
                    }
                } else { ?>
                    <tr class="table-info">
                    </tr>
                <?php } ?>
            </table>
            <div class="tongtien">
                <span>Tổng tiền:
                    <?php echo $tt ?>đ
                </span>
            </div>
            <div class="btn-xuly">
                <a href="../index.php" class="btn btn-css">Quay lại cửa hàng</a>
            </div>
            <div class="btn-xuly">
                <a href="thanhtoan.php" class="btn btn-css">Đặt hàng</a>
            </div>
        </form>
    </section>
</body>

</html>