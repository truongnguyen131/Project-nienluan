<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Trang Chủ</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/click_slider.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <link rel="stylesheet" href="css/card2.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>
<?php
include_once('page/process_cart.php');
$tentk = isset($_SESSION["nametaikhoan"]) ? $_SESSION["nametaikhoan"] : "";
$idtaikhoan = isset($_SESSION["idtaikhoan"]) ? $_SESSION["idtaikhoan"] : "";
$typetk = isset($_SESSION["loaitaikhoan"]) ? $_SESSION["loaitaikhoan"] : "";


?>

<!-- body -->

<body class="main-layout">

    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>

    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header sticky" id="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.html"><img src="images/logo.png" alt="#" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.html">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#aaa">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html">Contact Us</a>
                                    </li>
                                    <?php
                                    if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" && $_SESSION['loaitaikhoan'] == 'ad') { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="page/quanly-admin.html">Quản lý Admin</a>
                                        </li>
                                    <?php } else {
                                    }
                                    if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" && $_SESSION['loaitaikhoan'] == 'nsx') { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="page/quanly-nsx.php">Quản lý Nhà sản xuất</a>
                                        </li>
                                    <?php }
                                    if (isset($_SESSION['loaitaikhoan']) && $_SESSION['loaitaikhoan'] != "" && $_SESSION['loaitaikhoan'] == 'kh') { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Game</a>
                                        </li>
                                    <?php
                                    } ?>

                                    <!-- cart -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><ion-icon name="cart-outline"></ion-icon></a>
                                    </li>
                                    <?php
                                    if (isset($_SESSION["idtaikhoan"]) && $_SESSION["idtaikhoan"] != "") {
                                    ?>
                                        <li>
                                            <div class="dropdown show nav-item">
                                                <a class="nav-link dropdown-toggle nav-item" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?php echo $tentk; ?>
                                                </a>
                                                <div class="dropdown-menu nav-item-drop" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item nav-link" href="page/dangxuat.php"> Đăng xuất</a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="page/dangnhap.php">Đăng nhập</a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- end header inner -->
    <!-- end header -->
    <!-- banner -->
    <section class="banner_main bubbles center-outer center-inner d_none">
    </section>
    <div class="cart-index">
            <a class="" href="page/giohang.php"><ion-icon name="cart-outline"></ion-icon></a>
    </div>
    <!-- end banner -->
    <!-- three_box -->
    <div class="titlepage">
        <h2>GAME NỔI BẬC</h2>
    </div>
    <!-- Slider -->
    <div class="image-slider">
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://cdn.akamai.steamstatic.com/steam/apps/751630/header_292x136.jpg?t=1678710840" alt="" />
            </div>

        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://cdn.akamai.steamstatic.com/steam/spotlights/3158a7251c1744ddf5bbb2e1/spotlight_image_french.jpg?t=1681343243" alt="" />
            </div>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://cdn.akamai.steamstatic.com/steam/apps/751630/header_292x136.jpg?t=1678710840" alt="" />
            </div>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://cdn.akamai.steamstatic.com/steam/spotlights/90a59c99e66f1649efd98fb7/spotlight_image_english.jpg?t=1681246075" alt="" />
            </div>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=928&q=80" alt="" />
            </div>
        </div>
    </div>
    <!-- three_box -->
    <!-- products -->
    <div class="products">
        <div class="container">
            <div class="titlepage">
                <h2>GAME</h2>
            </div>
            <!-- search -->
            <div class="search">
                <div class="contain-search">
                    <span class="icon"><ion-icon name="search-outline"></ion-icon></span>
                    <input type="search" id="search" placeholder="Search..." />
                </div>
            </div>
            <!-- search -->
            <div>
                <div class="cards">
                    <div class="card">
                        <div class="content">
                            <div class="back">
                                <div class="back-content">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/751630/header_292x136.jpg?t=1678710840" alt="">
                                </div>
                            </div>
                            <div class="front">
                                <div class="img">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/751630/header_292x136.jpg?t=1678710840" alt="">
                                </div>
                                <div class="front-content">
                                    <!-- phần trăm sale -->
                                    <small class="badge">20%</small>
                                    <div class="description">
                                        <div class="title">
                                            <p class="title">
                                                <!-- tên sản phẩm -->
                                                <strong>ALLTER THE FALL </strong>
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
                                            <!-- button download -->
                                            <div class="card-button">
                                                <a href="" title="Chi tiết sản phẩm">
                                                    <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                                                </a>
                                            </div>
                                            <div class="card-button">
                                                <a href="" title="Mua sản phẩm">
                                                    <ion-icon name="download-outline"></ion-icon>
                                                </a>
                                            </div>
                                            <!-- button thêm vào giỏ hàng -->
                                            <div class="card-button">
                                                <a href="" title="Thêm và giỏ hàng">
                                                    <ion-icon name="cart-outline"></ion-icon>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="content">
                            <div class="back">
                                <div class="back-content">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/spotlights/90a59c99e66f1649efd98fb7/spotlight_image_english.jpg?t=1681246075" alt="">
                                </div>
                            </div>
                            <div class="front">
                                <div class="img">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/spotlights/90a59c99e66f1649efd98fb7/spotlight_image_english.jpg?t=1681246075" alt="">
                                </div>
                                <div class="front-content">
                                    <!-- phần trăm sale -->
                                    <small class="badge">20%</small>
                                    <div class="description">
                                        <div class="title">
                                            <p class="title">
                                                <!-- tên sản phẩm -->
                                                <strong>CYBER PUNK </strong>
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
                                            <!-- button download -->
                                            <div class="card-button">
                                                <a href="">
                                                    <ion-icon name="download-outline"></ion-icon>
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

                    <div class="card">
                        <div class="content">
                            <div class="back">
                                <div class="back-content">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/spotlights/390e51599c0470d07eee9316/spotlight_image_french.jpg?t=1681335169" alt="">
                                </div>
                            </div>
                            <div class="front">
                                <div class="img">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/spotlights/390e51599c0470d07eee9316/spotlight_image_french.jpg?t=1681335169" alt="">
                                </div>
                                <div class="front-content">
                                    <!-- phần trăm sale -->
                                    <small class="badge">20%</small>
                                    <div class="description">
                                        <div class="title">
                                            <p class="title">
                                                <!-- tên sản phẩm -->
                                                <strong>CALL OF DUTY </strong>
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
                                            <!-- button download -->
                                            <div class="card-button">
                                                <a href="">
                                                    <ion-icon name="download-outline"></ion-icon>
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

                    <div class="card">
                        <div class="content">
                            <div class="back">
                                <div class="back-content">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/spotlights/3158a7251c1744ddf5bbb2e1/spotlight_image_french.jpg?t=1681343243" alt="">
                                </div>
                            </div>
                            <div class="front">
                                <div class="img">
                                    <img src="https://cdn.akamai.steamstatic.com/steam/spotlights/3158a7251c1744ddf5bbb2e1/spotlight_image_french.jpg?t=1681343243" alt="">
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
                                            <!-- button download -->
                                            <div class="card-button">
                                                <a href="">
                                                    <ion-icon name="download-outline"></ion-icon>
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

                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
    <!-- laptop  section -->
    <div class="titlepage">
        <h2>GAME NỔI BẬC</h2>
    </div>
    <div class="image-slider1">
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://images.unsplash.com/photo-1476718406336-bb5a9690ee2a?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80" alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://images.unsplash.com/photo-1482049016688-2d3e1b311543?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=710&q=80" alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80" alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://images.unsplash.com/photo-1467003909585-2f8a72700288?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80" alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider" src="https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=928&q=80" alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
    </div>
    <!-- end laptop  section -->
    <!-- customer -->
    <div class="titlepage">
        <h2>Customer Review</h2>
    </div>
    <div class="customer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide customer_Carousel " data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="carousel-caption ">
                                        <div class="row">
                                            <div class="col-md-9 offset-md-3">
                                                <div class="test_box">
                                                    <i><img src="images/cos.png" alt="#" /></i>
                                                    <h4>Sandy Miller</h4>
                                                    <p>ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                        eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                        ad
                                                        minim veniam, quis nostrud exercitation ullamco laboris nisi
                                                        ut
                                                        aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                        reprehenderit in voluptate velit esse cillum dolore eu
                                                        fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat non
                                                        proident,
                                                        sunt in culpa qui officia deserunt mollit anim id</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-9 offset-md-3">
                                                <div class="test_box">
                                                    <i><img src="images/cos.png" alt="#" /></i>
                                                    <h4>Sandy Miller</h4>
                                                    <p>ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                        eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                        ad
                                                        minim veniam, quis nostrud exercitation ullamco laboris nisi
                                                        ut
                                                        aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                        reprehenderit in voluptate velit esse cillum dolore eu
                                                        fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat non
                                                        proident,
                                                        sunt in culpa qui officia deserunt mollit anim id</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-9 offset-md-3">
                                                <div class="test_box">
                                                    <i><img src="images/cos.png" alt="#" /></i>
                                                    <h4>Sandy Miller</h4>
                                                    <p>ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                        eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                        ad
                                                        minim veniam, quis nostrud exercitation ullamco laboris nisi
                                                        ut
                                                        aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                        reprehenderit in voluptate velit esse cillum dolore eu
                                                        fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat non
                                                        proident,
                                                        sunt in culpa qui officia deserunt mollit anim id</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end customer -->

    <!--  contact -->
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Contact Now</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <form id="request" class="main_form">
                        <div class="row">
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Name" type="type" name="Name">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Email" type="type" name="Email">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number">
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message" type="type" Message="Name">Message </textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="send_btn">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact -->
    <!--  footer -->
    <footer id="aaa">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <img class="logo1" src="images/logo1.png" alt="#" />
                        <ul class="social_icon">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <h3>About Us</h3>
                        <ul class="about_us">
                            <li>dolor sit amet, consectetur<br> magna aliqua. Ut enim ad <br>minim veniam, <br>
                                quisdotempor incididunt r</li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <h3>Contact Us</h3>
                        <ul class="conta">
                            <li>dolor sit amet,<br> consectetur <br>magna aliqua.<br> quisdotempor <br>incididunt ut
                                e
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <form class="bottom_form">
                            <h3>Newsletter</h3>
                            <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                            <button class="sub_btn">subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>© 2019 All Rights Reserved. Design by<a href="https://html.design/"> Free Html
                                    Templates</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <script>
        jQuery(document).ready(function($) {

            // Define a blank array for the effect positions. This will be populated based on width of the title.
            var bArray = [];
            // Define a size array, this will be used to vary bubble sizes
            var sArray = [4, 6, 8, 10];

            // Push the header width values to bArray
            for (var i = 0; i < $('.bubbles').width(); i++) {
                bArray.push(i);
            }

            // Function to select random array element
            // Used within the setInterval a few times
            function randomValue(arr) {
                return arr[Math.floor(Math.random() * arr.length)];
            }

            // setInterval function used to create new bubble every 350 milliseconds
            setInterval(function() {

                // Get a random size, defined as variable so it can be used for both width and height
                var size = randomValue(sArray);
                // New bubble appeneded to div with it's size and left position being set inline
                // Left value is set through getting a random value from bArray
                $('.bubbles').append('<div class="individual-bubble" style="left: ' + randomValue(bArray) + 'px; width: ' + size + 'px; height:' + size + 'px;"></div>');

                // Animate each bubble to the top (bottom 100%) and reduce opacity as it moves
                // Callback function used to remove finsihed animations from the page
                $('.individual-bubble').animate({
                    'bottom': '100%',
                    'opacity': '-=0.7'
                }, 3000, function() {
                    $(this).remove()
                });


            }, 350);

        });
    </script>


    <script>
        // sticky navrbar
        $(document).ready(function() {
            window.onscroll = function() {
                stickyNav();
            };

            var navbar = $('.header');
            var sticky = parseInt(navbar.offset().top);

            function stickyNav() {

                if (window.pageYOffset >= sticky) {
                    navbar.addClass("sticky");
                } else {
                    navbar.removeClass("sticky");
                }
            }
        });
        // doi mau khi cuon thanh navbar
        $(function() {
            $(document).scroll(function() {
                var $nav = $(".header");
                $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $(".image-slider").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                arrows: true,
                draggable: false,
                prevArrow: `<button type='button' class='slick-prev slick-arrow'><ion-icon name="arrow-back-circle-outline"></ion-icon></button>`,
                nextArrow: `<button type='button' class='slick-next slick-arrow'><ion-icon name="arrow-forward-circle-outline"></ion-icon></button>`,
                dots: true,
                responsive: [{
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            arrows: false,
                            infinite: false,
                        },
                    },
                ],
                // autoplay: true,
                // autoplaySpeed: 1000,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".image-slider1").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                arrows: true,
                draggable: false,
                prevArrow: `<button type='button' class='slick-prev slick-arrow'><ion-icon name="arrow-back-circle-outline"></ion-icon></button>`,
                nextArrow: `<button type='button' class='slick-next slick-arrow'><ion-icon name="arrow-forward-circle-outline"></ion-icon></button>`,
                dots: true,
                responsive: [{
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 1,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            arrows: false,
                            infinite: false,
                        },
                    },
                ],
                // autoplay: true,
                // autoplaySpeed: 1000,
            });
        });
    </script>
</body>

</html>