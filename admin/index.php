<?php
$act = isset($_GET['act']) ? $_GET['act'] : 'thongke';
include '../admin/commons/env.php';
include '../admin/commons/function.php';
include '../admin/models/users.php';
include '../admin/models/CommentModel.php';
include '../admin/models/ProductModel.php';
include '../admin/models/OrderModel.php';
include '../admin/controllers/userController.php';
include '../admin/controllers/CommentController.php';
include '../admin/controllers/OrderController.php';
include 'views/layout/header.php';
include 'views/layout/sidebar.php';
$userController = new UserController();
$commentController = new CommentController();
$orderController = new OrderController();

switch ($act) {
    case 'thongke':
        include "views/layout/thongke.php";
        break;
    case 'listUser':
        $userController->listUser();
        break;
    case 'create':
        $userController->create();
        break;
    case 'updateUser':
        $userController->edit($_GET['id']);
        break;
    case 'delete':
        $userController->delete($_GET['id']);
        break;
    case 'comments':
        $commentController->index();
        include "views/comments/listComment.php";
        break;
    case 'approveComment':
        $commentController->approve();
        break;
    case 'rejectComment':
        $commentController->reject();
        break;
    case 'deleteComment':
        $commentController->delete();
        break;
    case 'orders':
        $orderController->index();
        break;
    case 'viewOrder':
        $orderController->view($_GET['id']);
        break;
    case 'updateOrderStatus':
        $orderController->updateStatus();
        break;
    case 'deleteOrder':
        $orderController->delete($_GET['id']);
        break;
    default:
        include "views/layout/main.php";
        echo "Trang không tồn tại.";
        break;
}

