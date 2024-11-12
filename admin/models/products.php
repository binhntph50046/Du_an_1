<?php

class Products {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllProducts() {
        try {
            $sql = 'SELECT * FROM san_pham';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            // Debug
            error_log("SQL Query: " . $sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Query Result: " . print_r($result, true));
            
            return $result ?? [];
        } catch (Exception $e) {
            error_log("Error in getAllProducts: " . $e->getMessage());
            echo "<!-- Error: " . $e->getMessage() . " -->";
            return [];
        }
    }

    public function addProduct($ten_san_pham, $gia, $hinh, $ngay_nhap, $mo_ta, $so_luot_xem, $trang_thai, $danh_muc_id = NULL) {
        try {
            $sql = 'INSERT INTO san_pham (ten_san_pham, gia, hinh, ngay_nhap, mo_ta, so_luot_xem, trang_thai, danh_muc_id)
                    VALUES (:ten_san_pham, :gia, :hinh, :ngay_nhap, :mo_ta, :so_luot_xem, :trang_thai, :danh_muc_id)';
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia' => $gia,
                ':hinh' => $hinh,
                ':ngay_nhap' => $ngay_nhap,
                ':mo_ta' => $mo_ta,
                ':so_luot_xem' => $so_luot_xem,
                ':trang_thai' => $trang_thai,
                ':danh_muc_id' => $danh_muc_id, // Nếu không có giá trị, sẽ là NULL
            ]);
    
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            error_log("Error in addProduct: " . $e->getMessage());
            echo "Error adding product: " . $e->getMessage();
            return false;
        }
    }


    public function thongTinProduct($idProduct){
        try {
            // Kiểm tra kết nối
            if (!$this->conn) {
                error_log("Database connection failed");
                return false;
            }

            $sql = 'SELECT * FROM san_pham WHERE san_pham_id = :idProduct';
            
            // Debug
            error_log("Executing query for ID: " . $idProduct);
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':idProduct' => $idProduct]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Debug kết quả
            error_log("Query result: " . ($result ? "Found" : "Not found"));
            
            return $result;
        } catch (\PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

 

    public function deleteProductById($id)
    {
        try {
            // Câu lệnh SQL xóa sản phẩm theo `san_pham_id`
            $sql = 'DELETE FROM san_pham WHERE san_pham_id = :id';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
    
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            error_log("Error in deleteProduct: " . $e->getMessage());
            echo "Error deleting product: " . $e->getMessage();
            return false;
        }
    }
    
    
    public function getProductById($id)
    {
        try {
            $sql = 'SELECT * FROM san_pham WHERE san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error in getProductById: " . $e->getMessage());
            return false;
        }
    }
    

    public function updateProduct($san_pham_id, $ten_san_pham, $gia, $hinh, $ngay_nhap, $mo_ta, $so_luot_xem, $trang_thai, $danh_muc_id) {
        try {
            $sql = "UPDATE san_pham SET 
                    ten_san_pham = :ten_san_pham,
                    gia = :gia,
                    hinh = :hinh,
                    ngay_nhap = :ngay_nhap,
                    mo_ta = :mo_ta,
                    so_luot_xem = :so_luot_xem,
                    trang_thai = :trang_thai,
                    danh_muc_id = :danh_muc_id
                    WHERE san_pham_id = :san_pham_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':ten_san_pham' => $ten_san_pham,
                ':gia' => $gia,
                ':hinh' => $hinh,
                ':ngay_nhap' => $ngay_nhap,
                ':mo_ta' => $mo_ta,
                ':so_luot_xem' => $so_luot_xem,
                ':trang_thai' => $trang_thai,
                ':danh_muc_id' => $danh_muc_id
            ]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error in updateProduct: " . $e->getMessage());
            return false;
        }
    }

    
}
