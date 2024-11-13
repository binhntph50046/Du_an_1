<?php
class HomeController {
    private $conn;
    private $productModel;
    
    public function __construct($conn) {
        $this->conn = $conn;
        $this->productModel = new ProductModel($conn);
    }
    
    public function index() {
        $newProducts = $this->productModel->getAllProducts();
        $topProducts = $this->productModel->getTopProducts();
        
        include "./views/home.php";
    }
} 
?>