<?php
session_start();
session_destroy();
if (isset($_COOKIE['ntk']) &&  $_COOKIE['ntk'] == "chuacheck") {
    setcookie("taikhoan", "", time() -3600);
    setcookie("matkhau", "", time() - 3600);
}
header("location:index2.php");
?>