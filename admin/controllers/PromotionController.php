<?php
if (!class_exists('PromotionController')) {
    class PromotionController {
        private $promotionModel;
        private $productModel;

        public function __construct() {
            require_once './models/PromotionModel.php';
            $this->promotionModel = new PromotionModel();
            $this->productModel = new Products();
            // Kiểm tra khuyến mãi hết hạn mỗi khi truy cập controller
            $this->promotionModel->checkExpiredPromotions();
        }

        public function index() {
            $promotions = $this->promotionModel->getAllPromotions();
            include 'views/promotions/list.php';
        }

        public function add() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'ten_khuyen_mai' => $_POST['ten_khuyen_mai'],
                    'mo_ta' => $_POST['mo_ta'],
                    'phan_tram_giam' => !empty($_POST['phan_tram_giam']) ? $_POST['phan_tram_giam'] : 0,
                    'giam_gia' => !empty($_POST['giam_gia']) ? $_POST['giam_gia'] : 0,
                    'ngay_bat_dau' => $_POST['ngay_bat_dau'],
                    'ngay_ket_thuc' => $_POST['ngay_ket_thuc']
                ];

                try {
                    $promotionId = $this->promotionModel->addPromotion($data);
                    if ($promotionId && isset($_POST['products'])) {
                        $this->promotionModel->addPromotionProducts($promotionId, $_POST['products']);
                    }
                    
                    $_SESSION['success_message'] = "Thêm khuyến mãi thành công!";
                    header('Location: index.php?act=list-promotions');
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error_message'] = "Có lỗi xảy ra: " . $e->getMessage();
                    header('Location: index.php?act=add-promotion');
                    exit();
                }
            }
            
            $allProducts = $this->productModel->getAllProducts();
            include 'views/promotions/add.php';
        }
        
        public function edit($id) {
            $promotion = $this->promotionModel->getPromotionById($id);
            $allProducts = $this->productModel->getAllProducts();
            
            // Lấy danh sách ID sản phẩm đã được áp dụng khuyến mãi
            $promotionProducts = array_column(
                $this->promotionModel->getPromotionProducts($id), 
                'san_pham_id'
            );
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'ten_khuyen_mai' => $_POST['ten_khuyen_mai'],
                    'mo_ta' => $_POST['mo_ta'],
                    'phan_tram_giam' => !empty($_POST['phan_tram_giam']) ? $_POST['phan_tram_giam'] : null,
                    'giam_gia' => !empty($_POST['giam_gia']) ? $_POST['giam_gia'] : null,
                    'ngay_bat_dau' => $_POST['ngay_bat_dau'],
                    'ngay_ket_thuc' => $_POST['ngay_ket_thuc']
                ];

                try {
                    if ($this->promotionModel->updatePromotion($id, $data)) {
                        if (isset($_POST['products'])) {
                            $this->promotionModel->addPromotionProducts($id, $_POST['products']);
                        }
                        $_SESSION['success_message'] = "Cập nhật khuyến mãi thành công!";
                        header('Location: index.php?act=list-promotions');
                        exit();
                    }
                } catch (Exception $e) {
                    $_SESSION['error_message'] = "Có lỗi xảy ra: " . $e->getMessage();
                    header('Location: index.php?act=edit-promotion&id=' . $id);
                    exit();
                }
            }
            
            include 'views/promotions/edit.php';
        }
        public function delete($id) {
            if ($this->promotionModel->deletePromotion($id)) {
                header('Location: index.php?act=list-promotions');
                exit;
            } else {
                echo "<script>
                    alert('Không thể xóa khuyến mãi đang được áp dụng cho sản phẩm!'); 
                    window.location.href='index.php?act=list-promotions';
                </script>";
            }
        }
    }
} 


