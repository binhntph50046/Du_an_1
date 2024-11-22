<?php
class OrderController {
    public function getMyOrders() {
        if (!isset($_SESSION['email'])) {
            header('Location: ?act=login');
            exit;
        }

        $user_id = $_SESSION['email']['tai_khoan_id'];
        $conn = connectdb();
        
        $sql = "SELECT dh.*, ct.san_pham_id, ct.so_luong, ct.gia, sp.ten_san_pham, hasp.hinh_sp
                FROM don_hang dh 
                JOIN chi_tiet_don_hang ct ON dh.don_hang_id = ct.don_hang_id 
                JOIN san_pham sp ON ct.san_pham_id = sp.san_pham_id 
                LEFT JOIN hinh_anh_san_pham hasp ON sp.san_pham_id = hasp.san_pham_id 
                WHERE dh.tai_khoan_id = ? 
                GROUP BY ct.chi_tiet_don_hang_id
                ORDER BY dh.ngay_dat DESC";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $orders = [];
        foreach ($results as $row) {
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
                'ma_sp' => $row['san_pham_id'],
                'ten_sp' => $row['ten_san_pham'],
                'hinh' => $row['hinh_sp'],
                'so_luong' => $row['so_luong'],
                'gia' => $row['gia']
            ];
        }
        
        $orders = array_values($orders);
        include 'views/my-orders.php';
    }
}
?> 