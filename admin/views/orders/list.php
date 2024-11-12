<style>
    .containerr {
        margin-top: 20px;
        max-width: 1280px;
        margin: 0 auto;
        padding: 20px;
        margin-left: 268px;
        
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .card {
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    .btn-group .btn {
        margin-right: 5px;
    }
    
    .btn-group .btn i {
        margin-right: 5px;
    }
</style>

<div class="containerr">
    <div class="page-header">
        <h4 class="mb-0">Quản lý đơn hàng</h4>
    </div>

    <!-- Bộ lọc -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <input type="hidden" name="act" value="orders">
                
                <div class="col-md-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="1" <?= isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : '' ?>>Đang xử lý</option>
                        <option value="2" <?= isset($_GET['status']) && $_GET['status'] == '2' ? 'selected' : '' ?>>Đã hoàn thành</option>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Từ ngày</label>
                    <input type="date" name="date_from" class="form-control" value="<?= $_GET['date_from'] ?? '' ?>">
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Đến ngày</label>
                    <input type="date" name="date_to" class="form-control" value="<?= $_GET['date_to'] ?? '' ?>">
                </div>
                
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Lọc
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Danh sách đơn hàng -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã ĐH</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?= $order['don_hang_id'] ?></td>
                            <td>
                                <?= $order['ho_va_ten'] ?><br>
                                <small><?= $order['email'] ?></small><br>
                                <small><?= $order['so_dien_thoai'] ?></small>
                            </td>
                            <td><?= date('d/m/Y', strtotime($order['ngay_dat'])) ?></td>
                            <td><?= number_format($order['tong_tien']) ?>đ</td>
                            <td>
                                <?= $order['phuong_thuc_thanh_toan'] == 1 ? 'Tiền mặt' : 'Thẻ' ?>
                            </td>
                            <td>
                                <?php if($order['trang_thai'] == 1): ?>
                                    <span class="badge bg-warning">Đang xử lý</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Đã hoàn thành</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="index.php?act=viewOrder&id=<?= $order['don_hang_id'] ?>" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    
                                    <button type="button" 
                                            class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#statusModal<?= $order['don_hang_id'] ?>">
                                        <i class="fas fa-edit"></i> Sửa
                                    </button>

                                    <?php if($order['trang_thai'] == 1): ?>
                                        <a href="index.php?act=deleteOrder&id=<?= $order['don_hang_id'] ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                                            <i class="fas fa-trash"></i> Xóa
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--  cập nhật đơn hàng -->
<?php foreach ($orders as $order): ?>
<div class="modal fade" id="statusModal<?= $order['don_hang_id'] ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật đơn hàng #<?= $order['don_hang_id'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?act=updateOrderStatus" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="order_id" value="<?= $order['don_hang_id'] ?>">
                    
                    <!-- Thông tin khách hàng -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="ho_va_ten" class="form-control" value="<?= $order['ho_va_ten'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $order['email'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="so_dien_thoai" class="form-control" value="<?= $order['so_dien_thoai'] ?>">
                        </div>
                    </div>

                    <!-- Thông tin đơn hàng -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Phương thức thanh toán</label>
                            <select name="phuong_thuc_thanh_toan" class="form-select">
                                <option value="1" <?= $order['phuong_thuc_thanh_toan'] == 1 ? 'selected' : '' ?>>Tiền mặt</option>
                                <option value="2" <?= $order['phuong_thuc_thanh_toan'] == 2 ? 'selected' : '' ?>>Thẻ</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="1" <?= $order['trang_thai'] == 1 ? 'selected' : '' ?>>Đang xử lý</option>
                                <option value="2" <?= $order['trang_thai'] == 2 ? 'selected' : '' ?>>Đã hoàn thành</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?> 