<?php
// Kiểm tra xem request có phải là POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Đảm bảo rằng đã bắt đầu phiên làm việc
    session_start();

    // Include các file cần thiết
    include_once 'lib/session.php';
    include_once 'classes/order.php';

    // Kiểm tra xem phiên làm việc đã được kiểm tra chưa
    Session::checkSession('client');

    // Lấy thông tin từ request POST
    $address = $_POST['address'];
    $paymentMethod = $_POST['payment_method'];

    // Tạo một đối tượng order
    $order = new Order();

    // Thực hiện thêm đơn hàng
    $result = $order->add($address, $paymentMethod);

    // Kiểm tra kết quả
    if ($result) {
        // Đặt hàng thành công, chuyển hướng về trang chủ hoặc trang thông báo thành công
        header("Location: index.php");
        exit;
    } else {
        // Đặt hàng thất bại, chuyển hướng về trang trước đó hoặc trang thông báo thất bại
        header("Location: previous_page.php");
        exit;
    }
} else {
    // Nếu không phải là request POST, chuyển hướng về trang chủ hoặc trang lỗi
    header("Location: index.php");
    exit;
}
?>
