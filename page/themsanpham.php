<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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

    echo $idnsx;
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


    <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Ten san pham</td>
                <td><input type="text" name="tensp" value="<?php echo $tensp; ?>"></td>
            </tr>
            <tr>
                <td>Mo ta san pham</td>
                <td><input type="text" name="mota" value="<?php echo $mota; ?>"></td>
            </tr>
            <tr>
                <td>Gia san pham</td>
                <td><input type="text" name="gia" onchange="Gia(this)" value="<?php echo $gia; ?>"></td>
            </tr>
            <tr>
                <td>The loai</td>
                <td>


                    <select name="theloai">
                        <?php
                        $query = mysqli_query($cn, "SELECT * FROM theloai");
                        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                            echo '<option value="' . $row['tl_id'] . '">' . $row['tl_ten'] . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Avt san pham</td>
                <td><input type="file" name="imgavt" accept=".jpg, .jpeg, .png"></td>
            </tr>
            <tr>
                <td>Gameplay san pham</td>
                <td><input type="file" name="imggameplay[]" multiple accept=".jpg, .jpeg, .png"></td>
            </tr>
            <tr>
                <td>Trailer video game</td>
                <td><input type="file" name="trailer"></td>
            </tr>
            <tr>
                <td>Source game</td>
                <td><input type="file" name="filezip" accept=".zip"></td>
            </tr>
        </table>
        <button type="submit" name="submit">Them san pham</button>
    </form>

</body>

</html>
<script>
    function Gia(a){
        a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    }
   
</script>


<div class="tabs">
        <!-- tabs -->
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'cmt')" id="defaultOpen">
          Thêm sản phẩm
        </button>
            <button class="tablinks" onclick="openCity(event, 'des')">
          Thống kê sản phẩm hiện tại
        </button>
        </div>
        <!-- Thêm sản phẩm -->
        <div id="cmt" class="tabcontent">
            <div class="tabcontent-addproduct">
                <div class="add-nameproduct">
                    <div class="add-title">
                        <span>Tên sản phẩm</span>
                    </div>
                    <div class="add-input">
                        <input type="text" placeholder="Tên sản phẩm" />
                    </div>
                </div>
                <div class="add-describe">
                    <div class="add-title">
                        <span>Mô tả sản phẩm</span>
                    </div>
                    <div class="add-input">
                        <input type="text" placeholder="Mô tả sản phẩm" />
                    </div>
                </div>
                <div class="add-price">
                    <div class="add-title">
                        <span>Giá sản phẩm</span>
                    </div>
                    <div class="add-input">
                        <input type="text" name="gia" onchange="Gia(this)" value="" placeholder="Giá sản phẩm" />
                    </div>
                </div>
                <div class="add-category">
                    <div class="add-title">
                        <span>Thể loại</span>
                    </div>
                    <div class="add-input">
                        <select class="add-input" name="theloai">
                <!-- <?php
                        $query = mysqli_query($cn, "SELECT * FROM theloai");
                        while ($ = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                            echo '<option value="' . $['tl_id'] . '">' . $['tl_ten'] . '</option>';
                        }
                        ?> -->
              </select>
                    </div>
                </div>
                <div class="add-upload">
                    <div class="add-avatar">
                        <div class="add-title"><span>Ảnh đại diện</span></div>
                        <div class="add-input">
                            <input type="file" name="imgavt" accept=".jpg, .jpeg, .png" />
                        </div>
                    </div>
                    <div class="add-photogameplay">
                        <div class="add-title"><span>Ảnh trong game(Một số)</span></div>
                        <div class="add-input">
                            <input type="file" name="imggameplay[]" multiple accept=".jpg, .jpeg, .png" />
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
                </div>

                <div class="add-btn">
                    <button class="btn-add">Thêm sản phẩm</button>
                    <button class="btn-cancel" type="reset">Hủy bỏ</button>
                </div>
            </div>
        </div>
        <!-- Thống kê sản phẩm đang có -->
        <div id="des" class="tabcontent"></div>

        <!-- tabs -->
    </div>
 