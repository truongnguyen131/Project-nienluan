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

    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Sản phẩm</title>
</head>

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
            <div class="logo">
                <a href="">
                    <img src="https://evondev.com/wp-content/uploads/2021/12/logo-new.png" alt="">
                </a>
            </div>
            <!-- nav icon -->
            <div class="nav-icons">
                <i class='bx bxs-bell bx-tada' id="bell-icon"><span></span></i>
                <i class='bx bx-search-alt' id="search-icon"></i>
                <a href="#" onclick="openmodal()">
                    <i class='bx bx-filter-alt' id="filter-icon"></i>
                </a>

                <a href="">
                    <i class='bx bx-cart'></i>
                </a>
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
                        <a href="#">Game giảm giá</a>
                    </li>
                    <li>
                        <a href="#">Contact Us</a>
                    </li>
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
        </div>
    </header>
    <!-- menu 2 -->
    <div class="container menu-second">
        <h2>Các sản phẩm</h2>
        <div class="menu-content">
            <ul class="breadcrumb">
                <li><a href=" # ">Trang chủ</a></li>
                <li class="here">Sản phẩm</li>
            </ul>
        </div>
    </div>
    <!-- content -->

    <!-- Game đang được giảm giá -->
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
                $query = mysqli_query($cn, "SELECT * from sanpham  ORDER BY sp_id DESC LIMIT $begin,12");
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>

                    <div class="card">
                        <div class="content">
                            <div class="back">
                                <div class="back-content">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/spotlights/3158a7251c1744ddf5bbb2e1/spotlight_image_french.jpg?t=1681343243"
                                        alt="">
                                </div>
                            </div>
                            <div class="front">
                                <div class="img">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/spotlights/3158a7251c1744ddf5bbb2e1/spotlight_image_french.jpg?t=1681343243"
                                        alt="">
                                </div>
                                <div class="front-content">

                                    <!-- phần trăm sale -->
                                    <small class="badge">20%</small>
                                    <div class="description">
                                        <div class="title">
                                            <p class="title">
                                                <!-- tên sản phẩm -->
                                                <strong>soldes editeur</strong>
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <!-- giá trước khi sale -->
                                            <div class="footer-label">
                                                <label for="" class="price-old">120.000.000đ</label>
                                            </div>
                                            <!-- giá sai khi sale -->
                                            <div class="footer-label">
                                                <label for="">120.000.000đ</label>
                                            </div>
                                        </div>

                                        <div class="card-btn">
                                            <!-- button detail -->
                                            <div class="card-button">
                                                <a href="">
                                                    <ion-icon name="detail-outline"></ion-icon>
                                                </a>
                                            </div>
                                            <!-- button thêm vào giỏ hàng -->
                                            <div class="card-button">
                                                <a href="">
                                                    <ion-icon name="cart-outline"></ion-icon>
                                                </a>
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
                           } ?>" value="<?php echo $i; ?>" >
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
                        <input class="range-min" max="1000000" type="range" value="0">
                        <input class="range-max" max="1000000" type="range" value="1000000">
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
                        <span>hành động, đua xe</span>
                    </div>
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                </div>
            </a>
            <a href="#" id="nhasanxuat" onclick="opennsx()">
                <div class="filter-item items ">
                    <div class="item-title ">
                        <label for=" ">Nhà sản xuất</label>
                        <span>VNG</span>
                    </div>
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                </div>
            </a>

            <div class="filter-item filter-btn ">
                <a href="#" class="btn-filter">Lọc</a>
                <a href="#" class="btn-filter">Hủy</a>
            </div>
        </div>
    </div>

    <!-- Thể loại -->
    <div class="filter-control hidden" id="category">
        <div class="filter-title-item">
            <a href="#" onclick="returnmodal()">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </a>
            <h1>Thể loại</h1>
            <button class="btn-filter" onclick="returnmodal()">Chọn</button>
        </div>
        <div class="filter-itemss">
            <!-- 1 thể loại -->
            <label for="tl_id" class="lable-item">
                <div class="filter-item items">
                    <label for="tl_id">Đua xe</label>
                    <input type="checkbox" name="" id="tl_id">
                </div>
            </label>
            <!-- 1 thể loại -->
            <!-- 1 thể loại -->
            <label for="tl_id" class="lable-item">
                <div class="filter-item items">
                    <label for="tl_id">Đua xe</label>
                    <input type="checkbox" name="" id="tl_id">
                </div>
            </label>
            <!-- 1 thể loại -->
            <!-- 1 thể loại -->
            <label for="tl_id" class="lable-item">
                <div class="filter-item items">
                    <label for="tl_id">Đua xe</label>
                    <input type="checkbox" name="" id="tl_id">
                </div>
            </label>
            <!-- 1 thể loại -->
        </div>
    </div>
    <!-- nsx -->
    <div class="filter-control hidden" id="nsxx">
        <div class="filter-title-item">
            <a href="#" onclick="returnmodal()">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </a>
            <h1>Nhà sản xuất</h1>
            <button class="btn-filter" onclick="returnmodal()">Chọn</button>
        </div>
        <div class="filter-itemss">
            <!-- 1 nhà sản xuất -->
            <label for="nsx_id" class="lable-item">
                <div class="filter-item items">
                    <label for="nsx_id">VNG</label>
                    <input type="checkbox" name="" id="nsx_id">
                </div>
            </label>
            <!-- 1 nhà sản xuất -->
        </div>
    </div>


    <!-- coppyright -->
    <footer class="coppyright ">
        <div class="footer__content container">
            <div class="logo-page">
                <a href="Index2.html" class="logo">S-<span>Game</span></a>
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

    <script src="../js/index.js "></script>
    <script src="../js/sanpham.js "></script>

    <script type="text/javascript " src="//code.jquery.com/jquery-1.11.0.min.js "></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-migrate-1.2.1.min.js "></script>
   
</body>

</html>