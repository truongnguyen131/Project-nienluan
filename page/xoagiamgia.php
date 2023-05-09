<?php
session_start();
include_once('database_connection.php');
$arr_idsp = isset($_POST['data']) ? $_POST['data'] : "";

foreach ($arr_idsp as $key => $value) {
    $idsp = $value;
    mysqli_query($cn, "DELETE FROM `giamgia` WHERE sp_id = $idsp")or die();
}

?>
<script>
    alert("Xóa thành công")
    $('input:checkbox[name=chon_gg]').each(function () {
        if ($(this).is(':checked'))
            $(this).prop("checked", false);
    });
    document.getElementById('bntHuyGG').click()
</script>