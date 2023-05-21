<?php session_start();
include_once('database_connection.php'); ?>
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
$sql = "SELECT * FROM sanpham,giamgia WHERE sanpham.sp_id = giamgia.sp_id and
giamgia.gg_ngaybatdau <= CURDATE() and giamgia.gg_ngayketthuc >= CURDATE()";
$sql = $sql . " and  sanpham.sp_tengame like '%$tk%' ORDER BY giamgia.gg_phantram DESC LIMIT 0,8";
$query = mysqli_query($cn, $sql);
?>
<div class="heading">
    <i class='bx bxs-flame'></i>
    <h2>GAME ĐANG GIẢM GIÁ</h2>
</div>
<div class="saling-content">
    <div class="cards">
        <?php
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $giamoi = $row['sp_gia'] - ($row['sp_gia'] * ($row['gg_phantram'] / 100)); ?>
            <div class="card" id="<?php echo $row['sp_id'] ?>">
                <div class="content">
                    <div class="back">
                        <div class="back-content">
                            <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
                            <?php
                            $id = $row['sp_id'];
                            $count = mysqli_query($cn, "SELECT *,AVG(dg_sao) avgS FROM sanpham,danhgia WHERE sanpham.sp_id = danhgia.sp_id GROUP BY sanpham.sp_id");
                            while ($avg_sao = mysqli_fetch_array($count)) {
                                if ($avg_sao['sp_id'] == $id) { ?>
                                    <div class="rating">
                                        <i class='bx bxs-star'></i>
                                        <span>
                                            <?php echo number_format($avg_sao['avgS'], "1", ".", "") ?>
                                        </span>
                                    </div>
                                <?php }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="front">
                        <div class="img">
                            <img src="../uploads/<?php echo $row['sp_imgavt'] ?>" alt="">
                        </div>
                        <div class="front-content">
                            <!-- phần trăm sale -->
                            <small class="badge">
                                <?php echo $row['gg_phantram'] ?>%
                            </small>
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
                                    <!-- giá trước khi sale -->
                                    <div class="footer-label">
                                        <label for="" class="price-old">
                                            <?php echo currency_format($row['sp_gia']) ?>đ
                                        </label>
                                    </div>
                                    <!-- giá sau khi sale -->
                                    <div class="footer-label">
                                        <label for="">
                                            <?php echo currency_format($giamoi) ?>
                                        </label>
                                    </div>
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
                                        <a href="themvaothanhtoan.php?idsp=<?php echo $row['sp_id']; ?>"
                                            title="Mua sản phẩm">
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

        <?php } ?>
    </div>
</div>
<div class="products">
    <a href="sanpham.php">Xem thêm sản phẩm</a>
</div>