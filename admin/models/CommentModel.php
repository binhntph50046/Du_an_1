<?php
class CommentModel {
    private $conn;
    public function __construct() {
        $this->conn = connectDB();
    }

    public function getComments($filters = [], $limit = 10, $offset = 0) {
        try {
            $sql = "SELECT bl.*, tk.ho_va_ten, tk.hinh, sp.ten_san_pham 
                    FROM binh_luan bl
                    LEFT JOIN tai_khoan tk ON bl.tai_khoan_id = tk.tai_khoan_id
                    LEFT JOIN san_pham sp ON bl.san_pham_id = sp.san_pham_id
                    WHERE 1=1";

            $params = [];

            if (!empty($filters['status'])) {
                $sql .= " AND bl.trang_thai = ?";
                $params[] = $filters['status'];
            }
            if (!empty($filters['product_id'])) {
                $sql .= " AND bl.san_pham_id = ?";
                $params[] = $filters['product_id'];
            }
            if (!empty($filters['search'])) {
                $sql .= " AND (bl.noi_dung LIKE ? OR tk.ho_va_ten LIKE ?)";
                $params[] = "%{$filters['search']}%";
                $params[] = "%{$filters['search']}%";
            }

            $sql .= " ORDER BY bl.ngay_binh_luan DESC LIMIT ?, ?";
            $params[] = (int)$offset;
            $params[] = (int)$limit;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            error_log("Lỗi truy vấn bình luận: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalComments($filters = []) {
        try {
            $sql = "SELECT COUNT(*) as total 
                    FROM binh_luan bl
                    LEFT JOIN tai_khoan tk ON bl.tai_khoan_id = tk.tai_khoan_id
                    WHERE 1=1";

            $params = [];

            if (!empty($filters['status'])) {
                $sql .= " AND bl.trang_thai = ?";
                $params[] = $filters['status'];
            }
            if (!empty($filters['product_id'])) {
                $sql .= " AND bl.san_pham_id = ?";
                $params[] = $filters['product_id'];
            }
            if (!empty($filters['search'])) {
                $sql .= " AND (bl.noi_dung LIKE ? OR tk.ho_va_ten LIKE ?)";
                $params[] = "%{$filters['search']}%";
                $params[] = "%{$filters['search']}%";
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetch();
            return $result['total'] ?? 0;

        } catch (PDOException $e) {
            error_log("Lỗi đếm bình luận: " . $e->getMessage());
            return 0;
        }
    }

    public function updateStatus($id, $status) {
        try {
            $sql = "UPDATE binh_luan SET trang_thai = ?, ngay_cap_nhat = NOW() 
                    WHERE binh_luan_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$status, $id]);

        } catch (PDOException $e) {
            error_log("Lỗi cập nhật trạng thái: " . $e->getMessage());
            return false;
        }
    }

    public function deleteComment($id) {
        try {
            $sql = "DELETE FROM binh_luan WHERE binh_luan_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);

        } catch (PDOException $e) {
            error_log("Lỗi xóa bình luận: " . $e->getMessage());
            return false;
        }
    }
} 