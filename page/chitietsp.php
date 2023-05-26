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
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/card2.css">
    <link rel="stylesheet" href="../css/click_slider.css">
    <link rel="stylesheet" href="../css/product-like.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
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

if (isset($_GET['idsp'])) {
    $sp_id = $_GET['idsp'];
    $sp = mysqli_query($cn, "SELECT * FROM sanpham,nsx WHERE sanpham.nsx_id = nsx.nsx_id AND sp_id = $sp_id");
    $row = mysqli_fetch_array($sp, MYSQLI_ASSOC);
    $_SESSION['chitietsp'][$sp_id] = array(
        'hinh_sp' => $row['sp_imgavt'],
        'ten_sp' => $row['sp_tengame'],
        'gia_sp' => $row['sp_gia']
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
                <i class='bx bxs-bell' id="bell-icon"></i>
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
            <div class="nofication" id="nofication">
                <div class="nofication-box" id="noteTxT" onclick="closeNote()">
                </div>
                <script>
                    function closeNote() {
                        document.getElementById("nofication").classList.remove("active")
                        document.getElementById("bell-icon").classList.remove("bx-tada")
                        document.getElementById("bell-icon").innerHTML = ""
                        document.getElementById("noteTxT").innerHTML = ""
                    }
                </script>
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
    <!-- content -->
    <div class="content-product container">
        <div class="content-info">
            <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
            <h1>
                <?php echo $row['sp_tengame'] ?>
            </h1>
            <?php
            $theloai = mysqli_query($cn, "SELECT * from sanphamtheloai,theloai WHERE sanphamtheloai.tl_id = theloai.tl_id AND $sp_id = sp_id"); ?>
            <p>Thể loại:
                <?php
                $arr_idtl = array();
                while ($value1 = mysqli_fetch_array($theloai, MYSQLI_ASSOC)) {
                    array_push($arr_idtl, $value1['tl_id']); ?>
                    <a href="">
                        <?php echo $value1['tl_ten'] ?>
                    </a>
                <?php } ?>
            </p>
            <span>Nhà sản xuất:
                <?php echo $row['nsx_ten'] ?>
            </span>
            <div class="sale-and-star">
                <!-- số sao trung bình được đánh giá -->
                <?php
                $count = mysqli_query($cn, "SELECT AVG(dg_sao) FROM danhgia WHERE sp_id = $sp_id");
                while ($avg_sao = mysqli_fetch_array($count)) {
                    $avg = $avg_sao['AVG(dg_sao)'];
                }
                if ($avg > 0) {
                    ?>
                    <span class="medium-star">
                        <?php echo number_format($avg, "1", ".", "") ?> <i class='bx bxs-star bx-tada'></i>
                    </span>
                <?php } else { ?>
                    <span></span>
                <?php } ?>
                <!-- % giảm giá (nếu có)-->
                <?php
                $today = date('Y-m-d');
                $query1 = mysqli_query($cn, "SELECT * from giamgia where sp_id = $sp_id");
                if (mysqli_num_rows($query1) > 0) {
                    $row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC);
                    if (strtotime($row1['gg_ngaybatdau']) <= strtotime($today) && strtotime($row1['gg_ngayketthuc']) >= strtotime($today)) {
                        $giamoi = $row['sp_gia'] - ($row['sp_gia'] * ($row1['gg_phantram'] / 100));
                        ?>
                        <span class="sale">
                            <?php echo $row1['gg_phantram'] ?>%
                        </span>
                        <div class="info-price">
                            <!-- giá mới -->
                            <h2>
                                <?php echo currency_format($giamoi) ?>
                            </h2>
                            <!-- giá cũ trước khi sale (nếu có)-->
                            <span>
                                <?php echo currency_format($row['sp_gia']) ?>
                            </span>
                        </div>
                    <?php } else { ?>
                        <span></span>
                        <div class="info-price">
                            <!-- giá mới -->
                            <h2>
                                <?php echo currency_format($row['sp_gia']) ?>
                            </h2>
                            <!-- giá cũ trước khi sale (nếu có)-->
                            <span></span>
                        </div>
                    <?php } ?>
                    <?php
                } else { ?>
                    <span></span>
                    <div class="info-price">
                        <!-- giá mới -->
                        <h2>
                            <?php echo currency_format($row['sp_gia']) ?>
                        </h2>
                        <!-- giá cũ trước khi sale (nếu có)-->
                        <span></span>
                    </div>
                <?php } ?>
            </div>

            <div class="infor-btn">
                <a href="themvaothanhtoan.php?idsp=<?php echo $row['sp_id']; ?>">Mua</a>
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
    <div class="about container" id="mota">
        <h2>Mô tả Game</h2>
        <p>
            <?php
            $pre_mota = substr($row['sp_mota'], 0, 80);
            ;
            if (isset($_GET['mota'])) {
                echo $row['sp_mota'];
            }
            if (!isset($_GET['mota'])) {
                echo $pre_mota . " <a href='chitietsp.php?idsp=$sp_id&mota=xemthem#mota'>Xem thêm.....</a>";
            }
            ?>
        </p>

    </div>
    <!-- đánh giá và bình luận -->
    <form action="" method="post" id="danhgia">
        <div class="rate-and-cmt container">
            <h2>Đánh giá và bình luận</h2>
            <div class="tab-comment-content">
                <div class="tab-cmt-display" style="display: block;">
                    <!-- cmt và đánh giá của 1 người dùng -->
                    <?php
                    $danhgia2 = mysqli_query($cn, "SELECT * FROM danhgia,taikhoan WHERE danhgia.tk_id = taikhoan.tk_id AND sp_id = $sp_id ORDER BY danhgia.dg_id DESC");
                    while ($var = mysqli_fetch_array($danhgia2, MYSQLI_ASSOC)) {
                        ?>
                        <div class="tab-user-cmt">
                            <!-- tên khách hàng -->
                            <div class="cmt-user-name">
                                <span>
                                    <?php echo $var['tk_taikhoan'] ?>
                                </span>
                            </div>
                            <!-- ngày hiện tại -->
                            <div class="cmt-date">
                                <span>
                                    <?php echo $var['dg_ngaydanhgia'] ?>
                                </span>
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
                                <span>
                                    <?php echo $var['dg_binhluan'] ?>
                                </span>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- cmt và đánh giá của 1người dùng -->
                </div>
                <div class="tab-cmt-bottom">
                    <span>Hãy đánh giá nhé:</span>
                    <div class="product-danhgiasao">
                        <div class="stars">
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
                        </div>
                    </div>
                    <span>Bình luận</span>
                    <div class="product-bottom-inputbtn">
                        <div class="tab-cmt-input">
                            <textarea name="cmt" id="cmt" placeholder=" Bình luận "></textarea>
                            <div class="loi" id="loicmt"></div>
                            <input type="text" style="display:none" id="sp__id" value="<?php echo $sp_id ?>">
                        </div>
                        <div class="tab-cmt-btn">
                            <button style="display: block;" name="cmt_btn" onclick="kiemtraloi()" type="button">Bình
                                luận</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Game tuong tu -->
    <div class="container">
        <h2
            style="margin-bottom: 20px;display: inline-flex;font-size: 1.5rem;font-weight: bold;border-bottom: 4px solid var(--main-color);">
            Bạn có thể thích</h2>
        <div class="image-slider">
            <?php
            $sqlGameTT = "SELECT * FROM sanpham sp,danhgia dg, sanphamtheloai sptl WHERE sp.sp_id = dg.sp_id and sp.sp_id = sptl.sp_id AND (SELECT AVG(dg_sao) FROM danhgia) > 3 and sptl.tl_id in (";
            foreach ($arr_idtl as $key => $value) {
                if ($key === array_key_last($arr_idtl)) {
                    $sqlGameTT = $sqlGameTT . "" . $value . ") GROUP BY sp.sp_id ORDER BY AVG(dg_sao) DESC LIMIT 0,8";
                } else {
                    $sqlGameTT = $sqlGameTT . "" . $value . ",";
                }
            }

            $count_star = mysqli_query($cn, $sqlGameTT);
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
                                <div class="card-button">
                                    <a href="chitietsp.php?idsp=<?php echo $row['sp_id']; ?>" title="Chi tiết sản phẩm">
                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div id="thongbao"></div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/comment.js"></script>
    <script src="../js/slider.js"></script>
    <script>
        window.onload = function () {
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

    <script>
        function kiemtraloi() {
            var cmt = $('#cmt').val()
            var id_sp = $('#sp__id').val()
            var checkbox = document.getElementsByName('star');
            var result = 0;
            var loi = ""

            for (var i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked === true) {
                    result = checkbox[i].value;
                }
            }

            if (cmt == "") {
                loi = "Vui lòng nhập bình luận <br>"
            }

            if (result == 0) {
                loi += "Vui lòng chọn sao đánh giá"
            }

            if (loi != "") {
                $('#loicmt').html(loi)
            } else {
                $.post('xulydanhgia.php', {
                    cmt1: cmt,
                    id1: id_sp,
                    star1: result
                }, function (data) {
                    $('#thongbao').html(data);
                })
            }

        }
    </script>

    <?php
    if (isset($_GET['danhgia'])) {
        echo '<script>
    document.getElementById("nofication").classList.toggle("active")
    document.getElementById("bell-icon").classList.toggle("bx-tada")
    document.getElementById("bell-icon").innerHTML = "<span></span>"
    document.getElementById("noteTxT").innerHTML = "<p>Đánh giá thành công ùi</p>"
    </script>';
    }
    ?>

</body>
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

</html>