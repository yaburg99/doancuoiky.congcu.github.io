<?php
// Bắt đầu session
session_start();

// Xóa tất cả các session
session_unset();

// Hủy session
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập
header("Location: ../login.php");
exit;
?>
