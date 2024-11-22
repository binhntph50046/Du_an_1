<div class="cart-container">
    <h2 class="cart-title">Giỏ hàng của bạn</h2>
    
    <?php if (empty($cartItems)): ?>
        <div class="empty-cart">
            <p>Giỏ hàng của bạn đang trống</p>
            <a href="index.php" class="btn-continue-shopping">Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <div class="cart-content">
            <div class="cart-items">
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="<?= $item['hinh_sp'] ?>" alt="<?= $item['ten_san_pham'] ?>">
                        </div>
                        <div class="item-details">
                            <h3 class="item-name"><?= $item['ten_san_pham'] ?></h3>
                            <p class="item-variant">RAM: <?= $item['dung_luong'] ?></p>
                            <div class="item-price"><?= number_format($item['gia'], 0, ',', '.') ?>₫</div>
                            
                            <div class="quantity-controls">
                                <button onclick="updateQuantity(<?= $item['gio_hang_id'] ?>, 'decrease')">-</button>
                                <input type="number" value="<?= $item['so_luong'] ?>" 
                                       min="1" max="10" 
                                       id="qty-<?= $item['gio_hang_id'] ?>"
                                       onchange="updateQuantity(<?= $item['gio_hang_id'] ?>, 'input')">
                                <button onclick="updateQuantity(<?= $item['gio_hang_id'] ?>, 'increase')">+</button>
                            </div>
                            
                            <div class="item-subtotal">
                                Thành tiền: <?= number_format($item['thanh_tien'], 0, ',', '.') ?>₫
                            </div>
                            
                            <button class="btn-remove" onclick="removeItem(<?= $item['gio_hang_id'] ?>)">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <h3>Tổng tiền giỏ hàng</h3>
                <div class="summary-row">
                    <span>Tổng cộng:</span>
                    <span class="final-total">
                        <?= number_format(array_sum(array_map(function($item) {
                            return $item['thanh_tien'];
                        }, $cartItems)), 0, ',', '.') ?>₫
                    </span>
                </div>
                <button class="btn-checkout" onclick="location.href='?act=checkout'">
                    Tiến hành đặt hàng
                </button>
                <a href="index.php" class="btn-continue">Tiếp tục mua sắm</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="assets/js/cart.js"></script>

