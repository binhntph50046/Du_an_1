<?php
class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }
   // Tạo mảng $filters chứa các điều kiện lọc từ $GET
    public function index() {
        $filters = [
            'status' => $_GET['status'] ?? '',
            'date_from' => $_GET['date_from'] ?? '',
            'date_to' => $_GET['date_to'] ?? ''
        ];
        
        $orders = $this->orderModel->getAll($filters);
        include './views/orders/list.php';
    }

    public function view($id) {
        $order = $this->orderModel->getById($id);
        $orderDetails = $this->orderModel->getOrderDetails($id);
        include './views/orders/view.php';
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'];
            $status = $_POST['status'];
            
            if ($this->orderModel->updateStatus($orderId, $status)) {
                $_SESSION['success'] = "Cập nhật trạng thái đơn hàng thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật trạng thái!";
            }
        }
        header("Location: index.php?act=orders");
        exit();
    }

    public function delete($id) {
        if ($this->orderModel->delete($id)) {
            $_SESSION['success'] = "Xóa đơn hàng thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi xóa đơn hàng!";
        }
        header("Location: index.php?act=orders");
        exit();
    }
}
?>
