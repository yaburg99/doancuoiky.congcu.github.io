<?php
include_once 'lib/session.php';
Session::checkSession('client');
include_once 'classes/cart.php';
include_once 'classes/user.php';

$cart = new cart();
$list = $cart->get();
$totalPrice = $cart->getTotalPriceByUserId();
$totalQty = $cart->getTotalQtyByUserId();

$user = new user();
$userInfo = $user->get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán trực tuyến</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .options {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #ddd;
        }
        #qrCodeContainer {
            display: none;
            text-align: center;
        }
        .qrCode {
            margin: 10px;
            max-width: 600px; /* Giới hạn chiều rộng tối đa của hình ảnh */
            max-height: 600px; /* Giới hạn chiều cao tối đa của hình ảnh */
        }
        #paymentCode {
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chọn phương thức thanh toán</h1>
        <div class="options">
            <button class="button" onclick="showQRCode('momo')" style="background-color: #FF5722; color: #fff;">Thanh toán bằng MoMo</button>
            <button class="button" onclick="showQRCode('zalopay')" style="background-color: #03A9F4; color: #fff;">Thanh toán bằng ZaloPay</button>
        </div>

        <div id="qrCodeContainer" style="display: none;">
            <h2 id="qrTitle"></h2>
            <div id="qrCode" class="qrCode"></div>
            <p id="paymentCode"></p>
            <p id="accountInfo"></p>
            <form id="paymentForm" action="online_payment_confirm.php" method="post">
                <input type="hidden" name="address" value="<?php echo $userInfo['address']; ?>">
                <input type="hidden" name="payment_method" id="paymentMethod" value="">
                <button type="submit" style="background-color: #4CAF50; color: #fff;">Xác nhận thanh toán</button>
            </form>
        </div>
    </div>

    <script>
        function showQRCode(method) {
            var qrTitle = document.getElementById('qrTitle');
            var qrCode = document.getElementById('qrCode');
            var paymentCode = document.getElementById('paymentCode');
            var accountInfo = document.getElementById('accountInfo');
            var paymentMethodInput = document.getElementById('paymentMethod');

            if (method === 'momo') {
                qrTitle.textContent = 'MoMo QR Code';
                qrCode.innerHTML = '<img src="momo_qr_code.jpg" alt="MoMo QR Code" class="qrCode">';
                paymentCode.textContent = 'Mã thanh toán MoMo: Thezookb99';
                accountInfo.textContent = 'Tên chủ tài khoản: Nguyễn Thành Long';
                paymentMethodInput.value = 'momo';
            } else if (method === 'zalopay') {
                qrTitle.textContent = 'ZaloPay QR Code';
                qrCode.innerHTML = '<img src="zalopay_qr_code.jpg" alt="ZaloPay QR Code" class="qrCode">';
                paymentCode.textContent = 'Mã thanh toán ZaloPay: Thezookeyboard';
                accountInfo.textContent = 'Tên chủ tài khoản: Nguyễn Thành Long';
                paymentMethodInput.value = 'zalopay';
            }

            document.getElementById('qrCodeContainer').style.display = 'block';
        }
    </script>
</body>
</html>



