<?php
function loadall_sanpham_home()
{
    $sql = "SELECT DISTINCT  san_pham.san_pham_id, san_pham.ten_san_pham, san_pham.gia, hinh_anh_san_pham.hinh_sp
            FROM san_pham
            INNER JOIN hinh_anh_san_pham
            ON san_pham.san_pham_id = hinh_anh_san_pham.san_pham_id
            ORDER BY san_pham.san_pham_id DESC
            LIMIT 0, 9";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
// function loadall_sanpham($kyw = "", $iddm = 0)
// {
//     $sql = "SELECT * FROM san_pham WHERE 1";
//     if ($kyw != '') {
//         $sql .= " and name like '%" . $kyw . "%'"; // tim sp cung ten
//     }
//     if ($iddm > 0) {
//         $sql .= " and iddm ='" . $iddm . "'"; // tim sp cung ten
//     }
//     $sql .= " order by id desc";
//     $listsanpham = pdo_query($sql);
//     return $listsanpham;
// }
// function load_ten_dm($iddm)
// {
//     if ($iddm > 0) {
//         $sql = 'SELECT * FROM danh_muc WHERE danu_muc_id=' . $iddm;
//         $dm = pdo_query_one($sql);
//         extract($dm);
//         return $name;
//     } else {
//         return "";
//     }
// }
