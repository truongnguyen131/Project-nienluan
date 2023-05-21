<?php
session_start();
include_once('database_connection.php');

$arr_idsp = isset($_POST['arr_idsp']) ? $_POST['arr_idsp'] : "";
$nbd = isset($_POST['nbd']) ? $_POST['nbd'] : "";
$nkt = isset($_POST['nkt']) ? $_POST['nkt'] : "";
$ptgg = isset($_POST['ptgg']) ? $_POST['ptgg'] : "";


    foreach ($arr_idsp as $key => $value) {
        $idsp = $value;
        mysqli_query($cn, "INSERT INTO `giamgia`(`gg_phantram`, `gg_ngaybatdau`, `gg_ngayketthuc`, `sp_id`) VALUES 
        ('$ptgg ','$nbd','$nkt','$idsp')") or die();
    }


?>

<script>
alert('Cập nhật thành công')
$('input:checkbox[name=chon_gg]').each(function() {
    if ($(this).is(':checked'))
        $(this).prop('checked', false);
});
document.getElementById('bntHuyGG').click()
</script>