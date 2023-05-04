<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Index2.css">
    <link rel="stylesheet" href="../css/giohang2.css">
    <link rel="stylesheet" href="../css/stars.css">

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
            function currency_format($number, $suffix = 'đ') {
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
if (!isset($_SESSION["idtaikhoan"])) {
    $_SESSION["idsanpham"] = $idsp;
    header("location:dangnhap.php");
} else {
    if (!isset($_SESSION['xulygiohang'])) {
        $_SESSION['xulygiohang'] = array();
    }
    if (isset($_GET['idsp'])) {
        $idsp = $_GET['idsp'];
        if (isset($_SESSION['xulygiohang'][$idsp])) {
            $_SESSION['xulygiohang'][$idsp]['soluong'] += 1;
            header('Location:giohang.php');
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
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "delete":
            if (isset($_GET['id'])) {
                unset($_SESSION['xulygiohang'][$_GET['id']]);
                header('Location:giohang.php');
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
    <form action="" method="post">


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

        <div class="container menu-second">
            <h2>Giỏ hàng</h2>
            <div class="menu-content">
                <ul class="breadcrumb">
                    <li><a href=" # ">Trang chủ</a></li>
                    <li class="here">Giỏ hàng</li>
                </ul>
                <span>Giỏ hàng: 3 sản phẩm</span>
            </div>
        </div>



        <!-- content -->
        <div class="cart-content container scrollbar">
        <div class="cart-product">
        <?php
          $tt = 0;
          $num = 1;
          if (!empty($_SESSION['xulygiohang'])) {
              foreach ($_SESSION['xulygiohang'] as $key => $value) {

                  $tt = $tt + ($value['dongia'] * $value['soluong']);
        ?>
            
                <!-- sản phẩm -->
                <div class="product-item">
                    <img src="../uploads/<?php echo $value['hinhsp'] ?>" alt=" ">
                    <div class="product-infor">
                        <h1 class="product-name "> <?php echo $value['tensp'] ?></h1>
                        <h2 class="product-price "><?php echo currency_format( $value['dongia'] ) ?></h2>
                    </div>
                    <div class="info-quantity">
                        <form action="giohang.php" method="post">
                            <div class="product-btn-giam "><button id="giam" name="-<?php echo $key; ?>" onclick="quantity() ">-</button></div>
                            <div class="product-value "><input id="val " type="text " value="<?php echo $value['soluong'] ?>"></div>
                            <div class="product-btn-tang "><button id="tang " name="+<?php echo $key; ?>" onclick="quantity() ">+</button></div>
                        </form>
                        <?php
                                if (isset($_POST["+$key"])) {
                                    header('Location:giohang.php?idsp=' . $key . '');
                                }
                                if (isset($_POST["-$key"])) {
                                    if ($value['soluong'] > 1) {
                                        $_SESSION['xulygiohang'][$key]['soluong'] -= 1;
                                        header('Location:giohang.php');
                                    }
                                    if ($value['soluong'] == 1) {
                                        header('Location:giohang.php?action=delete&id=' . $key . '');
                                    }
                                }
                                ?>
                    </div>
                    <h2 class="product-price-total "><?php echo currency_format("Tổng giá") ?></h2>
                    <a href="giohang.php?action=delete&id=<?php echo $key ?>" class="close-item">
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </div>
                <?php
                    }
                } else { ?>
                <!-- sản phẩm -->
                <!-- <div class="product-item">
                    <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1012790/header_alt_assets_3.jpg?t=1683099724" alt="">
                    <div class="product-infor">
                            <h1 class="product-name ">SONICS</h1>
                            <h2 class="product-price ">120.000.000đ</h2>
                        </div>
                        <div class="info-quantity">
                        
                                <div class="product-btn-giam "><button id="giam" name="-" onclick="quantity() ">-</button></div>
                                <div class="product-value "><input id="val " type="text " value=""></div>
                                <div class="product-btn-tang "><button id="tang " name="+" onclick="quantity() ">+</button></div>
                        </div>
                        <h2 class="product-price-total ">120.000.000đ</h2>
                        <a href="" class="close-item">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                </div>
                <div class="product-item">
                    <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1012790/header_alt_assets_3.jpg?t=1683099724" alt="">
                    <div class="product-infor">
                            <h1 class="product-name ">SONICS</h1>
                            <h2 class="product-price ">120.000.000đ</h2>
                        </div>
                        <div class="info-quantity">
                        
                                <div class="product-btn-giam "><button id="giam" name="-" onclick="quantity() ">-</button></div>
                                <div class="product-value "><input id="val " type="text " value=""></div>
                                <div class="product-btn-tang "><button id="tang " name="+" onclick="quantity() ">+</button></div>
                        </div>
                        <h2 class="product-price-total ">120.000.000đ</h2>
                        <a href="" class="close-item">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                </div> -->
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
                    <label><?php echo currency_format($tt) ?></label>
                </div>
            </div>
        </div>

     
    </form>
    <script src="../js/index.js "></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-1.11.0.min.js "></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-migrate-1.2.1.min.js "></script>


</body>
   <!-- coppyright -->
   <footer class="coppyright">
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

</html>