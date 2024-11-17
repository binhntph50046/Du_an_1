<?php

class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=du_an_1", "root", "");
    }

    // Lấy danh sách đơn hàng với thông tin khách hàng
    public function getAllOrders() {
        $sql = "SELECT dh.*, tk.ho_va_ten as ten_khach_hang 
                FROM don_hang dh 
                JOIN tai_khoan tk ON dh.tai_khoan_id = tk.tai_khoan_id 
                ORDER BY dh.ngay_dat DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($orders as &$order) {
            // Lấy chi tiết sản phẩm của từng đơn hàng
            $sql = "SELECT * FROM chi_tiet_don_hang WHERE don_hang_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$order['don_hang_id']]);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Tính lại tổng tiền
            $tongTien = 0;
            foreach ($items as $item) {
                $giaSauKM = $item['gia'] * (1 - $item['khuyen_mai'] / 100);
                $tongTien += $giaSauKM * $item['so_luong'];
            }

            // Cập nhật lại tổng tiền trong DB
            $sql = "UPDATE don_hang SET tong_tien = ? WHERE don_hang_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$tongTien, $order['don_hang_id']]);
            $order['tong_tien'] = $tongTien;
        }

        return $orders;
    }

    // Lấy chi tiết một đơn hàng
    public function getOrderDetail($id) {
        // Lấy thông tin đơn hàng và join với bảng tai_khoan
        $sql = "SELECT dh.*, tk.ho_va_ten, tk.email, tk.so_dien_thoai, tk.dia_chi 
                FROM don_hang dh
                JOIN tai_khoan tk ON dh.tai_khoan_id = tk.tai_khoan_id
                WHERE dh.don_hang_id = ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($order) {
            // Lấy chi tiết sản phẩm của đơn hàng
            $sql = "SELECT ctdh.*, sp.ten_san_pham, MIN(hasp.hinh_sp) as hinh
                    FROM chi_tiet_don_hang ctdh
                    JOIN san_pham sp ON ctdh.san_pham_id = sp.san_pham_id
                    LEFT JOIN hinh_anh_san_pham hasp ON sp.san_pham_id = hasp.san_pham_id
                    WHERE ctdh.don_hang_id = ?
                    GROUP BY sp.san_pham_id";
                    
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'order' => $order,
                'items' => $items
            ];
        }
        return null;
    }

    // Lấy phương thức thanh toán
    public function getPaymentMethod($orderId) {
        $sql = "SELECT phuong_thuc_thanh_toan FROM don_hang WHERE don_hang_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['phuong_thuc_thanh_toan'];
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus($orderId, $status) {
        // Kiểm tra phương thức thanh toán
        $paymentMethod = $this->getPaymentMethod($orderId);
        
        // Nếu thanh toán online và status = 2 (đang xử lý), tự động chuyển sang trạng thái 3 (đã hoàn thành)
        if ($paymentMethod == 'online' && $status == 2) {
            $status = 3;
        }

        $sql = "UPDATE don_hang 
                SET trang_thai = ?, ngay_xu_ly = CURRENT_DATE 
                WHERE don_hang_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$status, $orderId]);
    }

    public function deleteOrder($orderId) {
        // Xóa chi tiết đơn hàng trước
        $sql1 = "DELETE FROM chi_tiet_don_hang WHERE don_hang_id = ?";
        $stmt1 = $this->db->prepare($sql1);
        $stmt1->execute([$orderId]);
        
        // Sau đó xóa đơn hàng
        $sql2 = "DELETE FROM don_hang WHERE don_hang_id = ?";
        $stmt2 = $this->db->prepare($sql2);
        return $stmt2->execute([$orderId]);
    }
}

    

