<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/client/Header.css">
    <style>
        .checkout-container {
            display: flex;
            gap: 30px;
            padding: 20px;
        }
        .order-info, .product-details {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .section-title {
            color: #4461F2;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table th, .info-table td {
            padding: 12px;
            border: 1px solid #dee2e6;
        }
        .info-table th {
            background: #f8f9fa;
            width: 35%;
            font-weight: 500;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
        }
        .product-table th, .product-table td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: center;
        }
        .product-table th {
            background: #f8f9fa;
        }
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        .total-row {
            text-align: right;
            padding: 10px 0;
        }
        .total-amount {
            color: #4461F2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include "views/header.php"; ?>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Chi tiết đơn hàng #<?= isset($_GET['id']) ? $_GET['id'] : '' ?></h1>
            <a href="index.php" class="btn btn-secondary">← Quay lại</a>
        </div>
        
        <div class="checkout-container">
            <div class="order-info">
                <h2 class="section-title">Thông tin đơn hàng</h2>
                <form action="?act=place-order" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['san_pham_id'] ?>">
                    <input type="hidden" name="product_price" value="<?= $product['gia'] ?>">
                    <input type="hidden" name="quantity" value="1">
                    
                    <table class="info-table">
                        <tr>
                            <th>Khách hàng:</th>
                            <td><input type="text" name="customer_name" class="form-control" value="<?= isset($_SESSION['email']) ? $_SESSION['email']['ho_va_ten'] : '' ?>" required></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><input type="email" name="customer_email" class="form-control" value="<?= isset($_SESSION['email']) ? $_SESSION['email']['email'] : '' ?>" required></td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td><input type="tel" name="customer_phone" class="form-control" value="<?= isset($_SESSION['email']) ? $_SESSION['email']['so_dien_thoai'] : '' ?>" required></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td><textarea name="customer_address" class="form-control" required><?= isset($_SESSION['email']) ? $_SESSION['email']['dia_chi'] : '' ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Phương thức thanh toán:</th>
                            <td>
                                <select name="payment_method" class="form-control" required>
                                    <option value="1">Thanh toán khi nhận hàng (COD)</option>
                                    <option value="2">Chuyển khoản ngân hàng</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    
                    <button type="submit" name="place_order" class="btn btn-primary w-100 mt-3">Đặt hàng</button>
                </form>
            </div>

            <div class="product-details">
                <h2 class="section-title">Chi tiết sản phẩm</h2>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?= $product['hinh_sp'] ?>" alt="<?= $product['ten_san_pham'] ?>" class="product-img me-2">
                                    <span><?= $product['ten_san_pham'] ?></span>
                                </div>
                            </td>
                            <td>1</td>
                            <td><?= number_format($product['gia'], 0, ',', '.') ?>₫</td>
                            <td><?= number_format($product['gia'], 0, ',', '.') ?>₫</td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="mt-3">
                    <div class="total-row">
                        <span>Tạm tính:</span>
                        <span class="ms-2"><?= number_format($product['gia'], 0, ',', '.') ?>₫</span>
                    </div>
                    <div class="total-row">
                        <span>Phí vận chuyển:</span>
                        <span class="ms-2">30.000₫</span>
                    </div>
                    <div class="total-row">
                        <span>Tổng cộng:</span>
                        <span class="ms-2 total-amount"><?= number_format($product['gia'] + 30000, 0, ',', '.') ?>₫</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "views/footer.php"; ?>
</body>
</html> 