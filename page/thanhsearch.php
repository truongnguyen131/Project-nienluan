<?php session_start();
include_once('database_connection.php'); ?>

<?php
$tk = isset($_POST['data']) ? $_POST['data'] : "";
$giaMin = isset($_POST['giaMin']) ? $_POST['giaMin'] : "";
$giaMax = isset($_POST['giaMax']) ? $_POST['giaMax'] : "";
$arr_TL = isset($_POST['arr_TL']) ? $_POST['arr_TL'] : "";
$arr_NSX = isset($_POST['arr_NSX']) ? $_POST['arr_NSX'] : "";
$sql = "SELECT * FROM sanpham sp, sanphamtheloai sptl,theloai tl, nsx n WHERE
 n.nsx_id = sp.nsx_id and sp.sp_id = sptl.sp_id and tl.tl_id = sptl.tl_id and
sp.sp_gia >= $giaMin and sp.sp_gia <= $giaMax";
$sql1 = "SELECT * FROM `sanpham` WHERE sp_id in (";
$arr_IDSP = array();
if ($arr_NSX != "") {
    $txtNSX = "(";
    foreach ($arr_NSX as $key => $value) {

        if ($key === array_key_last($arr_NSX)) {
            $txtNSX = $txtNSX . "'" . $value . "')";
        } else {
            $txtNSX = $txtNSX . "'" . $value . "',";
        }

    }
    $sql = $sql . " and n.nsx_ten in " . $txtNSX;
}

if ($arr_TL != "") {
    $txtTL = "(";
    foreach ($arr_TL as $key => $value) {

        if ($key === array_key_last($arr_TL)) {
            $txtTL = $txtTL . "'" . $value . "')";
        } else {
            $txtTL = $txtTL . "'" . $value . "',";
        }

    }
    $sql = $sql . " and tl.tl_ten in " . $txtTL;
}
if ($giaMin != "") {
    $query1 = mysqli_query($cn, $sql);
    while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
        if(!isset($arr_IDSP[$row1['sp_id']])){
            $arr_IDSP[$row1['sp_id']] = $row1['sp_id'];
        }
    }

    foreach ($arr_IDSP as $key => $value) {
        if ($key === array_key_last($arr_IDSP)) {
            $sql1 = $sql1 . "'" . $value . "')";
        } else {
            $sql1 = $sql1 . "'" . $value . "',";
        }
    }
    
}


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
$sl_sp = mysqli_num_rows(mysqli_query($cn, "SELECT * from sanpham "));
if ($tk != "") {
    $query = mysqli_query($cn, "SELECT * from sanpham WHERE sp_tengame like '%$tk%'  ORDER BY sp_id DESC LIMIT $begin,12");
    $sl_sp = mysqli_num_rows(mysqli_query($cn, "SELECT * from sanpham WHERE sp_tengame like '%$tk%'"));
}

if ($giaMax != "") {
    $sl_sp = mysqli_num_rows(mysqli_query($cn, $sql1));
    $sql1 = $sql1 . "  ORDER BY sp_id DESC LIMIT $begin,12";
    $query = mysqli_query($cn, $sql1);
}

?>

<div class="saling-content">
    <div class="cards">
        <?php
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