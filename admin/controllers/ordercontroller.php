<?php
class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    public function listOrders() {
        $orders = $this->orderModel->getAllOrders();
        include './views/orders/list.php';
    }

    public function viewOrder() {
        if (isset($_GET['id'])) {
            $order = $this->orderModel->getOrderById($_GET['id']);
            $orderDetails = $this->orderModel->getOrderDetails($_GET['id']);
            include './views/orders/view.php';
        }
    }

    public function updateOrderStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $orderId = $_POST['order_id'];
            $status = $_POST['status'];
            
            try {
                if ($this->orderModel->updateOrderStatus($orderId, $status)) {
                    $_SESSION['success'] = "Cập nhật trạng thái đơn hàng thành công!";
                    header("Location: index.php?act=view-order&id=" . $orderId);
                    exit();
                } else {
                    $_SESSION['error'] = "Không thể cập nhật trạng thái đơn hàng!";
                    header("Location: index.php?act=view-order&id=" . $orderId);
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['error'] = "Có lỗi xảy ra: " . $e->getMessage();
                header("Location: index.php?act=view-order&id=" . $orderId);
                exit();
            }
        }
    }

    public function editOrder() {
        if (isset($_GET['id'])) {
            $order = $this->orderModel->getOrderById($_GET['id']);
            $orderDetails = $this->orderModel->getOrderDetails($_GET['id']);
            include './views/orders/edit.php';
        }
    }

    public function updateOrder() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $orderId = $_POST['order_id'];
            $data = [
                'ho_va_ten' => $_POST['ho_va_ten'],
                'email' => $_POST['email'],
                'so_dien_thoai' => $_POST['so_dien_thoai'],
                'dia_chi' => $_POST['dia_chi'],
                'trang_thai' => $_POST['trang_thai']
            ];
            
            if ($this->orderModel->updateOrder($orderId, $data)) {
                header("Location: index.php?act=view-order&id=" . $orderId);
                exit();
            }
        }
    }

    public function deleteOrder() {
        if (isset($_GET['id'])) {
            $orderId = $_GET['id'];
            try {
                if ($this->orderModel->deleteOrder($orderId)) {
                    $_SESSION['success'] = "Xóa đơn hàng thành công!";
                } else {
                    $_SESSION['error'] = "Không thể xóa đơn hàng!";
                }
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
            header("Location: index.php?act=list-orders");
            exit();
        }
    }
}
?>
