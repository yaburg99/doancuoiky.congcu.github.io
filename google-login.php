require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('YOUR_CLIENT_ID_HERE');
$client->setClientSecret('YOUR_CLIENT_SECRET_HERE');
$client->setRedirectUri('YOUR_REDIRECT_URI_HERE');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Lấy thông tin người dùng từ Google
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;

    // Xử lý đăng nhập tại đây
    $_SESSION['email'] = $email;
    // Chuyển hướng người dùng về trang đích sau khi đăng nhập thành công
    header('Location: home.php');
    exit();
} else {
    $login_url = $client->createAuthUrl();
    header("Location: $login_url");
    exit();
}
