<?php
class OrderModel {
    private $conn;
    
    public function __construct() {
        $this->conn = connectDB();
    }

    public function createOrder($data) {
        try {
            $this->conn->beginTransaction();
            
            // Tạo đơn hàng mới
            $sql = "INSERT INTO don_hang (
                tai_khoan_id, ho_va_ten, email, so_dien_thoai, dia_chi,
                ngay_dat, tong_tien, phuong_thuc_thanh_toan, trang_thai
            ) VALUES (
                :tai_khoan_id, :ho_va_ten, :email, :phone, :address,
                CURRENT_TIMESTAMP, :total, :payment_method, 1
            )";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $data['tai_khoan_id'],
                ':ho_va_ten' => $data['ho_va_ten'],
                ':email' => $data['email'],
                ':phone' => $data['so_dien_thoai'],
                ':address' => $data['dia_chi'],
                ':total' => $data['tong_tien'],
                ':payment_method' => $data['payment_method']
            ]);

            $order_id = $this->conn->lastInsertId();

            // Thêm chi tiết đơn hàng
            $sql = "INSERT INTO chi_tiet_don_hang (
                don_hang_id, san_pham_id, so_luong, gia, tong_tien
            ) VALUES (
                :order_id, :product_id, :quantity, :price, :total
            )";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':order_id' => $order_id,
                ':product_id' => $data['san_pham_id'],
                ':quantity' => $data['so_luong'],
                ':price' => $data['gia'],
                ':total' => $data['gia'] * $data['so_luong']
            ]);

            $this->conn->commit();
            return $order_id;

        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteOrder($orderId) {
        try {
            $this->conn->beginTransaction();
            
            // Xóa chi tiết đơn hàng trước
            $sql1 = "DELETE FROM chi_tiet_don_hang WHERE don_hang_id = ?";
            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->execute([$orderId]);
            
            // Sau đó xóa đơn hàng
            $sql2 = "DELETE FROM don_hang WHERE don_hang_id = ? AND trang_thai = 4";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->execute([$orderId]);
            
            $this->conn->commit();
            return true;
            
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }
} 