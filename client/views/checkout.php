<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/client/Header.css">
    <link rel="stylesheet" href="./assets/css/client/Footer.css">
    <style>
        .checkout-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        .product-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
        .product-image img {
            max-width: 100px;
            height: auto;
        }
        .checkout-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .total-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <?php include "views/header.php"; ?>

    <div class="checkout-container">
        <div class="checkout-form">
            <h2>Thông tin thanh toán</h2>
            <form action="?act=place-order" method="POST">
                <input type="hidden" name="san_pham_id" value="<?= $product['san_pham_id'] ?>">
                <input type="hidden" name="so_luong" value="<?= $so_luong ?>">
                <input type="hidden" name="gia" value="<?= $product['gia'] ?>">

                <div class="form-group">
                    <label>Họ và tên</label>
                    <input type="text" name="ho_va_ten" class="form-control" required 
                           value="<?= isset($_SESSION['email']) ? $_SESSION['email']['ho_va_ten'] : '' ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required
                           value="<?= isset($_SESSION['email']) ? $_SESSION['email']['email'] : '' ?>">
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="tel" name="so_dien_thoai" class="form-control" required
                           value="<?= isset($_SESSION['email']) ? $_SESSION['email']['so_dien_thoai'] : '' ?>">
                </div>

                <div class="form-group">
                    <label>Địa chỉ giao hàng</label>
                    <textarea name="dia_chi" class="form-control" required><?= isset($_SESSION['email']) ? $_SESSION['email']['dia_chi'] : '' ?></textarea>
                </div>

                <div class="form-group">
                    <label>Phương thức thanh toán</label>
                    <select name="phuong_thuc_thanh_toan" class="form-control" required>
                        <option value="1">Thanh toán khi nhận hàng (COD)</option>
                        <option value="2">Chuyển khoản ngân hàng</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Đặt hàng</button>
            </form>
        </div>

        <div class="product-summary">
            <h3>Thông tin đơn hàng</h3>
            <div class="product-info d-flex gap-3 mb-3">
                <div class="product-image">
                    <img src="<?= $product['hinh_sp'] ?>" alt="<?= $product['ten_san_pham'] ?>">
                </div>
                <div>
                    <h5><?= $product['ten_san_pham'] ?></h5>
                    <p>Số lượng: <?= $so_luong ?></p>
                    <p>Giá: <?= number_format($product['gia'], 0, ',', '.') ?>₫</p>
                    <?php if (isset($ram_info)): ?>
                        <p>RAM: <?= $ram_info['dung_luong'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="total-section">
                <div class="d-flex justify-content-between mb-2">
                    <span>Tạm tính:</span>
                    <span><?= number_format($product['gia'] * $so_luong, 0, ',', '.') ?>₫</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Phí vận chuyển:</span>
                    <span>30.000₫</span>
                </div>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Tổng cộng:</span>
                    <span><?= number_format(($product['gia'] * $so_luong) + 30000, 0, ',', '.') ?>₫</span>
                </div>
            </div>
        </div>
    </div>

    <?php include "views/footer.php"; ?>
</body>
</html>
