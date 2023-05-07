<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/header-page.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/thanhtoan.css">
    <link rel="stylesheet" href="../css/click_slider.css">
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <title>Thanh Toán</title>
</head>

<body>

    <?php
    include_once('database_connection.php');

    if (!isset($_SESSION["idtaikhoan"])) {
        $_SESSION["chuadangnhapthanhtoan"] = false;
        header("location:dangnhap.php");
    }
    $idtk = $_SESSION["idtaikhoan"];
    $idkh = "";
    $dtl = 0;

    if ($_SESSION["loaitaikhoan"] == "admin") {
        $hoten = "admin";
        $sdt = "0123456789";
        $email = "admin@gmail.com";

    }
    if ($_SESSION["loaitaikhoan"] == "khach hang") {
        $sql = mysqli_query($cn, "SELECT * FROM khachhang WHERE tk_id='$idtk'");
        while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            $idkh = $row['kh_id'];
            $hoten = $row['kh_hoten'];
            $sdt = $row['kh_sdt'];
            $email = $row['kh_email'];
            $dtl = $row['kh_diemtichluy'];
        }
    }
    if ($_SESSION["loaitaikhoan"] == "nha san xuat") {
        $sql = mysqli_query($cn, "SELECT * FROM nsx WHERE tk_id='$idtk'");
        while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            $hoten = $row['nsx_ten'];
            $sdt = $row['nsx_sdt'];
            $email = $row['nsx_email'];
        }
    }
    ?>
    <div class="pay-main">
        <div class="pay-client">
            <div class="client-title">
                <h2>THÔNG TIN THANH TOÁN</h2>
            </div>
            <div class="client-top">
                <div class="client-email">
                    <input type="email" readonly value="<?php echo $email; ?>">
                </div>
                <div class="client-name">
                    <input type="text" readonly value="<?php echo $hoten; ?>">
                </div>
                <div class="client-numberphone">
                    <input type="text" readonly value="<?php echo $sdt; ?>">
                </div>
            </div>
            <div class="client-title">
                <h2>THÔNG TIN BỔ SUNG</h2>
            </div>
            <div class="client-addinfor">
                <textarea name="" id="" cols="58" rows="3"
                    placeholder="Nếu bạn có ghi chú thêm về đơn hàng, xin vui lòng viết ở đây (Có thể để trống)"></textarea>
            </div>
        </div>
        <div class="pay-order">
            <div class="order-title">
                <h2>ĐƠN HÀNG CỦA BẠN</h2>
            </div>
            <div class="order-infor">
                <form method="POST">
                    <table style="height: 250px">
                        <tr>
                            <td class="table-title">Sản phẩm</td>
                            <td class="table-title ">Số lượng</td>
                            <td class="table-title">Tạm tính</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="scrollbar">
                                    <table>
                                        <?php
                                        $tt = 0; 
                                        $sanpham = 1;
                                        if (!empty($_SESSION['xulygiohang'])) {
                                            $num = 1;
                                            foreach ($_SESSION['xulygiohang'] as $key => $value) {
                                                $tt = $tt + ($value['dongia'] * $value['soluong']);
                                                ?>
                                                <tr class="table-info">
                                                    <td>
                                                        <?php echo $value['tensp'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['soluong'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['dongia'] * $value['soluong'] ?>đ
                                                    </td>

                                                </tr>
                                                <?php
                                            }

                                        } else {
                                            $sanpham = 0; ?>
                                            <tr class="table-info">
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Tạm tính</td>
                            <td>
                                <?php echo $tt ?>đ
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span>Bạn đang có
                                    <?php echo $dtl; ?> điểm tích lũy bạn có muốn sử dụng không?
                                </span>
                            </td>
                            <td>
                                <input type="checkbox" name="dtl" id="dtl" value="<?php echo $dtl * 1000; ?>"
                                    onclick="clickToTotalDiscount()">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Tổng</td>
                            <td>
                                <input type="text" id="tt" value="<?php echo $tt; ?>" hidden>
                                <b id="total"></b><b>đ</b>
                            </td>
                        </tr>
                    </table>
                    <div class="infor-thanhtoan">
                        <div class="infor-momo">
                            <input type="checkbox" name="check" value="QR" onclick="onlyOne(this)">
                            <span>Quét mã QR</span>
                        </div>
                        <div class="infor-bank">
                            <input type="checkbox" name="check" value="ATM" onclick="onlyOne(this)">
                            <span>Thanh toán ATM</span>
                        </div>
                        <div class="infor-btn">
                            <?php
                            function diemtichluy($x)
                            {
                                if ($x >= 2000000) {
                                    $x = $x * 0.03 / 1000;
                                    return CEIL($x);
                                }
                                if ($x >= 500000) {
                                    $x = $x * 0.01 / 1000;
                                    return CEIL($x);
                                }
                                return 0;
                            }

                            if (isset($_POST["submit"])) {
                                if ($sanpham == 0) {
                                    echo "<b>Hãy thêm sản phâm bạn muốn mua vào giỏ hàng</b>";
                                } else {
                                    if ($idkh != "") {
                                        if (isset($_POST['check']) && !empty($_POST['check'])) {

                                            if (isset($_POST['dtl']) && !empty($_POST['dtl'])) {
                                                $tt = $tt - $dtl * 1000;
                                                $_SESSION['diemtichluy'] = 0;
                                            }
                                            $_SESSION['thanhtoan'] = $tt;
                                            if ($_POST['check'] == "QR") {
                                                echo "<meta http-equiv=" . "refresh" . " content=" . "0;url=thanhtoanQR.php" . ">";
                                            }
                                            if ($_POST['check'] == "ATM") {
                                                echo "<meta http-equiv=" . "refresh" . " content=" . "0;url=thanhtoanATM.php" . ">";
                                            }

                                        } else {
                                            echo "<b>Hãy chọn phương thức thanh toán</b>";
                                        }

                                    } else {
                                        echo "<b>Tài khoản ko được cấp quyền mua game, hãy chuyển sang tk kh để tiếp tục thao tác này!</b>";
                                    }
                                }
                            }

                            ?>
                            <button type="submit" name="submit">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>

    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('check')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }

    var cb = document.getElementById('dtl').value;
    var tt = document.getElementById('tt').value;
    var total = tt - cb;
    document.getElementById('total').innerHTML = tt;
    function clickToTotalDiscount() {
        if (document.getElementById('dtl').checked) {
            document.getElementById('total').innerHTML = total;
        } else {
            document.getElementById('total').innerHTML = tt;
        }
    }

</script>

</html>