<?php session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Index2.css">
    <link rel="stylesheet" href="../css/logout.css">
    <link rel="stylesheet" href="../css/giohang2.css">
    <link rel="stylesheet" href="../css/stars.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Giỏ hàng</title>
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
    $_SESSION["idsanpham"] = $idsp;
    header("location:dangnhap.php");
}
$idsp = "";
$today = date('Y-m-d');
if (!isset($_SESSION['xulygiohang'])) {
    $_SESSION['xulygiohang'] = array();
}
if (isset($_GET['idsp'])) {
    $idsp = $_GET['idsp'];
    if (isset($_SESSION['xulygiohang'][$idsp])) {
        $_SESSION['xulygiohang'][$idsp]['soluong'] += 1;
        header('Location:giohang2.php');
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

    if (isset($_GET['action'])) {
        header('Location:thanhtoan.php');
    }
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "delete":
            if (isset($_GET['id'])) {
                unset($_SESSION['xulygiohang'][$_GET['id']]);
                header('Location:giohang2.php');
            }
            break;
    }
}

?>

<body>
    <!-- custom scroll bar -->
    <div class="progress">
        <div class="progress-bar" id="scroll-bar"></div>
    </div>
    <form method="post">
        <!-- Header -->
        <header>
            <!-- nav -->
            <div class="nav container">
                <!-- logo -->
                <a href="index2.php" class="logo">Game<span>Store</span></a>
                <!-- nav icon -->
                <div class="nav-icons">
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
                        <?php } ?>
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
                <div class="log-out ">
                    <a href="khachhang.php">
                        <div class="logout-box box-color">
                            <p>Thông tin Khách hàng</p>
                            <i class='bx bx-spreadsheet'></i>
                        </div>
                    </a>
                    <a href="dangxuat.php" class="out">
                        <div class="logout-box box-color">
                            <p>Đăng xuất</p>
                            <i class='bx bx-log-out'></i>
                        </div>
                    </a>
                </div>
                <script>
                    let logout = document.querySelector(".log-out");
                    document.getElementById('logout-icon').onclick = () => {
                        logout.classList.toggle("active");
                    }
                </script>
            </div>
        </header>

        <div class="container menu-second">
            <h2>Giỏ hàng</h2>
            <div class="menu-content">
                <ul class="breadcrumb">
                    <li><a href=" # ">Trang chủ</a></li>
                    <li class="here">Giỏ hàng</li>
                </ul>
            </div>
        </div>

        <!-- content -->
        <div class="cart-content container scrollbar">
            <div class="cart-product">
                <?php
                $tt = 0;
                if (!empty($_SESSION['xulygiohang'])) {
                    foreach ($_SESSION['xulygiohang'] as $key => $value) {
                        $tt = $tt + ($value['dongia'] * $value['soluong']);
                        ?>
                        <!-- sản phẩm -->
                        <div class="product-item">
                            <img src="../uploads/<?php echo $value['hinhsp'] ?>" alt=" ">
                            <div class="product-infor">
                                <div class="name2">
                                    <h1 class="product-name">
                                        <?php echo $value['tensp'] ?>
                                    </h1>
                                </div>
                                <h2 class="product-price">
                                    <?php echo currency_format($value['dongia']) ?>
                                </h2>
                            </div>
                            <div class="info-quantity">
                                <form action="giohang2.php" method="post">
                                    <input class="product-btn-giam" type="submit" name="-<?php echo $key; ?>" value="-">
                                    <input class="product-value" type="text" name="soluong" readonly
                                        value="<?php echo $value['soluong'] ?>">
                                    <input class="product-btn-tang" type="submit" name="+<?php echo $key; ?>" value="+">
                                </form>
                                <?php
                                if (isset($_POST["+$key"])) {
                                    header('Location:giohang2.php?idsp=' . $key . '');
                                }
                                if (isset($_POST["-$key"])) {
                                    if ($value['soluong'] > 1) {
                                        $_SESSION['xulygiohang'][$key]['soluong'] -= 1;
                                        header('Location:giohang2.php');
                                    }
                                    if ($value['soluong'] == 1) {
                                        header('Location:giohang2.php?action=delete&id=' . $key . '');
                                    }
                                }
                                ?>
                            </div>
                            <h2 class="product-price-total ">
                                <?php echo currency_format($value['dongia'] * $value['soluong']) ?>
                            </h2>
                            <a href="giohang2.php?action=delete&id=<?php echo $key ?>" class="close-item">
                                <ion-icon name="close-outline"></ion-icon>
                            </a>
                        </div>
                        <?php
                    }
                } else { ?>
                    <!-- sản phẩm -->
                    <div></div>
                <?php } ?>
            </div>

        </div>
        <div class="cart-info container ">
            <div class="btn-control">
                <a href="sanpham.php" class="btn-retur__home "><i class='bx bx-left-arrow-alt'></i>Tiếp tục mua hàng</a>
                <a href="thanhtoan2.php" class="btn-buy ">Mua ngay</a>
            </div>
            <div class="total ">
                <div class="total-price ">
                    <span>Tổng cộng:</span>
                    <label>
                        <?php echo currency_format($tt) ?>
                    </label>
                </div>
            </div>
        </div>


    </form>
    <script src="../js/index.js "></script>
    <script src="../js/logout.js"></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-1.11.0.min.js "></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-migrate-1.2.1.min.js "></script>


    <footer class="footer">
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="">About us</a></li>
                        <li><a href="">Our service</a></li>
                        <li><a href="">Privacy policy</a></li>
                        <li><a href="">Afflicate progame</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Get help</h4>
                    <ul>
                        <li><a href="">FAQ</a></li>
                        <li><a href="">Shopping</a></li>
                        <li><a href="">Return</a></li>
                        <li><a href="">Payment option</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Online shop</h4>
                    <ul>
                        <li><a href="">Moba</a></li>
                        <li><a href="">Education</a></li>
                        <li><a href="">Racing</a></li>
                        <li><a href="">PvP</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Follow us</h4>
                    <div class="social-links">
                        <a href=""><i class="bx bxl-facebook-circle"></i></a>
                        <a href=""><i class="bx bxl-instagram-alt"></i></a>
                        <a href=""><i class="bx bxl-twitter"></i></a>
                        <a href=""><i class="bx bxs-phone-call"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
<?php ob_end_flush(); ?>