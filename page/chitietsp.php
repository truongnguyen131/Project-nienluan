<?php session_start();
include_once('database_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Index2.css">
    <link rel="stylesheet" href="../css/chitietsp.css">
    <link rel="stylesheet" href="../css/logout.css">
    <link rel="stylesheet" href="../css/stars.css">

    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Chi tiết sản phẩm</title>
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

if (isset($_SESSION["idtaikhoan"])) {
    $idtk = $_SESSION["idtaikhoan"];
}

if (isset($_GET['idsp'])) {
    $sp_id = $_GET['idsp'];
    $sp = mysqli_query($cn, "SELECT * FROM sanpham,nsx WHERE sanpham.nsx_id = nsx.nsx_id AND sp_id = $sp_id");
    $row = mysqli_fetch_array($sp, MYSQLI_ASSOC);
    $_SESSION['chitietsp'][$sp_id] = array(
        'hinh_sp' => $row['sp_imgavt'],
        'ten_sp' => $row['sp_tengame'],
        'gia_sp' => $row['sp_gia'],
        'soluong_sp' => '<script> console.log(count); </script>'
    );
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
                <a href="giohang2.php">
                    <!-- cart -->
                    <i class='bx bxs-cart-alt bx-tada' id="cart-icon"><span></span></i>
                </a>
                <?php if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "") { ?>
                    <i class='bx bxs-user bx-tada' id="logout-icon"></i>
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
                    if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" && $_SESSION['loaitaikhoan'] == 'admin') { ?>
                        <li>
                            <a href="#">Quản lý của Admin</a>
                        </li>
                    <?php }
                    if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" && $_SESSION['loaitaikhoan'] == 'nha san xuat') { ?>
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
    <!-- content -->
    <div class="content-product container">
        <div class="content-info">
            <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
            <h1><?php echo $row['sp_tengame'] ?></h1>
            <?php
            $theloai = mysqli_query($cn, "SELECT * from sanphamtheloai,theloai WHERE sanphamtheloai.tl_id = theloai.tl_id AND $sp_id = sp_id"); ?>
            <p>Thể loại:
                <?php
                while ($value1 = mysqli_fetch_array($theloai, MYSQLI_ASSOC)) { ?>
                    <a href="">
                        <?php echo $value1['tl_ten'] ?>
                    </a>
                <?php } ?>
            </p>

            <span>Nhà sản xuất: <?php echo $row['nsx_ten'] ?></span>
            <div class="sale-and-star">
                <!-- số sao trung bình được đánh giá -->
                <?php 
                $count = mysqli_query($cn, "SELECT AVG(dg_sao) FROM danhgia WHERE sp_id = $sp_id");
                while($avg_sao = mysqli_fetch_array($count)){
                    $avg = $avg_sao['AVG(dg_sao)'];
                }
                ?>
                <span class="medium-star"><?php echo number_format($avg,"1",".","")?> <i class='bx bxs-star bx-tada'></i></span>
                <!-- % giảm giá (nếu có)-->
                <?php $query1 = mysqli_query($cn, "SELECT * from giamgia where sp_id = $sp_id");
                if (mysqli_num_rows($query1) > 0) {
                    $row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC); ?>
                    <span class="sale"><?php echo $row1['gg_phantram'] ?>%</span>
                <?php $giamoi = $row['sp_gia'] - ($row['sp_gia'] * ($row1['gg_phantram'] / 100));
                } else {
                    $giamoi = $row['sp_gia'];
                } ?>
            </div>
            <div class="info-price">
                <!-- giá mới -->
                <h2><?php echo currency_format($giamoi) ?></h2>
                <!-- giá cũ trước khi sale (nếu có)-->
                <?php
                $query1 = mysqli_query($cn, "SELECT * from giamgia where sp_id = $sp_id");
                if (mysqli_num_rows($query1) > 0) { ?>
                    <span><?php echo currency_format($row['sp_gia']) ?></span>
                <?php } else { ?>
                    <span></span>
                <?php } ?>

            </div>
            <div class="info-quantity">
               <input class="product-btn-giam" type="button" id="giam" onclick="giamsl()" value="-"></input>
                <input class="product-value" id="val" type="text" value="1">
                <input class="product-btn-tang" type="button" id="tang" onclick="tangsl()" value="+"></input>
            </div>
            <div class="infor-btn">
                <a href="thanhtoan2.php?idsp=<?php echo $row['sp_id']; ?>">Mua</a>
                <a href="giohang2.php?idsp=<?php echo $row['sp_id']; ?>">Thêm vào giỏ hàng</a>
            </div>
        </div>
        <div class="content-tabs">
            <div class="container-tab">
                <img id="expandedImg">
                <div id="imgtext"></div>
            </div>
            <!-- The grid: four columns -->
            <div class="row">
                <?php
                $query = mysqli_query($cn, "SELECT * from anhgameplay WHERE $sp_id = sp_id");
                while ($value = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                ?>
                    <div class="column">
                        <img src="../uploads/<?php echo $value['agl_ten'] ?>" alt="" onclick="myFunction(this);">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- trailer -->
    <div class="video-container container">
        <h2>Trailer Game</h2>
        <video src="../uploads/<?php echo $row['sp_trailer'] ?>" muted autoplay></video>
    </div>
    <!-- mô tả -->
    <div class="about container">
        <h2>Mô tả Game</h2>
        <p><?php echo $row['sp_mota'] ?></p>
    </div>
    <!-- bản mở rộng (nếu có) -->
    <div class="extend container">
        <h2>Bản mở rộng</h2>
        <div class="extend-content">
            <label>Townsmen VR</label>
            <p>Bản mở rộng này có thêm được 5 màn chơi mới</p>
            <div class="extend-price">
                <div class="ext-sale">
                    <span class="sale">20%</span>
                </div>
                <div class="ext-price-new">
                    <h3>120.000.000đ</h3>
                </div>
                <div class="ext-price-old">
                    <span>120.000.000đ</span>
                </div>
            </div>
            <div class="infor-btn">
                <a href="#">Mua</a>
                <a href="#">Thêm vào giỏ hàng</a>
            </div>
        </div>
    </div>

    <!-- đánh giá và bình luận -->
    <form action="" method="post">
        <div class="rate-and-cmt container">
            <h2>Đánh giá và bình luận</h2>
            <div class="tab-comment-content">
                <div class="tab-cmt-display">
                    <!-- cmt và đánh giá của 1 người dùng -->
                    <?php
                    $danhgia2 = mysqli_query($cn, "SELECT * FROM danhgia,taikhoan WHERE danhgia.tk_id = taikhoan.tk_id AND sp_id = $sp_id ORDER BY dg_id DESC");
                    while ($var = mysqli_fetch_array($danhgia2, MYSQLI_ASSOC)) {
                    ?>
                        <div class="tab-user-cmt">
                            <!-- tên khách hàng -->
                            <div class="cmt-user-name">
                                <span><?php echo $var['tk_taikhoan']?></span>
                            </div>
                            <!-- ngày hiện tại -->
                            <div class="cmt-date">
                                <span><?php echo $var['dg_ngaydanhgia'] ?></span>
                            </div>
                            <!-- đánh giá sao -->
                            <div class="cmt-sao">
                                <?php
                                for ($i = 1; $i <= $var['dg_sao']; $i++) {
                                ?>
                                    <i class='bx bxs-star'></i>
                                <?php } ?>
                            </div>
                            <!-- nội dung cmt -->
                            <div class="cmt-content">
                                <span><?php echo $var['dg_binhluan'] ?></span>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- cmt và đánh giá của 1người dùng -->
                </div>
                <div class="tab-cmt-bottom">
                    <span>Hãy đánh giá nhé:</span>
                    <div class="product-danhgiasao">
                        <div class="stars">
                            <form action="">
                                <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-4" id="star-4" type="radio" name="star" value="4" />
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-2" id="star-2" type="radio" name="star" value="2" />
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-1" id="star-1" type="radio" name="star" value="1" />
                                <label class="star star-1" for="star-1"></label>
                            </form>
                        </div>
                    </div>
                    <span>Bình luận</span>
                    <div class="product-bottom-inputbtn">
                        <div class="tab-cmt-input">
                            <textarea name="cmt" id="cmt" placeholder=" Bình luận "></textarea>
                            <div class="loi" id="loicmt"></div>
                            <input type="text" style="display:none" id="sp__id" value="<?php echo $sp_id?>">
                            <input type="text" style="display:none" id="id_tk" value="<?php echo $idtk?>">
                        </div>
                        <div class="tab-cmt-btn">
                            <button name="cmt_btn" onclick="kiemtraloi()" type="button">Bình luận</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- tabs -->
    <script>
        window.onload = function() {
            document.getElementById("expandedImg").src = "../uploads/<?php echo $row['sp_imgavt'] ?>";
            document.getElementById("expandedImg").parentElement.style.display = "block";
        }

        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg");
            var imgText = document.getElementById("imgtext");
            expandImg.src = imgs.src;
            imgText.innerHTML = imgs.alt;
            expandImg.parentElement.style.display = "block";
        }
    </script>
    <!-- tabs -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/logout.js"></script>
    <script src="../js/chitietsp.js"></script>
    <script src="../js/comment.js"></script>


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