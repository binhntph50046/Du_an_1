<?php
ob_start();

   $act = isset($_GET['act']) ?$_GET['act'] :'/';

   include '../admin/commons/env.php';
   include '../admin/commons/function.php';
   include '../admin/models/products.php';
   include '../admin/controllers/productsController.php';
   include './views/layout/header.php';
   include './views/layout/sidebar.php';


   $productsController = new ProductsController();


   switch($act) {
      
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
         $productsController->deleteProduct();
         break;
      case 'formEditProducts':
         $productsController->formEditProducts();
         break;
      case 'updateProduct':
         $productsController->updateProduct();
         break;
      default:
         include './views/layout/main.php';
         break;
      
         
   }





?>