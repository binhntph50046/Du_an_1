<?php
class DashboardController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    public function index() {
        $allOrders = $this->orderModel->getAllOrders();
        $recentOrders = array_slice($allOrders, 0, 5);
        
        $formattedOrders = [];
        foreach ($recentOrders as $order) {
            $statusClass = '';
            switch($order['trang_thai']) {
                case 1: $statusClass = 'warning'; break;
                case 2: $statusClass = 'primary'; break;
                case 3: $statusClass = 'success'; break;
                case 4: $statusClass = 'danger'; break;
            }

            $formattedOrders[] = [
                'id' => $order['don_hang_id'],
                'customer_name' => $order['ten_khach_hang'],
                'product' => $this->getOrderProducts($order['don_hang_id']),
                'product_image' => $this->getFirstProductImage($order['don_hang_id']),
                'total_amount' => number_format($order['tong_tien']) . 'đ',
                'status' => $this->getStatusText($order['trang_thai']),
                'status_class' => $statusClass,
                'created_at' => date('d/m/Y', strtotime($order['ngay_dat']))
            ];
        }

        $recentOrders = $formattedOrders;
        include 'views/layout/static.php';
    }

    private function getOrderProducts($orderId) {
        $orderData = $this->orderModel->getOrderDetail($orderId);
        $products = [];
        foreach ($orderData['items'] as $item) {
            $products[] = $item['ten_san_pham'];
        }
        return implode(', ', $products);
    }

    private function getFirstProductImage($orderId) {
        $orderData = $this->orderModel->getOrderDetail($orderId);
        if (!empty($orderData['items'][0]['hinh'])) {
            return $orderData['items'][0]['hinh'];
        }
        return 'assets/images/no-image.jpg';
    }

    private function getStatusText($status) {
        switch($status) {
            case 1: return 'Chờ xử lý';
            case 2: return 'Đang xử lý';
            case 3: return 'Đã hoàn thành';
            case 4: return 'Đã hủy';
            default: return 'Không xác định';
        }
    }
}