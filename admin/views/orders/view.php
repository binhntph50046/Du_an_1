<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết đơn hàng #<?= $orderData['order']['don_hang_id'] ?></h1>
        <a href="index.php?act=list-orders" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin đơn hàng</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Khách hàng:</th>
                            <td><?= $orderData['order']['ho_va_ten'] ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?= $orderData['order']['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td><?= $orderData['order']['so_dien_thoai'] ?></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td><?= $orderData['order']['dia_chi'] ?></td>
                        </tr>
                        <tr>
                            <th>Ngày đặt:</th>
                            <td><?= date('d/m/Y', strtotime($orderData['order']['ngay_dat'])) ?></td>
                        </tr>
                        <?php if($orderData['order']['trang_thai'] != 4): ?>
                        <tr>
                            <th>Phương thức thanh toán:</th>
                            <td>
                                <?= $orderData['order']['phuong_thuc_thanh_toan'] == 'online' ? 
                                    '<span class="btn btn-danger">Thanh toán Online</span>' : 
                                    '<span class="btn btn-info">Thanh toán khi nhận hàng (COD)</span>' ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th>Trạng thái:</th>
                            <td>
                                <form action="index.php?act=update-order-status" method="POST">
                                    <input type="hidden" name="order_id" value="<?= $orderData['order']['don_hang_id'] ?>">
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="1" <?= $orderData['order']['trang_thai'] == 1 ? 'selected' : '' ?>>
                                            Chờ xử lý
                                        </option>
                                        <option value="2" <?= $orderData['order']['trang_thai'] == 2 ? 'selected' : '' ?>>
                                            Đang xử lý
                                        </option>
                                        <option value="3" <?= $orderData['order']['trang_thai'] == 3 ? 'selected' : '' ?>>
                                            Đã hoàn thành
                                        </option>
                                        <option value="4" <?= $orderData['order']['trang_thai'] == 4 ? 'selected' : '' ?>>
                                            Đã hủy
                                        </option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <?php if($orderData['order']['trang_thai'] == 4): ?>
                        <tr>
                            <th>Thao tác:</th>
                            <td>
                                <form action="index.php?act=delete-order" method="POST" 
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                                    <input type="hidden" name="order_id" value="<?= $orderData['order']['don_hang_id'] ?>">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Xóa đơn hàng
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chi tiết sản phẩm</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Giảm giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderData['items'] as $item): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= $item['hinh'] ?>" alt="" style="width: 50px; margin-right: 10px;">
                                            <?= $item['ten_san_pham'] ?>
                                        </div>
                                    </td>
                                    <td><?= $item['so_luong'] ?></td>
                                    <td><?= number_format($item['gia']) ?>đ</td>
                                    <td><?= $item['khuyen_mai'] ?>%</td>
                                    <td><?= number_format($item['tong_tien'] ?? 0) ?>đ</td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Tổng cộng:</strong></td>
                                    <td><strong><?= number_format($orderData['order']['tong_tien']) ?>đ</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
