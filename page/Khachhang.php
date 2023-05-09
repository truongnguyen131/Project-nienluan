<?php session_start();
include_once('database_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Index2.css">
    <link rel="stylesheet" href="../css/khachhang.css">
    <link rel="stylesheet" href="../css/logout.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Thông tin cá nhân</title>
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
            <a href="index2.php" class="logo">Game<span>Store</span></a>
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
                        <i class='bx bxs-user' id="login-icon"></i>
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
                    <input type="text" class="search-input" placeholder=" " onkeyup="thanhsearch()" id="thanhsearch" name="thanhsearch">
                    <span class="search-lable">Tìm kiếm</span>
                    <script>
                        function thanhsearch() {
                            let tk = document.getElementById("thanhsearch").value;
                            $.post('thanhsearchindex.php', {
                                data: tk
                            }, function(data) {
                                $('#sale').html(data);
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
    </header>
    <!-- menu 2 -->
    <div class="container menu-second">
        <h2>Thông tin cá nhân</h2>
        <div class="menu-content">
            <ul class="breadcrumb">
                <li><a href="index2.php">Trang chủ</a></li>
                <li class="here">Thông tin cá nhân</li>
            </ul>
        </div>
    </div>

    <div class="register-form container">
        <?php
        $tk_id = $_SESSION['idtaikhoan'];
        $loaitk = $_SESSION['loaitaikhoan'];

        $ten = "";
        $sdt = "";
        $email = "";
        $taikhoan = "";
        $matkhau = "";
        if ($loaitk == "khach hang") {
            $kh = mysqli_query($cn, "SELECT * FROM khachhang,taikhoan WHERE khachhang.tk_id = taikhoan.tk_id and taikhoan.tk_id = $tk_id");
            $row1 = mysqli_fetch_array($kh, MYSQLI_ASSOC);
            $ten = $row1['kh_hoten'];
            $sdt = $row1['kh_sdt'];
            $email = $row1['kh_email'];
            $taikhoan = $row1['tk_taikhoan'];
        }
        if ($loaitk == "nha san xuat") {
            $nsx = mysqli_query($cn, "SELECT * FROM nsx,taikhoan WHERE nsx.tk_id = taikhoan.tk_id AND  taikhoan.tk_id  = $tk_id");
            $row2 = mysqli_fetch_array($nsx, MYSQLI_ASSOC);
            $ten = $row2['nsx_ten'];
            $sdt = $row2['nsx_sdt'];
            $email = $row2['nsx_email'];
            $taikhoan = $row2['tk_taikhoan'];
        }
        if ($loaitk == "admin") {
             $ad = mysqli_query($cn, "SELECT * FROM taikhoan WHERE tk_id  = $tk_id");
             $row3 = mysqli_fetch_array($ad, MYSQLI_ASSOC);
            $ten = "Quản lý";
            $sdt = "0947492641";
            $email = "GameStore@gmail.com";
            $taikhoan = $row3['tk_taikhoan'];
        }?>
        <div class="register-item">
            <input type="text" class="register-input" id="hoten" placeholder=" " name="hoten" value="<?php echo $ten;?>">
            <span class="register-lable">Họ tên</span>
            <div class="loi" id="loihoten"></div>
        </div>
        <div class="register-item">
            <input type="text" class="register-input" id="sdt" name="sdt" placeholder=" " value="<?php echo $sdt;?>">
            <span class="register-lable">Số điện thoại</span>
            <div class="loi" id="loisdt"></div>
        </div>
        <div class="register-item">
            <input type="email" class="register-input" id="email" name="email" placeholder=" " value="<?php echo $email;?>">
            <span class="register-lable">Email</span>
            <div class="loi" id="loiemail"></div>
        </div>
        <div class="register-item">
            <input type="text" class="register-input" id="tk" placeholder=" " name="taikhoan" value="<?php echo $taikhoan;?>">
            <span class="register-lable">Tài khoản</span>
            <div class="loi" id="loitk"></div>
        </div>
        <div class="register-item">
            <input type="password" class="register-input input-pass" placeholder=" " id="mk" name="matkhau" >
            <span class="register-lable">Mật khẩu</span>
            <div class="loi" id="loimk"></div>
            <ion-icon name="eye-off-outline" class="eye eye-close"></ion-icon>
            <ion-icon name="eye-outline" class="eye eye-open hidden"></ion-icon>
        </div>
        <div class="register-item">
            <input type="password" class="register-input input-pass-again" placeholder=" " id="nlmk" name="matkhau_again">
            <span class="register-lable">Nhập lại mật khẩu</span>
            <div class="loi" id="loinlmk"></div>
            <ion-icon name="eye-off-outline" class="eye eye-close-again"></ion-icon>
            <ion-icon name="eye-outline" class="eye eye-open-again hidden"></ion-icon>
        </div>
        <div class="register-item register-btn">
            <button onclick="capnhat()" type="button">Cập nhật</button>
            <button type="button" onclick="Huy()">Hủy</button>
        </div>
    </div>

</body>


<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/index.js"></script>
<script src="../js/logout.js"></script>

</html>