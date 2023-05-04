o<?php
session_start();
include_once('database_connection.php');
switch (isset($_GET['action'])) {
    case "add":
        $result = update_xulygiohang(true);
        echo json_encode(array(
            'status'=>$result,
            'message'=>"Thêm sản phẩm thành công"
        )); 
        break;
    default:
        break;
}

function update_xulygiohang($add = false) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        if ($quantity == 0) {
            unset($_SESSION["xulygiohang"][$id]);
        } else {
            if (!isset($_SESSION["xulygiohang"][$id])) {
                $_SESSION["xulygiohang"][$id] = 0;
            }
            if ($add) {
                $_SESSION["xulygiohang"][$id] += $quantity;
            } else {
                $_SESSION["xulygiohang"][$id] = $quantity;
            }
        }
    }
    return true;
}
