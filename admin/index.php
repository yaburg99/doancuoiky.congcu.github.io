<?php
include '../lib/session.php';
Session::checkSession('admin');
$role_id = Session::get('role_id');
if ($role_id == 1) {
    header("Location:productlist.php");
} else {
    header("Location:../index.php");
}
// Kiểm tra xem người dùng đã đăng nhập và có phải là admin hay không
if (!Session::get('user') || Session::get('role_id') != 1) {
    header("Location: index.php"); // Chuyển hướng người dùng nếu không phải admin hoặc chưa đăng nhập
    exit;
}

// Code của trang admin tiếp theo...
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
    <title>Admin</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">ADMIN</label>
        <ul>
            <li><a href="productlist.php" class="active">Quản lý Sản phẩm</a></li>
            <li><a href="orderlist.php" id="order">Quản lý Đơn hàng</a></li>
            <li><a href="logout.php">Đăng xuất</a></li> <!-- Thêm liên kết đăng xuất -->
        </ul>
    </nav>
    

    <footer>
        <div class="social">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
        <ul class="list">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Product</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
            <li>
                <a href="#">About</a>
            </li>
        </ul>
        <p class="copyright">THEZOO @ 2024</p>
    </footer>
</body>

</html>