<?php
class comment
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getComment()
    {
        try {
            $sql = 'SELECT * FROM binh_luan ORDER BY binh_luan_id ASC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteComments($binh_luan_id)
    {
        try {
            $sql = 'DELETE FROM binh_luan WHERE binh_luan_id =:binh_luan_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':binh_luan_id' => $binh_luan_id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}
