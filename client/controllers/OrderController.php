<?php
class OrderController {
    public function checkout() {
        if (!isset($_SESSION['email'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để mua hàng";
            header('Location: ?act=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy-now'])) {
            $san_pham_id = $_POST['san_pham_id'];
            $so_luong = $_POST['so_luong'];
            
            // Lấy thông tin sản phẩm
            $product = getProductById($san_pham_id);
            if (!$product) {
                $_SESSION['error'] = "Không tìm thấy sản phẩm";
                header('Location: index.php');
                exit;
            }

            include "./views/checkout.php";
        }
    }

    public function placeOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_data = [
                'tai_khoan_id' => $_SESSION['email']['tai_khoan_id'],
                'ho_va_ten' => $_POST['ho_va_ten'],
                'email' => $_POST['email'],
                'so_dien_thoai' => $_POST['so_dien_thoai'],
                'dia_chi' => $_POST['dia_chi'],
                'phuong_thuc_thanh_toan' => $_POST['phuong_thuc_thanh_toan'],
                'tong_tien' => ($_POST['gia'] * $_POST['so_luong']) + 30000 // Cộng thêm phí ship
            ];

            $order_id = createOrder($order_data);

            if ($order_id) {
                $order_detail = [
                    'don_hang_id' => $order_id,
                    'san_pham_id' => $_POST['san_pham_id'],
                    'so_luong' => $_POST['so_luong'],
                    'gia' => $_POST['gia']
                ];

                if (createOrderDetail($order_detail)) {
                    $_SESSION['success'] = "Đặt hàng thành công!";
                    header('Location: ?act=my-orders');
                    exit;
                }
            }

            $_SESSION['error'] = "Có lỗi xảy ra, vui lòng thử lại!";
            header('Location: ?act=checkout');
        }
    }

    public function getMyOrders() {
        if (!isset($_SESSION['email'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để xem đơn hàng";
            header('Location: ?act=login');
            exit;
        }

        $tai_khoan_id = $_SESSION['email']['tai_khoan_id'];
        $orders = [];

        try {
            $pdo = pdo_get_connection();
            
            $sql = "SELECT dh.*, ct.san_pham_id, ct.so_luong, ct.gia, sp.ten_san_pham, hasp.hinh_sp     
                    FROM don_hang dh 
                    JOIN chi_tiet_don_hang ct ON dh.don_hang_id = ct.don_hang_id 
                    JOIN san_pham sp ON ct.san_pham_id = sp.san_pham_id 
                    LEFT JOIN hinh_anh_san_pham hasp ON sp.san_pham_id = hasp.san_pham_id 
                    WHERE dh.tai_khoan_id = ? 
                    GROUP BY ct.chi_tiet_don_hang_id
                    ORDER BY dh.ngay_dat DESC";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$tai_khoan_id]);
            
            while ($row = $stmt->fetch()) {
                if (!isset($orders[$row['don_hang_id']])) {
                    $orders[$row['don_hang_id']] = [
                        'ma_don_hang' => $row['don_hang_id'],
                        'ngay_dat' => $row['ngay_dat'],
                        'trang_thai' => $row['trang_thai'],
                        'tong_tien' => $row['tong_tien'],
                        'products' => []
                    ];
                }
                
                $orders[$row['don_hang_id']]['products'][] = [
                    'ten_san_pham' => $row['ten_san_pham'],
                    'hinh_sp' => $row['hinh_sp'],
                    'so_luong' => $row['so_luong'],
                    'gia' => $row['gia']
                ];
            }
        } catch(PDOException $e) {
            $_SESSION['error'] = "Có lỗi xảy ra khi lấy thông tin đơn hàng";
        }

        include "./views/my-orders.php";
    }
}
