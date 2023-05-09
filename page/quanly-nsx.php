<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý dành cho nsx</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- style css -->
    <link rel="stylesheet" href="../css/header-page.css" />
    <link rel="stylesheet" href="../css/tabs.css" />
    <link rel="stylesheet" href="../css/quanly-nsx.css" />
    <link rel="stylesheet" href="../css/quanly-admin.css" />
    <link rel="stylesheet" href="../css/a.css">
    <link rel="stylesheet prefetch" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>
<?php
include_once('database_connection.php');
session_start();
$tensp = isset($_POST['tensp']) ? $_POST['tensp'] : "";
$mota = isset($_POST['mota']) ? $_POST['mota'] : "";
$gia = isset($_POST['gia']) ? $_POST['gia'] : "";
$theloai = isset($_POST['theloai']) ? $_POST['theloai'] : "";
$idtaikhoan = $_SESSION["idtaikhoan"];
$typetk = $_SESSION["loaitaikhoan"];
$sqlidnsx = mysqli_query($cn, "SELECT nsx_id FROM nsx WHERE tk_id ='$idtaikhoan'");
if ($typetk == "nha san xuat") {
    if (mysqli_num_rows($sqlidnsx) == 1) {
        while ($row = mysqli_fetch_array($sqlidnsx, MYSQLI_ASSOC)) {
            $idnsx = $row['nsx_id'];
        }
    }
} else {
    $idnsx = "";
}
$target_dir = "../uploads/";
$erro = "";

if (isset($_POST["submit"])) {

    // check tensp va mota
    if ($tensp == "") {
        $erro .= "<li>Ten sp k dc rong</li>";
    }
    if ($mota == "") {
        $erro .= "<li>Mo ta k dc rong</li>";
    }
    if ($gia == "") {
        $erro .= "<li>Gia k dc rong</li>";
    }

    //check img avt
    if (move_uploaded_file($_FILES["imgavt"]["tmp_name"], $target_dir . $_FILES["imgavt"]["name"])) {
    } else {
        $erro .= "<li>Khong upload duoc anh avt game</li>";
    }

    //check source game
    if (move_uploaded_file($_FILES["filezip"]["tmp_name"], $target_dir . $_FILES["filezip"]["name"])) {
    } else {
        $erro .= "<li>Khong upload duoc source game</li>";
    }
    //check video trailer
    if (move_uploaded_file($_FILES["trailer"]["tmp_name"], $target_dir . $_FILES["trailer"]["name"])) {
    } else {
        $erro .= "<li>Khong upload duoc trailer game</li>";
    }

    // check img gamepalay
    foreach ($_FILES["imggameplay"]["name"] as $key => $value) {
        if (move_uploaded_file($_FILES["imggameplay"]["tmp_name"][$key], $target_dir . $value)) {
        } else {
            $erro .= "<li>Khong upload duoc anh game play</li>";
        }
    }

    if ($erro != "") {
        echo "<ul>" . $erro . "</ul>";
    } else {
        $imgavt = $_FILES["imgavt"]["name"];
        $filezip = $_FILES["filezip"]["name"];
        $trailer = $_FILES["trailer"]["name"];
        $sql = "INSERT INTO `sanpham`(`sp_id`, `sp_tengame`, `sp_imgavt`, `sp_file`, `sp_mota`, `sp_trailer`, `sp_gia`, `nsx_id`) VALUES 
        ('','$tensp','$imgavt','$filezip','$mota','$trailer','$gia','$idnsx')";

        mysqli_query($cn, $sql);
        $id_sp = mysqli_insert_id($cn);
        for ($i = 0; $i < count($_FILES["imggameplay"]["name"]); $i++) {
            $valueimgs = $_FILES["imggameplay"]["name"][$i];
            mysqli_query($cn, "INSERT INTO `anhgameplay`(`agl_id`, `sp_id`, `agl_ten`) VALUES ('','$id_sp','$valueimgs')");
        }

        header("location:quanlysanpham.php");
    }
}
?>

