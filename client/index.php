<?php
session_start();
include '../admin/commons/env.php';
include '../admin/commons/function.php';
require_once "./models/pdo.php";
require_once "./models/user.php";
require_once "./models/sanpham.php";
require_once "./models/slide.php";
require_once "./controllers/authController.php";

$authController = new AuthController();
$products = loadAll_sanpham_home();
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
            
        default:
            include "./views/home.php";
            break;
    }
} else {
    include "./views/home.php";
}
