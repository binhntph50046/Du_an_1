<?php
function loadall_sanpham_home()
{
    $sql = "SELECT  sp.san_pham_id, sp.ten_san_pham, sp.gia, sp.ngay_nhap, sp.mo_ta, sp.trang_thai, 
            dm.ten_danh_muc, dm.danh_muc_id,
            MIN(hasp.hinh_sp) as hinh_sp
            FROM san_pham sp
            LEFT JOIN hinh_anh_san_pham hasp ON sp.san_pham_id = hasp.san_pham_id 
            LEFT JOIN danh_muc dm ON sp.danh_muc_id = dm.danh_muc_id
            GROUP BY sp.san_pham_id, sp.ten_san_pham, sp.gia, sp.ngay_nhap, sp.mo_ta, 
                     sp.trang_thai, dm.ten_danh_muc, dm.danh_muc_id
            ORDER BY sp.ngay_nhap DESC";
            
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
function loadall_sanpham_top10()
{
    $sql = "SELECT sp.*, hasp.hinh_sp 
            FROM san_pham sp
            LEFT JOIN hinh_anh_san_pham hasp ON sp.san_pham_id = hasp.san_pham_id
            WHERE sp.trang_thai = 1
            ORDER BY sp.so_luot_xem DESC 
            LIMIT 10";
    return pdo_query($sql);
}
function getProductById($id) {
    $sql = "SELECT sp.*, hasp.hinh_sp, dm.ten_danh_muc
            FROM san_pham sp
            LEFT JOIN hinh_anh_san_pham hasp ON sp.san_pham_id = hasp.san_pham_id
            LEFT JOIN danh_muc dm ON sp.danh_muc_id = dm.danh_muc_id
            WHERE sp.san_pham_id = ?
            GROUP BY sp.san_pham_id";
    return pdo_query_one($sql, $id);
}