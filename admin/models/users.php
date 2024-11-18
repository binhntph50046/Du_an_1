<?php
class User {
    private $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    
    public function getAll() {
        $sql = "SELECT * FROM tai_khoan ORDER BY tai_khoan_id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT * FROM tai_khoan WHERE tai_khoan_id = :tai_khoan_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['tai_khoan_id' => $id]);
        return $stmt->fetch(); 
    }
    
    public function getUserById($id) {
        $sql = "SELECT * FROM tai_khoan WHERE tai_khoan_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($data) {
        try {
            $hinh = !empty($data['hinh']) ? $data['hinh'] : '../Upload/User/default.jpg';
            
            $sql = "INSERT INTO tai_khoan (ho_va_ten, email, mat_khau, dia_chi, 
                    so_dien_thoai, hinh, vai_tro, ngay_dang_ky, trang_thai) 
                    VALUES (:ho_va_ten, :email, :mat_khau, :dia_chi, 
                    :so_dien_thoai, :hinh, :vai_tro, NOW(), 1)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                'ho_va_ten' => $data['ho_va_ten'],
                'email' => $data['email'],
                'mat_khau' => $data['mat_khau'],
                'dia_chi' => $data['dia_chi'],
                'so_dien_thoai' => $data['so_dien_thoai'],
                'hinh' => $hinh,
                'vai_tro' => $data['vai_tro']
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }
    public function update($id, $data) {
        $sql = "UPDATE tai_khoan SET 
                hinh = :hinh,
                ho_va_ten = :ho_va_ten, 
                email = :email, 
                dia_chi = :dia_chi, 
                so_dien_thoai = :so_dien_thoai,
                vai_tro = :vai_tro, 
                trang_thai = :trang_thai,
                ngay_dang_ky = NOW()
                WHERE tai_khoan_id = :tai_khoan_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'hinh' => $data['hinh'],
            'ho_va_ten' => $data['ho_va_ten'],
            'email' => $data['email'],
            'dia_chi' => $data['dia_chi'],
            'so_dien_thoai' => $data['so_dien_thoai'],
            'vai_tro' => $data['vai_tro'],
            'trang_thai' => $data['trang_thai'],
            'tai_khoan_id' => $id
        ]);
    }
    public function delete($id) {
        $sql = "DELETE FROM tai_khoan WHERE tai_khoan_id = :tai_khoan_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['tai_khoan_id' => $id]);
    }
    public function login($email, $mat_khau) {
        try {
            $sql = "SELECT * FROM tai_khoan WHERE email = :email AND mat_khau = :mat_khau AND trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'mat_khau' => $mat_khau
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
