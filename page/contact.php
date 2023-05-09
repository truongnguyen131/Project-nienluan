<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Index2.css">
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="../css/logout.css">
    <link rel="stylesheet" href="../css/stars.css">

    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Liên hệ</title>
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
    <div class="container menu-second">
        <h2>Liên hệ</h2>
        <div class="menu-content">
            <ul class="breadcrumb">
                <li><a href=" # ">Trang chủ</a></li>
                <li class="here">Liên hệ</li>
            </ul>
        </div>
    </div>


    <!-- profile -->
    <div class="profile container">
        <div class="card">
            <div class="card__border">
                <img src="../images/avtar1.png" alt="" class="card__img">
            </div>
            <h3 class="card__name">Nguyễn Ngọc Trường</h3>
            <div class="card__professhion">
                Sinh viên Trường ĐH Cần Thơ
            </div>
            <div class="card__social" id="card-social-1">
                <div class="card__social-control">
                    <div class="card__social-toggle" id="card-toggle-1">
                        <ion-icon name="add-outline"></ion-icon>
                    </div>
                    <span class="card__social-text">
                        Liên hệ
                    </span>

                    <!-- card social -->
                    <div class="card__social-list">
                        <a href="" target="_blank" class="card__social-link">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                        <a href="" target="_blank" class="card__social-link">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                        <a href="" target="_blank" class="card__social-link">
                            <ion-icon name="logo-github"></ion-icon>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card__border">
                <img src="../images/avatar2.png" alt="" class="card__img">
            </div>
            <h3 class="card__name">Trương Minh Trí</h3>
            <div class="card__professhion">
                Sinh viên Trường ĐH Cần Thơ
            </div>
            <div class="card__social" id="card-social-2">
                <div class="card__social-control">
                    <div class="card__social-toggle" id="card-toggle-2">
                        <ion-icon name="add-outline"></ion-icon>
                    </div>
                    <span class="card__social-text">
                        Liên hệ
                    </span>

                    <!-- card social -->
                    <div class="card__social-list">
                        <a href="" target="_blank" class="card__social-link">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                        <a href="" target="_blank" class="card__social-link">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                        <a href="" target="_blank" class="card__social-link">
                            <ion-icon name="logo-github"></ion-icon>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card__border">
                <img src="../images/avatar3.png" alt="" class="card__img">
            </div>
            <h3 class="card__name">Phạm Thái Quốc</h3>
            <div class="card__professhion">
                Sinh viên Trường ĐH Cần Thơ
            </div>
            <div class="card__social" id="card-social-3">
                <div class="card__social-control">
                    <div class="card__social-toggle" id="card-toggle-3">
                        <ion-icon name="add-outline"></ion-icon>
                    </div>
                    <span class="card__social-text">
                        Liên hệ
                    </span>

                    <!-- card social -->
                    <div class="card__social-list">
                        <a href="" target="_blank" class="card__social-link">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                        <a href="" target="_blank" class="card__social-link">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                        <a href="" target="_blank" class="card__social-link">
                            <ion-icon name="logo-github"></ion-icon>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- contact-us -->
    <div class="contact container">
        <div class="contact__form">
            <h2 class="contact-title">Liên hệ với chúng tôi</h2>
            <div class="contact__input-infor">
                <div class="itemss">
                    <div class="contact-item">
                        <input type="text" class="contact-input" placeholder=" " name="taikhoan" id="tk">
                        <span class="contact-lable">Họ tên</span>
                    </div>
                    <div class="contact-item">
                        <input type="text" class="contact-input" placeholder=" " name="taikhoan" id="tk">
                        <span class="contact-lable">Email</span>
                    </div>
                    <div class="contact-item">
                        <input type="text" class="contact-input" placeholder=" " name="taikhoan" id="tk">
                        <span class="contact-lable">Số điện thoại</span>
                    </div>
                </div>
                <div class="mess">
                    <div class="contact-item">
                        <textarea name="" id="" class="contact-input-mess" placeholder=" "></textarea>
                        <span class="contact-lable-mess">Để lại lời nhắn ở đây</span>
                    </div>
                </div>
            </div>

            <div class="contact-item">
                <button class="contact-btn" type="submit">Gửi</button>
                <button class="contact-btn" type="reset">Hủy</button>
            </div>
        </div>
    </div>

    <!-- tabs -->
    <script>
        window.onload = function () {
            document.getElementById("expandedImg ").src = "https://cdn.akamai.steamstatic.com/steam/apps/749960/ss_c5cb2cbfaaa835cc774326daf5aad14f82335068.116x65.jpg?t=1678105868 ";
            document.getElementById("expandedImg ").parentElement.style.display = "block ";
        }

        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg ");
            var imgText = document.getElementById("imgtext ");
            expandImg.src = imgs.src;
            imgText.innerHTML = imgs.alt;
            expandImg.parentElement.style.display = "block ";
        }
    </script>
    <!-- tabs -->
    <script src="../js/index.js "></script>
    <script src="../js/logout.js"></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-1.11.0.min.js "></script>
    <script type="text/javascript " src="//code.jquery.com/jquery-migrate-1.2.1.min.js "></script>
    <script src="../js/contact.js"></script>


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