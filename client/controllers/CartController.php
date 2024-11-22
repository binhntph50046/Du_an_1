<?php
require_once './models/cart.php';
require_once 'models/user.php';

class CartController {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new Cart();
    }

    public function addToCart() {
        if (!isset($_SESSION['email']) || !isset($_SESSION['email']['tai_khoan_id'])) {
            $_SESSION['error'] = 'Vui lòng đăng nhập để thêm vào giỏ hàng';
            header('Location: ?act=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userModel = new User();
                $user = $userModel->getUserByEmail($_SESSION['email']['email']);
                
                if (!$user) {
                    throw new Exception('Tài khoản không tồn tại');
                }

                $tai_khoan_id = $user['tai_khoan_id'];
                $san_pham_id = isset($_POST['san_pham_id']) ? (int)$_POST['san_pham_id'] : 0;
                $ram_id = isset($_POST['ram_id']) ? (int)$_POST['ram_id'] : 0;
                $so_luong = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 1;

                if ($san_pham_id <= 0 || $ram_id <= 0 || $so_luong <= 0) {
                    throw new Exception('Vui lòng chọn đầy đủ thông tin sản phẩm');
                }

                $result = $this->cartModel->addToCart($tai_khoan_id, $san_pham_id, $ram_id, $so_luong);

                if (!$result) {
                    throw new Exception('Có lỗi xảy ra khi thêm vào giỏ hàng');
                }

                $_SESSION['success'] = 'Thêm vào giỏ hàng thành công';
                if (isset($_POST['buy-now'])) {
                    header('Location: ?act=checkout');
                } else {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
                exit();
                
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function showCart() {
        if (!isset($_SESSION['email'])) {
            $_SESSION['error'] = 'Vui lòng đăng nhập để xem giỏ hàng';
            header('Location: ?act=login');
            return;
        }
        
        $cartItems = $this->cartModel->getCartItems($_SESSION['email']['tai_khoan_id']);
        include 'views/cart/cart.php';
    }

    public function updateCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $cartId = $data['cart_id'];
            $quantity = $data['quantity'];
            
            $result = $this->cartModel->updateCartQuantity($cartId, $quantity);
            
            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
            exit();
        }
    }

    public function removeCartItem() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $cartId = $data['cart_id'];
            
            $result = $this->cartModel->removeCartItem($cartId);
            
            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
            exit();
        }
    }

    public function getCartItems() {
        if (!isset($_SESSION['email'])) {
            return [];
        }
        return $this->cartModel->getCartItems($_SESSION['email']['tai_khoan_id']);
    }
}
?> 