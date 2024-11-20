<?php

class OrderModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAllOrders() {
        $sql = "SELECT dh.*, tk.ho_va_ten, tk.email, tk.so_dien_thoai,
                COUNT(ctdh.chi_tiet_don_hang_id) as so_san_pham
                FROM don_hang dh
                LEFT JOIN tai_khoan tk ON dh.tai_khoan_id = tk.tai_khoan_id
                LEFT JOIN chi_tiet_don_hang ctdh ON dh.don_hang_id = ctdh.don_hang_id
                GROUP BY dh.don_hang_id
                ORDER BY dh.ngay_dat DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy chi tiết một đơn hàng
    public function getOrderDetail($id) {
        $sql = "SELECT dh.*, tk.ho_va_ten, tk.email, tk.so_dien_thoai, tk.dia_chi 
                FROM don_hang dh
                JOIN tai_khoan tk ON dh.tai_khoan_id = tk.tai_khoan_id
                WHERE dh.don_hang_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($order) {
            $sql = "SELECT ctdh.*, sp.ten_san_pham, MIN(hasp.hinh_sp) as hinh
                    FROM chi_tiet_don_hang ctdh
                    JOIN san_pham sp ON ctdh.san_pham_id = sp.san_pham_id
                    LEFT JOIN hinh_anh_san_pham hasp ON sp.san_pham_id = hasp.san_pham_id
                    WHERE ctdh.don_hang_id = ?
                    GROUP BY ctdh.chi_tiet_don_hang_id, ctdh.don_hang_id, ctdh.san_pham_id, 
                             ctdh.so_luong, ctdh.gia, sp.ten_san_pham";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Tính tổng tiền cho từng item
            foreach ($items as &$item) {
                $giaSauKM = $item['gia']; // Default to original price if no discount
                if (isset($item['khuyen_mai'])) {
                    $giaSauKM = $item['gia'] * (1 - $item['khuyen_mai'] / 100);
                }
                $item['tong_tien'] = $giaSauKM * $item['so_luong'];
            }
            
            return [
                'order' => $order,
                'items' => $items
            ];
        }
        return null;
    }

    // Lấy phương thức thanh toán
    public function getPaymentMethod($orderId) {
        $sql = "SELECT phuong_thuc_thanh_toan FROM don_hang WHERE don_hang_id = $orderId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['phuong_thuc_thanh_toan'];
    }
    public function updateOrderStatus($orderId, $status) {
        // Kiểm tra phương thức thanh toán
        $paymentMethod = $this->getPaymentMethod($orderId);
        if ($paymentMethod == 'online' && $status == 2) {
            $status = 3;
        }
        $sql = "UPDATE don_hang 
                SET trang_thai = $status, ngay_xu_ly = CURRENT_DATE 
                WHERE don_hang_id = $orderId";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    public function deleteOrder($orderId) {
        // Xóa chi tiết đơn hàng trước
        $sql1 = "DELETE FROM chi_tiet_don_hang WHERE don_hang_id = $orderId";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute();
        // Sau đó xóa đơn hàng
        $sql2 = "DELETE FROM don_hang WHERE don_hang_id = $orderId";
        $stmt2 = $this->conn->prepare($sql2);
        return $stmt2->execute();
    }
    public function getOrdersByUserId($userId) {
        $sql = "SELECT dh.*, COUNT(ctdh.don_hang_id) as total_items 
                FROM don_hang dh 
                LEFT JOIN chi_tiet_don_hang ctdh ON dh.don_hang_id = ctdh.don_hang_id 
                WHERE dh.tai_khoan_id = $userId 
                GROUP BY dh.don_hang_id 
                ORDER BY dh.ngay_dat DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchOrders($keyword) {
        $sql = "SELECT dh.*, tk.ho_va_ten, tk.email, tk.so_dien_thoai,
                COUNT(ctdh.chi_tiet_don_hang_id) as so_san_pham
                FROM don_hang dh
                LEFT JOIN tai_khoan tk ON dh.tai_khoan_id = tk.tai_khoan_id
                LEFT JOIN chi_tiet_don_hang ctdh ON dh.don_hang_id = ctdh.don_hang_id
      
                WHERE dh.don_hang_id LIKE :keyword 
                OR tk.ho_va_ten LIKE :keyword 
                OR tk.email LIKE :keyword
                OR tk.so_dien_thoai LIKE :keyword
                GROUP BY dh.don_hang_id
                ORDER BY dh.ngay_dat DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':keyword' => "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderDetails($orderId) {
        $sql = "SELECT ct.*, sp.ten_san_pham, sp.gia, km.phan_tram_giam,
                CASE 
                    WHEN km.khuyen_mai_id IS NOT NULL 
                    AND km.trang_thai = 1 
                    AND CURRENT_DATE BETWEEN km.ngay_bat_dau AND km.ngay_ket_thuc 
                    THEN sp.gia * (1 - km.phan_tram_giam/100)
                    ELSE sp.gia
                END as gia_sau_khuyen_mai
                FROM chi_tiet_don_hang ct
                JOIN san_pham sp ON ct.san_pham_id = sp.san_pham_id
                LEFT JOIN san_pham_khuyen_mai spkm ON sp.san_pham_id = spkm.san_pham_id
                LEFT JOIN khuyen_mai km ON spkm.khuyen_mai_id = km.khuyen_mai_id
                WHERE ct.don_hang_id = :orderId";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':orderId' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

