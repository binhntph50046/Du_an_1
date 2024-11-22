<?php
session_start();
include '../admin/commons/env.php';
include '../admin/commons/function.php';
require_once "./models/pdo.php";
require_once "./models/user.php";
require_once "./models/sanpham.php";
require_once "./models/slide.php";
require_once "./controllers/authController.php";
require_once "./models/binhluan.php";


$authController = new AuthController();
$products = loadAll_sanpham_home();
$dstop10 = loadAll_sanpham_top10();
$listSlides = getSlides();

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'register':
            $authController->register();
            break;

        case 'login':
            $authController->login();
            break;

        case 'logout':
            $authController->logout();
            break;

        case 'forgot-password':
            $authController->forgotPassword();
            break;

        case 'product-detail':
            if (isset($_GET['id'])) {
                $product = getProductById($_GET['id']);
                include "./views/product-detail.php";
            }
            break;

        case 'comment':
            if (isset($_SESSION['email']) && isset($_POST['san_pham_id']) && isset($_POST['noi_dung'])) {
                $san_pham_id = $_POST['san_pham_id'];
                $tai_khoan_id = $_SESSION['email']['tai_khoan_id'];
                $noi_dung = $_POST['noi_dung'];

                themBinhLuan($san_pham_id, $tai_khoan_id, $noi_dung);
                header("Location: ?act=product-detail&id=" . $san_pham_id);
            }
            break;
        default:
            include "./views/home.php";
            break;
    }
} else {
    include "./views/home.php";
}
