<?php
include_once 'lib/session.php';
Session::checkSession('client');
include_once 'classes/order.php';
$order = new order();
$result = $order->add();
if ($result) {
    echo '<script type="text/javascript">alert("Đặt hàng thành công!"); window.location.href = "index.php";</script>';
    exit; 
} else {
    echo '<script type="text/javascript">alert("Đặt hàng thất bại!"); window.history.back();</script>';
    exit; 
}
?>
