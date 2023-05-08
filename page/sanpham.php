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
    <script>
        let arr_TL = []
        let arr_NSX = []
    </script>
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
                                    <img src="../uploads/<?php echo $row['sp_imgavt']; ?>">
                                </div>
                            </div>
                            <div class="front">
                                <div class="img">
                                    <img src="../uploads/<?php echo $row['sp_imgavt']; ?>">
                                </div>
                                <div class="front-content">
                                    <?php
                                    $query1 = mysqli_query($cn, "SELECT * from giamgia");
                                    $giamoi = 0;
                                    while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
                                        $today = date('Y-m-d');
                                        if ($row1['sp_id'] == $row['sp_id'] && strtotime($row1['gg_ngaybatdau']) <= strtotime($today) && strtotime($row1['gg_ngayketthuc']) >= strtotime($today)) {
                                            $giamoi = $row['sp_gia'] - ($row['sp_gia'] * ($row1['gg_phantram'] / 100));
                                            ?>
                                            <small class="badge">
                                                <?php echo $row1['gg_phantram']; ?>%
                                            </small>
                                        <?php } else { ?>
                                            <small></small>
                                        <?php }

                                    }
                                    ?>
                                    <div class="description">
                                        <div class="title">
                                            <p class="title">
                                                <!-- tên sản phẩm -->
                                                <strong>
                                                    <?php echo $row['sp_tengame']; ?>
                                                </strong>
                                            </p>
                                        </div>
                                        <?php
                                        if ($giamoi != 0) { ?>
                                            <div class="card-footer">
                                                <!-- giá trước khi sale -->
                                                <div class="footer-label">
                                                    <label for="" class="price-old">
                                                        <?php echo $row['sp_gia']; ?>đ
                                                    </label>
                                                </div>
                                                <!-- giá sai khi sale -->
                                                <div class="footer-label">
                                                    <label for="">
                                                        <?php echo $giamoi; ?>đ
                                                    </label>
                                                </div>
                                            </div>
                                            <?php $giamoi = 0;
                                        } else { ?>
                                            <!-- giá sai khi sale -->
                                            <div class="footer-label">
                                                <label for="">
                                                    <?php echo $row['sp_gia']; ?>đ
                                                </label>
                                            </div>
                                        <?php }
                                        ?>


                                        <div class="card-btn">
                                            <!-- button detail -->
                                            <div class="card-button">
                                                <a href="chitietsp.php?idsp=<?php echo $row['sp_id']; ?>">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
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

            <div class="filter-item filter-btn ">
                <button id="Loc" onclick="Loc()">Lọc</button>
                <button id="Huy">Hủy</button>
            </div>
            <script>
                function Loc() {
                    let giaMin = document.getElementById('giaMin').value
                    let giaMax = document.getElementById('giaMax').value
                    
                    arr_NSX.forEach(element => {
                        alert(element)
                    });
                }
            </script>
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
            <script>
                function returnmodal() {
                    var textTL = ""
                    var textNSX = ""
                    var checkboxTL = document.getElementsByName('timkiem_TL')
                    var checkboxNSX = document.getElementsByName('timkiem_NSX')
                    for (var i = 0; i < checkboxTL.length; i++) {
                        if (checkboxTL[i].checked == true) {
                            arr_TL.push(checkboxTL[i].value)
                            textTL = textTL + checkboxTL[i].value + " "
                        }
                    }
                    for (var i = 0; i < checkboxNSX.length; i++) {
                        if (checkboxNSX[i].checked == true) {
                            arr_NSX.push(checkboxNSX[i].value)
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

    <script src="../js/index.js "></script>
    <script src="../js/sanpham.js "></script>

    <script type="text/javascript " src="//code.jquery.com/jquery-1.11.0.min.js "></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-migrate-1.2.1.min.js "></script>

</body>

</html>