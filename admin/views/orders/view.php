<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Chi tiết đơn hàng #<?= $order['don_hang_id'] ?></h4>
                    <a href="index.php?act=list-orders" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $_SESSION['success'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['error'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Thông tin khách hàng</h5>
                            <p><strong>Họ tên:</strong> <?= $order['ho_va_ten'] ?></p>
                            <p><strong>Email:</strong> <?= $order['email'] ?></p>
                            <p><strong>Số điện thoại:</strong> <?= $order['so_dien_thoai'] ?></p>
                            <p><strong>Địa chỉ:</strong> <?= $order['dia_chi'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Thông tin đơn hàng</h5>
                            <p><strong>Ngày đặt:</strong> <?= date('d/m/Y', strtotime($order['ngay_dat'])) ?></p>
                            <p><strong>Phương thức thanh toán:</strong> 
                                <?= $order['phuong_thuc_thanh_toan'] == 1 ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản' ?>
                            </p>
                            <p><strong>Trạng thái:</strong> 
                                <?php
                                switch($order['trang_thai']) {
                                    case 1: 
                                        echo '<span class="badge bg-warning">Chờ xử lý</span>';
                                        break;
                                    case 2:
                                        echo '<span class="badge bg-info">Đang xử lý</span>';
                                        break;
                                    case 3:
                                        echo '<span class="badge bg-success">Đã giao</span>';
                                        break;
                                    case 4:
                                        echo '<span class="badge bg-danger">Đã hủy</span>';
                                        break;
                                }
                                ?>
                            </p>
                            <form action="index.php?act=update-order-status" method="POST" class="d-flex align-items-center">
                                <input type="hidden" name="order_id" value="<?= $order['don_hang_id'] ?>">
                                <select name="status" class="form-select me-2" style="width: 200px;">
                                    <option value="1" <?= $order['trang_thai'] == 1 ? 'selected' : '' ?>>Chờ xử lý</option>
                                    <option value="2" <?= $order['trang_thai'] == 2 ? 'selected' : '' ?>>Đang xử lý</option>
                                    <option value="3" <?= $order['trang_thai'] == 3 ? 'selected' : '' ?>>Đã giao</option>
                                    <option value="4" <?= $order['trang_thai'] == 4 ? 'selected' : '' ?>>Đã hủy</option>
                                </select>
                                <button type="submit" name="update_status" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Cập nhật trạng thái
                                </button>
                            </form>
                        </div>
                    </div>

                    <h5>Chi tiết sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Khuyến mãi</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $tongCong = 0;
                                foreach ($orderDetails as $item): 
                                    $giaSauKM = $item['gia_san_pham'] * (1 - ($item['khuyen_mai'] / 100));
                                    $thanhTien = $item['tong_tien'];
                                    $tongCong += $thanhTien;
                                    
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= $item['hinh_sp'] ?>" 
                                                 alt="Product Image" 
                                                 class="img-thumbnail me-2" 
                                                 style="width: 50px; height: 50px; object-fit: cover;"
                                                 onerror="this.src='../Upload/Product/default.jpg'">
                                            <span><?= $item['ten_san_pham'] ?></span>
                                        </div>
                                    </td>
                                    <td><?= number_format($item['gia_san_pham'], 0, ',', '.') ?>đ</td>
                                    <td><?= $item['so_luong'] ?></td>
                                    <td><?= $item['khuyen_mai'] ?>%</td>
                                    <td><?= number_format($thanhTien, 0, ',', '.') ?>đ</td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                                    <td><strong><?= number_format($tongCong, 0, ',', '.') ?>đ</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
