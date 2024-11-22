<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/client/Cart.css">
</head>
<body>
    <?php include "views/header.php"; ?>
    
    <div class="container mt-5">
        <h2>Giỏ hàng của bạn</h2>
        
        <?php if (!empty($cartItems)): ?>
            <div class="cart-container">
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <img src="<?= $item['hinh_sp'] ?>" alt="<?= $item['ten_san_pham'] ?>">
                            <div class="item-details">
                                <h3><?= $item['ten_san_pham'] ?></h3>
                                <p class="price">
                                    <?php if (!empty($item['phan_tram_giam'])): ?>
                                        <del class="original-price">
                                            <?= number_format($item['gia_goc'], 0, ',', '.') ?>₫
                                        </del>
                                        <span class="discounted-price">
                                            <?= number_format($item['gia_sau_khuyen_mai'], 0, ',', '.') ?>₫
                                        </span>
                                        <span class="discount-badge">-<?= $item['phan_tram_giam'] ?>%</span>
                                    <?php else: ?>
                                        <?= number_format($item['gia_goc'], 0, ',', '.') ?>₫
                                    <?php endif; ?>
                                </p>
                                <div class="quantity">
                                    <span>Số lượng: <?= $item['so_luong'] ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="cart-summary">
                    <h3>Tổng đơn hàng</h3>
                    <div class="summary-item">
                        <span>Tạm tính:</span>
                        <span><?= number_format($totalAmount, 0, ',', '.') ?>₫</span>
                    </div>
                    <div class="summary-item">
                        <span>Phí vận chuyển:</span>
                        <span>30.000₫</span>
                    </div>
                    <div class="summary-total">
                        <span>Tổng cộng:</span>
                        <span><?= number_format($totalAmount + 30000, 0, ',', '.') ?>₫</span>
                    </div>
                    
                    <form action="index.php" method="POST" class="checkout-form">
                        <input type="hidden" name="act" value="checkout">
                        <div class="form-group">
                            <input type="text" name="dia_chi" placeholder="Địa chỉ giao hàng" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="so_dien_thoai" placeholder="Số điện thoại" required>
                        </div>
                        <button type="submit" class="checkout-btn">Đặt hàng</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <p>Giỏ hàng của bạn đang trống</p>
                <a href="index.php" class="continue-shopping">Tiếp tục mua sắm</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include "views/footer.php"; ?>
</body>
</html> 