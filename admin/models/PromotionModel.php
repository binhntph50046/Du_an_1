<?php
class PromotionModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllPromotions()
    {
        $sql = "SELECT * FROM khuyen_mai ORDER BY ngay_bat_dau DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPromotionById($id)
    {
        $sql = "SELECT khuyen_mai_id, ten_khuyen_mai, mo_ta, phan_tram_giam, giam_gia, 
                ngay_bat_dau, ngay_ket_thuc 
                FROM khuyen_mai 
                WHERE khuyen_mai_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPromotion($data)
    {
        try {
            $this->conn->beginTransaction();

            $sql = "INSERT INTO khuyen_mai (
                ten_khuyen_mai, 
                mo_ta, 
                phan_tram_giam,
                giam_gia,
                ngay_bat_dau, 
                ngay_ket_thuc
            ) VALUES (
                :ten_khuyen_mai,
                :mo_ta,
                :phan_tram_giam,
                :giam_gia,
                :ngay_bat_dau,
                :ngay_ket_thuc
            )";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_khuyen_mai' => $data['ten_khuyen_mai'],
                ':mo_ta' => $data['mo_ta'],
                ':phan_tram_giam' => $data['phan_tram_giam'],
                ':giam_gia' => $data['giam_gia'],
                ':ngay_bat_dau' => $data['ngay_bat_dau'],
                ':ngay_ket_thuc' => $data['ngay_ket_thuc']
            ]);

            $promotionId = $this->conn->lastInsertId();
            $this->conn->commit();
            return $promotionId;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function updatePromotion($id, $data)
    {
        $sql = "UPDATE khuyen_mai 
                SET ten_khuyen_mai = :ten_khuyen_mai,
                    mo_ta = :mo_ta,
                    phan_tram_giam = :phan_tram_giam,
                    giam_gia = :giam_gia,
                    ngay_bat_dau = :ngay_bat_dau,
                    ngay_ket_thuc = :ngay_ket_thuc
                WHERE khuyen_mai_id = :id";

        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':ten_khuyen_mai' => $data['ten_khuyen_mai'],
                ':mo_ta' => $data['mo_ta'],
                ':phan_tram_giam' => $data['phan_tram_giam'],
                ':giam_gia' => $data['giam_gia'],
                ':ngay_bat_dau' => $data['ngay_bat_dau'],
                ':ngay_ket_thuc' => $data['ngay_ket_thuc'],
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            error_log("Error updating promotion: " . $e->getMessage());
            return false;
        }
    }

    public function deletePromotion($id)
    {
        try {
            $this->conn->beginTransaction();

            // Cập nhật lại giá gốc cho các sản phẩm thuộc khuyến mãi này
            $sqlUpdateProducts = "UPDATE san_pham 
                                SET gia_khuyen_mai = NULL,
                                    khuyen_mai_id = NULL 
                                WHERE khuyen_mai_id = :id";
            $stmtUpdateProducts = $this->conn->prepare($sqlUpdateProducts);
            $stmtUpdateProducts->execute([':id' => $id]);

            // Xóa các liên kết trong bảng san_pham_khuyen_mai
            $sqlDeleteLinks = "DELETE FROM san_pham_khuyen_mai WHERE khuyen_mai_id = :id";
            $stmtDeleteLinks = $this->conn->prepare($sqlDeleteLinks);
            $stmtDeleteLinks->execute([':id' => $id]);

            // Xóa khuyến mãi
            $sqlDeletePromo = "DELETE FROM khuyen_mai WHERE khuyen_mai_id = :id";
            $stmtDeletePromo = $this->conn->prepare($sqlDeletePromo);
            $result = $stmtDeletePromo->execute([':id' => $id]);

            $this->conn->commit();
            return $result;
        } catch (\PDOException $e) {
            $this->conn->rollBack();
            error_log("Error deleting promotion: " . $e->getMessage());
            return false;
        }
    }

    public function getPromotionProducts($promotionId)
    {
        $sql = "SELECT sp.ten_san_pham 
                FROM san_pham sp
                JOIN san_pham_khuyen_mai spkm ON sp.san_pham_id = spkm.san_pham_id
                WHERE spkm.khuyen_mai_id = :promotion_id";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':promotion_id' => $promotionId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getPromotionProducts: " . $e->getMessage());
            return [];
        }
    }

    public function addProductToPromotion($promotionId, $productId)
    {
        $sql = "INSERT INTO san_pham_khuyen_mai (san_pham_id, khuyen_mai_id)
                VALUES (:productId, :promotionId)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':productId' => $productId,
            ':promotionId' => $promotionId
        ]);
    }

    public function removeProductFromPromotion($promotionId, $productId)
    {
        $sql = "DELETE FROM san_pham_khuyen_mai 
                WHERE san_pham_id = $productId AND khuyen_mai_id = $promotionId";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }

    public function addPromotionProducts($promotionId, $productIds)
    {
        try {
            $this->conn->beginTransaction();

            // Xóa các liên kết cũ
            $sqlDelete = "DELETE FROM san_pham_khuyen_mai WHERE khuyen_mai_id = :promotion_id";
            $stmtDelete = $this->conn->prepare($sqlDelete);
            $stmtDelete->execute([':promotion_id' => $promotionId]);

            // Thêm các liên kết mới
            $sqlInsert = "INSERT INTO san_pham_khuyen_mai (san_pham_id, khuyen_mai_id) 
                         VALUES (:product_id, :promotion_id)";
            $stmtInsert = $this->conn->prepare($sqlInsert);

            foreach ($productIds as $productId) {
                $stmtInsert->execute([
                    ':product_id' => $productId,
                    ':promotion_id' => $promotionId
                ]);
            }

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error in addPromotionProducts: " . $e->getMessage());
            throw $e;
        }
    }

    public function updateProductPromotionPrice($productId)
    {
        try {
            // Lấy khuyến mãi hiện tại của sản phẩm
            $sql = "SELECT sp.gia, 
                    COALESCE(MAX(km.phan_tram_giam), 0) as max_discount
                    FROM san_pham sp
                    LEFT JOIN san_pham_khuyen_mai spkm ON sp.san_pham_id = spkm.san_pham_id
                    LEFT JOIN khuyen_mai km ON spkm.khuyen_mai_id = km.khuyen_mai_id
                        AND km.trang_thai = 1
                        AND CURRENT_DATE BETWEEN km.ngay_bat_dau AND km.ngay_ket_thuc
                    WHERE sp.san_pham_id = :product_id
                    GROUP BY sp.san_pham_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':product_id' => $productId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $giaGoc = $result['gia'];
                $phanTramGiam = $result['max_discount'];
                $giaKhuyenMai = $giaGoc * (1 - $phanTramGiam / 100);

                // Cập nhật giá khuyến mãi trong bảng sản phẩm
                $sqlUpdate = "UPDATE san_pham 
                             SET gia_khuyen_mai = :gia_khuyen_mai 
                             WHERE san_pham_id = :product_id";
                $stmtUpdate = $this->conn->prepare($sqlUpdate);
                $stmtUpdate->execute([
                    ':gia_khuyen_mai' => $giaKhuyenMai,
                    ':product_id' => $productId
                ]);
            }
        } catch (\PDOException $e) {
            error_log("Error updating product promotion price: " . $e->getMessage());
            throw $e;
        }
    }

    public function updateOrderDetailsPrice()
    {
        try {
            $sql = "UPDATE chi_tiet_don_hang ctdh
                    JOIN san_pham sp ON ctdh.san_pham_id = sp.san_pham_id
                    SET ctdh.gia = COALESCE(sp.gia_khuyen_mai, sp.gia)
                    WHERE ctdh.trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Error updating order details price: " . $e->getMessage());
            throw $e;
        }
    }

    public function checkExpiredPromotions()
    {
        try {
            $this->conn->beginTransaction();

            // Lấy danh sách khuyến mãi đã hết hạn
            $sql = "SELECT km.khuyen_mai_id, spkm.san_pham_id
                    FROM khuyen_mai km
                    JOIN san_pham_khuyen_mai spkm ON km.khuyen_mai_id = spkm.khuyen_mai_id
                    WHERE km.trang_thai = 1 
                    AND km.ngay_ket_thuc < CURRENT_DATE";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $expiredPromotions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($expiredPromotions)) {
                // Lấy danh sách sản phẩm cần cập nhật
                $productIds = array_unique(array_column($expiredPromotions, 'san_pham_id'));

                // Cập nhật trạng thái khuyến mãi
                $sqlUpdatePromo = "UPDATE khuyen_mai 
                                 SET trang_thai = 0 
                                 WHERE ngay_ket_thuc < CURRENT_DATE";
                $this->conn->query($sqlUpdatePromo);

                // Cập nhật giá sản phẩm về giá gốc
                $sqlUpdateProducts = "UPDATE san_pham 
                                    SET gia_khuyen_mai = NULL,
                                        khuyen_mai_id = NULL 
                                    WHERE san_pham_id IN (" . implode(',', $productIds) . ")";
                $this->conn->query($sqlUpdateProducts);

                // Cập nhật giá trong đơn hàng chưa hoàn thành
                $sqlUpdateOrders = "UPDATE chi_tiet_don_hang ctdh
                                  JOIN don_hang dh ON ctdh.don_hang_id = dh.don_hang_id
                                  JOIN san_pham sp ON ctdh.san_pham_id = sp.san_pham_id
                                  SET ctdh.gia = sp.gia
                                  WHERE ctdh.san_pham_id IN (" . implode(',', $productIds) . ")
                                  AND dh.trang_thai IN (1, 2)";
                $this->conn->query($sqlUpdateOrders);
            }

            $this->conn->commit();
            return true;
        } catch (\PDOException $e) {
            $this->conn->rollBack();
            error_log("Error checking expired promotions: " . $e->getMessage());
            return false;
        }
    }

    public function calculateDiscountedPrice($originalPrice, $promotion)
    {
        if (!empty($promotion['phan_tram_giam'])) {
            return $originalPrice * (1 - $promotion['phan_tram_giam'] / 100);
        } elseif (!empty($promotion['giam_gia'])) {
            return max(0, $originalPrice - $promotion['giam_gia']);
        }
        return $originalPrice;
    }
}
