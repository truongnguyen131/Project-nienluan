<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Index2.css">
    <link rel="stylesheet" href="../css/logout.css">
    <link rel="stylesheet" href="../css/thanhtoan2.css">
    <link rel="stylesheet" href="../css/stars.css">

    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Thanh toán</title>
</head>
<!-- hàm format giá -->
<?php
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = 'đ')
    {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
}
?>
<?php
include_once('database_connection.php');

if (!isset($_SESSION["idtaikhoan"])) {
    $_SESSION["chuadangnhapthanhtoan"] = false;
    if (isset($_GET['idsp'])) {
        $_SESSION["idsp"] = $_GET['idsp'];
    }
    header("location:dangnhap.php");
}
$idtk = $_SESSION["idtaikhoan"];
$idkh = "";
$dtl = 0;

if ($_SESSION["loaitaikhoan"] == "admin") {
    $hoten = "admin";
    $sdt = "";
    $email = "";
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

<body>

    <!-- custom scroll bar -->
    <div class="progress">
        <div class="progress-bar" id="scroll-bar"></div>
    </div>
    <!-- Header -->
    <header>
        <!-- nav -->
        <div class="nav container">
            <!-- logo -->
            <a href="index2.php" class="logo">Game<span>Store</span></a>
            <!-- nav icon -->
            <div class="nav-icons">
                <i class='bx bxs-bell bx-tada' id="bell-icon"><span></span></i>
                <i class='bx bx-search-alt' id="search-icon"></i>
                <?php
                if (isset($_SESSION['xulygiohang']) && !empty($_SESSION['xulygiohang'])) {
                ?>
                    <a href="giohang2.php">
                        <i class='bx bx-cart bx-tada' id="cart-icon"><span></span></i>
                    </a>
                <?php } else { ?>
                    <a href="giohang2.php">
                        <i class='bx bx-cart'></i>
                    </a>
                <?php } ?>
                <?php if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "") { ?>
                    <i class='bx bxs-user bx-tada' id="logout-icon"><span></span></i>
                <?php } else { ?>
                    <a href="dangnhap.php">
                        <i class='bx bxs-user'></i>
                    </a>
                <?php } ?>
                <div class="menu-icon">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </div>
            <!-- menu -->
            <div class="menu">
                <img src="" alt="">
                <div class="navbar">
                    <li>
                        <a href="index2.php">Trang chủ</a>
                    </li>
                    <li>
                        <a href="index2.php#like">Yêu thích</a>
                    </li>
                    <li>
                        <a href="index2.php#sale">Giảm giá</a>
                    </li>
                    <li>
                        <a href="index2.php#category">Thể loại</a>
                    </li>
                    <li>
                        <a href="contact.php">Liên hệ chúng tôi</a>
                    </li>
                    <?php
                    if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" && $_SESSION['loaitaikhoan'] == 'admin') { ?>
                        <li>
                            <a href="quanly-admin.php">Quản lý của Admin</a>
                        </li>
                    <?php }
                    if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" && $_SESSION['loaitaikhoan'] == 'nha san xuat') { ?>
                        <li>
                            <a href="quanly-nsx.php">Quản lý của Nhà sản xuất</a>
                        </li>
                    <?php }  ?>
                </div>
            </div>
            <!-- Thông báo -->
            <div class="nofication">
                <div class="nofication-box">
                    <p>Bạn đã tải game thành công</p>
                    <i class='bx bxs-check-circle bx-tada'></i>
                </div>
                <div class="nofication-box box-color">
                    <p>Bạn đã tải game thành công</p>
                    <i class='bx bxs-x-circle bx-tada'></i>
                </div>
            </div>

            <!-- tìm kiếm -->
            <div class="search">
                <div class="search-item">
                    <input type="text" class="search-input" placeholder=" " name="hoten" value="">
                    <span class="search-lable">Tìm kiếm</span>
                </div>
            </div>

            <!-- Đăng xuất -->
            <div class="log-out">
                <a href="dangxuat.php" class="out">
                    <div class="logout-box box-color">
                        <p>Đăng xuất</p>
                        <i class='bx bx-log-out'></i>
                    </div>
                </a>
            </div>
        </div>
    </header>
    <!-- menu 2 -->
    <div class="container menu-second">
        <h2>Thanh toán</h2>
        <div class="menu-content">
            <ul class="breadcrumb">
                <li><a href="index2.php">Trang chủ</a></li>
                <li class="here">Thanh toán</li>
            </ul>
        </div>
    </div>
    <!-- content -->
    <form method="POST">
        <div class="checkout-form container">

            <!-- thông tin giỏ hàng -->
            <div class="cart-infor">
                <h1 class="title">Giỏ hàng</h1>
                <div class="cart-form scrollbar">
                    <!-- 1 sản phẩm -->
                    <?php
                    $tt = 0;
                    $sanpham = 1;
                    if (!empty($_SESSION['xulygiohang']) && !isset($_GET['huy'])) {
                        foreach ($_SESSION['xulygiohang'] as $key => $value) {
                            $tt = $tt + ($value['dongia'] * $value['soluong']);
                    ?>
                            <div class="cart-item">
                                <div class="item-right">
                                    <h3><?php echo $value['tensp'] ?></h3>
                                    <span class="money"><?php echo currency_format($value['dongia']); ?></span><span> x <?php echo $value['soluong'] ?></span>
                                </div>
                                <div class="item-left">
                                    <?php $tong = $value['dongia'] * $value['soluong']; ?>
                                    <span><?php echo currency_format($tong); ?></span>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        $sanpham = 0; ?>
                        <div></div>
                    <?php } ?>

                 

                    <!---------------->
                </div>
                <div class="cart-bottom">
                    <div class="points">
                        <label for="point">
                            Có <?php echo $dtl; ?> điểm tích lũy
                        </label>
                        <!-- Này chỉnh css checkbox-->
                        <label class="switch">
                            <!-- sử dụng checkbox này -->
                            <input type="checkbox" name="dtl" id="dtl" value="<?php echo $dtl * 1000; ?>" onclick="clickToTotalDiscount()">
                            <!-------------------------->
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="total">
                        <span>Tổng tiền:</span>
                        <?php if ($sanpham == 0) { ?>
                            <h3>0đ</h3>
                        <?php } else { ?>
                            <input type="text" id="tt" value="<?php echo $tt; ?>" hidden>
                            <h3 id="total"><?php echo currency_format($tt); ?></h3>
                        <?php } ?>


                    </div>
                </div>
            </div>

            <!-- thông tin khách hàng -->
            <div class=" infor-customer">
                <h1 class="title">Thông tin khách hàng</h1>
                <div class="infor-form">
                    <div class="infor-item">
                        <input type="text" class="infor-input" placeholder=" " name="hoten" value="<?php echo $hoten; ?>" id="name">
                        <span class="infor-lable">Họ tên</span>
                    </div>
                    <div class="infor-item">
                        <input type="text" class="infor-input" placeholder=" " name="sdt" value="<?php echo $sdt; ?>" id="phone">
                        <span class="infor-lable">Số điện thoại</span>
                    </div>
                    <div class="infor-item">
                        <input type="text" class="infor-input" placeholder=" " name="email" value="<?php echo $email; ?>" id="mail">
                        <span class="infor-lable">Email</span>
                    </div>
                    <div class="infor-item">
                        <h3>Hình thức thanh toán</h3>
                        <div class="payments">
                            <input type="radio" id="QR" name="check" value="QR" onclick="onlyOne(this)">
                            <label for="QR">Quét mã QR</label>
                        </div>
                        <div class="payments">
                            <input type="radio" id="ATM" name="check" value="ATM" onclick="onlyOne(this)">
                            <label for="ATM">Thanh toán bằng ngân hàng</label>
                        </div>

                    </div>
                    <div class="infor-bottom">
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

                        if (isset($_POST["dathang"])) {
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
                                    echo "<b>Tài khoản không được cấp quyền mua game!</b>";
                                }
                            }
                        }
                        ?>
                        <button class="infor-btn" type="submit" name="dathang">Đặt hàng</button>
                        <a class="infor-btn" href="thanhtoan2.php?huy=huy">Hủy</a>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script src="../js/index.js "></script>
    <script src="../js/logout.js"></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-1.11.0.min.js "></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-migrate-1.2.1.min.js "></script>

    <script>
        var cb = document.getElementById('dtl').value;
        var tt = document.getElementById('tt').value;
        var total = tt - cb;

        function onlyOne(checkbox) {
            var checkboxes = document.getElementsByName('check')
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false
            })
        }

        function clickToTotalDiscount() {
            if (document.getElementById('dtl').checked) {
                document.getElementById('total').innerText = total.toLocaleString('vi', {
                    style: 'currency',
                    currency: 'VND'
                });
            }
            if (!document.getElementById('dtl').checked) {
                document.getElementById('total').innerText = parseInt(tt).toLocaleString('vi', {
                    style: 'currency',
                    currency: 'VND'
                });
            }
        }
    </script>
</body>
<!-- coppyright -->
<footer class="coppyright ">
    <div class="footer__content container">
        <div class="logo-page">
            <a href="Index2.html" class="logo">Game<span>Store</span></a>
        </div>
        <div class="page">
            <h1 class="footer__title">Trang</h1>
            <a href="">Trang chủ</a>
            <a href="">Phổ biến</a>
            <a href="">Game giảm giá</a>
            <a href="">Thể loại</a>
            <a href="">Liên hệ</a>
        </div>
        <div class="conection">
            <h1 class="footer__title">Liên hệ</h1>
            <a href=""><i class='bx bxl-facebook-circle'></i></a>
            <a href=""><i class='bx bxl-instagram-alt'></i></a>
            <a href=""><i class='bx bxl-twitter'></i></a>
            <a href=""><i class='bx bxs-phone-call'></i> <span>0927383736</span></a>
        </div>
    </div>
    <div class="vd">
        <p>&#169; Carpool Venom All Right Reserved</p>
    </div>
</footer>

</html>