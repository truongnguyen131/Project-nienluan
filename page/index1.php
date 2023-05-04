<?php session_start();
include_once('page/database_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
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

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>cla</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <link rel="stylesheet" href="css/card.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <style>
        .ul_phantrang li {
            float: left;
            padding: 5px 15px;
            margin: 5px;
            background-color: blue;
            display: block;
        }

        .ul_phantrang li a {
            color: white;
            text-align: center;
        }
    </style>
</head>


<!-- body -->

<body class="main-layout">

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
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="page/giamgia.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="page/about.html">About</a>
                                    </li>
                                    <div class="dropdown show nav-item">
                                        <a class="nav-link dropdown-toggle nav-item" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Dropdown link
                                        </a>
                                        <div class="dropdown-menu nav-item-drop" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item nav-link" href="#">Action</a>
                                            <a class="dropdown-item nav-link" href="#">Another action</a>
                                            <a class="dropdown-item nav-link" href="#">Something else here</a>
                                        </div>
                                    </div>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html">Contact Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="search-box nav-link">
                                            <button class="btn-search"><ion-icon
                                                    name="search-circle-outline"></ion-icon>
                                            </button>
                                            <input type="text" class="input-search" placeholder="Type to Search...">
                                        </div>
                                    </li>
                                    <li class="nav-item d_none">
                                        <a class="nav-link" href="#"><i class="fa fa-shopping-cart"
                                                aria-hidden="true"></i></a>
                                    </li>
                                    <li class="nav-item d_none">
                                        <a class="nav-link" href="page/dangnhap.php">Login</a>
                                    </li>
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
    <div style="height: 200px; background-color: blue;"></div>
    <!-- end banner -->
    <!-- three_box -->
    <div class="titlepage">
        <h2>GAME NỔI BẬC</h2>
    </div>
    <!-- Slider -->
    <div class="image-slider">
        <div class="image-item">
            <div class="image">
                <img class="img-slider"
                    src="https://images.unsplash.com/photo-1476718406336-bb5a9690ee2a?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80"
                    alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider"
                    src="https://images.unsplash.com/photo-1482049016688-2d3e1b311543?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=710&q=80"
                    alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider"
                    src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80"
                    alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider"
                    src="https://images.unsplash.com/photo-1467003909585-2f8a72700288?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=687&q=80"
                    alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
        <div class="image-item">
            <div class="image">
                <img class="img-slider"
                    src="https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=928&q=80"
                    alt="" />
            </div>
            <h3 class="image-title">This is demo title</h3>
        </div>
    </div>
    <!-- three_box -->
    <!-- products -->
    <div class="products">
        <div class="container">
            <div class="titlepage" id="GAME">
                <h2>GAME</h2>
            </div>
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
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>


                    <div class="card">
                        <!-- img zoom -->
                        <div class="card-img-zoom">
                            <a href="page/chitietsanpham.php?idsp=<?php echo $row['sp_id']; ?>">
                                <img src="uploads/<?php echo $row['sp_imgavt']; ?>" alt="" class="card-img">
                            </a>
                        </div>
                        <!-- ----------- -->
                        <div class="card-content">
                            <div class="card-top">
                                <!-- Tên card -->
                                <h3 class="card-title">
                                    <?php echo $row['sp_tengame']; ?>
                                </h3>
                                <!-- Thông tin card -->
                                <div class="card-info">
                                    <div class="card-info-top">
                                        <?php
                                        $query1 = mysqli_query($cn, "SELECT * from giamgia");
                                        while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
                                            $today = date('Y-m-d');
                                            if ($row1['sp_id'] == $row['sp_id'] && strtotime($row1['gg_ngaybatdau']) <= strtotime($today) && strtotime($row1['gg_ngayketthuc']) >= strtotime($today)) {
                                                $giamoi = $row['sp_gia'] - ($row['sp_gia'] * ($row1['gg_phantram'] / 100));
                                                ?>
                                                <div class="card-price-sale">
                                                    <h2>
                                                        <?php echo $row1['gg_phantram']; ?>%
                                                    </h2>
                                                </div>
                                                <div class="card-price-old">
                                                    <h2>
                                                        <?php echo $row['sp_gia']; ?>đ
                                                    </h2>
                                                </div>
                                                <div class="card-price-new">
                                                    <h2>
                                                        <?php echo $giamoi; ?>đ
                                                    </h2>
                                                </div>
                                            <?php } else { ?>
                                                <div class="card-price-new">
                                                    <h2>
                                                        <?php echo $row['sp_gia']; ?>đ
                                                    </h2>
                                                </div>
                                            <?php }

                                        }
                                        ?>

                                    </div>

                                    <div class="card-info-bottom">
                                        <h2 class="card-nsx">
                                            <?php echo $row['nsx_ten']; ?>
                                        </h2>
                                    </div>
                                    <?php
                                    $idsp = $row['sp_id'];
                                    $query1 = mysqli_query($cn, "SELECT * from theloai,sanphamtheloai where theloai.tl_id = sanphamtheloai. tl_id and sanphamtheloai.sp_id = $idsp");
                                    ?>
                                    <div>The loai:
                                        <?php
                                        while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) { ?>
                                            <a style="background-color: red;"
                                                href="page/timkiemsanpham.php?id=<?php echo $row1['tl_id']; ?>"><?php echo $row1['tl_ten']; ?></a>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                            <!-- Button -->
                            <div class="card-bottom">
                                <div class="card-buy">
                                    <ion-icon name="download"></ion-icon>
                                </div>
                                <div class="card-cart">
                                    <a href="page/giohang.php?idsp=<?php echo $row['sp_id']; ?>">
                                        <ion-icon name="cart"></ion-icon>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>



                <?php }

                ?>
            </div>

            <div>
                <p>Trang</p>
                <?php
                $sl_sp = mysqli_num_rows(mysqli_query($cn, "SELECT * from sanpham"));
                $tong_page = ceil($sl_sp / 12);
                ?>
                <ul class="ul_phantrang">
                    <?php
                    for ($i = 1; $i <= $tong_page; $i++) { ?>
                        <li <?php if ($i == $page) {
                            echo 'style="background: red"';
                        } ?>>
                            <a href="index.php?page=<?php echo $i; ?>#GAME"><?php echo $i; ?></a>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>

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
        jQuery(document).ready(function ($) {

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
            setInterval(function () {

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
                }, 3000, function () {
                    $(this).remove()
                });


            }, 350);

        });
    </script>


    <script>
        // sticky navrbar
        $(document).ready(function () {
            window.onscroll = function () {
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
        $(function () {
            $(document).scroll(function () {
                var $nav = $(".header");
                $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
            });
        });
    </script>


    <script>
        $(document).ready(function () {
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
        $(document).ready(function () {
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