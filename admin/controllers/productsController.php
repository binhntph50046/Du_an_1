<?php

class ProductsController
{
    public $modelProducts;
    private $conn;

    public function __construct()
    {
        $this->modelProducts = new Products();
        $this->conn = connectDB();
    }

    public function getAllRam()
    {
        return $this->modelProducts->getAllRam();
    }

    public function listProducts()
    {
        $listProducts = $this->modelProducts->getAllProducts();
        // var_dump($listProducts);
        echo "<!-- Debug: ";
        // var_dump($listProducts);
        echo " -->";
        
        require_once './views/Products/listProducts.php';
    }

    public function formAddProducts()
    {
        $categories = $this->modelProducts->getCategories();
        $rams = $this->modelProducts->getAllRam();
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
            // var_dump("hinh", $hinh);

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
                // var_dump($url);
                $san_pham_id = $result['san_pham_id'];
                $this->modelProducts->addProductImage($url, $san_pham_id);
            }
            header("location: ?act=listProducts");
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
        $rams = $this->modelProducts->getAllRam();
        $productRams = $this->modelProducts->getProductRams($id);
        $product = $this->modelProducts->thongTinProduct($id);

        // Debug product data
        error_log("Product data: " . print_r($product, true));

        if (!$product) {
            die("Không tìm thấy sản phẩm với ID: " . $id);
        }

        require_once './views/Products/editProducts.php';
    }


    
    public function updateProduct() {
        try {
            $san_pham_id = (int)$_POST['san_pham_id'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia = (int)$_POST['gia'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $mo_ta = $_POST['mo_ta'];
            $old_img = $_POST['old_img'];
            $trang_thai = (int)$_POST['trang_thai'];
            $danh_muc_id = (int)$_POST['danh_muc_id'];
            $hinh_id = $_POST['hinh_anh_id'];

            // Xử lý hình ảnh
            if(isset($_FILES['hinh_sp']) && $_FILES['hinh_sp']['error'] === UPLOAD_ERR_OK) {
                $hinh_path = uploadFile($_FILES['hinh_sp'], '../Upload/Product/');
            } else {
                $hinh_path = $old_img;
            }

            // Bắt đầu transaction
            $this->conn->beginTransaction();

            // Cập nhật thông tin cơ bản của sản phẩm
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

            // Cập nhật RAM của sản phẩm
            if (isset($_POST['ram_ids']) && is_array($_POST['ram_ids'])) {
                $this->modelProducts->updateProductRams($san_pham_id, $_POST['ram_ids']);
            }

            $this->conn->commit();

            if ($result) {
                echo "<script>alert('Cập nhật thành công'); window.location.href='index.php?act=listProducts';</script>";
            } else {
                echo "<script>alert('Cập nhật thất bại'); window.location.href='index.php?act=listProducts';</script>";
            }
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log($e->getMessage());
            echo "<script>alert('Có lỗi xảy ra!'); window.location.href='index.php?act=formEditProducts&id=".$san_pham_id."';</script>";
        }
    }

    public function deleteProduct($id)
    {
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception('ID không hợp lệ');
        }

        // Kiểm tra sản phẩm có trong đơn hàng không
        $orderCheck = $this->modelProducts->checkProductInOrders($id);
        if ($orderCheck) {
            $_SESSION['error'] = "Không thể xóa sản phẩm đang có trong đơn hàng!";
            header('Location: ./?act=listProducts');
            exit();
        }

        // Nếu không có trong đơn hàng thì xóa
        $result = $this->modelProducts->deleteProductAndImages($id);
        if ($result) {
            $_SESSION['success'] = "Xóa sản phẩm thành công!";
            header('Location: ./?act=listProducts');
        } else {
            $_SESSION['error'] = "Không thể xóa sản phẩm!";
            header('Location: ./?act=listProducts');
        }
        exit();
    }
}