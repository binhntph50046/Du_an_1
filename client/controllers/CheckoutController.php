<?php
require_once 'models/OrderModel.php';

class CheckoutController {
    private $orderModel;
    
    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    public function checkout() {
        if (!isset($_SESSION['email'])) {
            header('Location: ?act=login');
            exit;
        }

        if (isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            $product = $this->getProductById($product_id);
            
            include "views/checkout.php";
        }
    }

    public function placeOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $orderData = [
                    'tai_khoan_id' => $_SESSION['email']['tai_khoan_id'],
                    'ho_va_ten' => $_POST['customer_name'],
                    'email' => $_POST['customer_email'],
                    'so_dien_thoai' => $_POST['customer_phone'],
                    'dia_chi' => $_POST['customer_address'],
                    'san_pham_id' => $_POST['product_id'],
                    'gia' => $_POST['product_price'],
                    'so_luong' => $_POST['quantity'],
                    'tong_tien' => $_POST['product_price'] + 30000,
                    'payment_method' => $_POST['payment_method']
                ];

                $order_id = $this->orderModel->createOrder($orderData);

                if ($order_id) {
                    $_SESSION['email']['ho_va_ten'] = $_POST['customer_name'];
                    $_SESSION['email']['email'] = $_POST['customer_email'];
                    $_SESSION['email']['so_dien_thoai'] = $_POST['customer_phone'];
                    $_SESSION['email']['dia_chi'] = $_POST['customer_address'];
                    
                    header("Location: ?act=order-success&id=" . $order_id);
                    exit;
                } else {
                    throw new Exception("Không thể tạo đơn hàng");
                }
            } catch (Exception $e) {
                error_log($e->getMessage());
                $_SESSION['error'] = "Có lỗi xảy ra khi đặt hàng: " . $e->getMessage();
                header('Location: ?act=checkout');
                exit;
            }
        }
    }

    private function getProductById($id) {
        $conn = connectDB();
        $sql = "SELECT sp.*, hasp.hinh_sp 
                FROM san_pham sp
                LEFT JOIN hinh_anh_san_pham hasp ON sp.san_pham_id = hasp.san_pham_id 
                WHERE sp.san_pham_id = :id
                LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
} 