<?php session_start();
include_once('database_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Index2.css">
    <link rel="stylesheet" href="../css/card2.css">
    <link rel="stylesheet" href="../css/click_slider.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Trang chủ</title>
</head>
<!-- hàm format giá -->
<?php
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
}
echo currency_format(5000000);
?>
<?php
if (isset($_GET['idtaikhoan'])) {
    $idtk = $_SESSION["idtaikhoan"];
    $dtl = 0;
}
if (isset($_GET['loaitaikhoan']) && $_SESSION["loaitaikhoan"] == "khach hang") {
    $sql = mysqli_query($cn, "SELECT * FROM khachhang WHERE tk_id='$idtk'");
    while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
        $idkh = $row['kh_id'];
        $dtl = $row['kh_diemtichluy'];
    }
}
if (isset($_GET['partnerCode'])) {
    if (isset($_SESSION['diemtichluy'])) {
        $dtl = $_SESSION['diemtichluy'] + diemtichluy($_SESSION['thanhtoan']);
        unset($_SESSION['diemtichluy']);
    } else {
        $dtl = $dtl + diemtichluy($_SESSION['thanhtoan']);
    }

    mysqli_query($cn, "UPDATE `khachhang` SET `kh_diemtichluy`='$dtl' WHERE kh_id = $idkh");
    $today = date('Y-m-d');
    mysqli_query($cn, "INSERT INTO `donhang`(`dh_id`, `dh_ngaylap`, `kh_id`) VALUES ('','$today','$idkh')");
    $id_dh = mysqli_insert_id($cn);
    foreach ($_SESSION['xulygiohang'] as $key => $value) {
        $soluong = $value['soluong'];
        $tongtien = $value['dongia'] * $value['soluong'];
        mysqli_query($cn, "INSERT INTO `chitietdonhang`(`dh_id`, `sp_id`, `ctdh_soluong`, `ctdh_tongtien`) VALUES ('$id_dh','$key','$soluong','$tongtien')");
    }

    unset($_SESSION['xulygiohang']);
    unset($_SESSION['thanhtoan']);
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
            <a href="#" class="logo">Store<span>Game</span></a>
            <!-- nav icon -->
            <div class="nav-icons">
                <i class='bx bxs-bell bx-tada' id="bell-icon"><span></span></i>
                <i class='bx bx-search-alt' id="search-icon"></i>
                <a href="giohang2.php">
                    <i class='bx bx-cart'></i>
                </a>
                <?php if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" ) { ?>
                    <i class='bx bxs-user bx-tada' id="logout-icon"></i>
                <?php } else {?>
                    <a href="dangnhap.php">
                    <i class='bx bxs-user'></i>
                    </a>
                <?php }?>
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
                        <a href="#">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#">Phổ biến</a>
                    </li>
                   
                    <li>
                        <a href="#">Game mới</a>
                    </li>
                    <li>
                        <a href="#">Giảm giá</a>
                    </li>
                    <li>
                        <a href="#">Contact Us</a>
                    </li>
                    <?php
                    if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" && $_SESSION['loaitaikhoan'] == 'ad') { ?>
                    <li>
                        <a href="#">Quản lý của Admin</a>
                    </li>
                    <?php }
                    if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" && $_SESSION['loaitaikhoan'] == 'nsx') { ?>
                    <li>
                        <a href="#">Quản lý của Nhà sản xuất</a>
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
            <div class="log_out">
                <a href="dangxuat.php" class="out">
                <div class="logout-box box-color">
                    <p>Đăng xuất</p>
                    <i class='bx bx-log-out'></i>
                </div>
                </a>
            </div>
        </div>
    </header>

    <!-- home section -->
    <section class="home container" id="home">
        <img src="https://dotesports.com/wp-content/uploads/2020/10/27031436/VALORANT_YR1_KeyArt_4k_3_.0-2.jpg" alt="">
        <div class="home-text">
            <h1>CITY OF THE <br> FUTURE</h1>
            <a href="#" class="btn">Mua ngay</a>
        </div>
    </section>
    <!-- Game được tải nhiều nhất, slider -->
    <section class="container product-content">
        <div class="heading">
            <i class='bx bxs-flame'></i>
            <h2>Game được yêu thích </h2>
        </div>
        <!-- Game được yêu thích -->
        <div class="image-slider">
            <div class="image-item">
                <div class="image">
                    <img src="https://images.unsplash.com/photo-1476718406336-bb5a9690ee2a?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80"
                        alt="" />
                    <div class="box-text">
                        <h2>Tên game</h2>
                        <h3>Thể loại</h3>
                        <div class="rating-download">
                            <div class="rating">
                                <i class='bx bxs-heart'></i>
                                <span>5</span>
                            </div>
                            <a href="#" class="box-btn"><i class='bx bx-download'></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="image-item">
                <div class="image">
                    <img src="https://images.unsplash.com/photo-1482049016688-2d3e1b311543?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=710&q=80"
                        alt="" />
                    <div class="box-text">
                        <h2>Tên game</h2>
                        <h3>Thể loại</h3>
                        <div class="rating-download">
                            <div class="rating">
                                <i class='bx bxs-heart'></i>
                                <span>5</span>
                            </div>
                            <a href="#" class="box-btn"><i class='bx bx-download'></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="image-item">
                <div class="image">
                    <img src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80"
                        alt="" />
                </div>
            </div>
            <div class="image-item">
                <div class="image">
                    <img src="https://images.unsplash.com/photo-1467003909585-2f8a72700288?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80"
                        alt="" />
                </div>
            </div>
            <div class="image-item">
                <div class="image">
                    <img src="https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=928&q=80"
                        alt="" />
                </div>
            </div>
        </div>
        <!-- Game được yêu thích -->
    </section>
    <!-- Game đang được giảm giá -->
    <section class="saling container" id="saling">
        <div class="heading">
            <i class='bx bxs-flame'></i>
            <h2>Game đang giảm giá</h2>
        </div>
        <div class="saling-content">
            <div class="cards">
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = "";
                }
                if ($page == "" || $page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($page * 12) - 12;
                }
                $query = mysqli_query($cn, "SELECT * from sanpham,nsx where sanpham.nsx_id = nsx. nsx_id ORDER BY sanpham.sp_id DESC LIMIT $begin,12");
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {?>
                <div class="card">
                    <div class="content">
                        <div class="back">
                            <div class="back-content">
                                <img src="https://cdn.akamai.steamstatic.com/steam/apps/751630/header_292x136.jpg?t=1678710840"
                                    alt="">
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <span>4.7</span>
                                </div>
                            </div>
                        </div>
                        <div class="front">
                            <div class="img">
                                <img src="../uploads/<?php echo $row['sp_imgavt']; ?>" alt="">
                            </div>
                            <div class="front-content">
                                <!-- phần trăm sale -->
                                <?php
                                        $query1 = mysqli_query($cn, "SELECT * from giamgia");
                                        while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
                                            $today = date('Y-m-d');
                                            if ($row1['sp_id'] == $row['sp_id'] && strtotime($row1['gg_ngaybatdau']) <= strtotime($today) && strtotime($row1['gg_ngayketthuc']) >= strtotime($today)) {
                                                $giamoi = $row['sp_gia'] - ($row['sp_gia'] * ($row1['gg_phantram'] / 100));
                                                ?>
                                <small class="badge"><?php echo $row1['gg_phantram']; ?>%</small>
                                <div class="description">
                                    <div class="title">
                                        <p class="title">
                                            <!-- tên sản phẩm -->
                                            <strong><?php echo $row['sp_tengame']; ?> </strong>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <!-- giá trước khi sale -->
                                        <div class="footer-label">
                                            <label for="" class="price-old"><?php echo $row['sp_gia']; ?></label>
                                        </div>
                                        <!-- giá sau khi sale -->
                                        <div class="footer-label">
                                            <label for=""><?php echo $giamoi; ?></label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="footer-label">
                                            <label for="" class="price-old"><?php echo $row['sp_gia']; ?></label>
                                        </div>
                                        <?php }}?>
                                    </div>

                                    <div class="card-btn">
                                        <!-- chi tiết sản phẩm -->
                                        <div class="card-button">
                                            <a href="chitietsp.php?idsp=<?php echo $row['sp_id']; ?>"
                                                title="Chi tiết sản phẩm">
                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                            </a>
                                        </div>
                                        <!-- button download -->
                                        <div class="card-button">
                                            <a href="" title="Mua sản phẩm">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </div>
                                        <!-- button thêm vào giỏ hàng -->
                                        <div class="card-button">
                                            <a href="giohang.php?idsp=<?php echo $row['sp_id']; ?>"
                                                title="Thêm và giỏ hàng">
                                                <i class='bx bxs-cart'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="products">
            <a href="sanpham.php">Xem thêm sản phẩm</a>
        </div>
    </section>
    <!-- Game đang được giảm giá -->

    <!-- Thể loại -->
    <section class="container product-content">
        <div class="heading">
            <i class='bx bxs-flame'></i>
            <h2>Thể loại</h2>
        </div>
        <div class="image-slider">
            <div class="image-item">
                <div class="image">
                    <a href="">
                        <img src="https://images.unsplash.com/photo-1476718406336-bb5a9690ee2a?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80"
                            alt="" />
                    </a>
                    <div class="box-text-category">
                        <h2>Tên game</h2>

                    </div>
                </div>
            </div>
            <div class="image-item">
                <div class="image">
                    <img src="https://images.unsplash.com/photo-1482049016688-2d3e1b311543?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=710&q=80"
                        alt="" />
                    <div class="box-text">
                        <h2>Tên game</h2>
                        <h3>Thể loại</h3>
                        <div class="rating-download">
                            <div class="rating">
                                <i class='bx bxs-heart'></i>
                                <span>5</span>
                            </div>
                            <a href="#" class="box-btn"><i class='bx bx-download'></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="image-item">
                <div class="image">
                    <img src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80"
                        alt="" />
                </div>
            </div>
            <div class="image-item">
                <div class="image">
                    <img src="https://images.unsplash.com/photo-1467003909585-2f8a72700288?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80"
                        alt="" />
                </div>
            </div>
            <div class="image-item">
                <div class="image">
                    <img src="https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=928&q=80"
                        alt="" />
                </div>
            </div>
        </div>
        <!-- Game được yêu thích -->
    </section>
    <!-- coppyright -->
    <footer class="coppyright ">
        <div class="footer__content container">
            <div class="logo-page">
                <a href="Index2.html" class="logo">Store<span>Game</span></a>
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

    <script src="../js/index.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="../js/slider.js"></script>
</body>

</html>