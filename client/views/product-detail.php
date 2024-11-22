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
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>
    <?php include "views/header.php"; ?>

    <div class="messages">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success'] ?>
                <?php unset($_SESSION['success']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']) ?>
            </div>
        <?php endif; ?>
    </div>

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
            </div>
                
                <!-- Chọn RAM -->
                <div class="ram-selector">
                    <label>Chọn dung lượng RAM:</label>
                    <div class="ram-options">
                        <?php if (!empty($product['rams'])): ?>
                            <?php foreach ($product['rams'] as $ram): ?>
                                <label class="ram-option">
                                    <input type="radio" name="ram_id" value="<?= $ram['ram_id'] ?>" required>
                                    <span class="ram-label"><?= $ram['dung_luong'] ?></span>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="quantity-selector">
                    <label>Số lượng:</label>
                    <div class="quantity-controls">
                        <button type="button" onclick="decreaseQuantity()" class="quantity-btn minus">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" name="so_luong" value="1" min="1" max="10" readonly>
                        <button type="button" onclick="increaseQuantity()" class="quantity-btn plus">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="button-group">
                    <form action="?act=add-to-cart" method="POST" class="d-inline">
                        <input type="hidden" name="san_pham_id" value="<?= $product['san_pham_id'] ?>">
                        <input type="hidden" name="ten_san_pham" value="<?= $product['ten_san_pham'] ?>">
                        <input type="hidden" name="gia" value="<?= $product['gia'] ?>">
                        <input type="hidden" name="hinh_sp" value="<?= $product['hinh_sp'] ?>">
                        <input type="hidden" name="so_luong" id="cart_quantity" value="1">
                        <input type="hidden" name="ram_id" id="cart_ram_id">
                        <button type="submit" name="add-to-cart" class="btn-add-to-cart" onclick="return validateForm()">
                            <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                        </button>
                    </form>
                    
                    <form action="?act=checkout" method="POST" class="d-inline">
                        <input type="hidden" name="san_pham_id" value="<?= $product['san_pham_id'] ?>">
                        <input type="hidden" name="ten_san_pham" value="<?= $product['ten_san_pham'] ?>">
                        <input type="hidden" name="gia" value="<?= $product['gia'] ?>">
                        <input type="hidden" name="hinh_sp" value="<?= $product['hinh_sp'] ?>">
                        <input type="hidden" name="so_luong" id="buy_quantity">
                        <input type="hidden" name="ram_id" id="selected_ram">
                        <button type="submit" name="buy-now" class="btn-buy-now">
                            <i class="fas fa-bolt"></i> Mua ngay
                        </button>
                    </form>
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

    <script>
    function decreaseQuantity() {
        var input = document.querySelector('input[name="so_luong"]');
        var cartQuantityInput = document.getElementById('cart_quantity');
        var buyQuantityInput = document.getElementById('buy_quantity');
        var value = parseInt(input.value);
        if (value > 1) {
            value = value - 1;
            input.value = value;
            cartQuantityInput.value = value;
            buyQuantityInput.value = value;
        }
    }

    function increaseQuantity() {
        var input = document.querySelector('input[name="so_luong"]');
        var cartQuantityInput = document.getElementById('cart_quantity');
        var buyQuantityInput = document.getElementById('buy_quantity');
        var value = parseInt(input.value);
        if (value < 10) {
            value = value + 1;
            input.value = value;
            cartQuantityInput.value = value;
            buyQuantityInput.value = value;
        }
    }

    document.querySelectorAll('input[name="ram_id"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.getElementById('cart_ram_id').value = this.value;
            document.getElementById('selected_ram').value = this.value;
        });
    });

    function validateForm() {
        var ramId = document.getElementById('cart_ram_id').value;
        if (!ramId) {
            alert('Vui lòng chọn dung lượng RAM');
            return false;
        }
        return true;
    }

    window.onload = function() {
        document.getElementById('cart_quantity').value = 1;
        document.getElementById('buy_quantity').value = 1;
        
        var firstRam = document.querySelector('input[name="ram_id"]');
        if (firstRam) {
            firstRam.checked = true;
            document.getElementById('cart_ram_id').value = firstRam.value;
            document.getElementById('selected_ram').value = firstRam.value;
        }
    }
    </script>
</body>

</html>