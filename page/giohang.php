<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
   
    <title>Giỏ Hàng</title> <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/header-page.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/giohang.css">
    <link rel="stylesheet" href="../css/click_slider.css">
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>

<body>

    <header>
        <div class="header sticky" id="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.html"><img src="../images/logo.png" alt="#" /></a>
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
                                        <a class="nav-link" href="page/about.html">About</a>
                                    </li>
                                    <div class="dropdown show nav-item">
                                        <a class="nav-link dropdown-toggle nav-item" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                            <button class="btn-search">
                                                <ion-icon name="search-circle-outline"></ion-icon>
                                            </button>
                                            <input type="text" class="input-search" placeholder="Type to Search...">
                                        </div>
                                    </li>
                                    <li class="nav-item d_none">
                                        <a class="nav-link" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
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

    <div class="cart-main">
        <div class="cart-product">
            <div class="cart-table">
                <table>
                    <tr>
                        <th class="a"></th>
                        <th>HÌNH</th>
                        <th>SẢN PHẨM</th>
                        <th>GIÁ</th>
                        <th>SỐ LƯỢNG</th>
                        <th>TẠM TÍNH</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="scrollbar">
                                <!-- san pham -->
                                <table>
                                    <tr class="scrollbar-product">
                                        <td class="child-dele">
                                            <div class="i-dele">
                                                <a href="">
                                                    <ion-icon name="close-circle-outline"></ion-icon>
                                                </a>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="img1">
                                                <img class="img-sp" src="https://muaga.me/wp-content/uploads/2019/09/Human-Fall-Flat-1.jpg" alt="">
                                                <div class="icon-dele">
                                                    <a href="">
                                                        <ion-icon name="close-circle-outline"></ion-icon>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-size">Sniper Ghost Warrior Contracts Steam Key
                                            <div class="quantity-fake">x1</div>
                                            <div class="price-fake">165.000đ</div>
                                        </td>
                                        <td class="product-size">165.000₫</td>
                                        <!-- tang giam so luong -->
                                        <td>
                                            <div class="product-soluong">
                                                <div class="product-btn-giam"><button id="giam" onclick="quantity()">-</button></div>
                                                <div class="product-value"><input id="val" type="text" value="1"></div>
                                                <div class="product-btn-tang"><button id="tang" onclick="quantity()">+</button></div>
                                            </div>
                                        </td>
                                        <td class="product-size">165.000₫</td>
                                        <td class="b"><input type="checkbox" name="" id=""></td>
                                    </tr>
                                    <tr class="scrollbar-product">
                                        <td class="child-dele">
                                            <div class="i-dele">
                                                <a href="">
                                                    <ion-icon name="close-circle-outline"></ion-icon>
                                                </a>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="img1">
                                                <img class="img-sp" src="https://muaga.me/wp-content/uploads/2019/09/Human-Fall-Flat-1.jpg" alt="">
                                                <div class="icon-dele">
                                                    <a href="">
                                                        <ion-icon name="close-circle-outline"></ion-icon>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-size">Sniper Ghost Warrior Contracts Steam Key
                                            <div class="quantity-fake">x1</div>
                                            <div class="price-fake">165.000đ</div>
                                        </td>
                                        <td class="product-size">165.000₫</td>
                                        <!-- tang giam so luong -->
                                        <td>
                                            <div class="product-soluong">
                                                <div class="product-btn-giam"><button id="giam" onclick="quantity()">-</button></div>
                                                <div class="product-value"><input id="val" type="text" value="1"></div>
                                                <div class="product-btn-tang"><button id="tang" onclick="quantity()">+</button></div>
                                            </div>
                                        </td>
                                        <td class="product-size">165.000₫</td>
                                        <td class="b"><input type="checkbox" name="" id=""></td>
                                    </tr>
                                    <tr class="scrollbar-product">
                                        <td class="child-dele">
                                            <div class="i-dele">
                                                <a href="">
                                                    <ion-icon name="close-circle-outline"></ion-icon>
                                                </a>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="img1">
                                                <img class="img-sp" src="https://muaga.me/wp-content/uploads/2019/09/Human-Fall-Flat-1.jpg" alt="">
                                                <div class="icon-dele">
                                                    <a href="">
                                                        <ion-icon name="close-circle-outline"></ion-icon>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-size">Sniper Ghost Warrior Contracts Steam Key
                                            <div class="quantity-fake">x1</div>
                                            <div class="price-fake">165.000đ</div>
                                        </td>
                                        <td class="product-size">165.000₫</td>
                                        <!-- tang giam so luong -->
                                        <td>
                                            <div class="product-soluong">
                                                <div class="product-btn-giam"><button id="giam" onclick="quantity()">-</button></div>
                                                <div class="product-value"><input id="val" type="text" value="1"></div>
                                                <div class="product-btn-tang"><button id="tang" onclick="quantity()">+</button></div>
                                            </div>
                                        </td>
                                        <td class="product-size">165.000₫</td>
                                        <td class="b"><input type="checkbox" name="" id=""></td>
                                    </tr>

                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="cart-bottom">
                <div class="cart-btn">
                    <button><ion-icon name="arrow-back-outline"></ion-icon>Tiếp tục xem sản phẩm</button>
                </div>
                <div class="cart-btn deletes">
                    <button>Xóa mục đã chọn</button>
                </div>
            </div>

        </div>
        <div class="cart-total">
            <div class="cart-total-title"><span>CỘNG GIỎ HÀNG</span></div>
            <div class="cart-total-content">
                <div class="content-tamtinh">
                    <div class="total-content-title"><span>Tạm tính</span></div>
                    <div class="total-content-price">1.600.000đ</div>
                </div>
                <div class="content-total">
                    <div class="total-content-title"><span>Tổng</span></div>
                    <div class="total-content-price">1.600.000đ</div>
                </div>
            </div>
            <div class="cart-btn">
                <button name="">Tiến hành thanh toán</button>
            </div>
        </div>
    </div>

</body>
<script>
    var giamsl = document.getElementById("giam");
    var tangsl = document.getElementById("tang");
    var valu = document.getElementById("val");
    giamsl.addEventListener("click", function() {
        if (valu.value == 1) {
            valu.value == 1;
        } else {
            valu.value--;
        }
    });
    tangsl.addEventListener("click", function() {
        valu.value++;
    });
</script>

</html>