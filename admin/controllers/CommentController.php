<?php
class CommentController {
    private $commentModel;
    private $productModel;

    public function __construct() {
        $this->commentModel = new CommentModel();
        $this->productModel = new ProductModel();
    }

    public function index() {
        try {
            // Xử lý phân trang
            $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
            $limit = 10;
            $offset = ($page - 1) * $limit;

            // Xử lý filter
            $filters = [
                'status' => $_GET['status'] ?? '',
                'product_id' => $_GET['product_id'] ?? '',
                'search' => $_GET['search'] ?? ''
            ];

            // Lấy dữ liệu
            $comments = $this->commentModel->getComments($filters, $limit, $offset);
            $totalComments = $this->commentModel->getTotalComments($filters);
            $totalPages = ceil($totalComments / $limit);

            // Gán dữ liệu vào GLOBALS để view có thể truy cập
            $GLOBALS['comments'] = $comments;
            $GLOBALS['products'] = $this->productModel->getAllProducts();
            $GLOBALS['currentPage'] = $page;
            $GLOBALS['totalPages'] = $totalPages;
            $GLOBALS['filters'] = $filters;

        } catch (Exception $e) {
            error_log("Lỗi controller bình luận: " . $e->getMessage());
            $_SESSION['error'] = "Có lỗi xảy ra khi tải danh sách bình luận";
            
            // Gán giá trị mặc định khi có lỗi
            $GLOBALS['comments'] = [];
            $GLOBALS['products'] = [];
            $GLOBALS['currentPage'] = 1;
            $GLOBALS['totalPages'] = 1;
            $GLOBALS['filters'] = [];
        }
    }

    public function approve() {
        try {
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            
            if (!$id) {
                throw new Exception("ID bình luận không hợp lệ");
            }

            if ($this->commentModel->updateStatus($id, 1)) {
                $_SESSION['success'] = "Đã duyệt bình luận thành công!";
            } else {
                $_SESSION['error'] = "Không thể duyệt bình luận!";
            }

        } catch (Exception $e) {
            error_log("Lỗi duyệt bình luận: " . $e->getMessage());
            $_SESSION['error'] = "Có lỗi xảy ra khi duyệt bình luận";
        }

        header('Location: index.php?act=comments');
        exit();
    }

    public function reject() {
        try {
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            
            if (!$id) {
                throw new Exception("ID bình luận không hợp lệ");
            }

            if ($this->commentModel->updateStatus($id, 2)) {
                $_SESSION['success'] = "Đã từ chối bình luận thành công!";
            } else {
                $_SESSION['error'] = "Không thể từ chối bình luận!";
            }

        } catch (Exception $e) {
            error_log("Lỗi từ chối bình luận: " . $e->getMessage());
            $_SESSION['error'] = "Có lỗi xảy ra khi từ chối bình luận";
        }

        header('Location: index.php?act=comments');
        exit();
    }

    public function delete() {
        try {
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            
            if (!$id) {
                throw new Exception("ID bình luận không hợp lệ");
            }

            if ($this->commentModel->deleteComment($id)) {
                $_SESSION['success'] = "Đã xóa bình luận thành công!";
            } else {
                $_SESSION['error'] = "Không thể xóa bình luận!";
            }

        } catch (Exception $e) {
            error_log("Lỗi xóa bình luận: " . $e->getMessage());
            $_SESSION['error'] = "Có lỗi xảy ra khi xóa bình luận";
        }

        header('Location: index.php?act=comments');
        exit();
    }
} 