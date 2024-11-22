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
                        sp.*,
                        dm.ten_danh_muc,
                        GROUP_CONCAT(r.dung_luong SEPARATOR ', ') as ram_info,
                        COALESCE(
                            (SELECT hinh_sp 
                             FROM hinh_anh_san_pham 
                             WHERE san_pham_id = sp.san_pham_id 
                             LIMIT 1),
                            'default.jpg'
                        ) as hinh_sp
                    FROM san_pham sp
                    LEFT JOIN danh_muc dm ON sp.danh_muc_id = dm.danh_muc_id
                    LEFT JOIN san_pham_ram spr ON sp.san_pham_id = spr.san_pham_id
                    LEFT JOIN ram r ON spr.ram_id = r.ram_id
                    GROUP BY sp.san_pham_id
                    ORDER BY sp.san_pham_id DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Lỗi lấy danh sách sản phẩm: " . $e->getMessage());
            return false;
        }
    }

    public function addProduct($ten_san_pham, $gia, $ngay_nhap, $mo_ta, $trang_thai, $danh_muc_id)
    {
        try {
            $this->conn->beginTransaction();
            
            $sql = "INSERT INTO san_pham (ten_san_pham, gia, ngay_nhap, mo_ta, trang_thai, danh_muc_id) 
                    VALUES (:ten_san_pham, :gia, :ngay_nhap, :mo_ta, :trang_thai, :danh_muc_id)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia' => $gia,
                ':ngay_nhap' => $ngay_nhap,
                ':mo_ta' => $mo_ta,
                ':trang_thai' => $trang_thai,
                ':danh_muc_id' => $danh_muc_id
            ]);
            
            $san_pham_id = $this->conn->lastInsertId();
            $this->conn->commit();
            
            return ['san_pham_id' => $san_pham_id];
        } catch(PDOException $e) {
            $this->conn->rollBack();
            error_log("Lỗi thêm sản phẩm: " . $e->getMessage());
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

    public function updateProductWithRelations($san_pham_id, $ten_san_pham, $gia, $hinh_id, $hinh_path, $ngay_nhap, $mo_ta, $trang_thai, $danh_muc_id) {
        try {
            $sql = "UPDATE san_pham SET 
                    ten_san_pham = :ten_san_pham,
                    gia = :gia,
                    ngay_nhap = :ngay_nhap,
                    mo_ta = :mo_ta,
                    trang_thai = :trang_thai,
                    danh_muc_id = :danh_muc_id
                    WHERE san_pham_id = :san_pham_id";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':ten_san_pham' => $ten_san_pham,
                ':gia' => $gia,
                ':ngay_nhap' => $ngay_nhap,
                ':mo_ta' => $mo_ta,
                ':trang_thai' => $trang_thai,
                ':danh_muc_id' => $danh_muc_id
            ]);

            // Cập nhật hình ảnh nếu có
            if ($hinh_path !== null) {
                $sqlImage = "UPDATE hinh_anh_san_pham 
                            SET hinh_sp = :hinh_sp 
                            WHERE hinh_anh_id = :hinh_id";
                $stmtImage = $this->conn->prepare($sqlImage);
                $stmtImage->execute([
                    ':hinh_sp' => $hinh_path,
                    ':hinh_id' => $hinh_id
                ]);
            }

            return true;
        } catch(PDOException $e) {
            error_log("Lỗi cập nhật sản phẩm: " . $e->getMessage());
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

    public function addProductRam($san_pham_id, $ram_id) {
        try {
            $sql = "INSERT INTO san_pham_ram (san_pham_id, ram_id) 
                    VALUES (:san_pham_id, :ram_id)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':ram_id' => $ram_id
            ]);
        } catch(PDOException $e) {
            error_log("Lỗi thêm RAM cho sản phẩm: " . $e->getMessage());
            return false;
        }
    }

    public function getAllRam()
    {
        try {
            $sql = "SELECT * FROM ram WHERE trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Lỗi lấy danh sách RAM: " . $e->getMessage());
            return false;
        }
    }

    public function getProductRams($san_pham_id) 
    {
        try {
            $sql = "SELECT r.* 
                    FROM ram r
                    INNER JOIN san_pham_ram spr ON r.ram_id = spr.ram_id
                    WHERE spr.san_pham_id = :san_pham_id";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':san_pham_id', $san_pham_id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Lỗi lấy RAM của sản phẩm: " . $e->getMessage());
            return false;
        }
    }

    // Thêm phương thức để cập nhật RAM của sản phẩm
    public function updateProductRams($san_pham_id, $ram_ids) 
    {
        try {
            $this->conn->beginTransaction();
            
            // Xóa tất cả RAM cũ của sản phẩm
            $sqlDelete = "DELETE FROM san_pham_ram WHERE san_pham_id = :san_pham_id";
            $stmtDelete = $this->conn->prepare($sqlDelete);
            $stmtDelete->execute([':san_pham_id' => $san_pham_id]);
            
            // Thêm RAM mới
            if (!empty($ram_ids)) {
                $sqlInsert = "INSERT INTO san_pham_ram (san_pham_id, ram_id) VALUES (:san_pham_id, :ram_id)";
                $stmtInsert = $this->conn->prepare($sqlInsert);
                foreach ($ram_ids as $ram_id) {
                    $stmtInsert->execute([':san_pham_id' => $san_pham_id, ':ram_id' => $ram_id]);
                }
            }
            
            $this->conn->commit();
            return true;
        } catch(PDOException $e) {
            $this->conn->rollBack();
            error_log("Lỗi trong updateProductRams: " . $e->getMessage());
            return false;
        }
    }
}

