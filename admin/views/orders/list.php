<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản lý đơn hàng</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="index.php" method="GET" class="form-inline justify-content-end">
                <input type="hidden" name="act" value="list-orders">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" 
                           placeholder="Tìm theo mã đơn, tên, email, SĐT..." 
                           value="<?= isset($_GET['keyword']) ? ($_GET['keyword']) : '' ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <?php if(isset($_GET['keyword']) && !empty($_GET['keyword'])): ?>
                <div class="mb-3">
                    <p class="mb-0">Kết quả tìm kiếm cho: <strong><?= ($_GET['keyword']) ?></strong></p>
                    <a href="index.php?act=list-orders" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times"></i> Xóa bộ lọc
                    </a>
                </div>
            <?php endif; ?>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                          
                            
                            <tr class="<?= ($order['yeu_cau_huy'] == 1) ? 'table-warning' : '' ?>">
                                <td>#<?= $order['don_hang_id'] ?></td>
                                <td><?= $order['ho_va_ten'] ?></td>
                                <td><?= date('d/m/Y', strtotime($order['ngay_dat'])) ?></td>
                                <td><?= number_format($order['tong_tien'], 0, ',', '.') ?>đ</td>
                                <td>
                                    <?php if ($order['yeu_cau_huy'] == 1): ?>
                                        <span class="badge bg-warning">Yêu cầu hủy</span>
                                    <?php else: ?>
                                        <?php
                                        switch ($order['trang_thai']) {
                                            case 0:
                                                echo '<span class="badge bg-secondary">Đã hủy</span>';
                                                break;
                                            case 1:
                                                echo '<span class="badge bg-warning">Chờ xác nhận</span>';
                                                break;
                                            case 2:
                                                echo '<span class="badge bg-primary">Đã xác nhận</span>';
                                                break;
                                            case 3:
                                                echo '<span class="badge bg-info">Đang giao</span>';
                                                break;
                                            case 4:
                                                echo '<span class="badge bg-success">Đã giao</span>';
                                                break;
                                        }
                                        ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="index.php?act=view-order&id=<?= $order['don_hang_id'] ?>" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>

                                    <?php if ($order['yeu_cau_huy'] == 1): ?>
                                        <form action="index.php" method="POST" class="d-inline">
                                            <input type="hidden" name="act" value="handle-cancel-request">
                                            <input type="hidden" name="order_id" value="<?= $order['don_hang_id'] ?>">
                                            <button type="submit" name="action" value="approve" 
                                                    class="btn btn-sm btn-success">
                                                <i class="fas fa-check"></i> Duyệt hủy
                                            </button>
                                            <button type="submit" name="action" value="reject" 
                                                    class="btn btn-sm btn-danger">
                                                <i class="fas fa-times"></i> Từ chối
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>