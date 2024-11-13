<?php
class ProductModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllProducts() {
        $sql = "SELECT sp.*, dm.ten_danh_muc 
                FROM san_pham sp
                INNER JOIN danh_muc dm ON sp.danh_muc_id = dm.danh_muc_id 
                WHERE sp.trang_thai = 1 
                ORDER BY sp.ngay_nhap DESC 
                LIMIT 10";
        return pdo_query($sql);
    }

    public function getTopProducts() {
        $sql = "SELECT sp.*, dm.ten_danh_muc 
                FROM san_pham sp
                INNER JOIN danh_muc dm ON sp.danh_muc_id = dm.danh_muc_id 
                WHERE sp.trang_thai = 1 
                AND sp.san_pham_id > 45
                ORDER BY sp.so_luot_xem DESC 
                LIMIT 10";
        return pdo_query($sql);
    }
} 

?>
