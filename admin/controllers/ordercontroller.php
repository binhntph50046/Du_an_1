<?php
class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    // Hiển thị danh sách đơn hàng
    public function index() {
        $orders = $this->orderModel->getAllOrders();
        include 'views/orders/list.php';
    }

    // Xem chi tiết đơn hàng
    public function view($id) {
        $orderData = $this->orderModel->getOrderDetail($id);
        include 'views/orders/view.php';
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus() {
        if(isset($_POST['order_id']) && isset($_POST['status'])) {
            $orderId = $_POST['order_id'];
            $status = $_POST['status'];
            
            $this->orderModel->updateOrderStatus($orderId, $status);
        }
        header("Location: index.php?act=list-orders");
        exit();
    }

    // Xóa đơn hàng
    public function deleteOrder() {
        if(isset($_POST['order_id'])) {
            $orderId = $_POST['order_id'];
            $this->orderModel->deleteOrder($orderId);
            header("Location: index.php?act=list-orders");
            exit();
        }
    }
}
