<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/client/Header.css">
    <link rel="stylesheet" href="./assets/css/client/Footer.css">
    <link rel="stylesheet" href="./assets/css/client/ProductDetail.css">
</head>

<body>
    <?php include "views/header.php"; ?>

    <div class="product-detail-container">
        <div class="product-images">
            <div class="main-image">
                <img id="mainImage" src="<?= $product['hinh_sp'] ?>" alt="<?= $product['ten_san_pham'] ?>">
            </div>
        </div>

        <div class="product-info">
            <h1 class="product-title"><?= $product['ten_san_pham'] ?></h1>
            <div class="product-meta">
                <span class="product-id">Mã SP: <?= $product['san_pham_id'] ?></span>
                <span class="product-views"><i class="fas fa-eye"></i> <?= number_format($product['so_luot_xem']) ?> lượt xem</span>
            </div>

            <div class="product-price">
                <span class="current-price"><?= number_format($product['gia'], 0, ',', '.') ?>₫</span>
                <!-- <?php if (isset($product['gia_goc']) && $product['gia_goc'] > $product['gia']): ?>
                    <span class="original-price"><?= number_format($product['gia_goc'], 0, ',', '.') ?>₫</span>
                    <span class="discount-percent">-<?= ceil((($product['gia_goc'] - $product['gia']) / $product['gia_goc']) * 100) ?>%</span>
                <?php endif; ?> -->
            </div>

            <div class="product-variants">
                <div class="variant-group">
                    <h3>Dung lượng</h3>
                    <div class="variant-options">
                        <?php if (!empty($product['rams'])): ?>
                            <?php foreach ($product['rams'] as $ram): ?>
                                <button class="variant-btn"><?= $ram['dung_luong'] ?></button>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Chưa có thông tin RAM</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- <div class="variant-group">
                    <h3>Màu sắc</h3>
                    <div class="variant-options">
                        <button class="color-btn" data-color="Hồng">
                            <span class="color-circle" style="background-color: #FFB6C1;"></span>
                            <span class="color-name">Hồng</span>
                        </button>
                        <button class="color-btn" data-color="Đen">
                            <span class="color-circle" style="background-color: #000000;"></span>
                            <span class="color-name">Đen</span>
                        </button>
                        <button class="color-btn" data-color="Xanh">
                            <span class="color-circle" style="background-color: #87CEEB;"></span>
                            <span class="color-name">Xanh dương</span>
                        </button>
                    </div>
                </div> -->
            </div>

            <div class="product-actions">
                <button class="buy-now-btn">Mua ngay</button>
                <button class="add-to-cart-btn">Thêm vào giỏ hàng</button>
            </div>

            <div class="product-description">
                <h3>Mô tả sản phẩm</h3>
                <div class="description-content">
                    <?= $product['mo_ta'] ?>
                </div>
            </div>
        </div>

        <div class="product-comments">
            <h3>Bình luận</h3>

            <?php if (isset($_SESSION['email'])): ?>
                <div class="comment-form">
                    <form action="?act=comment" method="POST">
                        <input type="hidden" name="san_pham_id" value="<?= $product['san_pham_id'] ?>">
                        <div class="form-group">
                            <textarea name="noi_dung" class="form-control" rows="3" placeholder="Viết bình luận của bạn..."></textarea>
                        </div>
                        <button type="submit" class="btn-comment">Gửi bình luận</button>
                    </form>
                </div>
            <?php else: ?>
                <p class="login-to-comment">Vui lòng <a href="?act=login">đăng nhập</a> để bình luận</p>
            <?php endif; ?>

            <div class="comment-list">
                <?php
                $comments = getBinhLuanBySanPhamId($product['san_pham_id']);
                foreach ($comments as $comment):
                ?>
                    <div class="comment-item">
                        <div class="comment-avatar">
                            <?php if ($comment['hinh'] && file_exists($comment['hinh'])): ?>
                                <img src="<?= $comment['hinh'] ?>" alt="Avatar">
                            <?php else: ?>
                                <img src="./assets/images/default-avatar.png" alt="Default Avatar">
                            <?php endif; ?>
                        </div>
                        <div class="comment-content">
                            <div class="comment-header">
                                <span class="comment-author"><?= $comment['ho_va_ten'] ?></span>
                                <span class="comment-date" style="margin-left: 8px;"><?= date('d/m/Y H:i', strtotime($comment['ngay_binh_luan'])) ?></span>
                            </div>
                            <div class="comment-text">
                                <?= htmlspecialchars($comment['noi_dung']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <?php include "views/footer.php"; ?>
</body>

</html>