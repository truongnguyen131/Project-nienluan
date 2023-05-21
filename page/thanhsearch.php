<?php session_start();
include_once('database_connection.php'); ?>
<!-- hàm format giá -->
<?php
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = 'đ')
    {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
}
?>
<?php
$tk = isset($_POST['data']) ? $_POST['data'] : "";
$giaMin = isset($_POST['giaMin']) ? $_POST['giaMin'] : "";
$giaMax = isset($_POST['giaMax']) ? $_POST['giaMax'] : "";
$arr_TL = isset($_POST['arr_TL']) ? $_POST['arr_TL'] : "";
$arr_NSX = isset($_POST['arr_NSX']) ? $_POST['arr_NSX'] : "";
$sql = "SELECT * FROM sanpham sp, sanphamtheloai sptl,theloai tl, nsx n WHERE  sp_trangthai = 'duyet' and
 n.nsx_id = sp.nsx_id and sp.sp_id = sptl.sp_id and tl.tl_id = sptl.tl_id and
sp.sp_gia >= $giaMin and sp.sp_gia <= $giaMax";
$sql1 = "SELECT * FROM `sanpham` WHERE  sp_trangthai = 'duyet' and sp_id in (";
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
        if (!isset($arr_IDSP[$row1['sp_id']])) {
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


if (isset($_POST['page'])) {
    $page = $_POST['page'];
} else {
    $page = "";
}
if ($page == "" || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page * 12) - 12;
}
$query = mysqli_query($cn, "SELECT * from sanpham where sp_trangthai = 'duyet'  ORDER BY sp_id DESC LIMIT $begin,12");
$sl_sp = mysqli_num_rows(mysqli_query($cn, "SELECT * from sanpham "));
if ($tk != "") {
    $query = mysqli_query($cn, "SELECT * from sanpham WHERE  sp_trangthai = 'duyet' and sp_tengame like '%$tk%'  ORDER BY sp_id DESC LIMIT $begin,12");
    $sl_sp = mysqli_num_rows(mysqli_query($cn, "SELECT * from sanpham WHERE sp_tengame like '%$tk%' "));
}

if ($giaMax != "") {
    $sl_sp = 0;
    $q = mysqli_query($cn, $sql1) or die();
    if (mysqli_num_rows($q) > 0) {
        $sl_sp = mysqli_num_rows($q);
    }
    $sql1 = $sql1 . "  ORDER BY sp_id DESC LIMIT $begin,12";
    $query = mysqli_query($cn, $sql1);
}

?>

<div class="saling-content">
    <div class="cards">
        <?php
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $idsp = $row['sp_id'];
            ?>
            <div class="card">
                <div class="content">
                    <div class="back">
                        <div class="back-content">
                            <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
                            <!-- số sao trung bình được đánh giá -->
                            <?php
                            $count = mysqli_query($cn, "SELECT AVG(dg_sao) FROM danhgia WHERE sp_id =  $idsp");
                            while ($avg_sao = mysqli_fetch_array($count)) {
                                $avg = $avg_sao['AVG(dg_sao)'];
                            }
                            if ($avg > 0) { ?>
                                <div class="rating">
                                    <span class="starss">
                                        <?php echo number_format($avg, "1", ".", "") ?> <i class='bx bxs-star'></i>
                                    </span>
                                </div>
                            <?php } else { ?>
                                <div></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="front">
                        <div class="img">
                            <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
                        </div>
                        <div class="front-content">
                            <!-- phần trăm sale -->
                            <?php
                            $today = date('Y-m-d');
                            $query1 = mysqli_query($cn, "SELECT * FROM giamgia WHERE sp_id = $idsp");
                            if (mysqli_num_rows($query1) > 0) {
                                $row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC);
                                if (strtotime($row1['gg_ngaybatdau']) <= strtotime($today) && strtotime($row1['gg_ngayketthuc']) >= strtotime($today)) {
                                    $giamoi = $row['sp_gia'] - ($row['sp_gia'] * ($row1['gg_phantram'] / 100));
                                    ?>
                                    <small class="badge">
                                        <?php echo $row1['gg_phantram'] ?>%
                                    </small>
                                <?php }
                            } else { ?>
                                <small></small>
                            <?php } ?>
                            <div class="description">
                                <div class="title">
                                    <p class="title">
                                        <!-- tên sản phẩm -->
                                        <strong>
                                            <?php echo $row['sp_tengame']; ?>
                                        </strong>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <?php
                                    if (mysqli_num_rows($query1) > 0) { ?>
                                        <!-- giá trước khi sale -->
                                        <div class="footer-label">
                                            <label for="" class="price-old">
                                                <?php echo currency_format($row['sp_gia']) ?>
                                            </label>
                                        </div>
                                        <!-- giá sau khi sale -->
                                        <div class="footer-label">
                                            <?php if (strtotime($row1['gg_ngaybatdau']) <= strtotime($today) && strtotime($row1['gg_ngayketthuc']) >= strtotime($today)) {
                                                echo currency_format($giamoi);
                                            } ?>
                                        </div>
                                    <?php } else { ?>
                                        <!-- giá trước khi sale -->
                                        <div></div>
                                        <!-- giá sau khi sale -->
                                        <div class="footer-label">
                                            <label for="">
                                                <?php echo currency_format($row['sp_gia']) ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="card-btn">
                                    <!-- chi tiết sản phẩm -->
                                    <div class="card-button">
                                        <a href="chitietsp.php?idsp=<?php echo $row['sp_id']; ?>" title="Chi tiết sản phẩm">
                                            <i class='bx bx-dots-horizontal-rounded'></i>
                                        </a>
                                    </div>
                                    <!-- button download -->
                                    <div class="card-button">
                                        <a href="thanhtoan2.php?idsp=<?php echo $row['sp_id']; ?>">
                                            <i class='bx bx-download'></i>
                                        </a>
                                    </div>
                                    <!-- button thêm vào giỏ hàng -->
                                    <div class="card-button">
                                        <button class="add-product"
                                            onclick="themsanphamindex(<?php echo $row['sp_id']; ?>)">
                                            <i class='bx bxs-cart'></i>
                                        </button>
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
        for ($i = 1; $i <= $tong_page; $i++) { ?> <a href="javascript:timkiemPage('<?php echo $tk; ?>',<?php echo $i; ?>)">
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