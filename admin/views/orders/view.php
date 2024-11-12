<style>
    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        margin-left: 268px;
    }
    .order-details {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .product-item {
        border-bottom: 1px solid #eee;
        padding: 10px 0;
    }
    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }
</style>
<div class="container">
    <div class="mb-4">
        <h4>Chi tiết đơn hàng #<?= $order['don_hang_id'] ?></h4>
    </div>

    <div class="order-details">
        <!-- Thông tin khách hàng -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Thông tin khách hàng</h5>
                <p>Họ tên: <?= $order['ho_va_ten'] ?></p>
                <p>Email: <?= $order['email'] ?></p>
                <p>Số điện thoại: <?= $order['so_dien_thoai'] ?></p>
            </div>
            <div class="col-md-6">
                <h5>Thông tin đơn hàng</h5>
                <p>Ngày đặt: <?= date('d/m/Y', strtotime($order['ngay_dat'])) ?></p>
                <p>Phương thức thanh toán: <?= $order['phuong_thuc_thanh_toan'] == 1 ? 'Tiền mặt' : 'Thẻ' ?></p>
                <p>Trạng thái: 
                    <?php if($order['trang_thai'] == 1): ?>
                        <span class="badge bg-warning">Đang xử lý</span>
                    <?php else: ?>
                        <span class="badge bg-success">Đã hoàn thành</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <h5>Sản phẩm đã đặt</h5>
        <?php foreach ($orderDetails as $item): ?>
        <div class="product-item row align-items-center">
            <div class="col-md-2">
                <img src="../uploads/products/<?= $item['hinh'] ?>" 
                     class="img-fluid rounded" 
                     alt="<?= $item['ten_san_pham'] ?>"
                     style="max-width: 100px;">
            </div>
            <div class="col-md-4">
                <h6><?= $item['ten_san_pham'] ?></h6>
                <small class="text-muted">Đơn giá: <?= number_format($item['gia']) ?>đ</small>
            </div>
            <div class="col-md-2 text-center">
                x<?= $item['so_luong'] ?>
            </div>
            <div class="col-md-4 text-end">
                <strong><?= number_format($item['gia'] * $item['so_luong']) ?>đ</strong>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Tổng tiền -->
        <div class="row mt-4">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <table class="table">
                    <tr>
                        <td><strong>Tổng tiền:</strong></td>
                        <td class="text-end"><?= number_format($order['tong_tien']) ?>đ</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Nút quay lại -->
        <div class="mt-4">
            <a href="index.php?act=orders" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>
</div> 