<body>

    <div class="menu">
        <div class="return-home">
            <button><ion-icon name="home-outline"></ion-icon> Trang chủ</button>
        </div>
        <div class="menu-title">
            <h1>Quản lý dành cho Nhà Sản Xuất</h1>
        </div>
    </div>
    <!-- tabs -->
    <div class="tabs">
        <!-- tabs -->
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'cmt')">
                Thêm sản phẩm
            </button>
            <button class="tablinks" onclick="openCity(event, 'sale')">
                Thêm giảm giá
            </button>
            <button class="tablinks" onclick="openCity(event, 'des')">
                Thống kê sản phẩm hiện tại
            </button>
            <button class="tablinks" onclick="openCity(event, 'revenue')">
                Thống kê doanh thu
            </button>
        </div>
        <!-- Thêm sản phẩm -->
        <div id="cmt" class="tabcontent">
            <?php
            if (isset($_SESSION['dangkythanhcong']) && $_SESSION['dangkythanhcong'] == "ThemSP") {
                echo "<script> 
                        alert('Thêm sản phẩm thành công!!') </script>";
                unset($_SESSION['dangkythanhcong']);
            }
            if (isset($_SESSION['dangkythanhcong']) && $_SESSION['dangkythanhcong'] == "capNhatSP") {
                echo "<script> document.getElementById('Themsanpham').click();
                        document.getElementById('tabDSSP').click();
                        alert('Cập nhật sản phẩm thành công!!') </script>";
                unset($_SESSION['dangkythanhcong']);
            }
            ?>
            <div class="tabcontent-addproduct">
                <div class="add-nameproduct">
                    <div class="add-title">
                        <span>Tên sản phẩm</span>
                    </div>
                    <div class="add-input">
                        <input type="text" name="tensp" id="tensp" placeholder="Tên sản phẩm" />
                        <div class="loi" id="loitensp"></div>
                    </div>
                </div>
                <div class="add-describe">
                    <div class="add-title">
                        <span>Mô tả sản phẩm</span>
                    </div>
                    <div class="add-input">
                        <input type="text" name="mota" id="motasp" placeholder="Mô tả sản phẩm" />
                        <div class="loi" id="loimotasp"></div>
                    </div>
                </div>
                <div class="add-price">
                    <div class="add-title">
                        <span>Giá sản phẩm</span>
                    </div>
                    <div class="add-input">
                        <input type="number" min="50000" step="10000" name="giasp" id="giasp" value="50000" placeholder="Giá sản phẩm">
                    </div>
                </div>
                <div class="add-category">
                    <div class="add-title">
                        <span>Thể loại</span>
                    </div>
                    <div class="add-input">
                        <select class="add-input" name="theloaisp" id="theloaisp" multiple>
                            <?php
                            $query = mysqli_query($cn, "SELECT * FROM theloai");
                            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['tl_id'] . '">' . $row['tl_ten'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="loi" style="margin-bottom: 10px;" id="loitheloaisp"></div>
                </div>
                <div class="add-input" style="margin-top: 15px;">
                    <span>Ngày phát hành</span>
                    <input type="date" max="<?php echo date('Y-m-d'); ?>" name="nph" id="nph" />
                    <div class="loi" id="loinph"></div>
                </div>
                <script>
                    // hàm tăng số
                    function a(b) {
                        document.getElementById('gia').value = b
                        setTimeout(function() {
                            a(b + 1)
                        }, 50);
                    }
                </script>
                <div class="add-upload">
                    <div class="add-avatar">
                        <div class="add-title"><span>Ảnh đại diện</span></div>
                        <div class="add-input">
                            <input type="file" name="imgavt" id="imgavt" accept=".jpg, .jpeg, .png" />
                            <div class="loi" id="loiimgavt"></div>
                        </div>
                    </div>
                    <div class="add-photogameplay">
                        <div class="add-title"><span>Ảnh trong game(Một số)</span></div>
                        <div class="add-input">
                            <input type="file" name="igl" id="igl" multiple accept=".jpg, .jpeg, .png" />
                            <div class="loi" id="loiigl"></div>
                        </div>
                    </div>
                    <div class="add-trailer">
                        <div class="add-title"><span>Trailer video game</span></div>
                        <div class="add-input">
                            <input type="file" name="trailer" id="trailer" accept=".mp4" />
                            <div class="loi" id="loitrailer"></div>
                        </div>
                    </div>

                    <div class="add-source">
                        <div class="add-title"><span>File game</span></div>
                        <div class="add-input">
                            <input type="file" name="source" id="source" accept=".zip" />
                            <div class="loi" id="loisource"></div>
                        </div>
                    </div>
                    <!-- <div class="add-source">
                        <div class="add-title"><span>Bản mở rộng(nếu có)</span></div>
                        <div class="add-input">
                            <input class="" type="file" name="filezip" accept=".zip" />
                        </div>
                    </div> -->
                </div>

                <div class="add-btn">
                    <button type="button" id="bntThemSP" onclick="add_update_SP('add')">Thêm</button>
                    <button type="button" id="bntCapnhatSP" onclick="add_update_SP('update')" hidden>Cập
                        nhật</button>
                    <button type="button" id="bntHuySP" onclick="HuySP()">Hủy</button>
                </div>
            </div>
            <script>
                function HuySP() {
                    document.getElementById('tensp').value = ""
                    document.getElementById('giasp').value = "50000"
                    document.getElementById('motasp').value = ""
                    document.getElementById('source').value = ""
                    document.getElementById('trailer').value = ""
                    document.getElementById('imgavt').value = ""
                    document.getElementById('igl').value = ""
                    document.getElementById('nph').value = ""
                    $('#loitensp').html("")
                    $('#loinph').html("")
                    $('#loigiasp').html("")
                    $('#loimotasp').html("")
                    $('#imgavt').removeClass('is-invalid')
                    $('#trailer').removeClass('is-invalid')
                    $('#source').removeClass('is-invalid')
                    $('#igl').removeClass('is-invalid')
                    $('#loitheloaisp').html("")

                    if (document.getElementById('bntThemSP').hasAttribute("hidden")) {
                        document.getElementById("bntThemSP").removeAttribute("hidden")
                        document.getElementById("bntCapnhatSP").setAttribute("hidden", "hidden")
                    }
                }
            </script>
            <script>
                function add_update_SP(choose) {
                    var check = 0
                    var tensp = $('#tensp').val()
                    var giasp = $('#giasp').val()
                    var motasp = $('#motasp').val()
                    var nph = $('#nph').val()
                    var p_nsx = $('#p_nsx').val()
                    var theloaisp = document.getElementById('theloaisp')
                    var trailer = document.getElementById('trailer')
                    var source = document.getElementById('source')
                    var imgavt = document.getElementById('imgavt')
                    var igl = document.getElementById('igl')
                    let arr_tlsp = []
                    let arr_igl = []

                    if (tensp.length < 5 || tensp.length > 50) {
                        check -= 1
                        $('#tensp').addClass('is-invalid');
                        $('#loitensp').html("Tên sản phẩm chứa ít nhất 5-50 ký tự")
                    } else {
                        $('#tensp').removeClass('is-invalid')
                        $('#loitensp').html("")
                        check += 1
                    }

                    if (nph == "") {
                        check -= 1
                        $('#nph').addClass('is-invalid');
                        $('#loinph').html("Hãy chọn ngày phát hành")
                    } else {
                        $('#nph').removeClass('is-invalid')
                        $('#loinph').html("")
                        check += 1
                    }

                    if (giasp <= 50000) {
                        check -= 1
                        $('#giasp').addClass('is-invalid');
                        $('#loigiasp').html("Giá sản phẩm phải trên 50.000VND")
                    } else {
                        $('#giasp').removeClass('is-invalid')
                        $('#loigiasp').html("")
                        check += 1
                    }

                    if (motasp.length < 10 || motasp.length > 100) {
                        check -= 1
                        $('#motasp').addClass('is-invalid');
                        $('#loimotasp').html("Mô tả sản phẩm chứa ít nhất 10-100 ký tự")
                    } else {
                        $('#motasp').removeClass('is-invalid')
                        $('#loimotasp').html("")
                        check += 1
                    }

                    if (imgavt.files.length == "") {
                        check -= 1
                        $('#imgavt').addClass('is-invalid');
                    } else {
                        $('#imgavt').removeClass('is-invalid')
                        check += 1
                    }

                    if (trailer.files.length == "") {
                        check -= 1
                        $('#trailer').addClass('is-invalid');
                    } else {
                        $('#trailer').removeClass('is-invalid')
                        check += 1
                    }

                    if (source.files.length == "") {
                        check -= 1
                        $('#source').addClass('is-invalid');
                    } else {
                        $('#source').removeClass('is-invalid')
                        check += 1
                    }

                    if (theloaisp.options.selectedIndex == -1) {
                        check -= 1
                        $('#theloaisp').addClass('is-invalid');
                        $('#loitheloaisp').html("Hãy chọn thể loại của sản phẩm")
                    } else {
                        $('#theloaisp').removeClass('is-invalid')
                        $('#loitheloaisp').html("")
                        check += 1
                        for (let index = 0; index < theloaisp.options.length; index++) {
                            if (theloaisp.options[index].selected) {
                                arr_tlsp.push(theloaisp.options[index].value)
                            }
                        }
                    }

                    if (igl.files.length == "") {
                        check -= 1
                        $('#igl').addClass('is-invalid');
                    } else {
                        $('#igl').removeClass('is-invalid')
                        check += 1
                        for (let index = 0; index < igl.files.length; index++) {
                            arr_igl.push(igl.files[index].name)
                        }
                    }

                    if (check == 9) {
                        if (choose == 'add') {
                            let formData2 = new FormData()
                            formData2.append("source", source.files[0]);
                            fetch('themsanpham-nsx.php', {
                                method: "POST",
                                body: formData2
                            })

                            let formData = new FormData()
                            formData.append("imgavt", imgavt.files[0]);
                            fetch('themsanpham-nsx.php', {
                                method: "POST",
                                body: formData
                            })

                            let formData1 = new FormData()
                            formData1.append("trailer", trailer.files[0]);
                            fetch('themsanpham-nsx.php', {
                                method: "POST",
                                body: formData1
                            })


                            let formData0 = new FormData()
                            for (let index = 0; index < igl.files.length; index++) {
                                formData0.append("igl[]", igl.files[index])
                            }
                            var x = new XMLHttpRequest()
                            x.open("POST", "themsanpham-nsx.php", true)
                            x.send(formData0)

                            $.post('themsanpham-nsx.php', {
                                tensp: tensp,
                                giasp: giasp,
                                motasp: motasp,
                                p_nsx: p_nsx,
                                nph: nph,
                                imgavt: imgavt.files[0].name,
                                trailer: trailer.files[0].name,
                                source: source.files[0].name,
                                igl_name: arr_igl,
                                theloaisp: arr_tlsp,
                                page: "themSP"
                            }, function(data) {
                                $('#THONGBAO').html(data);
                            })
                        }
                        if (choose == 'update') {
                            let formData2 = new FormData()
                            formData2.append("source", source.files[0]);
                            fetch('themsanpham-nsx.php', {
                                method: "POST",
                                body: formData2
                            })

                            let formData = new FormData()
                            formData.append("imgavt", imgavt.files[0]);
                            fetch('themsanpham-nsx.php', {
                                method: "POST",
                                body: formData
                            })

                            let formData1 = new FormData()
                            formData1.append("trailer", trailer.files[0]);
                            fetch('themsanpham-nsx.php', {
                                method: "POST",
                                body: formData1
                            })


                            let formData0 = new FormData()
                            for (let index = 0; index < igl.files.length; index++) {
                                formData0.append("igl[]", igl.files[index])
                            }
                            var x = new XMLHttpRequest()
                            x.open("POST", "themsanpham-nsx.php", true)
                            x.send(formData0)

                            $.post('themsanpham-nsx.php', {
                                tensp: tensp,
                                giasp: giasp,
                                motasp: motasp,
                                p_nsx: p_nsx,
                                nph: nph,
                                imgavt: imgavt.files[0].name,
                                trailer: trailer.files[0].name,
                                source: source.files[0].name,
                                igl_name: arr_igl,
                                theloaisp: arr_tlsp,
                                page: "capNhatSP"
                            }, function(data) {
                                $('#THONGBAO').html(data);
                            })
                        }


                    }

                }
            </script>
        </div>
        <div id="THONGBAO"></div>
        <!-- Thêm phần trăm giảm giá -->
        <div id="sale" class="tabcontent">
            <table>
                <tr class="table-light">
                    <td colspan="6">
                        <div class="scroll">
                            <table border="1" class="table-scroll table">
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
                                <tr>
                                    <td>1</td>
                                    <td>27</td>
                                    <td>STAR WARS Jedi: Fallen Order</td>
                                    <td>12/4/2022</td>
                                    <td>120.000đ</td>
                                    <td></td>
                                    <td>60.000đ</td>
                                    <td>20/3/2022</td>
                                    <td>30/3/2022</td>
                                    <td><input class="addpercent" type="submit" name="" id="" value="Thêm %"></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>27</td>
                                    <td>STAR WARS Jedi: Fallen Order</td>
                                    <td>12/4/2022</td>
                                    <td>120.000đ</td>
                                    <td> 50</td>
                                    <td>60.000đ</td>
                                    <td>20/3/2022</td>
                                    <td>30/3/2022</td>
                                    <td><input class="addpercent" type="submit" name="" id="" value="Thêm %"></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>27</td>
                                    <td>STAR WARS Jedi: Fallen Order</td>
                                    <td>12/4/2022</td>
                                    <td>120.000đ</td>
                                    <td></td>
                                    <td>60.000đ</td>
                                    <td>20/3/2022</td>
                                    <td>30/3/2022</td>
                                    <td><input class="addpercent" type="submit" name="" id="" value="Thêm %"></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>27</td>
                                    <td>STAR WARS Jedi: Fallen Order</td>
                                    <td>12/4/2022</td>
                                    <td>120.000đ</td>
                                    <td></td>
                                    <td>60.000đ</td>
                                    <td>20/3/2022</td>
                                    <td>30/3/2022</td>
                                    <td><input class="addpercent" type="submit" name="" id="" value="Thêm %"></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>27</td>
                                    <td>STAR WARS Jedi: Fallen Order</td>
                                    <td>12/4/2022</td>
                                    <td>120.000đ</td>
                                    <td> 50</td>
                                    <td>60.000đ</td>
                                    <td>20/3/2022</td>
                                    <td>30/3/2022</td>
                                    <td><input class="addpercent" type="submit" name="" id="" value="Thêm %"></td>
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
        <!-- Thống kê sản phẩm đang có -->
        <div id="des" class="tabcontent">
            <div class="table-control">
                <div class="search">
                    <input class="search" type="text" id="timkiem_sp" placeholder="Tìm kiếm bằng tên sản phẩm" />
                    <button class="search" onclick="timkiemSP()">Tìm kiếm</button>
                    <script>
                        
                        var search = $('#timkiem_sp').val()
                        $.post('timkiemSP-nsx.php', {
                            data: search
                        }, function(data) {
                            $('.danhsachtimkiemSP').html(data);
                        })

                        function timkiemSP() {
                            var search = $('#timkiem_sp').val()
                            $.post('timkiemSP-nsx.php', {
                                data: search
                            }, function(data) {
                                $('.danhsachtimkiemSP').html(data);
                            })
                        }
                    </script>
                </div>
            </div>
            <div class="table-thongke table-responsive-sm">
                <div class="danhsachtimkiemSP scrollbar">

                </div>
            </div>
        </div>
        <!-- Thống kê doanh thu -->
        <div id="revenue" class="tabcontent">
            <div class="table-control">
                <div class="type-table">
                    <select class="type-table" name="" id="" onchange="statistical(this)">
                        <option value="" selected="selected">
                            ---Chọn loại bảng muốn hiển thị---
                        </option>
                        <option value="revenue_date">Doanh thu hằng ngày</option>
                        <option value="revenue_month">Doanh thu hằng tháng</option>
                        <option value="download_month">Lượt tải trong tháng</option>
                        <option value="game_sale">Game được giảm giá trong tháng</option>
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
                <!-- Thống kê số lượt tải của từng game trong từng tháng(Từ lớn xuống bé) -->
                <table border="1" id="downloads-month" style="display: none" class="table">
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
                        <th scope="col">ID</th>
                        <th scope="col">Tên game</th>
                        <th scope="col">Nhà sản xuất</th>
                        <th scope="col">Số lượt tải (tháng)</th>
                    </tr>
                    <!-- dữ liệu từng game -->
                    <tr class="table-light">
                        <td>1</td>
                        <td>
                            01/2021
                        </td>
                        <td>27</td>
                        <td>Mario</td>
                        <td>VNG</td>
                        <td>100</td>
                    </tr>
                    <tr class="table-light">
                        <td>2</td>
                        <td>
                            01/2021
                        </td>
                        <td>26</td>
                        <td>sonic</td>
                        <td>VNG</td>
                        <td>90</td>
                    </tr>
                    <!-- tổng cộng -->
                    <tr class="table-danger">
                        <th colspan="5">Tổng cộng</th>
                        <td>190</td>
                    </tr>
                </table>
                <!-- Thống kê game được giảm giá trong tháng -->
                <table border="1" id="sale-month" style="display: none" class="table">
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
                        <th scope="col">Tháng/Năm</th>
                        <th scope="col">ID</th>
                        <th scope="col">Tên game</th>
                        <th scope="col">Nhà sản xuất</th>
                        <th scope="col">Phần trăm</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
                    </tr>
                    <!-- dữ liệu từng game -->
                    <tr class="table-light">
                        <td>1</td>
                        <td>
                            01/2021
                        </td>
                        <td>27</td>
                        <td>Mario</td>
                        <td>VNG</td>
                        <td>100</td>
                        <td>20/1/2021</td>
                        <td>30/1/2021</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
    <!-- tabs -->


</body>
<script type="text/javascript " src="https://code.jquery.com/jquery-1.11.0.min.js "></script>
<script type="text/javascript " src="https://code.jquery.com/jquery-migrate-1.2.1.min.js "></script>
<script type="text/javascript " src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js "></script>
<!-- Regex giá sản phẩm -->
<script>
    function Gia(a) {
        a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1. ");
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
<!-- select chọn table -->
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

<!-- select chọn table thống kê-->
<script>
    var revenue_date = document.getElementById("revenue-date");
    var revenue_month = document.getElementById("revenue-month");
    var downloads_month = document.getElementById("downloads-month");
    var sale_month = document.getElementById("sale-month");

    function statistical(obj) {
        var value = obj.value;

        if (value === "revenue_date") {
            revenue_date.style.display = "table";
            revenue_month.style.display = "none";
            downloads_month.style.display = "none";
            sale_month.style.display = "none";
        }
        if (value === "revenue_month") {
            revenue_date.style.display = "none";
            revenue_month.style.display = "table";
            downloads_month.style.display = "none";
            sale_month.style.display = "none";
        }
        if (value === "download_month") {
            revenue_date.style.display = "none";
            revenue_month.style.display = "none";
            downloads_month.style.display = "table";
            sale_month.style.display = "none";
        }
        if (value === "game_sale") {
            revenue_date.style.display = "none";
            revenue_month.style.display = "none";
            downloads_month.style.display = "none";
            sale_month.style.display = "table";
        }
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