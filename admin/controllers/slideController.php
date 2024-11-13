<?php
ob_start();
class SLideController
{
    public $modelSlide;

    public function __construct()
    {
        $this->modelSlide = new Slide();
    }

    public function listSlide()
    {
        $listSlide = $this->modelSlide->getSlide();
        require_once './views/slide/formListSlide.php';
    }

    public function formAddSlide()
    {
        require_once './views/slide/formAddSlide.php';
    }

    public function postAddSlide()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            $img = $_FILES['img'];
            $trang_thai = $_POST['trang_thai'];

            $hinh_path = uploadFile($img, '../Upload/Slides/');
            if ($hinh_path !== null && $this->modelSlide->addSlide($hinh_path, $trang_thai)) {
                header('Location:./?act=list-slide');
                exit();
            } else {
                echo "Thêm thất bại";
            }
        }
    }

    public function postEditSlide()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
            $slide_id = $_POST['slide_id'];
            $trang_thai = $_POST['trang_thai'];

            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                if (!empty($_POST['old_img'])) {
                    deleteFile($_POST['old_img']);
                }
                $new_img = uploadFile($_FILES['img'], '../Upload/Slides/');
            } else {
                $new_img = $_POST['old_img'];
            }

            if ($this->modelSlide->updateSlide($slide_id,  $new_img,  $trang_thai)) {
                header("Location: ./?act=list-slide");
                exit();
            } else {
                echo "Sửa thất bại!";
            }
        } else {
            echo "Không có dữ liệu gửi đi!";
        }
    }

    public function formEditSlide()
    {
        $slide_id = $_GET['slide_id'];
        $Slide = $this->modelSlide->inforSlide($slide_id);
        require_once './views/slide/formEditSlide.php';
    }

    public function postDeleteSlide()
    {
        $slide_id = $_GET['slide_id'];
        if ($this->modelSlide->deleteSlide($slide_id)) {
            header('Location: ?act=list-slide');
            exit();
        } else {
            echo "Xóa thất bại!";
        }
    }
}
