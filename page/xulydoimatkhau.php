<?php
session_start();
include_once('database_connection.php');

$matkhaumoi = isset($_POST['mknew']) ? $_POST['mknew'] : "";
$idtk = isset($_POST['idtk']) ? $_POST['idtk'] : "";

mysqli_query($cn, "UPDATE taikhoan SET tk_matkhau = '$matkhaumoi'  WHERE tk_id = $idtk");
?>

<script>
alert('Doi mat khau thanh cong')
document.getElementById('mk1').value = "";
document.getElementById('mk2').value = "";
document.getElementById('nlmk').value = "";
</script>