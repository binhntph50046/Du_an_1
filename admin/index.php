<?php
$act = isset($_GET['act']) ? $_GET['act'] : 'static';

include '../admin/commons/env.php';
include '../admin/commons/function.php';
include '../admin/controllers/categoryController.php';
include '../admin/models/Category.php';
include '../admin/controllers/slideController.php';
include '../admin/models/Slide.php';
include '../admin/models/products.php';
include '../admin/controllers/productsController.php';
include '../admin/controllers/userController.php';
include '../admin/controllers/OrderController.php';
include '../admin/models/users.php';
include '../admin/models/OrderModel.php';
include '../admin/controllers/commentController.php';
include '../admin/models/comment.php';
include './views/layout/header.php';


$userController = new UserController();
$orderController = new OrderController();
$productsController = new ProductsController();
$categoryController = new CategoryController();
$slideController = new SlideController();
$commentController = new commentController();

switch ($act) {
   case 'static':
      include './views/layout/static.php';
      break;
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

   case 'list-slide':
      $slideController->listSlide();
      break;
   case 'form-add-slide':
      $slideController->formAddSlide();
      break;
   case 'post-add-slide':
      $slideController->postAddSlide();
      break;
   case 'form-edit-slide':
      $slideController->formEditSlide();
      break;
   case 'post-edit-slide':
      $slideController->postEditSlide();
      break;
   case 'delete-slide':
      $slideController->postDeleteSlide();
      break;
   case 'listProducts':
      $productsController->listProducts();
      break;
   case 'formAddProducts':
      $productsController->formAddProducts();
      break;
   case 'postFormAdd':
      $productsController->postFormAdd();
      break;
   case 'deleteProduct':
      $productsController->deleteProduct($_GET['id']);
      break;
   case 'formEditProducts':
      $productsController->formEditProducts();
      break;
   case 'updateProduct':
      $productsController->updateProduct();
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

      // Comment
   case 'listComments':
      $commentController->listComment();
      break;
   case 'deleteComments':
      $commentController->deleteComments($_GET['id']);
      break;
   default:
      break;
}
include './views/layout/footer.php';
