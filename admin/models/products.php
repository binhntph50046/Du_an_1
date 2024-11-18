<?php

class Products
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllProducts()
    {
        try {
            $sql = "SELECT
            san_pham.*,
            danh_muc.ten_danh_muc,
            -- hàm COALESCE thay thế 1 giá trị NULL bảng giá trị khác (trường hợp này k chọn nó sẽ trả về a2.jpg)
            COALESCE(
                (SELECT hinh_sp FROM hinh_anh_san_pham WHERE san_pham.san_pham_id = hinh_anh_san_pham.san_pham_id LIMIT 1),
                'a2.jpg'
            ) AS hinh_sp
        FROM
            san_pham
        LEFT JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.danh_muc_id
        ORDER BY san_pham.san_pham_id";


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

    public function addProduct($ten_san_pham, $gia, $ngay_nhap, $mo_ta, $trang_thai, $danh_muc_id = NULL)
    {
        try {
            $sql = 'INSERT INTO san_pham (ten_san_pham, gia, ngay_nhap, mo_ta, trang_thai, danh_muc_id)
                    VALUES (:ten_san_pham, :gia, :ngay_nhap, :mo_ta, :trang_thai, :danh_muc_id)';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia' => $gia,
                ':ngay_nhap' => $ngay_nhap,
                ':mo_ta' => $mo_ta,
                ':trang_thai' => $trang_thai,
                ':danh_muc_id' => $danh_muc_id, // Nếu không có giá trị, sẽ là NULL
            ]);

            $stmt = $this->conn->query("SELECT * FROM san_pham WHERE san_pham_id = " . $this->conn->lastInsertId());
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error in addProduct: " . $e->getMessage());
            echo "Error adding product: " . $e->getMessage();
            return false;
        }
    }

    public function addProductImage($url, $san_pham_id)
    {
        try {
            $sql = 'INSERT INTO hinh_anh_san_pham (hinh_sp,san_pham_id) VALUES (:hinh_sp,:san_pham_id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':hinh_sp' => $url,
                ':san_pham_id' => $san_pham_id,
            ]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function thongTinProduct($idProduct)
    {
        try {
            // Kiểm tra kết nối
            if (!$this->conn) {
                error_log("Database connection failed");
                return false;
            }

            $sql = 'SELECT * FROM san_pham 
                    JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.danh_muc_id
                    JOIN hinh_anh_san_pham ON hinh_anh_san_pham.san_pham_id = san_pham.san_pham_id
                    WHERE san_pham.san_pham_id = :idProduct';

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

    public function updateProductWithRelations(
        $san_pham_id,
        $ten_san_pham,
        $gia,
        $hinh_id,
        $hinh_path,
        $ngay_nhap,
        $mo_ta,
        $trang_thai,
        $danh_muc_id
    ) {
        try {
            
            $this->conn->beginTransaction();
    
            $sqlProduct = "UPDATE san_pham
                SET ten_san_pham = :ten_san_pham,
                    gia = :gia,
                    ngay_nhap = :ngay_nhap,
                    mo_ta = :mo_ta,
                    trang_thai = :trang_thai,
                    danh_muc_id = :danh_muc_id
                WHERE san_pham_id = :san_pham_id";
    
            $stmtProduct = $this->conn->prepare($sqlProduct);
            $stmtProduct->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia' => $gia,
                ':ngay_nhap' => $ngay_nhap,
                ':mo_ta' => $mo_ta,
                ':trang_thai' => $trang_thai,
                ':danh_muc_id' => $danh_muc_id,
                ':san_pham_id' => $san_pham_id
            ]);
    
            $sqlImage = "UPDATE hinh_anh_san_pham
                SET hinh_sp = :hinh_sp
                WHERE hinh_anh_id = :hinh_anh_id AND san_pham_id = :san_pham_id";
            $stmtImage = $this->conn->prepare($sqlImage);
            $stmtImage->execute([
                ':hinh_sp' => $hinh_path,
                ':hinh_anh_id' => $hinh_id,
                ':san_pham_id' => $san_pham_id,
            ]);
    
            $this->conn->commit();
            return true;
        } catch (\PDOException $e) {
            $this->conn->rollBack();
            error_log("Error in updateProduct: " . $e->getMessage());
            return false;
        }
    }
    

    public function deleteProductAndImages($id)
    {
        try {
            // bắt đầu giao dịch trong cơ sở dữ liệu , đảm bảo thao tác xóa ảnh và sản phẩm nếu thất bại sẽ rollback về để đảm bảo dữ li
            $this->conn->beginTransaction();

            // Xóa ảnh từ bảng hinh_anh
            $sqlDeleteImages = 'DELETE FROM hinh_anh_san_pham WHERE san_pham_id = :id';
            $stmtImages = $this->conn->prepare($sqlDeleteImages);
            $stmtImages->execute([':id' => $id]);

            // Xóa sản phẩm từ bảng san_pham
            $sqlDeleteProduct = 'DELETE FROM san_pham WHERE san_pham_id = :id';
            $stmtProduct = $this->conn->prepare($sqlDeleteProduct);
            $stmtProduct->execute([':id' => $id]);

            $this->conn->commit();
            return true;
        } catch (\PDOException $e) {
            $this->conn->rollBack();
            error_log("Error in deleteProductAndImages: " . $e->getMessage());
            return false;
        }
    }

    public function getCategories()
    {
        $sql = 'SELECT * FROM danh_muc';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function checkProductInOrders($productId) {
        $sql = "SELECT COUNT(*) as count FROM chi_tiet_don_hang WHERE san_pham_id = :productId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['productId' => $productId]);
        $result = $stmt->fetch();
        return $result['count'] > 0;
    }
}

