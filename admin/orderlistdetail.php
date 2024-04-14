<?php
include_once '../lib/session.php';
Session::checkSession('admin');
$role_id = Session::get('role_id');
if ($role_id != 1) {
    header("Location:../index.php");
    exit(); // Thoát khỏi script để ngăn mã tiếp tục thực thi
}

// Kiểm tra xem orderId được truyền vào qua URL không
if (isset($_GET['orderId']) && !empty($_GET['orderId'])) {
    $orderId = $_GET['orderId'];

    include '../classes/orderDetails.php';
    include '../classes/order.php';

    $orderDetails = new orderDetails();
    $result = $orderDetails->getOrderDetails($orderId);

    if ($result && is_array($result)) { // Kiểm tra xem $result có phải là một mảng hợp lệ không
        $order = new order();
        $order_result = $order->getById($orderId);
    }
}

// Nếu $result không tồn tại hoặc không phải là mảng, hoặc không có dữ liệu
if (!isset($result) || !is_array($result) || empty($result)) {
    $error_message = "Không có đơn hàng nào đang xử lý hoặc dữ liệu không hợp lệ.";
}
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
    <title>Chi tiết đơn đặt hàng</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">ADMIN</label>
        <ul>
            <li><a href="productlist.php">Quản lý Sản phẩm</a></li>
            <li><a href="categoriesList.php">Quản lý Danh mục</a></li>
            <li><a href="orderlist.php" class="active">Quản lý Đơn hàng</a></li>
            <li><a href="logout.php">Đăng xuất</a></li> <!-- Thêm liên kết đăng xuất -->
        </ul>
    </nav>
    <div class="title">
        <h1>Chi tiết đơn đặt hàng <?= isset($order_result['id']) ? $order_result['id'] : "" ?></h1>
    </div>
    <div class="container">
        <?php
        if (isset($error_message)) {
            // Hiển thị thông báo lỗi nếu có
            echo "<h3>$error_message</h3>";
        } elseif ($result) { ?>
            <table class="list">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                </tr>
                <?php $count = 1;
                foreach ($result as $key => $value) { ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?= $value['productName'] ?></td>
                        <td><img class="image-cart" src="uploads/<?= $value['productImage'] ?>" alt=""></td>
                        <td><?= $value['productPrice'] ?></td>
                        <td><?= $value['qty'] ?></td>
                    </tr>
                <?php }
                ?>
            </table>
            <?php
            if (isset($order_result['status']) && $order_result['status'] == 'Processing') { ?>
                <a href="processed_order.php?orderId=<?= $_GET['orderId'] ?>">Xác nhận</a>
            <?php }
            ?>
        <?php } ?>
    </div>
    <footer>
        <p class="copyright">THEZOO @ 2024</p>
    </footer>
</body>

</html>
