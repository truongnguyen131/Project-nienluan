<?php
include_once('database_connection.php');
session_start();
$page = isset($_POST['page']) ? $_POST['page'] : "";
$tensp = isset($_POST['tensp']) ? $_POST['tensp'] : "";
$ngayphathanh = isset($_POST['nph']) ? $_POST['nph'] : "";
$mota = isset($_POST['motasp']) ? $_POST['motasp'] : "";
$gia = isset($_POST['giasp']) ? $_POST['giasp'] : "";
$theloai = isset($_POST['theloaisp']) ? $_POST['theloaisp'] : "";
$idnsx = isset($_POST['p_nsx']) ? $_POST['p_nsx'] : "";
$imgavt = isset($_POST['imgavt']) ? $_POST['imgavt'] : "";
$source = isset($_POST['source']) ? $_POST['source'] : "";
$trailer = isset($_POST['trailer']) ? $_POST['trailer'] : "";
$igl_name = isset($_POST['igl_name']) ? $_POST['igl_name'] : "";
$idtaikhoan = $_SESSION["idtaikhoan"];
$target_dir = "../uploads/";

if (isset($_FILES["source"]["tmp_name"])) {
    move_uploaded_file($_FILES["source"]["tmp_name"], $target_dir . $_FILES["source"]["name"]);
    move_uploaded_file($_FILES["imgavt"]["tmp_name"], $target_dir . $_FILES["imgavt"]["name"]);
    move_uploaded_file($_FILES["trailer"]["tmp_name"], $target_dir . $_FILES["trailer"]["name"]);
    for ($i = 0; $i < count($_FILES['igl']['name']); $i++) {
        move_uploaded_file($_FILES['igl']['tmp_name'][$i], $target_dir . $_FILES['igl']['name'][$i]);
    }
}

if ($page == "themSP") {
    $sql = "INSERT INTO `sanpham`(`sp_tengame`, `sp_imgavt`, `sp_file`, `sp_mota`, `sp_trailer`, `sp_gia`, `sp_ngayphathanh`, `nsx_id`, `sp_trangthai`, `nguoi_duyet`) VALUES 
('$tensp','$imgavt','$source','$mota','$trailer','$gia', '$ngayphathanh','$idnsx', 'duyet', '$idtaikhoan')";

    mysqli_query($cn, $sql);
    $id_sp = mysqli_insert_id($cn);
    for ($i = 0; $i < count($igl_name); $i++) {
        $valueimgs = $igl_name[$i];
        mysqli_query($cn, "INSERT INTO `anhgameplay`(`sp_id`, `agl_ten`) VALUES ('$id_sp','$valueimgs')");
    }
    for ($i = 0; $i < count($theloai); $i++) {
        mysqli_query($cn, "INSERT INTO `sanphamtheloai`(`sptl_id`, `sp_id`, `tl_id`) VALUES ('',$id_sp,'$theloai[$i]')");
    }
    $_SESSION['dangkythanhcong'] = "themSP";
}

if ($page == "capNhatSP") {
    $idsp = $_SESSION['sanphamUpdate'];
    $sqlD = "DELETE FROM `sanpham` WHERE sp_id = $idsp";
    mysqli_query($cn, $sqlD);
    $sql = "INSERT INTO `sanpham`(`sp_id`,`sp_tengame`, `sp_imgavt`, `sp_file`, `sp_mota`, `sp_trailer`, `sp_gia`, `sp_ngayphathanh`, `nsx_id`, `sp_trangthai`, `nguoi_duyet`) VALUES 
    ($idsp,'$tensp','$imgavt','$source','$mota','$trailer','$gia', '$ngayphathanh','$idnsx', 'duyet', '$idtaikhoan')";
    mysqli_query($cn, $sql);
    $id_sp = mysqli_insert_id($cn);
    for ($i = 0; $i < count($igl_name); $i++) {
        $valueimgs = $igl_name[$i];
        mysqli_query($cn, "INSERT INTO `anhgameplay`(`sp_id`, `agl_ten`) VALUES ('$id_sp','$valueimgs')");
    }
    for ($i = 0; $i < count($theloai); $i++) {
        mysqli_query($cn, "INSERT INTO `sanphamtheloai`(`sptl_id`, `sp_id`, `tl_id`) VALUES ('',$id_sp,'$theloai[$i]')");
    }
    $_SESSION['dangkythanhcong'] = "capNhatSP";
}
?>
<script>
window.location.reload();
</script>