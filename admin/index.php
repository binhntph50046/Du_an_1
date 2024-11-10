<?php

$act = isset($_GET['act']) ? $_GET['act'] : '/';
include '../admin/commons/env.php';
include '../admin/commons/function.php';

include '../admin/controllers/categoryController.php';

include '../admin/models/Category.php';

include './views/layout/header.php';
include './views/layout/sidebar.php';


$categoryController = new CategoryController();

switch ($act) {
    case 'list-category':
        $categoryController->listCategory();
        break;
    case 'form-add-category':
        $categoryController->formAddCategory();
        break;
    case 'post-add-category':
        $categoryController->postAddCategory();
        break;
    case 'form-edit-category':
        $categoryController->formEditCategory();
        break;
    case 'post-edit-category':
        $categoryController->postEditCategory();
        break;
    case 'delete-category':
        $categoryController->postDeleteCategory();
        break;
    default:
        include './views/layout/main.php';
        break;
}

include './views/layout/footer.php';
