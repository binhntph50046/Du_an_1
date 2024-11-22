<?php
require_once 'pdo.php';

function createOrder($data) {
    try {
        $pdo = pdo_get_connection();
        
        $sql = "INSERT INTO don_hang (tai_khoan_id, ho_va_ten, email, so_dien_thoai, dia_chi, 
                tong_tien, phuong_thuc_thanh_toan, ngay_dat) 
                VALUES (:tai_khoan_id, :ho_va_ten, :email, :so_dien_thoai, :dia_chi, 
                :tong_tien, :phuong_thuc_thanh_toan, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':tai_khoan_id' => $data['tai_khoan_id'],
            ':ho_va_ten' => $data['ho_va_ten'],
            ':email' => $data['email'],
            ':so_dien_thoai' => $data['so_dien_thoai'],
            ':dia_chi' => $data['dia_chi'],
            ':tong_tien' => $data['tong_tien'],
            ':phuong_thuc_thanh_toan' => $data['phuong_thuc_thanh_toan']
        ]);
        
        return $pdo->lastInsertId();
    } catch(PDOException $e) {
        return false;
    }
}

function createOrderDetail($data) {
    try {
        $pdo = pdo_get_connection();
        
        $sql = "INSERT INTO chi_tiet_don_hang (don_hang_id, san_pham_id, so_luong, gia) 
                VALUES (:don_hang_id, :san_pham_id, :so_luong, :gia)";
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':don_hang_id' => $data['don_hang_id'],
            ':san_pham_id' => $data['san_pham_id'],
            ':so_luong' => $data['so_luong'],
            ':gia' => $data['gia']
        ]);
    } catch(PDOException $e) {
        return false;
    }
}
