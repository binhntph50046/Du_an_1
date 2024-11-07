<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

// ham xu li them file 
function uploadFile($file,$folderUpload){
    //thêm thời gian vào đầu tên file để chống trùng tên
    $pathStorage=$folderUpload . time() . $file['name'];
    $from=$file['tmp_name'];
    $to=PATH_ROOT . $pathStorage; // đường dẫn tuyệt đối
    if(move_uploaded_file($from,$to)){
        return $pathStorage ; // trả đường dẫn lưu vào db
    }else{
        return null;
    }
} 
// hàm xử lý xóa file
function deleteFile($file){
    $path=PATH_ROOT . $file;
    if(file_exists($path)){
        unlink($path);
    }
}
