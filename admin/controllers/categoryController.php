<?php
ob_start();
class CategoryController
{
    public $modelCategory;

    public function __construct()
    {
        $this->modelCategory = new Category();
    }

    public function listCategory()
    {
        $listCategory = $this->modelCategory->getCategory();
        require_once './views/category/formListCategory.php';
    }

    public function formAddCategory()
    {
        require_once './views/category/formAddCategory.php';
    }

    public function postAddCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $hinh = $_FILES['hinh'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];

            $hinh_path = uploadFile($hinh, '../Upload/Category/');
            if ($hinh_path !== null && $this->modelCategory->addCategory($ten_danh_muc, $hinh_path, $mo_ta, $trang_thai)) {
                header('Location:./?act=list-category');
                exit();
            } else {
                echo "Thêm thất bại";
            }
        }
    }

    public function postEditCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
            $danh_muc_id = $_POST['danh_muc_id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];

            if (isset($_FILES['hinh']) && $_FILES['hinh']['error'] === UPLOAD_ERR_OK) {
                if (!empty($_POST['old_img'])) {
                    deleteFile($_POST['old_img']);
                }
                $new_img = uploadFile($_FILES['hinh'], '../Upload/Category/');
            } else {
                $new_img = $_POST['old_img'];
            }

            if ($this->modelCategory->updateCategory($danh_muc_id, $ten_danh_muc, $new_img, $mo_ta, $trang_thai)) {
                header("Location: ./?act=list-category");
                exit();
            } else {
                echo "Sửa thất bại!";
            }
        } else {
            echo "Không có dữ liệu gửi đi!";
        }
    }

    public function formEditCategory()
    {
        $danh_muc_id = $_GET['danh_muc_id'];
        $Category = $this->modelCategory->inforCategory($danh_muc_id);
        require_once './views/category/formEditCategory.php';
    }

    public function postDeleteCategory()
    {
        $danh_muc_id = $_GET['danh_muc_id'];
        if ($this->modelCategory->deleteCategory($danh_muc_id)) {
            header('Location: ?act=list-category');
            exit();
        } else {
            echo "Xóa thất bại!";
        }
    }
}
