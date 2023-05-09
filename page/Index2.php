<?php session_start();
include_once('database_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Index2.css">
    <link rel="stylesheet" href="../css/logout.css">
    <link rel="stylesheet" href="../css/card2.css">
    <link rel="stylesheet" href="../css/click_slider.css">
    <link rel="stylesheet" href="../css/product-like.css">
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
    function currency_format($number, $suffix = 'đ')
    {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
}
?>
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

if (isset($_SESSION['idtaikhoan'])) {
    $idtk = $_SESSION["idtaikhoan"];
    $dtl = 0;
}
if (isset($_SESSION['loaitaikhoan']) && $_SESSION["loaitaikhoan"] == "khach hang") {
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
            <a href="#" class="logo">Game<span>Store</span></a>
            <!-- nav icon -->
            <div class="nav-icons">
                <i class='bx bxs-bell' id="bell-icon"></i>
                <i class='bx bx-search-alt' id="search-icon"></i>
                <?php
                if (isset($_SESSION['xulygiohang']) && !empty($_SESSION['xulygiohang'])) {
                    ?>
                    <a href="giohang2.php">
                        <i class='bx bx-cart bx-tada' id="cart-icon"><span></span></i>
                    </a>
                <?php } else { ?>
                    <a href="giohang2.php">
                        <i class='bx bx-cart' id="cart-icon"></i>
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
            <div class="nofication" id="nofication">
                <div class="nofication-box" id="noteTxT">

                </div>
                <!-- <div class="nofication-box box-color">
                    <p>Bạn đã không tải game thành công</p>
                    <i class='bx bxs-x-circle bx-tada'></i>
                </div> -->
            </div>

            <!-- tìm kiếm -->
            <div class="search">
                <div class="search-item">
                    <input type="text" class="search-input" placeholder=" " onkeyup="thanhsearch()" id="thanhsearch"
                        name="thanhsearch">
                    <span class="search-lable">Tìm kiếm</span>
                    <script>
                        function thanhsearch() {
                            let tk = document.getElementById("thanhsearch").value;
                            $.post('thanhsearchindex.php', {
                                data: tk
                            }, function (data) {
                                $('#sale').html(data);
                            })
                        }
                    </script>
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

    <!-- home section -->
    <section class="home container" id="home">
        <img src="https://dotesports.com/wp-content/uploads/2020/10/27031436/VALORANT_YR1_KeyArt_4k_3_.0-2.jpg" alt="">
        <div class="home-text">
            <h1>CITY OF THE <br> FUTURE</h1>
            <a href="#sale" class="btn">Mua ngay</a>
        </div>
    </section>

    <!-- Game được đề xuất-->
    <section class="container product-content" id="dexuat">
        <div class="heading">
            <i class='bx bxs-flame'></i>
            <h2>Game đề xuất </h2>
        </div>
        <!-- Game được đề xuất -->
        <div class="image-slider1">
            <?php $query6 = mysqli_query($cn, "SELECT * from sanpham");
            while ($row6 = mysqli_fetch_array($query6, MYSQLI_ASSOC)) { ?>
                <a href="chitietsp.php?idsp=<?php echo $row6['sp_id'] ?>">
                    <div class="image-item1">
                        <div class="image1">
                            <img src="../uploads/<?php echo $row6['sp_imgavt'] ?>" alt="" />
                        </div>
                    </div>
                </a>
            <?php } ?>

        </div>
        <!-- Game được đề xuất -->
    </section>
    <!-- Game được yêu thích nhất-->
    <section class="container product-content" id="like">
        <div class="heading">
            <i class='bx bxs-flame'></i>
            <h2>Game được yêu thích </h2>
        </div>
        <!-- Game được yêu thích -->
        <div class="image-slider">
            <?php
            $count_star = mysqli_query($cn, "SELECT * FROM sanpham,danhgia WHERE sanpham.sp_id = danhgia.sp_id AND (SELECT AVG(dg_sao) FROM danhgia) > 3 GROUP BY sanpham.sp_id");
            while ($sosao = mysqli_fetch_array($count_star)) {
                $id = $sosao['sp_id'];
                ?>
                <div class="image-item">
                    <div class="card">
                        <a class="sp_img" href="chitietsp.php?idsp=<?php echo $sosao['sp_id'] ?>">
                            <img src="../uploads/<?php echo $sosao['sp_imgavt'] ?>" alt="" class="card-image" />
                        </a>
                        <div class="card-content">
                            <div class="card-top">
                                <h3 class="card-title">
                                    <?php echo $sosao['sp_tengame'] ?>
                                </h3>
                                <div class="card-user">
                                    <h3>
                                        <?php echo currency_format($sosao['sp_gia']) ?>
                                    </h3>
                                    <span>
                                        <?php echo currency_format($sosao['sp_gia']) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="rating-download">
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <?php
                                    $count = mysqli_query($cn, "SELECT AVG(dg_sao) FROM sanpham,danhgia WHERE sanpham.sp_id = danhgia.sp_id AND sanpham.sp_id = $id AND (SELECT AVG(dg_sao) FROM danhgia) > 3 GROUP BY sanpham.sp_id;");
                                    while ($avg_sao = mysqli_fetch_array($count)) {
                                        $avg = $avg_sao['AVG(dg_sao)'];
                                    }
                                    ?>
                                    <span>
                                        <?php echo number_format($avg, "1", ".", "") ?>
                                    </span>
                                </div>
                                <a href="thanhtoan2.php?idsp=<?php echo $sosao['sp_id'] ?>" class="box-btn"><i
                                        class='bx bx-download'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Game được yêu thích -->
    </section>
    <!-- Game đang được giảm giá -->
    <section class="saling container" id="sale">
        <div class="heading">
            <i class='bx bxs-flame'></i>
            <h2>Game đang giảm giá</h2>
        </div>
        <div class="saling-content">
            <div class="cards">
                <?php
                $today = date('Y-m-d');
                $query = mysqli_query($cn, "SELECT * FROM sanpham,giamgia WHERE sanpham.sp_id = giamgia.sp_id ");
                $gioihan = 0;
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    if (strtotime($row['gg_ngaybatdau']) <= strtotime($today) && strtotime($row['gg_ngayketthuc']) >= strtotime($today) && $gioihan < 9) {
                        $gioihan++; ?>
                        <div class="card" id="<?php echo $row['sp_id'] ?>">
                            <div class="content">
                                <div class="back">
                                    <div class="back-content">
                                        <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
                                        <div class="rating">
                                            <i class='bx bxs-star'></i>
                                            <?php
                                            $id = $row['sp_id'];
                                            $count = mysqli_query($cn, "SELECT AVG(dg_sao) FROM sanpham,danhgia WHERE sanpham.sp_id = danhgia.sp_id AND sanpham.sp_id = $id AND (SELECT AVG(dg_sao) FROM danhgia) > 3 GROUP BY sanpham.sp_id;");
                                            while ($avg_sao = mysqli_fetch_array($count)) {
                                                $avg = $avg_sao['AVG(dg_sao)'];
                                            }
                                            ?>
                                            <span>
                                                <?php echo number_format($avg, "1", ".", "") ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="front">
                                    <div class="img">
                                        <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
                                    </div>
                                    <div class="front-content">
                                        <!-- phần trăm sale -->
                                        <small class="badge">
                                            <?php echo $row['gg_phantram'] ?>%
                                        </small>
                                        <div class="description">
                                            <div class="title">
                                                <p class="title">
                                                    <!-- tên sản phẩm -->
                                                    <strong>
                                                        <?php echo $row['sp_tengame']; ?>
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <!-- giá trước khi sale -->
                                                <div class="footer-label">
                                                    <label for="" class="price-old">
                                                        <?php echo currency_format($row['sp_gia']) ?>đ
                                                    </label>
                                                </div>
                                                <!-- giá sau khi sale -->
                                                <div class="footer-label">
                                                    <label for="">
                                                        <?php echo currency_format($row['sp_gia']) ?>
                                                    </label>
                                                </div>
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
                                                    <a href="thanhtoan2.php?idsp=<?php echo $row['sp_id']; ?>"
                                                        title="Mua sản phẩm">
                                                        <i class='bx bx-download'></i>
                                                    </a>
                                                </div>
                                                <!-- button thêm vào giỏ hàng -->
                                                <div class="card-button">
                                                    <button class="add-product"
                                                        onclick="themsanphamindex(<?php echo $row['sp_id']; ?>)">
                                                        <ion-icon name="cart-outline"></ion-icon>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
        <div class="products">
            <a href="sanpham.php">Xem thêm sản phẩm</a>
        </div>
    </section>
    <!-- Game đang được giảm giá -->

    <!-- Thể loại -->
    <section class="container product-content" id="category">
        <div class="heading">
            <i class='bx bxs-flame'></i>
            <h2>Thể loại</h2>
        </div>
        <div class="image-slider">
            <?php $query5 = mysqli_query($cn, "SELECT * from theloai");
            while ($row5 = mysqli_fetch_array($query5, MYSQLI_ASSOC)) { ?>
                <div class="image-item">
                    <a href="">
                        <div class="image">
                            <img src="../uploads/tl_<?php echo $row5['tl_id'] ?>.png" alt="" />
                            <div class="box-text">
                                <h2>
                                    <?php echo $row5['tl_ten'] ?>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
    </section>
    <div id="note"></div>
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/logout.js"></script>
    <script src="../js/slider.js"></script>
    <script src="../js/slider1.js"></script>
</body>
<script>
    function themsanphamindex(idsp) {
        var audio = new Audio('click.mp3')
        audio.play()
        $.post('themvaogiohang.php', {
            data: idsp
        }, function (data) {
            $('#note').html(data);
        })
    }
</script>

</html>