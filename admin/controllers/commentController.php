<?php
ob_start();
class commentController
{
    public $commentController;

    public function __construct()
    {
        $this->commentController = new comment();
    }

    public function listComment()
    {
        $listComment = $this->commentController->getComment();
        require_once './views/comments/listComment.php';
    }

    public function deleteComments()
    {
        $binh_luan_id = $_GET['binh_luan_id'];
        if ($this->commentController->deleteComments($binh_luan_id)) {
            header('Location: ?act=listComments');
            exit();
        } else {
            echo "Xóa thất bại!";
        }
    }
}
