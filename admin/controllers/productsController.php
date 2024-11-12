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
        require_once './views/Products/formAddProducts.php';
    }

    public function postFormAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia = $_POST['gia'];
            $hinh = $_FILES['hinh'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $mo_ta = $_POST['mo_ta'];
            $so_luot_xem = $_POST['so_luot_xem'];
            $trang_thai = $_POST['trang_thai'];
            $danh_muc_id = isset($_POST['danh_muc_id']) ? $_POST['danh_muc_id'] : NULL;

            $hinh_path = uploadFile($hinh, '../Upload/Product');

            if ($hinh_path !== null) {
                $result = $this->modelProducts->addProduct($ten_san_pham, $gia, $hinh_path, $ngay_nhap, $mo_ta, $so_luot_xem, $trang_thai, $danh_muc_id);

                if ($result) {
                    echo "<script>window.location.href='index.php?act=listProducts';</script>";
                    return;
                }
            }
            echo "Thêm thất bại";
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

        // Debug ID after conversion
        error_log("ID after conversion: " . $id);

        $product = $this->modelProducts->thongTinProduct($id);

        // Debug product data
        error_log("Product data: " . print_r($product, true));

        if (!$product) {
            die("Không tìm thấy sản phẩm với ID: " . $id);
        }

        require_once './views/Products/editProducts.php';
    }

    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            $san_pham_id = $_POST['san_pham_id'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia = $_POST['gia'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $mo_ta = $_POST['mo_ta'];
            $so_luot_xem = $_POST['so_luot_xem'];
            $trang_thai = $_POST['trang_thai'];
            $danh_muc_id = isset($_POST['danh_muc_id']) ? $_POST['danh_muc_id'] : NULL;
            $old_img = $_POST['old_img'];

            // Xử lý ảnh
            if (isset($_FILES['hinh']) && $_FILES['hinh']['error'] === 0) {
                $hinh_path = uploadFile($_FILES['hinh'], '../Upload/Product/');
            } else {
                $hinh_path = $old_img; // Giữ ảnh cũ nếu không upload ảnh mới
            }

            // Gọi hàm update 
            $result = $this->modelProducts->updateProduct($san_pham_id, $ten_san_pham, $gia, $hinh_path, $ngay_nhap, $mo_ta, $so_luot_xem, $trang_thai, $danh_muc_id);

            if ($result) {
                echo "<script>window.location.href='index.php?act=listProducts';</script>";
                return;
            } elseif (!$result) {
                echo "<script>window.location.href='index.php?act=listProducts';</script>";
                return;
            }
            echo "Cập nhật thất bại";
        }
    }

    public function deleteProduct()
    {
        // Lấy ID sản phẩm từ URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            // Kiểm tra xem sản phẩm có tồn tại không
            $product = $this->modelProducts->getProductById($id);

            if ($product) {
                // Xóa ảnh nếu có
                if (file_exists(PATH_ROOT . $product['hinh'])) {
                    unlink(PATH_ROOT . $product['hinh']);
                }

                // Gọi model để xóa sản phẩm khỏi cơ sở dữ liệu
                if ($this->modelProducts->deleteProductById($id)) {
                    // Sau khi xóa thành công, chuyển hướng về trang danh sách sản phẩm
                    header('Location:?act=listProducts');
                    exit();
                } else {
                    echo "Xóa sản phẩm thất bại.";
                }
            } else {
                echo "Sản phẩm không tồn tại.";
            }
        } else {
            echo "ID sản phẩm không hợp lệ.";
        }
    }
}
