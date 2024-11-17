<?php
class OrderModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllOrders() {
        $sql = "SELECT dh.*, 
                tk.ho_va_ten, 
                tk.email, 
                tk.so_dien_thoai,
                GROUP_CONCAT(DISTINCT sp.ten_san_pham) as ten_san_pham,
                (SELECT SUM(ct2.so_luong * (sp2.gia * (1 - ct2.khuyen_mai/100)))
                 FROM chi_tiet_don_hang ct2 
                 JOIN san_pham sp2 ON ct2.san_pham_id = sp2.san_pham_id
                 WHERE ct2.don_hang_id = dh.don_hang_id) as tong_tien,
                COALESCE(
                    (SELECT CONCAT('../Upload/Product/', hasp.hinh_sp)
                     FROM chi_tiet_don_hang ct_img
                     JOIN hinh_anh_san_pham hasp ON ct_img.san_pham_id = hasp.san_pham_id
                     WHERE ct_img.don_hang_id = dh.don_hang_id
                     LIMIT 1),
                    '../Upload/Product/default.jpg'
                ) as hinh_anh
                FROM don_hang dh 
                LEFT JOIN tai_khoan tk ON dh.tai_khoan_id = tk.tai_khoan_id
                LEFT JOIN chi_tiet_don_hang ct ON dh.don_hang_id = ct.don_hang_id
                LEFT JOIN san_pham sp ON ct.san_pham_id = sp.san_pham_id
                GROUP BY dh.don_hang_id
                ORDER BY dh.ngay_dat DESC";   
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getOrderById($id) {
        $sql = "SELECT dh.*, tk.ho_va_ten, tk.email, tk.so_dien_thoai 
                FROM don_hang dh 
                LEFT JOIN tai_khoan tk ON dh.tai_khoan_id = tk.tai_khoan_id
                WHERE dh.don_hang_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getOrderDetails($orderId) {
        $sql = "SELECT ct.chi_tiet_don_hang_id, ct.don_hang_id, ct.san_pham_id, 
                ct.so_luong, ct.khuyen_mai, sp.gia as gia_san_pham,
                sp.ten_san_pham,
                (sp.gia * (1 - ct.khuyen_mai/100) * ct.so_luong) as tong_tien,
                COALESCE(
                    (SELECT CONCAT('../Upload/Product/', hinh_sp) 
                     FROM hinh_anh_san_pham
                     WHERE san_pham_id = sp.san_pham_id 
                     LIMIT 1),
                    '../Upload/Product/default.jpg'
                ) as hinh_sp
                FROM chi_tiet_don_hang ct 
                INNER JOIN san_pham sp ON ct.san_pham_id = sp.san_pham_id 
                WHERE ct.don_hang_id = :orderId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['orderId' => $orderId]);
        return $stmt->fetchAll();
    }

    public function updateOrderStatus($orderId, $status) {
        try {
            $sql = "UPDATE don_hang 
                    SET trang_thai = :status,
                        ngay_xu_ly = CASE 
                            WHEN :status != 1 THEN NOW() 
                            ELSE ngay_xu_ly 
                        END
                    WHERE don_hang_id = :orderId";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([
                'status' => $status,
                'orderId' => $orderId
            ]);
            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi cập nhật trạng thái đơn hàng: " . $e->getMessage());
            throw $e;
        }
    }
    public function updateOrder($orderId, $data) {
        $sql = "UPDATE don_hang 
                SET ho_va_ten = :ho_va_ten,
                    email = :email,
                    so_dien_thoai = :so_dien_thoai,
                    dia_chi = :dia_chi,
                    trang_thai = :trang_thai,
                    ngay_cap_nhat = NOW()
                WHERE don_hang_id = :orderId";
        $stmt = $this->conn->prepare($sql);
        $data['orderId'] = $orderId;
        return $stmt->execute($data);
    }

    public function deleteOrder($orderId) {
        try {
            // Kiểm tra trạng thái đơn hàng
            $checkSql = "SELECT trang_thai FROM don_hang WHERE don_hang_id = :orderId";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->execute(['orderId' => $orderId]);
            $order = $checkStmt->fetch();

            if ($order['trang_thai'] != 4) {
                throw new Exception("Chỉ được phép xóa đơn hàng đã hủy!");
            }

            $this->conn->beginTransaction();
            
            // Xóa chi tiết đơn hàng
            $sqlDeleteDetails = "DELETE FROM chi_tiet_don_hang WHERE don_hang_id = :orderId";
            $stmtDetails = $this->conn->prepare($sqlDeleteDetails);
            $stmtDetails->execute(['orderId' => $orderId]);
            
            // Xóa đơn hàng
            $sqlDeleteOrder = "DELETE FROM don_hang WHERE don_hang_id = :orderId";
            $stmtOrder = $this->conn->prepare($sqlDeleteOrder);
            $result = $stmtOrder->execute(['orderId' => $orderId]);
            
            $this->conn->commit();
            return $result;
            
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }
}
?>
