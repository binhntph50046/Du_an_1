<?php
    function insert_taikhoan($name,$email,$pass, $address, $phonenumber) {
        $sql = "INSERT INTO tai_khoan(ho_va_ten, email, mat_khau, dia_chi, so_dien_thoai) VALUES('$name', '$email','$pass','$address', '$phonenumber')";
        pdo_execute($sql);
    }
    function check_user($email, $pass) {
        $sql = "SELECT * FROM tai_khoan WHERE email='".$email."' AND mat_khau='".$pass."' ";
        $sp = pdo_query_one($sql);
        return $sp;
    }
?>