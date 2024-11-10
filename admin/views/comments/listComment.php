<?php
// Khởi tạo các biến mặc định
$currentPage = $GLOBALS['currentPage'] ?? 1;
$totalPages = $GLOBALS['totalPages'] ?? 1;
$comments = $GLOBALS['comments'] ?? [];
$products = $GLOBALS['products'] ?? [];
$filters = $GLOBALS['filters'] ?? [];
?>

<div class="container">
    <div class="page-header">
        <h4 class="mb-0">Quản lý bình luận</h4>
    </div>

    <!-- Phần filter -->
    <div class="filter-section mb-4">
        <form class="row g-3" method="GET">
            <input type="hidden" name="act" value="comments">
            <div class="col-md-3">
                <select class="form-select" name="status">
                    <option value="">Tất cả trạng thái</option>
                    <option value="1" <?= ($filters['status'] == '1') ? 'selected' : '' ?>>Đã duyệt</option>
                    <option value="0" <?= ($filters['status'] == '0') ? 'selected' : '' ?>>Chờ duyệt</option>
                    <option value="2" <?= ($filters['status'] == '2') ? 'selected' : '' ?>>Từ chối</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="product_id">
                    <option value="">Tất cả sản phẩm</option>
                    <?php foreach($products as $product): ?>
                    <option value="<?= $product['san_pham_id'] ?>" 
                            <?= ($filters['product_id'] == $product['san_pham_id']) ? 'selected' : '' ?>>
                        <?= $product['ten_san_pham'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Tìm kiếm..." 
                       name="search" value="<?= $filters['search'] ?? '' ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
            </div>
        </form>
    </div>

    <!-- Danh sách bình luận -->
    <div class="comment-table">
        <?php if(empty($comments)): ?>
            <div class="alert alert-info m-3">Không có bình luận nào.</div>
        <?php else: ?>
            <?php foreach($comments as $comment): ?>
            <div class="comment-card">
                <div class="comment-header">
                    <div class="user-info">
                        <img src="<?= $comment['hinh'] ?? 'assets/images/default-avatar.png' ?>" 
                             alt="User Avatar" class="user-avatar">
                        <div>
                            <h6 class="mb-0"><?= $comment['ho_va_ten'] ?></h6>
                            <small class="text-muted">
                                <?= date('d/m/Y H:i', strtotime($comment['ngay_binh_luan'])) ?>
                            </small>
                        </div>
                    </div>
                    <div class="comment-actions">
                        <span class="comment-status <?= getStatusClass($comment['trang_thai']) ?>">
                            <?= getStatusText($comment['trang_thai']) ?>
                        </span>
                        <?php if($comment['trang_thai'] == 0): ?>
                        <button class="btn btn-sm btn-success" 
                                onclick="approveComment(<?= $comment['binh_luan_id'] ?>)"
                                title="Duyệt">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-warning" 
                                onclick="rejectComment(<?= $comment['binh_luan_id'] ?>)"
                                title="Từ chối">
                            <i class="fas fa-times"></i>
                        </button>
                        <?php endif; ?>
                        <button class="btn btn-sm btn-danger" 
                                onclick="deleteComment(<?= $comment['binh_luan_id'] ?>)"
                                title="Xóa">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="comment-product">
                    <i class="fas fa-box"></i> 
                    Sản phẩm: <a href="#"><?= $comment['ten_san_pham'] ?></a>
                </div>
                <div class="comment-text">
                    <?= htmlspecialchars($comment['noi_dung']) ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>

<?php
function getStatusClass($status) {
    switch($status) {
        case 1: return 'status-approved';
        case 0: return 'status-pending';
        case 2: return 'status-rejected';
        default: return '';
    }
}

function getStatusText($status) {
    switch($status) {
        case 1: return 'Đã duyệt';
        case 0: return 'Chờ duyệt';
        case 2: return 'Từ chối';
        default: return 'Không xác định';
    }
}
?>

<style>
.container {
    width: 1200px;
    margin-left: 310px;
    padding: 20px;
    padding: 30px;
}

.comment-table {
    background-color: white;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    border-radius: 8px;
    margin-top: 20px;
    padding: 20px;
}

.comment-card {
    border: 1px solid #eee;
    border-radius: 8px;
    margin-bottom: 15px;
    padding: 15px;
    background-color: white;
    transition: all 0.3s ease;
}

.comment-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.comment-actions {
    display: flex;
    gap: 10px;
}

.comment-status {
    padding: 4px 8px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 500;
}

.status-approved {
    background-color: #d4edda;
    color: #155724;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
}

.status-rejected {
    background-color: #f8d7da;
    color: #721c24;
}

.comment-product {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 8px;
}

.comment-text {
    margin: 10px 0;
    color: #212529;
}

.comment-meta {
    font-size: 12px;
    color: #6c757d;
}

.filter-section {
    margin-bottom: 20px;
    padding: 15px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}
</style>
