<?php
class User {
    private $conn;
    
    public function __construct() {
        $this->conn = connectDB();
    }

    public function create($data) {
        try {
            $sql = "INSERT INTO tai_khoan(ho_va_ten, email, mat_khau, dia_chi, so_dien_thoai, hinh) 
                    VALUES(:ho_va_ten, :email, :mat_khau, :dia_chi, :so_dien_thoai, :hinh)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                'ho_va_ten' => $data['ho_va_ten'],
                'email' => $data['email'],
                'mat_khau' => $data['mat_khau'],
                'dia_chi' => $data['dia_chi'],
                'so_dien_thoai' => $data['so_dien_thoai'],
                'hinh' => $data['hinh']
            ]);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function login($email, $pass) {
        try {
            $sql = "SELECT * FROM tai_khoan WHERE email = :email AND mat_khau = :mat_khau AND trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'mat_khau' => $pass
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function getUserByEmail($email) {
        try {
            $sql = "SELECT * FROM tai_khoan WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function updatePassword($email, $newPassword) {
        try {
            $sql = "UPDATE tai_khoan SET mat_khau = :mat_khau WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                'email' => $email,
                'mat_khau' => $newPassword
            ]);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function getPasswordByEmail($email) {
        try {
            $sql = "SELECT mat_khau FROM tai_khoan WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['mat_khau'] : false;
        } catch(PDOException $e) {
            return false;
        }
    }
}
?>