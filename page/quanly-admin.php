<?php session_start();
include_once('database_connection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý của Admin</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- style css -->
    <link rel="stylesheet" href="../css/quanly-admin.css" />
    <link rel="stylesheet prefetch" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Javascript files-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <style>
    .is-invalid {
        border: 1px solid red;
        vertical-align: center;
    }

    .loi {
        color: red;
    }
    </style>
</head>

<body>

    <?php
    if (isset($_POST['xoa'])) {
        $idtk = $_POST['xoa'];
        mysqli_query($cn, "DELETE FROM `taikhoan` WHERE tk_id = $idtk");
        $_SESSION['xoaKHthanhcong'] = true;
    }
    ?>

    <?php if (isset($_POST['updateKH'])) {
        $_SESSION['updateKH'] = $_POST['updateKH'];
    }

    ?>
    <?php if (isset($_POST['updateNSX'])) {
        $_SESSION['updateNSX'] = $_POST['updateNSX'];
    }
    ?>

    <div class="menu-title">
        <h1>Quản lý dành cho Admin</h1>
    </div>
    <div class="admin-manager">
        <!-- menu -->
        <div class="tab-menu">
            <a href="">
                <div class="menu-item">
                    <ion-icon name="home-outline"></ion-icon><span>
                        TRANG CHỦ
                    </span>
                </div>
            </a>

            <button class="btn-menu" onclick="menu(event, 'clients')" id="Themkhachhang">
                <div class="menu-item">
                    <ion-icon name="people-outline"></ion-icon>
                    <span>THÊM KHÁCH HÀNG</span>
                </div>
            </button>

            <button class="btn-menu" onclick="menu(event, 'nsx')" id="Themnsx">
                <div class="menu-item">
                    <ion-icon name="people-outline"></ion-icon>
                    <span>THÊM NSX</span>
                </div>
            </button>

            <button class="btn-menu" onclick="menu(event, 'account')" id="Themtaikhoan">
                <div class="menu-item">
                    <ion-icon name="person-add-outline"></ion-icon>
                    <span>THÊM TÀI KHOẢN</span>
                </div>
            </button>

            <button class="btn-menu" onclick="menu(event, 'product')" id="Themsanpham">
                <div class="menu-item">
                    <ion-icon name="add-circle-outline"></ion-icon>
                    <span>THÊM SẢN PHẨM</span>
                </div>
            </button>

            <button class="btn-menu" onclick="menu(event, 'category')" id="Themtheloai">
                <div class="menu-item">
                    <ion-icon name="game-controller-outline"></ion-icon>
                    <span>THÊM THỂ LOẠI</span>
                </div>
            </button>

            <button class="btn-menu" onclick="menu(event, 'sale-product')" id="Themgiamgia">
                <div class="menu-item">
                    <ion-icon name="gift-outline"></ion-icon>
                    <span>THÊM GIẢM GIÁ</span>
                </div>
            </button>

            <div class="menu-dropdow">
                <div class="dropdow-selected">
                    <div class="select-left">
                        <ion-icon name="stats-chart-outline"></ion-icon>
                        <span>THỐNG KÊ</span>
                    </div>
                    <ion-icon name="caret-down-outline"></ion-icon>
                </div>
                <div class="dropdow-list">
                    <button class="btn-menu" onclick="menu(event, 'revenue')">
                        <div class="dropdow-item">
                            <span>Doanh thu</span>
                        </div>
                    </button>
                    <button class="btn-menu" onclick="menu(event, 'downloads')">
                        <div class="dropdow-item">
                            <span>Số lượt tải</span>
                        </div>
                    </button>
                    <button class="btn-menu" onclick="menu(event, 'on-sale')">
                        <div class="dropdow-item">
                            <span>Sản phẩm đang giảm giá</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <!-- ==========================================ADD============================================ -->
        <!-- Thêm Khách hàng -->
        <div class="client menu-tab" id="clients">
            <!-- tabs -->
            <div class="tabs">
                <!-- tabs -->
                <div class="tab">
                    <?php
                    if (isset($_SESSION['dangkythanhcong']) && $_SESSION['dangkythanhcong'] == "ThemKH") {
                        echo "<script> document.getElementById('Themkhachhang').click();
                        document.getElementById('tabThemKH').click();
                        alert('Thêm khách hàng thành công!!') </script>";
                        unset($_SESSION['dangkythanhcong']);
                    }
                    ?>
                    <script>
                    let listTK = [];
                    </script>
                    <?php
                    $query = mysqli_query($cn, "SELECT * FROM taikhoan");
                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                    <script>
                    listTK.push("<?php echo $row['tk_taikhoan']; ?>")
                    </script>
                    <?php }
                    ?>
                    <button class="tablinks" onclick="openCity(event, 'add-client')" id="tabThemKH">
                        Thêm khách hàng
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'list-client')" id="tabDSKH">
                        Danh sách khách hàng
                    </button>
                </div>
                <!-- Thêm khách hàng -->

                <div id="add-client" class="tabcontent">
                    <div class="add-client-main">
                        <div class="client-item">
                            <span>Họ và tên</span>
                            <input type="text" name="hotenKH" id="hotenKH" placeholder="Họ tên"><br>
                            <p class="loi" id="loihotenkh"></p>
                        </div>
                        <div class="client-item">
                            <span>Email</span>
                            <input type="email" name="emailKH" id="emailKH" placeholder="Email">
                            <div class="loi" id="loiemailkh"></div>
                        </div>
                        <div class="client-item">
                            <span>Số điện thoại</span>
                            <input type="text" name="sdtKH" id="sdtKH" placeholder="Số điện thoại">
                            <div class="loi" id="loisdtkh"></div>
                        </div>
                        <div class="client-item">
                            <span>Tài khoản</span>
                            <input type="text" name="tkKH" id="tkKH" placeholder="Tài khoản">
                            <div class="loi" id="loitkkh"></div>
                        </div>
                        <div class="client-item">
                            <span>Mật khẩu</span>
                            <input type="password" name="mkKH" id="mkKH" placeholder="Mật khẩu">
                            <div class="loi" id="loimkkh"></div>
                        </div>
                        <div class="client-item">
                            <span>Nhập lại mật khẩu</span>
                            <input type="password" name="nlmkKH" id="nlmkKH" placeholder="Nhập lại mật khẩu">
                            <div class="loi" id="loinlmkkh"></div>
                        </div>
                        <div class="client-item">
                            <button type="button" id="bntThemKH" onclick="themKH()">Thêm</button>
                            <button type="button" id="bntUpdateKH" hidden onclick="UpdateKH()">Cập nhật</button>
                            <button type="button" onclick="HuyKH()">Hủy</button>
                        </div>
                    </div>
                </div>

                <script>
                function HuyKH() {
                    document.getElementById('hotenKH').value = "";
                    document.getElementById('sdtKH').value = "";
                    document.getElementById('emailKH').value = "";
                    document.getElementById('tkKH').value = "";
                    document.getElementById('mkKH').value = "";
                    document.getElementById('nlmk').value = "";
                }

                function themKH() {
                    var check = 0
                    var hoten = $('#hotenKH').val()
                    const testHoTen = new RegExp(
                        '^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+ [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+(?: [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*)*'
                    )
                    var sdtKH = $('#sdtKH').val()
                    const testSdt = new RegExp(
                        "^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$"
                    )
                    var emailKH = $('#emailKH').val()
                    const testEmail = new RegExp("^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$")
                    var tkKH = $('#tkKH').val()
                    var mkKH = $('#mkKH').val()
                    var nlmkKH = $('#nlmkKH').val()


                    if (testHoTen.test(hoten) != true) {
                        check -= 1
                        $('#hotenKH').addClass('is-invalid');
                        $('#loihotenkh').html("Họ tên phải là chữ có ít nhất 4 đến 20 kí tự")
                    } else {
                        $('#hotenKH').removeClass('is-invalid')
                        $('#loihotenkh').html("")
                        check += 1
                    }

                    if (testSdt.test(sdtKH) != true) {
                        check -= 1
                        $('#sdtKH').addClass('is-invalid');
                        $('#loisdtkh').html("Số điện thoại không hợp lệ")
                    } else {
                        $('#sdtKH').removeClass('is-invalid')
                        $('#loisdtkh').html("")
                        check += 1
                    }

                    if (testEmail.test(emailKH) != true) {
                        check -= 1
                        $('#emailKH').addClass('is-invalid');
                        $('#loiemailkh').html("Email không hợp lệ")
                    } else {
                        $('#emailKH').removeClass('is-invalid')
                        $('#loiemailkh').html("")
                        check += 1
                    }

                    if (mkKH.length < 5 || mkKH.length > 15) {
                        check -= 1
                        $('#mkKH').addClass('is-invalid');
                        $('#loimkkh').html("Mật khẩu không đủ mạnh")
                    } else {
                        $('#mkKH').removeClass('is-invalid')
                        $('#loimkkh').html("")
                        check += 1
                    }

                    if (nlmkKH != mkKH || nlmkKH.length == 0) {
                        check -= 1
                        $('#nlmkKH').addClass('is-invalid');
                        $('#loinlmkkh').html("Hãy nhập lại mật khẩu")
                    } else {
                        $('#nlmkKH').removeClass('is-invalid')
                        $('#loinlmkkh').html("")
                        check += 1
                    }

                    let checkTK = true
                    for (let i = 0; i < listTK.length; i++) {
                        if (tkKH == listTK[i]) {
                            checkTK = false
                            break
                        }
                    }

                    if (tkKH.length < 5 || tkKH.length > 15 || tkKH.indexOf("admin") != -1) {
                        check -= 1
                        $('#tkKH').addClass('is-invalid');
                        $('#loitkkh').html("Tài khoản không hợp lệ")
                    } else {
                        if (checkTK == false) {
                            check -= 1
                            $('#tkKH').addClass('is-invalid');
                            $('#loitkkh').html("Tài khoản bị trùng")
                        } else {
                            $('#tkKH').removeClass('is-invalid')
                            $('#loitkkh').html("")
                            check += 1
                        }
                    }

                    if (check == 6) {
                        $.post('xulydangky.php', {
                            hoten1: hoten,
                            sdt1: sdtKH,
                            email1: emailKH,
                            taikhoan1: tkKH,
                            matkhau1: mkKH,
                            page: "themKH"
                        }, function(data) {
                            $('body').html(data);
                        })

                    }
                }
                </script>

                <!-- Danh sách khách hàng -->
                <div id="list-client" class="tabcontent">
                    <!-- Thông tin khách hàng-->
                    <table>
                        <tr>
                            <div class="table-control">
                                <div class="search">
                                    <input class="search" type="text" id="timkiem_kh"
                                        placeholder="Tìm kiếm bằng tên tài khoản khách hàng" />
                                    <button class="search" onclick="timkiemKH()">Tìm kiếm</button>

                                    <script>
                                    var search = $('#timkiem_kh').val()
                                    $.post('timkiemKH_NSX.php', {
                                        data: search,
                                        page: "KH"
                                    }, function(data) {
                                        $('.danhsachtimkiemKH').html(data);
                                    })


                                    function timkiemKH() {
                                        var search = $('#timkiem_kh').val()
                                        $.post('timkiemKH_NSX.php', {
                                            data: search,
                                            page: "KH"
                                        }, function(data) {
                                            $('.danhsachtimkiemKH').html(data);
                                        })
                                    }
                                    </script>


                                </div>
                            </div>
                        </tr>
                        <tr>
                            <td colspan="11">
                                <div class="scrollbar">
                                    <table border="1" class="table table-inforgame">
                                        <tr class="table-primary">
                                            <th scope="col">STT</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Họ tên</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Điểm tích lũy</th>
                                            <th scope="col">Tài khoản</th>
                                            <th scope="col">Mật khẩu</th>
                                            <th scope="col">Cập nhật</th>
                                            <th scope="col">Xóa</th>
                                        </tr>
                                        <tbody class="danhsachtimkiemKH">
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Thêm nhà sản xuất -->
        <div class="client menu-tab" id="nsx">
            <div class="tabs">
                <?php
                if (isset($_SESSION['dangkythanhcong']) && $_SESSION['dangkythanhcong'] == "ThemNSX") {
                    echo "<script> document.getElementById('Themnsx').click();
                        document.getElementById('tabThemNSX').click();
                        alert('Thêm NSX thành công!!') </script>";
                    unset($_SESSION['dangkythanhcong']);
                }
                ?>
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'add-nsx')" id="tabThemNSX">
                        Thêm nhà sản xuất
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'list-nsx')" id="tabDSNSX">
                        Danh sách nhà sản xuất
                    </button>
                </div>
                <!-- Thêm nhà sản xuất -->
                <div id="add-nsx" class="tabcontent">
                    <div class="add-client-main">
                        <div class="client-item">
                            <span>Tên NSX</span>
                            <input type="text" name="tenNSX" id="tenNSX" placeholder="Tên nsx"><br>
                            <p class="loi" id="loitennsx"></p>
                        </div>
                        <div class="client-item">
                            <span>Email</span>
                            <input type="email" name="emailNSX" id="emailNSX" placeholder="Email">
                            <div class="loi" id="loiemailnsx"></div>
                        </div>
                        <div class="client-item">
                            <span>Số điện thoại</span>
                            <input type="text" name="sdtNSX" id="sdtNSX" placeholder="Số điện thoại">
                            <div class="loi" id="loisdtnsx"></div>
                        </div>
                        <div class="client-item">
                            <span>Tài khoản</span>
                            <input type="text" name="tkNSX" id="tkNSX" placeholder="Tài khoản">
                            <div class="loi" id="loitknsx"></div>
                        </div>
                        <div class="client-item">
                            <span>Mật khẩu</span>
                            <input type="password" name="mkNSX" id="mkNSX" placeholder="Mật khẩu">
                            <div class="loi" id="loimknsx"></div>
                        </div>
                        <div class="client-item">
                            <span>Nhập lại mật khẩu</span>
                            <input type="password" name="nlmkNSX" id="nlmkNSX" placeholder="Nhập lại mật khẩu">
                            <div class="loi" id="loinlmknsx"></div>
                        </div>
                        <div class="client-item">
                            <button type="button" onclick="themNSX()">Thêm</button>
                            <button type="button" onclick="HuyNSX()">Hủy</button>
                        </div>
                    </div>
                </div>

                <script>
                function HuyNSX() {
                    document.getElementById('tenNSX').value = "";
                    document.getElementById('sdtNSX').value = "";
                    document.getElementById('emailNSX').value = "";
                    document.getElementById('tkNSX').value = "";
                    document.getElementById('mkNSX').value = "";
                    document.getElementById('nlmkNSX').value = "";
                }

                function themNSX() {
                    var check = 0
                    var hoten = $('#tenNSX').val()
                    var sdt = $('#sdtNSX').val()
                    const testSdt = new RegExp(
                        "^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$"
                    )
                    var email = $('#emailNSX').val()
                    const testEmail = new RegExp("^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$")
                    var tk = $('#tkNSX').val()
                    var mk = $('#mkNSX').val()
                    var nlmk = $('#nlmkNSX').val()

                    if (hoten.length < 5 || hoten.length > 15) {
                        check -= 1
                        $('#tenNSX').addClass('is-invalid');
                        $('#loitennsx').html("Hãy nhập tên khác")
                    } else {
                        $('#tenNSX').removeClass('is-invalid')
                        $('#loitennsx').html("")
                        check += 1
                    }

                    if (testSdt.test(sdt) != true) {
                        check -= 1
                        $('#sdtNSX').addClass('is-invalid');
                        $('#loisdtnsx').html("Số điện thoại không hợp lệ")
                    } else {
                        $('#sdtNSX').removeClass('is-invalid')
                        $('#loisdtnsx').html("")
                        check += 1
                    }

                    if (testEmail.test(email) != true) {
                        check -= 1
                        $('#emailNSX').addClass('is-invalid');
                        $('#loiemailnsx').html("Email không hợp lệ")
                    } else {
                        $('#emailNSX').removeClass('is-invalid')
                        $('#loiemailnsx').html("")
                        check += 1
                    }

                    if (mk.length < 5 || mk.length > 15) {
                        check -= 1
                        $('#mkNSX').addClass('is-invalid');
                        $('#loimknsx').html("Mật khẩu không đủ mạnh")
                    } else {
                        $('#mkNSX').removeClass('is-invalid')
                        $('#loimknsx').html("")
                        check += 1
                    }

                    if (nlmk != mk || nlmk.length == 0) {
                        check -= 1
                        $('#nlmkNSX').addClass('is-invalid');
                        $('#loinlmknsx').html("Hãy nhập lại mật khẩu")
                    } else {
                        $('#nlmkNSX').removeClass('is-invalid')
                        $('#loinlmknsx').html("")
                        check += 1
                    }

                    let checkTK = true
                    for (let i = 0; i < listTK.length; i++) {
                        if (tk == listTK[i]) {
                            checkTK = false
                            break
                        }
                    }

                    if (tk.length < 5 || tk.length > 15 || tk.indexOf("admin") != -1) {
                        check -= 1
                        $('#tkNSX').addClass('is-invalid');
                        $('#loitknsx').html("Tài khoản không hợp lệ")
                    } else {
                        if (checkTK == false) {
                            check -= 1
                            $('#tkNSX').addClass('is-invalid');
                            $('#loitknsx').html("Tài khoản bị trùng")
                        } else {
                            $('#tkNSX').removeClass('is-invalid')
                            $('#loitknsx').html("")
                            check += 1
                        }
                    }

                    if (check == 6) {
                        $.post('xulydangky.php', {
                            hoten1: hoten,
                            sdt1: sdt,
                            email1: email,
                            taikhoan1: tk,
                            matkhau1: mk,
                            page: "themNSX"
                        }, function(data) {
                            $('body').html(data);
                        })

                    }
                }
                </script>

                <!-- Danh sách nhà sản xuất -->
                <div id="list-nsx" class="tabcontent">
                    <div class="table-control">
                        <div class="search">
                            <input class="search" type="text" id="timkiem_nsx"
                                placeholder="Tìm kiếm bằng tên tài khoản nhà sản xuất" />
                            <button class="search" onclick="timkiemNSX()">Tìm kiếm</button>
                            <script>
                            window.onload = function() {
                                var search = $('#timkiem_nsx').val()
                                $.post('timkiemKH_NSX.php', {
                                    data: search,
                                    page: "NSX"
                                }, function(data) {
                                    $('.danhsachtimkiemNSX').html(data);
                                })
                            }

                            function timkiemNSX() {
                                var search = $('#timkiem_nsx').val()
                                $.post('timkiemKH_NSX.php', {
                                    data: search,
                                    page: "NSX"
                                }, function(data) {
                                    $('.danhsachtimkiemNSX').html(data);
                                })
                            }
                            </script>
                        </div>
                    </div>
                    <div class="table-thongke table-responsive-sm">
                        <!-- Thông tin về game -->
                        <table border="1" id="inforgame" class="table
                                            table-inforgame">
                            <tr class="table-primary">
                                <th scope="col">STT</th>
                                <th scope="col">ID NSX</th>
                                <th scope="col">Tên NSX</th>
                                <th scope="col">Sdt</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tài khoản</th>
                                <th scope="col">Mật khẩu</th>
                                <th scope="col">Cập nhật</th>
                                <th scope="col">Xóa</th>
                            </tr>
                            <tbody class="danhsachtimkiemNSX">
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Thêm Tài khoản -->
        <div class="client menu-tab" id="account">

            <div class="tabs">
                <!-- tabs -->
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'add-account')" id="tabThemTK">
                        Thêm tài khoản
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'list-account')" id="tabDSTK">
                        Danh sách tài khoản
                    </button>
                </div>
                <!-- Thêm tài khoản -->
                <div id="add-account" class="tabcontent">
                    <div class="add-client-main">
                        <div class="client-item">
                            <span>Tài khoản</span>
                            <input type="text" name="" placeholder="Tài khoản">
                        </div>
                        <div class="client-item">
                            <span>Mật khẩu</span>
                            <input type="password" name="" placeholder="Mật khẩu">
                        </div>
                        <div class="client-item">
                            <span>Nhập lại mật khẩu</span>
                            <input type="password" name="" placeholder="Nhập lại mật khẩu">
                        </div>
                        <div class="client-item">
                            <span>Loại tài khoản</span>
                            <div class="type-acc">
                                <div class="type-admin type-item">
                                    <span>Quản lý</span>
                                    <input type="radio" name="" id="" value="admin">
                                </div>
                                <div class="type-nsx type-item">
                                    <span>Nhà sản xuất</span>
                                    <input type="radio" name="" id="" value="nsx">
                                </div>
                                <div class="type-kh type-item">
                                    <span>Khách hàng</span>
                                    <input type="radio" name="" id="" value="kh">
                                </div>
                            </div>

                        </div>
                        <div class="client-item">
                            <button type="submit">Thêm</button>
                            <button type="reset">Hủy</button>
                        </div>
                    </div>
                </div>

                <!-- Danh sách tài khoản -->
                <div id="list-account" class="tabcontent">
                    <!-- Thông tin tài khoản-->
                    <table>
                        <div class="table-control">
                            <div class="search">
                                <input class="search" type="text" placeholder="Tìm kiếm" />
                                <button class="search">Tìm kiếm</button>
                            </div>
                        </div>
                        <tr>
                            <td colspan="11">
                                <div class="scrollbar">
                                    <table border="1" id="infor-acc" style="display: table" class="table
                                                        table-inforgame">
                                        <tr class="table-primary">
                                            <th scope="col">STT</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Tài khoản</th>
                                            <th scope="col">Mật khẩu</th>
                                            <th scope="col">Loại tài khoản</th>
                                            <th scope="col">Cập nhật</th>
                                            <th scope="col">Xóa</th>
                                        </tr>
                                        <tr class="table-light">
                                            <td>1</td>
                                            <td>27</td>
                                            <td>truongnguyennnt131</td>
                                            <td>ádasd6987d8a2ek</td>
                                            <td>KH</td>
                                            <td>
                                                <button class="tablinks" onclick="openCity(event,'add-account')"
                                                    id="defaultOpen">
                                                    <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                                </button>
                                            </td>
                                            <td>
                                                <a href="">
                                                    <ion-icon name="close-circle-outline"></ion-icon>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- tabs -->
        </div>

        <!-- Thêm Sản phẩm -->
        <div class="client menu-tab" id="product">
            <!-- tabs -->
            <div class="tabs">
                <!-- tabs -->
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'add-product')" id="defaultOpen">
                        Thêm sản phẩm
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'list-product')">
                        Danh sách sản phẩm
                    </button>
                </div>
                <!-- Thêm sản phẩm -->
                <div id="add-product" class="tabcontent">
                    <div class="tabcontent-addproduct">
                        <div class="client-item">
                            <span>Tên sản phẩm</span>
                            <input type="text" placeholder="Tên sản phẩm" />
                        </div>
                        <div class="client-item">
                            <span>Mô tả sản phẩm</span>
                            <input type="text" placeholder="Mô tả sản phẩm" />
                        </div>

                        <div class="client-item">
                            <span>Giá sản phẩm</span>
                            <input type="text" name="gia" onchange="Gia(this)" value="" placeholder="Giá sản phẩm" />
                        </div>
                        <div class="client-item">
                            <span>Thể loại</span>
                            <select name="theloai">

                            </select>
                        </div>
                        <div class="client-item">
                            <span>Nhà sản xuất</span>
                            <input type="text" name="gia" value="" placeholder="Nhà sản xuất" />
                        </div>
                        <div class="add-upload">
                            <div class="add-avatar">
                                <div class="add-title"><span>Ảnh đại diện</span></div>
                                <div class="add-input">
                                    <input type="file" name="imgavt" accept=".jpg, .jpeg,
                                                        .png" />
                                </div>
                            </div>
                            <div class="add-photogameplay">
                                <div class="add-title"><span>Ảnh trong game(Một số)</span></div>
                                <div class="add-input">
                                    <input type="file" name="imggameplay[]" multiple accept=".jpg,
                                                        .jpeg, .png" />
                                </div>

                            </div>
                            <div class="add-trailer">
                                <div class="add-title"><span>Trailer video game</span></div>
                                <div class="add-input">
                                    <input type="file" name="trailer" />
                                </div>
                            </div>

                            <div class="add-source">
                                <div class="add-title"><span>File game</span></div>
                                <div class="add-input">
                                    <input class="" type="file" name="filezip" accept=".zip" />
                                </div>
                            </div>
                            <div class="add-source">
                                <div class="add-title"><span>Bản mở rộng(nếu có)</span></div>
                                <div class="add-input">
                                    <input class="" type="file" name="filezip" accept=".zip" />
                                </div>
                            </div>
                        </div>

                        <div class="add-btn">
                            <button class="btn-add">Thêm sản phẩm</button>
                            <button class="btn-cancel" type="reset">Hủy bỏ</button>
                        </div>
                    </div>
                </div>
                <!-- Danh sách sản phẩm-->
                <div id="list-product" class="tabcontent">
                    <div class="table-control">
                        <div class="type-table">
                            <select class="type-table" name="" id="" onchange="changetable(this)">
                                <option value="" selected="selected">
                                    ---Chọn loại bảng muốn hiển thị---
                                </option>
                                <option value="infor">Thông tin Game</option>
                                <option value="category">Thông tin Game và thể loại</option>
                                <option value="nsx">Thông tin Game và nhà sản xuất</option>
                                <option value="img-trailer">
                                    Thông tin Game và ảnh, trailer
                                </option>
                                <option value="filegame">Thông tin Game và Source game</option>
                            </select>
                        </div>

                        <div class="search">
                            <input class="search" type="text" placeholder="Tìm kiếm" />
                            <button class="search">Tìm kiếm</button>
                        </div>
                    </div>
                    <div class="table-thongke table-responsive-sm">
                        <!-- Thông tin về game -->
                        <table border="1" id="inforgame" style="display: table" class="table
                                            table-inforgame">
                            <tr class="table-primary">
                                <th scope="col">STT</th>
                                <th scope="col">ID</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Ngày phát hành</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Cập nhật</th>
                                <th scope="col">Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>STAR WARS Jedi: Fallen Order</td>
                                <td>23/4/2023</td>
                                <td>
                                    <div class="table-mota">
                                        Một cuộc phiêu lưu thiên hàMột cuộc phiêu lưu thiên hàMột cuộc phiêu lưu thiên
                                        hàMột Một cuộc phiêu lưu thiên hàMột cuộc phiêu lưu thiên hàMột cuộc phiêu lưu
                                        thiên hàMột Một cuộc phiêu lưu thiên hàMột cuộc phiêu lưu thiên hàMột cuộc phiêu
                                        lưu thiên hàMột
                                    </div>
                                </td>
                                <td>120.000.000đ</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-product')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <!-- Thông tin về game và thể loại -->
                        <table border="1 " id="inforgame-and-category" style="display: none" class="table">
                            <tr class="table-primary">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Thể loại</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>STAR WARS Jedi: Fallen Order</td>
                                <td>abc,ol,io</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-product')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <!-- Thông tin về game và nsx -->
                        <table border="1 " id="inforgame-and-nsx" style="display: none" class="table">
                            <tr class="table-primary">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Tên nhà sản xuất</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>STAR WARS Jedi: Fallen Order</td>
                                <td>VNG</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-product')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <!-- Thông tin về game và ảnh,trailer -->
                        <table border="1 " id="inforgame-and-img" style="display: none" class="table">
                            <tr class="table-primary">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh đại diện</th>
                                <th>Ảnh liên quan</th>
                                <th>Trailer</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>STAR WARS Jedi: Fallen Order</td>
                                <td>abc.jpn</td>
                                <td>th.jpn,th2.jpn,th3.jpn</td>
                                <td>th.video</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-product')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <!-- Thông tin về game và source game -->
                        <table border="1 " id="inforgame-and-source" style="display: none" class="table">
                            <tr class="table-primary">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>File game</th>
                                <th>File mở rộng</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>STAR WARS Jedi: Fallen Order</td>
                                <td>okoko.zip</td>
                                <td>1.zip,2.zip,3.zip</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-product')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <!-- tabs -->
            </div>
        </div>

        <!-- Thêm Thể loại -->
        <div class="client menu-tab" id="category">
            <!-- tabs -->
            <div class="tabs">
                <!-- tabs -->
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'add-category')" id="defaultOpen">
                        Thêm thể loại
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'list-category')">
                        Danh sách thể loại
                    </button>
                </div>
                <!-- Thêm thể loại -->
                <div id="add-category" class="tabcontent">
                    <div class="tabcontent-addproduct">
                        <div class="client-item">
                            <span>Tên thể loại</span>
                            <input type="text" placeholder="Tên thể loại " />
                        </div>
                    </div>
                    <div class="client-item">
                        <button type="submit">Thêm</button>
                        <button type="reset">Hủy</button>
                    </div>
                </div>
                <!-- Danh sách thể loại -->
                <div id="list-category" class="tabcontent">
                    <div class="table-control">
                        <div class="search">
                            <input class="search" type="text" placeholder="Tìm kiếm" />
                            <button class="search">Tìm kiếm</button>
                        </div>
                    </div>
                    <div class="table-thongke table-responsive-sm">
                        <!-- Thông tin về game -->
                        <table border="1" id="inforgame" style="display: table" class="table
                                            table-inforgame">
                            <tr class="table-primary">
                                <th scope="col">STT</th>
                                <th scope="col">ID</th>
                                <th scope="col">Tên thể loại</th>
                                <th scope="col">Tổng số game</th>
                                <th scope="col">Cập nhật</th>
                                <th scope="col">Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>Hành động</td>
                                <td>50</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-category')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <!-- Thông tin về game và thể loại -->
                        <table border="1 " id="inforgame-and-category" style="display: none" class="table">
                            <tr class="table-primary">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Thể loại</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>STAR WARS Jedi: Fallen Order</td>
                                <td>abc,ol,io</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-product')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <!-- Thông tin về game và nsx -->
                        <table border="1 " id="inforgame-and-nsx" style="display: none" class="table">
                            <tr class="table-primary">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Tên nhà sản xuất</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>STAR WARS Jedi: Fallen Order</td>
                                <td>VNG</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-product')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <!-- Thông tin về game và ảnh,trailer -->
                        <table border="1 " id="inforgame-and-img" style="display: none" class="table">
                            <tr class="table-primary">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh đại diện</th>
                                <th>Ảnh liên quan</th>
                                <th>Trailer</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>STAR WARS Jedi: Fallen Order</td>
                                <td>abc.jpn</td>
                                <td>th.jpn,th2.jpn,th3.jpn</td>
                                <td>th.video</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-product')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <!-- Thông tin về game và source game -->
                        <table border="1 " id="inforgame-and-source" style="display: none" class="table">
                            <tr class="table-primary">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>File game</th>
                                <th>File mở rộng</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>27</td>
                                <td>STAR WARS Jedi: Fallen Order</td>
                                <td>okoko.zip</td>
                                <td>1.zip,2.zip,3.zip</td>
                                <td>
                                    <button class="tablinks" onclick="openCity(event,
                                                        'add-product')" id="defaultOpen">
                                        <ion-icon name="create-outline" alt="cập nhật"></ion-icon>
                                    </button>
                                </td>
                                <td>
                                    <a href="">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <!-- tabs -->
            </div>
        </div>

        <!-- Thêm giảm giá -->
        <div class="client menu-tab" id="sale-product">
            <div class="sale-main">
                <div class="table-control">
                    <div class="type-table">
                        <select class="type-table" name="" id="" onchange="changetable(this)">
                            <option value="" selected="selected">
                                ---Chọn loại bảng muốn hiển thị---
                            </option>
                            <option value="games">Game</option>
                            <option value="categorys">Thể loại</option>
                            <option value="nsxs">Nhà sản xuất</option>
                        </select>
                    </div>

                    <div class="search">
                        <input class="search" type="text" placeholder="Tìm kiếm" />
                        <button class="search">Tìm kiếm</button>
                    </div>
                </div>
                <!-- Tất cả sản phẩm -->
                <table style="display: table" id="all-games">
                    <tr>
                        <td colspan="10">
                            <div class="scrollbar">
                                <table border="1" class="table">
                                    <tr class="table-primary">
                                        <th scope="col">STT</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Ngày phát hành</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Phần trăm giảm giá</th>
                                        <th scope="col">Giá mới</th>
                                        <th scope="col">Ngày bắt đầu</th>
                                        <th scope="col">Ngày kết thúc</th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tr class="table-light">
                                        <td>1</td>
                                        <td>27</td>
                                        <td>STAR WARS Jedi: Fallen Order</td>
                                        <td>12/4/2022</td>
                                        <td>120.000đ</td>
                                        <td></td>
                                        <td>60.000đ</td>
                                        <td>20/3/2022</td>
                                        <td>30/3/2022</td>
                                        <td><input type="checkbox" name="" id="" value="Thêm %"></td>
                                    </tr>
                                    <tr class="table-light">
                                        <td>1</td>
                                        <td>27</td>
                                        <td>STAR WARS Jedi: Fallen Order</td>
                                        <td>12/4/2022</td>
                                        <td>120.000đ</td>
                                        <td></td>
                                        <td>60.000đ</td>
                                        <td>20/3/2022</td>
                                        <td>30/3/2022</td>
                                        <td><input type="checkbox" name="" id="" value="Thêm %"></td>
                                    </tr>

                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- Tất cả thể loại -->
                <table style="display: none" id="all-category">
                    <tr>
                        <td colspan="10">
                            <div class="scrollbar">
                                <table border="1" class="table">
                                    <tr class="table-primary">
                                        <th scope="col">STT</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên thể loại</th>
                                        <th scope="col">Tổng cộng game</th>
                                        <th scope="col">Phần trăm giảm giá</th>
                                        <th scope="col">Ngày bắt đầu</th>
                                        <th scope="col">Ngày kết thúc</th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tr class="table-light">
                                        <td>1</td>
                                        <td>27</td>
                                        <td>Hành động</td>
                                        <td>30</td>
                                        <td>30</td>
                                        <td>20/3/2022</td>
                                        <td>30/3/2022</td>
                                        <td><input type="checkbox" name="" id="" value="Thêm %"></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- Tất cả nhà sản xuất -->
                <table style="display: none" id="all-nsx">
                    <tr>
                        <td colspan="10">
                            <div class="scrollbar">
                                <table border="1" class="table">
                                    <tr class="table-primary">
                                        <th scope="col">STT</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên nhà sản xuất</th>
                                        <th scope="col">Tổng cộng game</th>
                                        <th scope="col">Phần trăm giảm giá</th>
                                        <th scope="col">Ngày bắt đầu</th>
                                        <th scope="col">Ngày kết thúc</th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tr class="table-light">
                                        <td>1</td>
                                        <td>27</td>
                                        <td>VNG</td>
                                        <td>20</td>
                                        <td>40</td>
                                        <td>20/3/2022</td>
                                        <td>30/3/2022</td>
                                        <td><input type="checkbox" name="" id="" value="Thêm %"></td>
                                    </tr>

                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="control-sale">
                    <div class="sale-title">
                        Kéo để chọn phần trăm
                    </div>
                    <div class="control-middel">
                        <div class="slidecontainer">
                            <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                            <p><b>Value: <span id="demo"></span>%</b></p>
                        </div>
                        <div class="date-star-end">
                            <div class="date-star">
                                <span>Ngày bắt đầu</span>
                                <input type="datetime-local" name="" id="">
                            </div>
                            <div class="date-end">
                                <span>Ngày kết thúc</span>
                                <input type="datetime-local" name="" id="">
                            </div>

                        </div>
                        <div class="sale-screen">
                            <table border="1" class="table">
                                <tr class="table-light">
                                    <td>27</td>
                                    <td>STAR WARS Jedi: Fallen Order</td>
                                    <td>30%</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="sale-update">
                        <button type="submit">Cập nhật</button>
                        <button type="reset">Hủy bỏ</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================THỐNG KÊ=============================================== -->
        <!-- Doanh thu -->
        <div class="client menu-tab" id="revenue">
            <div class="sale-main">
                <div class="table-control">
                    <div class="type-table">
                        <select class="type-table" name="" id="" onchange="statistical(this)">
                            <option value="" selected="selected">
                                ---Chọn loại bảng muốn hiển thị---
                            </option>
                            <option value="revenue_date">Doanh thu hằng ngày</option>
                            <option value="revenue_month">Doanh thu hằng tháng</option>
                        </select>
                    </div>

                    <div class="search">
                        <input class="search" type="text" placeholder="Tìm kiếm" />
                        <button class="search">Tìm kiếm</button>
                    </div>
                </div>
                <div class="table-thongke table-responsive-sm">
                    <!-- Thống kê doanh thu theo từng ngày -->
                    <table border="1" id="revenue-date" style="display: table" class="table">
                        <tr class="table-success">
                            <td colspan="7">
                                <!-- Hiển thị ngày -->
                                <select name="ngay" id="">
                                    <?php
                                    for ($date = 1; $date <= 31; $date++) {
                                        ?>
                                    <option value="<?php echo $date; ?>">Ngày <?php echo $date; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị tháng -->
                                <select name="thang" id="">
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $month; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị năm -->
                                <select name="nam" id="">
                                    <?php
                                    for ($year = 2022; $year <= 2030; $year++) {
                                        ?>
                                    <option value="<?php echo $year; ?>">Năm <?php echo $year; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="col">STT</th>
                            <th scope="col">Ngày/Tháng/Năm</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th>Lượt tải</th>
                            <th scope="col">Tổng tiền (Lượt tải)</th>
                        </tr>
                        <!-- dữ liệu từng game -->
                        <tr class="table-light">
                            <td>1</td>
                            <td>
                                13/01/2001
                            </td>
                            <td>27</td>
                            <td>STAR WARS Jedi: Fallen Order</td>

                            <td>120.000đ</td>
                            <td>
                                10
                            </td>
                            <td>
                                1.200.000đ
                            </td>
                        </tr>
                        <!-- tổng cộng -->
                        <tr class="table-danger">
                            <th colspan="5">Tổng</th>
                            <td>10</td>
                            <td>1.200.000đ</td>
                        </tr>
                    </table>
                    <!-- Thống kê doanh thu theo từng tháng -->
                    <table border="1" id="revenue-month" style="display: none" class="table">
                        <tr class="table-success">
                            <td colspan="7">
                                <!-- Hiển thị tháng -->
                                <select name="" id="">
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $month; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị năm -->
                                <select name="" id="">
                                    <?php
                                    for ($year = 2022; $year <= 2030; $year++) {
                                        ?>
                                    <option value="<?php echo $year; ?>">Năm <?php echo $year; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="col">STT</th>
                            <th scope="col">Tháng/Năm</th>
                            <th scope="col">Số lượt tải(tháng)</th>
                            <th scope="col">Tổng tiền(tháng)</th>
                        </tr>
                        <!-- dữ liệu từng game -->
                        <tr class="table-light">
                            <td>1</td>
                            <td>
                                01/2021
                            </td>
                            <td>30</td>
                            <td>100.000.000đ</td>
                        </tr>
                        <!-- tổng cộng -->
                        <tr class="table-danger">
                            <th colspan="2">Tổng cộng</th>
                            <td>30</td>
                            <td>1.200.000đ</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Số lượt tải -->
        <div class="client menu-tab" id="downloads">
            <!-- tabs -->
            <div class="tabs">
                <!-- tabs -->
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'download_date')" id="defaultOpen">
                        Số lượt tải mỗi ngày
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'download_month')">
                        Số lượt tải mỗi tháng
                    </button>
                </div>
                <!-- Lượt tải mỗi ngày -->
                <div id="download_date" class="tabcontent">
                    <div class="table-control">
                        <div class="type-table">
                            <select class="type-table" name="" id="" onchange="downloads_date(this)">
                                <option value="" selected="selected">
                                    ---Chọn loại bảng muốn hiển thị---
                                </option>
                                <option value="downloads-games-date">Số lượt tải theo game (ngày)</option>
                                <option value="downloads-category-date">Số lượt tải theo thể loại (ngày)</option>
                                <option value="downloads-nsx-date">Số lượt tải theo nhà sản xuất (ngày)</option>
                            </select>
                        </div>

                        <div class="search">
                            <input class="search" type="text" placeholder="Tìm kiếm" />
                            <button class="search">Tìm kiếm</button>
                        </div>
                    </div>

                    <!-- Thống kê lượt tải game trong ngày -->
                    <table border="1" id="downloadsgametheongay" style="display: table" class="table">
                        <tr class="table-success">
                            <td colspan="8">
                                <!-- Hiển thị ngày -->
                                <select name="" id="">
                                    <?php
                                    for ($date = 1; $date <= 31; $date++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $date; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị tháng -->
                                <select name="" id="">
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $month; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị năm -->
                                <select name="" id="">
                                    <?php
                                    for ($year = 2022; $year <= 2030; $year++) {
                                        ?>
                                    <option value="<?php echo $year; ?>">Năm <?php echo $year; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="col">STT</th>
                            <th scope="col">Ngày/Tháng/Năm tải</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tên game</th>
                            <th scope="col">Số lượt tải</th>
                        </tr>
                        <!-- dữ liệu từng game -->
                        <tr class="table-light">
                            <td>1</td>
                            <td>
                                13/01/2021
                            </td>
                            <td>27</td>
                            <td>Mario</td>
                            <td>100</td>
                        </tr>
                        <tr class="table-danger">
                            <th colspan="4">Tổng</th>
                            <td>10</td>
                        </tr>
                    </table>
                    <!-- Thống kê lượt tải thể loại trong ngày -->
                    <table border="1" id="downloadscategorytheongay" style="display: none" class="table">
                        <tr class="table-success">
                            <td colspan="8">
                                <!-- Hiển thị ngày -->
                                <select name="" id="">
                                    <?php
                                    for ($date = 1; $date <= 31; $date++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $date; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị tháng -->
                                <select name="" id="">
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $month; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị năm -->
                                <select name="" id="">
                                    <?php
                                    for ($year = 2022; $year <= 2030; $year++) {
                                        ?>
                                    <option value="<?php echo $year; ?>">Năm <?php echo $year; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="col">STT</th>
                            <th scope="col">Ngày/Tháng/Năm tải</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tên thể loại</th>
                            <th scope="col">Số lượt tải</th>
                        </tr>
                        <!-- dữ liệu từng game -->
                        <tr class="table-light">
                            <td>1</td>
                            <td>
                                13/01/2021
                            </td>
                            <td>27</td>
                            <td>Hành động</td>
                            <td>100</td>
                        </tr>
                        <tr class="table-danger">
                            <th colspan="4">Tổng</th>
                            <td>10</td>
                        </tr>
                    </table>
                    <!-- Thống kê lượt tải nsx trong ngày -->
                    <table border="1" id="downloadsnsxtheongay" style="display: none" class="table">
                        <tr class="table-success">
                            <td colspan="8">
                                <!-- Hiển thị ngày -->
                                <select name="" id="">
                                    <?php
                                    for ($date = 1; $date <= 31; $date++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $date; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị tháng -->
                                <select name="" id="">
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $month; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị năm -->
                                <select name="" id="">
                                    <?php
                                    for ($year = 2022; $year <= 2030; $year++) {
                                        ?>
                                    <option value="<?php echo $year; ?>">Năm <?php echo $year; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="col">STT</th>
                            <th scope="col">Ngày/Tháng/Năm tải</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tên nhà sản xuất</th>
                            <th scope="col">Số lượt tải</th>
                        </tr>
                        <!-- dữ liệu từng game -->
                        <tr class="table-light">
                            <td>1</td>
                            <td>
                                13/01/2021
                            </td>
                            <td>27</td>
                            <td>VNG</td>
                            <td>100</td>
                        </tr>
                        <tr class="table-danger">
                            <th colspan="4">Tổng</th>
                            <td>10</td>
                        </tr>
                    </table>
                </div>

                <!-- Lượt tải mỗi tháng -->
                <div id="download_month" class="tabcontent">
                    <div class="table-control">
                        <div class="type-table">
                            <select class="type-table" name="" id="" onchange="downloads_month(this)">
                                <option value="" selected="selected">
                                    ---Chọn loại bảng muốn hiển thị---
                                </option>
                                <option value="downloads-games-month">Số lượt tải theo game (tháng)</option>
                                <option value="downloads-category-month">Số lượt tải theo thể loại (tháng)</option>
                                <option value="downloads-nsx-month">Số lượt tải theo nhà sản xuất (tháng)</option>
                            </select>
                        </div>

                        <div class="search">
                            <input class="search" type="text" placeholder="Tìm kiếm" />
                            <button class="search">Tìm kiếm</button>
                        </div>
                    </div>

                    <!-- Thống kê lượt tải game trong tháng -->
                    <table border="1" id="downloadsgametheothang" style="display: table" class="table">
                        <tr class="table-success">
                            <td colspan="8">
                                <!-- Hiển thị tháng -->
                                <select name="" id="">
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $month; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị năm -->
                                <select name="" id="">
                                    <?php
                                    for ($year = 2022; $year <= 2030; $year++) {
                                        ?>
                                    <option value="<?php echo $year; ?>">Năm <?php echo $year; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="col">STT</th>
                            <th scope="col">Tháng/Năm tải</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tên game</th>
                            <th scope="col">Số lượt tải</th>
                        </tr>
                        <!-- dữ liệu từng game -->
                        <tr class="table-light">
                            <td>1</td>
                            <td>
                                01/2021
                            </td>
                            <td>27</td>
                            <td>Mario</td>
                            <td>100</td>
                        </tr>
                        <tr class="table-danger">
                            <th colspan="4">Tổng</th>
                            <td>10</td>
                        </tr>
                    </table>
                    <!-- Thống kê lượt tải thể loại trong tháng -->
                    <table border="1" id="downloadscategorytheothang" style="display: none" class="table">
                        <tr class="table-success">
                            <td colspan="8">
                                <!-- Hiển thị tháng -->
                                <select name="" id="">
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $month; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị năm -->
                                <select name="" id="">
                                    <?php
                                    for ($year = 2022; $year <= 2030; $year++) {
                                        ?>
                                    <option value="<?php echo $year; ?>">Năm <?php echo $year; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="col">STT</th>
                            <th scope="col">Tháng/Năm tải</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tên thể loại</th>
                            <th scope="col">Số lượt tải</th>
                        </tr>
                        <!-- dữ liệu từng game -->
                        <tr class="table-light">
                            <td>1</td>
                            <td>
                                01/2021
                            </td>
                            <td>27</td>
                            <td>Hành động</td>
                            <td>100</td>
                        </tr>
                        <tr class="table-danger">
                            <th colspan="4">Tổng</th>
                            <td>10</td>
                        </tr>
                    </table>
                    <!-- Thống kê lượt tải nsx trong tháng -->
                    <table border="1" id="downloadsnsxtheothang" style="display: none" class="table">
                        <tr class="table-success">
                            <td colspan="8">
                                <!-- Hiển thị tháng -->
                                <select name="" id="">
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                    <option value="<?php echo $month; ?>">Tháng <?php echo $month; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Hiển thị năm -->
                                <select name="" id="">
                                    <?php
                                    for ($year = 2022; $year <= 2030; $year++) {
                                        ?>
                                    <option value="<?php echo $year; ?>">Năm <?php echo $year; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="col">STT</th>
                            <th scope="col">Tháng/Năm tải</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tên nhà sản xuất</th>
                            <th scope="col">Số lượt tải</th>
                        </tr>
                        <!-- dữ liệu từng game -->
                        <tr class="table-light">
                            <td>1</td>
                            <td>
                                01/2021
                            </td>
                            <td>27</td>
                            <td>VNG</td>
                            <td>100</td>
                        </tr>
                        <tr class="table-danger">
                            <th colspan="4">Tổng</th>
                            <td>10</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- tabs -->
        </div>


        <!-- Sản phẩm đang giảm giá -->
        <div class="client menu-tab" id="on-sale">
            <div class="sale-main">
                <div class="table-control">
                    <div class="type-table">
                        <select class="type-table" name="" id="" onchange="saletable(this)">
                            <option value="" selected="selected">
                                ---Chọn loại bảng muốn hiển thị---
                            </option>
                            <option value="sale-games">Giảm giá theo game</option>
                            <option value="sale-categorys">Giảm giá theo thể loại</option>
                            <option value="sale-nsxs">Giảm giá theo nhà sản xuất</option>
                        </select>
                    </div>

                    <div class="search">
                        <input class="search" type="text" placeholder="Tìm kiếm" />
                        <button class="search">Tìm kiếm</button>
                    </div>
                </div>
                <!-- Tất cả sản phẩm -->
                <table style="display: table" id="sale-all-games">
                    <tr>
                        <td colspan="10">
                            <div class="scrollbar">
                                <table border="1" class="table">
                                    <tr class="table-primary">
                                        <th scope="col">STT</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Ngày phát hành</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Phần trăm giảm giá</th>
                                        <th scope="col">Giá mới</th>
                                        <th scope="col">Ngày bắt đầu</th>
                                        <th scope="col">Ngày kết thúc</th>

                                    </tr>
                                    <tr class="table-light">
                                        <td>1</td>
                                        <td>27</td>
                                        <td>STAR WARS Jedi: Fallen Order</td>
                                        <td>12/4/2022</td>
                                        <td>120.000đ</td>
                                        <td></td>
                                        <td>60.000đ</td>
                                        <td>20/3/2022</td>
                                        <td>30/3/2022</td>

                                    </tr>
                                    <tr class="table-light">
                                        <td>1</td>
                                        <td>27</td>
                                        <td>STAR WARS Jedi: Fallen Order</td>
                                        <td>12/4/2022</td>
                                        <td>120.000đ</td>
                                        <td></td>
                                        <td>60.000đ</td>
                                        <td>20/3/2022</td>
                                        <td>30/3/2022</td>

                                    </tr>

                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- Tất cả thể loại -->
                <table style="display: none" id="sale-all-category">
                    <tr>
                        <td colspan="10">
                            <div class="scrollbar">
                                <table border="1" class="table">
                                    <tr class="table-primary">
                                        <th scope="col">STT</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên thể loại</th>
                                        <th scope="col">Tổng cộng game</th>
                                        <th scope="col">Phần trăm giảm giá</th>
                                        <th scope="col">Ngày bắt đầu</th>
                                        <th scope="col">Ngày kết thúc</th>
                                    </tr>
                                    <tr class="table-light">
                                        <td>1</td>
                                        <td>27</td>
                                        <td>Hành động</td>
                                        <td>30</td>
                                        <td>30</td>
                                        <td>20/3/2022</td>
                                        <td>30/3/2022</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- Tất cả nhà sản xuất -->
                <table style="display: none" id="sale-all-nsx">
                    <tr>
                        <td colspan="10">
                            <div class="scrollbar">
                                <table border="1" class="table">
                                    <tr class="table-primary">
                                        <th scope="col">STT</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên nhà sản xuất</th>
                                        <th scope="col">Tổng cộng game</th>
                                        <th scope="col">Phần trăm giảm giá</th>
                                        <th scope="col">Ngày bắt đầu</th>
                                        <th scope="col">Ngày kết thúc</th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tr class="table-light">
                                        <td>1</td>
                                        <td>27</td>
                                        <td>VNG</td>
                                        <td>20</td>
                                        <td>40</td>
                                        <td>20/3/2022</td>
                                        <td>30/3/2022</td>
                                        <td><input class="addpercent" type="submit" name="" id="" value="Thêm %"></td>
                                    </tr>

                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- ========================================THỐNG KÊ=============================================== -->
    </div>
</body>
<?php if (isset($_SESSION['xoaKHthanhcong']) && $_SESSION['xoaKHthanhcong'] == true) {
    echo "<script>
        window.onload = function() {
            alert('Xóa thành công!!')
            document.getElementById('Themkhachhang').click();
            document.getElementById('tabDSKH').click();
        }
        </script>";
}
$_SESSION['xoaKHthanhcong'] = false;

if (isset($_SESSION['updateKH']) && $_SESSION['updateKH'] != 0) {
    $idtk = $_SESSION['updateKH'];
    $sql = "SELECT * FROM taikhoan tk,khachhang kh WHERE kh.tk_id = tk.tk_id and tk.tk_id = $idtk";
    $query = mysqli_query($cn, $sql);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $hoten = $row['kh_hoten'];
        $sdt = $row['kh_sdt'];
        $email = $row['kh_email'];
        $tk = $row['tk_taikhoan'];
        $mk = $row['tk_matkhau'];
    }
    ?>
<script>
window.onload = function() {
    document.getElementById('Themkhachhang').click();
    document.getElementById('tabThemKH').click();
    document.getElementById('hotenKH').value = "<?php echo $hoten; ?>";
    document.getElementById('sdtKH').value = "<?php echo $sdt; ?>";
    document.getElementById('emailKH').value = "<?php echo $email; ?>";
    document.getElementById('tkKH').value = "<?php echo $tk; ?>";
    document.getElementById('mkKH').value = "<?php echo $mk; ?>";
    document.getElementById("bntUpdateKH").removeAttribute("hidden");
    document.getElementById("bntThemKH").setAttribute("hidden","hidden" );
    
}
</script>
<?php }
$_SESSION['updateKH'] = 0;



?>




<!-- select chọn table sản phẩm -->
<script>
var infor = document.getElementById("inforgame");
var category = document.getElementById("inforgame-and-category");
var nsx = document.getElementById("inforgame-and-nsx");
var imgtrailer = document.getElementById("inforgame-and-img");
var source = document.getElementById("inforgame-and-source");

function changetable(obj) {
    var value = obj.value;

    if (value === "category") {
        infor.style.display = "none";
        category.style.display = "table";
        nsx.style.display = "none";
        imgtrailer.style.display = "none";
        source.style.display = "none";
    }
    if (value === "nsx") {
        infor.style.display = "none";
        category.style.display = "none";
        nsx.style.display = "table";
        imgtrailer.style.display = "none";
        source.style.display = "none";
    }
    if (value === "img-trailer") {
        infor.style.display = "none";
        category.style.display = "none";
        nsx.style.display = "none";
        imgtrailer.style.display = "table";
        source.style.display = "none";
    }
    if (value === "filegame") {
        infor.style.display = "none";
        category.style.display = "none";
        nsx.style.display = "none";
        imgtrailer.style.display = "none";
        source.style.display = "table";
    }
    if (value === "infor") {
        infor.style.display = "table";
        category.style.display = "none";
        nsx.style.display = "none";
        imgtrailer.style.display = "none";
        source.style.display = "none";
    }
}
</script>
<!-- select chọn table giảm giá -->
<script>
var all_game = document.getElementById("all-games");
var all_category = document.getElementById("all-category");
var all_nsx = document.getElementById("all-nsx");

function changetable(obj) {
    var value = obj.value;

    if (value === "categorys") {
        all_game.style.display = "none";
        all_category.style.display = "table";
        all_nsx.style.display = "none";
    }
    if (value === "nsxs") {
        all_game.style.display = "none";
        all_category.style.display = "none";
        all_nsx.style.display = "table";
    }
    if (value === "games") {
        all_game.style.display = "table";
        all_category.style.display = "none";
        all_nsx.style.display = "none";
    }

}
</script>
<!-- select chọn table tài khoản -->
<script>
var info_account = document.getElementById("infor-acc");
var type_account = document.getElementById("type-acc");

function changetableaccount(obj) {
    var value = obj.value;

    if (value === "type-account") {
        info_account.style.display = "none";
        type_account.style.display = "table";
    }
    if (value === "infor-account") {
        info_account.style.display = "table";
        type_account.style.display = "none";
    }

}
</script>
<!-- select chọn table thống kê lượt tải theo ngày-->
<script>
var downloads_games_date = document.getElementById("downloadsgametheongay");
var downloads_category_date = document.getElementById("downloadscategorytheongay");
var downloads_nsx_date = document.getElementById("downloadsnsxtheongay");

function downloads_date(obj) {
    var value = obj.value;

    if (value === "downloads-games-date") {
        downloads_games_date.style.display = "table";
        downloads_category_date.style.display = "none";
        downloads_nsx_date.style.display = "none";

    }
    if (value === "downloads-category-date") {
        downloads_games_date.style.display = "none";
        downloads_category_date.style.display = "table";
        downloads_nsx_date.style.display = "none";

    }
    if (value === "downloads-nsx-date") {
        downloads_games_date.style.display = "none";
        downloads_category_date.style.display = "none";
        downloads_nsx_date.style.display = "table";

    }
}
</script>
<!-- select chọn table thống kê lượt tải theo tháng-->
<script>
var downloads_games_month = document.getElementById("downloadsgametheothang");
var downloads_category_month = document.getElementById("downloadscategorytheothang");
var downloads_nsx_month = document.getElementById("downloadsnsxtheothang");

function downloads_month(obj) {
    var value = obj.value;

    if (value === "downloads-games-month") {
        downloads_games_month.style.display = "table";
        downloads_category_month.style.display = "none";
        downloads_nsx_month.style.display = "none";

    }
    if (value === "downloads-category-month") {
        downloads_games_month.style.display = "none";
        downloads_category_month.style.display = "table";
        downloads_nsx_month.style.display = "none";

    }
    if (value === "downloads-nsx-month") {
        downloads_games_month.style.display = "none";
        downloads_category_month.style.display = "none";
        downloads_nsx_month.style.display = "table";

    }
}
</script>
<!-- select chọn table thống kê giảm giá -->
<script>
var all_games = document.getElementById("sale-all-games");
var all_categorys = document.getElementById("sale-all-category");
var all_nsxs = document.getElementById("sale-all-nsx");

function saletable(obj) {
    var value = obj.value;

    if (value === "sale-categorys") {
        all_games.style.display = "none";
        all_categorys.style.display = "table";
        all_nsxs.style.display = "none";
    }
    if (value === "sale-nsxs") {
        all_games.style.display = "none";
        all_categorys.style.display = "none";
        all_nsxs.style.display = "table";
    }
    if (value === "sale-games") {
        all_games.style.display = "table";
        all_categorys.style.display = "none";
        all_nsxs.style.display = "none";
    }

}
</script>
<!-- select chọn table thống kê-->
<script>
var revenue_date = document.getElementById("revenue-date");
var revenue_month = document.getElementById("revenue-month");

function statistical(obj) {
    var value = obj.value;

    if (value === "revenue_date") {
        revenue_date.style.display = "table";
        revenue_month.style.display = "none";

    }
    if (value === "revenue_month") {
        revenue_date.style.display = "none";
        revenue_month.style.display = "table";

    }
}
</script>
<!-- tabss -->
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent ");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none ";
    }
    tablinks = document.getElementsByClassName("tablinks ");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active ", " ");
    }
    document.getElementById(cityName).style.display = "block ";
    evt.currentTarget.className += " active ";
}
</script>
<!-- tabss -->
<script>
function menu(evt, NameMenu) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("menu-tab");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none ";
    }
    tablinks = document.getElementsByClassName("btn-menu");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active ", " ");
    }
    document.getElementById(NameMenu).style.display = "block ";
    evt.currentTarget.className += " active ";
}
</script>
<!-- range slider -->
<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
// Hiển thị giá trị thanh trượt mặc định
output.innerHTML = slider.value;
//Cập nhật giá trị thanh trượt hiện tại (mỗi khi bạn kéo tay cầm thanh trượt)
slider.oninput = function() {
    output.innerHTML = this.value;
}
</script>

</html>