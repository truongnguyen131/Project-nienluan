<?php session_start();
include_once('database_connection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Index2.css">
    <link rel="stylesheet" href="../css/sanpham.css">
    <link rel="stylesheet" href="../css/card2.css">
    <link rel="stylesheet" href="../css/pagination.css">
    <link rel="stylesheet" href="../css/logout.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Sản phẩm</title>
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
                <i class='bx bx-search-alt' id="search-icon"></i>
                <a href="#" onclick="openmodal()">
                    <i class='bx bx-filter-alt' id="filter-icon"></i>
                </a>
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
            <div class="nofication1" id="nofication">
                <div class="nofication-box" id="noteTxT">

                </div>
                <!-- <div class="nofication-box box-color">
                    <p>Bạn đã không tải game thành công</p>
                    <i class='bx bxs-x-circle bx-tada'></i>
                </div> -->
            </div>

            <!-- tìm kiếm -->
            <div class="search1">
                <div class="search-item">
                    <input type="text" class="search-input" placeholder=" " onkeyup="thanhsearch()" id="thanhsearch"
                        name="thanhsearch">
                    <span class="search-lable">Tìm kiếm</span>
                    <script>
                        function thanhsearch() {
                            let tk = document.getElementById("thanhsearch").value;
                            $.post('thanhsearch.php', {
                                data: tk
                            }, function (data) {
                                $('#saling').html(data);
                            })
                        }
                    </script>
                </div>
            </div>

            <!-- Đăng xuất -->
            <div class="log-out">
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
        </div>
    </header>
    <!-- menu 2 -->
    <div class="container menu-second">
        <h2>Các sản phẩm</h2>
        <div class="menu-content">
            <ul class="breadcrumb">
                <li><a href="index2.php">Trang chủ</a></li>
                <li class="here">Sản phẩm</li>
            </ul>
        </div>
    </div>

    <!-- content -->
    <section class="saling container" id="saling">
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
                $query = mysqli_query($cn, "SELECT * from sanpham WHERE sp_trangthai = 'duyet' ORDER BY sanpham.sp_id DESC LIMIT $begin,12");
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $idsp = $row['sp_id'];
                    ?>
                    <div class="card">
                        <div class="content">
                            <div class="back">
                                <div class="back-content">
                                    <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
                                    <!-- số sao trung bình được đánh giá -->
                                    <?php
                                    $count = mysqli_query($cn, "SELECT AVG(dg_sao) FROM danhgia WHERE sp_id =  $idsp");
                                    while ($avg_sao = mysqli_fetch_array($count)) {
                                        $avg = $avg_sao['AVG(dg_sao)'];
                                    }
                                    if ($avg > 0) { ?>
                                        <div class="rating">
                                            <span class="starss">
                                                <?php echo number_format($avg, "1", ".", "") ?> <i class='bx bxs-star'></i>
                                            </span>
                                        </div>
                                    <?php } else { ?>
                                        <div></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="front">
                                <div class="img">
                                    <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
                                </div>
                                <div class="front-content">
                                    <!-- phần trăm sale -->
                                    <?php
                                    $today = date('Y-m-d');
                                    $giamoi = 0;
                                    $query1 = mysqli_query($cn, "SELECT * FROM giamgia WHERE sp_id = $idsp");
                                    if (mysqli_num_rows($query1) > 0) {
                                        $row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC);
                                        if (strtotime($row1['gg_ngaybatdau']) <= strtotime($today) && strtotime($row1['gg_ngayketthuc']) >= strtotime($today)) {
                                            $giamoi = $row['sp_gia'] - ($row['sp_gia'] * ($row1['gg_phantram'] / 100)); ?>
                                            <small class="badge">
                                                <?php echo $row1['gg_phantram'] ?>%
                                            </small>
                                        <?php }
                                    } else { ?>
                                        <small></small>
                                    <?php } ?>
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
                                            <?php
                                            if (mysqli_num_rows($query1) > 0) { 
                                                ?>
                                                <!-- giá trước khi sale -->
                                                <div class="footer-label">
                                                    <label for="" class="price-old">
                                                        <?php echo currency_format($row['sp_gia']) ?>
                                                    </label>
                                                </div>
                                                <!-- giá sau khi sale -->
                                                <div class="footer-label">
                                                    <label for="">
                                                        <?php if (strtotime($row1['gg_ngaybatdau']) <= strtotime($today) && strtotime($row1['gg_ngayketthuc']) >= strtotime($today)) {
                                                            echo currency_format($giamoi);
                                                        } ?>
                                                    </label>
                                                </div>
                                                <?php
                                            } else { ?>
                                                <!-- giá sau khi sale -->
                                                <div class="footer-label">
                                                    <label for="">
                                                        <?php echo currency_format($row['sp_gia']) ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
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
                                                <a href="themvaothanhtoan.php?idsp=<?php echo $row['sp_id']; ?>">
                                                    <i class='bx bx-download'></i>
                                                </a>
                                            </div>
                                            <!-- button thêm vào giỏ hàng -->
                                            <div class="card-button">
                                                <button class="add-product"
                                                    onclick="themsanphamindex(<?php echo $row['sp_id']; ?>)">
                                                    <i class='bx bxs-cart'></i>
                                                </button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
        </div>
        <!-- pagination -->
        <div class="pagination">
            <?php
            $sl_sp = mysqli_num_rows(mysqli_query($cn, "SELECT * from sanpham"));
            $tong_page = ceil($sl_sp / 12);
            ?>
            <ul class="ul_phantrang">
                <?php
                for ($i = 1; $i <= $tong_page; $i++) { ?> <a href="sanpham.php?page=<?php echo $i; ?>#saling">
                        <li id="<?php echo $i; ?>" class="link <?php if ($i == $page) {
                               echo 'active';
                           } ?>" value="<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </li>
                    </a>
                <?php }
                ?>
            </ul>
        </div>
    </section>

    <!-- Bộ lọc -->
    <div class="filter-control hidden" id="control">
        <div class="filter-title-coltrol">
            <a href="#" onclick="closemodal()">
                <ion-icon name="close-circle-outline"></ion-icon>
            </a>
            <h1>Bộ lọc</h1>
        </div>
        <div class="filter-itemss">
            <div class="filter-item ">
                <label for=" ">Kéo để chọn giá</label>
                <div class="group">
                    <div class="pro"></div>
                    <div class="range-input">
                        <input class="range-min" max="1000000" id="giaMin" type="range" value="0">
                        <input class="range-max" max="1000000" id="giaMax" type="range" value="1000000">
                    </div>
                    <div class="range-text">
                        <div class="text-min">0</div>
                        <div class="text-max">1.000.000</div>
                    </div>
                </div>
            </div>
            <a href="#" id="theloai" onclick="opentheloai()">
                <div class=" filter-item items ">
                    <div class="item-title ">
                        <label for=" ">Thể loại</label>
                        <span id="TLs"></span>
                    </div>
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                </div>
            </a>
            <a href="#" id="nhasanxuat" onclick="opennsx()">
                <div class="filter-item items ">
                    <div class="item-title ">
                        <label for=" ">Nhà sản xuất</label>
                        <span id="NSXs"></span>
                    </div>
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                </div>
            </a>

            <div class="filter-item filter-btn">
                <button id="Loc" onclick="Loc()">Lọc</button>
                <button id="Huy" onclick="Huy()">Hủy</button>
            </div>
            <script>
                function Huy() {
                    document.getElementById('giaMin').value = 0
                    document.getElementById('giaMax').value = 1000000
                    document.getElementById("TLs").innerHTML = ""
                    document.getElementById("NSXs").innerHTML = ""
                    var checkboxTL = document.getElementsByName('timkiem_TL')
                    var checkboxNSX = document.getElementsByName('timkiem_NSX')
                    progress.style.left = 0 + '%';
                    progress.style.right = 0 + '%';
                    rangeText[0].style.left = 0 + '%';
                    rangeText[1].style.right = 0 + '%';
                    rangeText[0].innerText = 0;
                    rangeText[1].innerText = 1000000;
                    for (var i = 0; i < checkboxTL.length; i++) {
                        checkboxTL[i].checked = false
                    }
                    for (var i = 0; i < checkboxNSX.length; i++) {
                        checkboxNSX[i].checked = false
                    }

                    $.post('thanhsearch.php', {
                        giaMin: document.getElementById('giaMin').value,
                        giaMax: document.getElementById('giaMax').value
                    }, function (data) {
                        $('#saling').html(data);
                    })
                }

                function Loc() {
                    let giaMin = document.getElementById('giaMin').value
                    let giaMax = document.getElementById('giaMax').value
                    var checkboxTL = document.getElementsByName('timkiem_TL')
                    var checkboxNSX = document.getElementsByName('timkiem_NSX')
                    let arr_TL = []
                    let arr_NSX = []
                    for (var i = 0; i < checkboxTL.length; i++) {
                        if (checkboxTL[i].checked == true) {
                            arr_TL.push(checkboxTL[i].value)
                        }
                    }
                    for (var i = 0; i < checkboxNSX.length; i++) {
                        if (checkboxNSX[i].checked == true) {
                            arr_NSX.push(checkboxNSX[i].value)
                        }
                    }
                    $.post('thanhsearch.php', {
                        giaMin: giaMin,
                        giaMax: giaMax,
                        arr_TL: arr_TL,
                        arr_NSX: arr_NSX
                    }, function (data) {
                        $('#saling').html(data);
                    })
                }
            </script>
        </div>
    </div>


    <!--filter Thể loại -->
    <div class="filter-control hidden" id="category">
        <div class="filter-title-item">
            <a href="#" onclick="returnmodal()">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </a>
            <h1>Thể loại</h1>
            <button class="btn-filter" onclick="returnmodal()">Chọn</button>
            <script>
                function returnmodal() {
                    var textTL = ""
                    var textNSX = ""
                    var checkboxTL = document.getElementsByName('timkiem_TL')
                    var checkboxNSX = document.getElementsByName('timkiem_NSX')
                    for (var i = 0; i < checkboxTL.length; i++) {
                        if (checkboxTL[i].checked == true) {
                            textTL = textTL + checkboxTL[i].value + " "
                        }
                    }

                    for (var i = 0; i < checkboxNSX.length; i++) {
                        if (checkboxNSX[i].checked == true) {
                            textNSX = textNSX + checkboxNSX[i].value + " "
                        }
                    }

                    document.getElementById("TLs").innerHTML = textTL
                    document.getElementById("NSXs").innerHTML = textNSX
                    modal.style.display = "block";
                    nsx.style.display = "none";
                    theloai.style.display = "none";
                }
            </script>
        </div>


        <div class="filter-itemss">
            <?php
            $s = mysqli_query($cn, "SELECT * from theloai");
            while ($r = mysqli_fetch_array($s, MYSQLI_ASSOC)) { ?>
                <label class="lable-item">
                    <div class="filter-item items">
                        <label for="<?php echo $r['tl_ten']; ?>"><?php echo $r['tl_ten']; ?></label>
                        <input type="checkbox" name="timkiem_TL" value="<?php echo $r['tl_ten']; ?>">
                    </div>
                </label>
            <?php }
            ?>

        </div>
    </div>

    <!--filter nsx -->
    <div class="filter-control hidden" id="nsxx">
        <div class="filter-title-item">
            <a href="#" onclick="returnmodal()">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </a>
            <h1>Nhà sản xuất</h1>
            <button class="btn-filter" onclick="returnmodal()">Chọn</button>
        </div>
        <div class="filter-itemss">
            <?php
            $s = mysqli_query($cn, "SELECT * from nsx");
            while ($r = mysqli_fetch_array($s, MYSQLI_ASSOC)) {
                if (strpos($r['nsx_ten'], "a") != false) { ?>
                    <label class="lable-item">
                        <div class="filter-item items">
                            <label for="<?php echo $r['nsx_ten']; ?>"><?php echo $r['nsx_ten']; ?></label>
                            <input type="checkbox" name="timkiem_NSX" value="<?php echo $r['nsx_ten']; ?>">
                        </div>
                    </label>
                <?php }
            } ?>

        </div>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="../js/index.js "></script>
    <script src="../js/sanpham.js "></script>
    <script src="../js/logout.js"></script>
    <script src="../js/search_nofication.js"></script>
    <div id="note"></div>
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


<?php
if (isset($_GET['tenTL'])) {
    $tentl = $_GET['tenTL'];
    echo "<script>
    let giaMin = document.getElementById('giaMin').value
    let giaMax = document.getElementById('giaMax').value
    let arr_TL = []
    arr_TL.push('$tentl')
    $.post('thanhsearch.php', {
        giaMin: giaMin,
        giaMax: giaMax,
        arr_TL: arr_TL,
    }, function (data) {
        $('#saling').html(data);
    })
</script>";
}
?>

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