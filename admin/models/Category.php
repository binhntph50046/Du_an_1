<?php
class Category
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getCategory()
    {
        try {
            $sql = 'SELECT * FROM danh_muc ORDER BY danh_muc_id ASC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addCategory($ten_danh_muc, $hinh, $mo_ta, $trang_thai)
    {
        try {
            $sql = 'INSERT INTO danh_muc(ten_danh_muc, hinh, mo_ta, trang_thai) 
                    VALUES (:ten_danh_muc, :hinh, :mo_ta, :trang_thai)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':hinh' => $hinh,
                ':mo_ta' => $mo_ta,
                ':trang_thai' => $trang_thai
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function inforCategory($danh_muc_id)
    {
        try {
            $sql = 'SELECT * FROM danh_muc WHERE danh_muc_id = :danh_muc_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['danh_muc_id' => $danh_muc_id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateCategory($danh_muc_id, $ten_danh_muc, $hinh, $mo_ta, $trang_thai)
    {
        try {
            $sql = 'UPDATE danh_muc SET ten_danh_muc = :ten_danh_muc, hinh = :hinh, mo_ta = :mo_ta, trang_thai = :trang_thai WHERE danh_muc_id = :danh_muc_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':danh_muc_id' => $danh_muc_id,
                ':ten_danh_muc' => $ten_danh_muc,
                ':hinh' => $hinh,
                ':mo_ta' => $mo_ta,
                ':trang_thai' => $trang_thai
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function deleteCategory($danh_muc_id)
    {
        try {
            $sql = 'DELETE FROM danh_muc WHERE danh_muc_id = :danh_muc_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':danh_muc_id' => $danh_muc_id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}
