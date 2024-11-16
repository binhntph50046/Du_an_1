<?php

class ProductsController
{
    public $modelProducts;

    public function __construct()
    {
        $this->modelProducts = new Products();
    }


    public function listProducts()
    {
        // Debug kết nối
        if (!$this->modelProducts->conn) {
            die("Không có kết nối database");
        }

        // Lấy dữ liệu từ model và debug
        $listProducts = $this->modelProducts->getAllProducts();
        // var_dump($listProducts);
        echo "<!-- Debug: ";
        var_dump($listProducts);
        echo " -->";

        // Đảm bảo $listProducts là một mảng
        if (!is_array($listProducts)) {
            $listProducts = [];
        }

        // Kiểm tra biến có được định nghĩa không
        if (!isset($listProducts)) {
            die("Biến listProducts không được định nghĩa");
        }

        // Truyền dữ liệu vào view
        require_once './views/Products/listProducts.php';
    }

    public function formAddProducts()
    {
        $categories = $this->modelProducts->getCategories();
        // var_dump($categories);

        require_once './views/Products/formAddProducts.php';
    }


    public function postFormAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia = $_POST['gia'];
            $hinh = $_FILES['hinh_sp'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];
            $danh_muc_id = isset($_POST['danh_muc']) ? $_POST['danh_muc'] : NULL;
            var_dump("hinh", $hinh);

            // $hinhPath = uploadFile($hinh,'../Upload/Product/');

            $result = $this->modelProducts->addProduct($ten_san_pham, $gia, $ngay_nhap, $mo_ta, $trang_thai, $danh_muc_id);
            // var_dump($result['san_pham_id']);

            foreach ($hinh['name'] as $key => $value) {
                $file = [
                    'name' => $hinh['name'][$key],
                    'type' => $hinh['type'][$key],
                    'tmp_name' => $hinh['tmp_name'][$key],
                    'error' => $hinh['error'][$key],
                    'size' => $hinh['size'][$key]
                ];

                $url = uploadFile($file, '../Upload/Product/');
                var_dump($url);
                $san_pham_id = $result['san_pham_id'];
                $this->modelProducts->addProductImage($url, $san_pham_id);
            }

            if ($result) {
                echo "<script>window.location.href='index.php?act=listProducts';</script>";
                return;
            }




            // if($hinhPath !== null){
            //     $result = $this->modelProducts->addProduct($ten_san_pham, $gia, $ngay_nhap, $mo_ta, $so_luot_xem, $trang_thai, $danh_muc_id);



            // }


            // echo "Thêm thất bại";
        }
    }

    public function formEditProducts()
    {
        // Debug URL parameters
        error_log("GET parameters: " . print_r($_GET, true));

        // Kiểm tra chi tiết ID
        if (!isset($_GET['id'])) {
            die("Thiếu tham số ID");
        }

        if (!is_numeric($_GET['id'])) {
            die("ID phải là số");
        }

        $id = (int)$_GET['id'];
        if ($id <= 0) {
            die("ID không hợp lệ");
        }
        // lấy dữ liệu bảng danh mục
        $categories = $this->modelProducts->getCategories();

        $product = $this->modelProducts->thongTinProduct($id);

        // Debug product data
        error_log("Product data: " . print_r($product, true));

        if (!$product) {
            die("Không tìm thấy sản phẩm với ID: " . $id);
        }

        require_once './views/Products/editProducts.php';
    }


    
    public function updateProduct(){
        $san_pham_id = (int)$_POST['san_pham_id'];
        $ten_san_pham = $_POST['ten_san_pham'];
        $gia = (int)$_POST['gia'];
        $ngay_nhap = $_POST['ngay_nhap'];
        $mo_ta = $_POST['mo_ta'];
        $old_img = $_POST['old_img'];
        $trang_thai = (int)$_POST['trang_thai'];
        $danh_muc_id = (int)$_POST['danh_muc_id'];
        $hinh_id = $_POST['hinh_anh_id'];
        var_dump($_POST);

        

        if(isset($_FILES['hinh_sp']) && $_FILES['hinh_sp']['error']  === UPLOAD_ERR_OK){
            $hinh_path = uploadFile($_FILES['hinh_sp'], '../Upload/Product/');
        }
        else{
            $hinh_path = $old_img;
        }
        

        $result = $this->modelProducts->updateProductWithRelations(
            $san_pham_id,
            $ten_san_pham,
            $gia,
            $hinh_id,
            $hinh_path,
            $ngay_nhap,
            $mo_ta,
            $trang_thai,
            $danh_muc_id
        );
        
        if ($result) {
            echo "<script>alert('Cập nhật thành công'); window.location.href='index.php?act=listProducts';</script>";
        } else {
            echo "<script>alert('Cập nhật thất bại'); window.location.href='index.php?act=listProducts';</script>";
        }
    }
    public function deleteProduct($id)
    {
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception('ID không hợp lệ');
        }

        // Gọi model để xóa sản phẩm
        $result = $this->modelProducts->deleteProductAndImages($id);

        if ($result) {
            // Điều hướng sau khi xóa thành công
            header('Location: ./?act=listProducts');
        } else {
            // Xử lý lỗi
            throw new \Exception('Không thể xóa sản phẩm');
        }
    }
}
