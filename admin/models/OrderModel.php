<?php
class OrderModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAll($filters = []) {
        try {
            $sql = "SELECT donhang.*, taikhoan.ho_va_ten, taikhoan.email, taikhoan.so_dien_thoai 
                    FROM don_hang donhang
                    LEFT JOIN tai_khoan taikhoan ON donhang.tai_khoan_id = taikhoan.tai_khoan_id
                    WHERE 1=1";
            $parameters = [];

            if (!empty($filters['status'])) {
                $sql .= " AND donhang.trang_thai = ?";
                $parameters[] = $filters['status'];
            }

            if (!empty($filters['date_from'])) {
                $sql .= " AND donhang.ngay_dat >= ?";
                $parameters[] = $filters['date_from'];
            }

            if (!empty($filters['date_to'])) {
                $sql .= " AND donhang.ngay_dat <= ?";
                $parameters[] = $filters['date_to'];
            }

            $sql .= " ORDER BY donhang.ngay_dat DESC";
            
            $statement = $this->conn->prepare($sql);
            $statement->execute($parameters);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log("Lỗi lấy danh sách đơn hàng: " . $exception->getMessage());
            return [];
        }
    }

    public function getOrderDetails($orderId) {
        try {
            $sql = "SELECT chitietdonhang.*, sanpham.ten_san_pham, sanpham.hinh 
                    FROM chi_tiet_don_hang chitietdonhang
                    LEFT JOIN san_pham sanpham ON chitietdonhang.san_pham_id = sanpham.san_pham_id
                    WHERE chitietdonhang.don_hang_id = ?";
            $statement = $this->conn->prepare($sql);
            $statement->execute([$orderId]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log("Lỗi lấy chi tiết đơn hàng: " . $exception->getMessage());
            return [];
        }
    }

    public function updateStatus($orderId, $status) {
        try {
            $sql = "UPDATE don_hang SET 
                    trang_thai = ?,
                    ngay_xu_ly = CASE WHEN ? = 2 THEN CURRENT_DATE ELSE NULL END
                    WHERE don_hang_id = ?";
            $statement = $this->conn->prepare($sql);
            return $statement->execute([$status, $status, $orderId]);
        } catch (PDOException $exception) {
            error_log("Lỗi cập nhật trạng thái: " . $exception->getMessage());
            return false;
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT donhang.*, taikhoan.ho_va_ten, taikhoan.email, taikhoan.so_dien_thoai 
                    FROM don_hang donhang
                    LEFT JOIN tai_khoan taikhoan ON donhang.tai_khoan_id = taikhoan.tai_khoan_id
                    WHERE donhang.don_hang_id = ?";
            $statement = $this->conn->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log("Lỗi lấy thông tin đơn hàng: " . $exception->getMessage());
            return null;
        }
    }

    public function delete($id) {
        try {
            // Xóa chi tiết đơn hàng trước
            $sql = "DELETE FROM chi_tiet_don_hang WHERE don_hang_id = don_hang_id";
            $statement = $this->conn->prepare($sql);
            $statement->execute([$id]);
            
            // Sau đó xóa đơn hàng
            $sql = "DELETE FROM don_hang WHERE don_hang_id = don_hang_id";
            $statement = $this->conn->prepare($sql);
            return $statement->execute([$id]);
        } catch (PDOException $exception) {
            error_log("Lỗi xóa đơn hàng: " . $exception->getMessage());
            return false;
        }
    }
}
?> 