<?php
// Đảm bảo rằng người dùng đã đăng nhập và có session
include_once 'lib/session.php';
Session::checkSession('client');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://use.fontawesome.com/2145adbb48.js"></script>
    <script src="https://kit.fontawesome.com/a42aeb5b72.js" crossorigin="anonymous"></script>
    <title>Xác nhận đơn hàng</title>
</head>

<body>
    <h1>Xác nhận đơn hàng</h1>
    <form action="process_order.php" method="post">
        <label for="address">Địa chỉ nhận hàng:</label><br>
        <textarea id="address" name="address" rows="4" cols="50" required></textarea><br><br>

        <label for="payment_method">Phương thức thanh toán:</label><br>
        <select id="payment_method" name="payment_method" onchange="redirectToPayment(this.value)" required>
            <option value="cash">Thanh toán khi nhận hàng</option>
            <option value="online">Thanh toán trực tuyến</option>
        </select>

        <script>
    function redirectToPayment(paymentMethod) {
        if (paymentMethod === "online") {
        window.location.href = "online_payment.php"; // Đường dẫn của trang thanh toán trực tuyến
    }}
    </script>
        <input type="submit" value="Xác nhận đơn hàng" formaction="add_order.php">
    </form>
</body>
</html>
