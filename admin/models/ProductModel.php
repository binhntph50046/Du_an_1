<?php
class ProductModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllProducts() {
        try {
            $sql = "SELECT san_pham_id, ten_san_pham FROM san_pham WHERE trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Lỗi lấy danh sách sản phẩm: " . $e->getMessage());
            return [];
        }
    }

    public function getProductById($id) {
        try {
            $sql = "SELECT * FROM san_pham WHERE san_pham_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Lỗi lấy thông tin sản phẩm: " . $e->getMessage());
            return null;
        }
    }
} 