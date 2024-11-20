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
                <table class="table table-bordered" id="orderTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
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
                            <td><?= $order['ho_va_ten'] ?></td>
                            <td><?= date('d/m/Y', strtotime($order['ngay_dat'])) ?></td>
                            <td><?= number_format($order['tong_tien']) ?>đ</td>
                            <td>
                                <?php if($order['trang_thai'] != 4): ?>
                                    <?= $order['phuong_thuc_thanh_toan'] == 'online' ? 
                                        '<span class="btn btn-success">Online</span>' : 
                                        '<span class="btn btn-info">COD</span>' ?> 
                                <?php else: ?>
                                    <span class="btn btn-secondary">Đã hủy</span> 
                                <?php endif; ?> 
                            </td> 
                            <td> 
                                <?php 
                                $status = ''; 
                                switch($order['trang_thai']) { 
                                    case 1: $status = '<span class="btn btn-warning">Chờ xử lý</span>'; break; 
                                    case 2: $status = '<span class="btn btn-info">Đang xử lý</span>'; break;
                                    case 3: $status = '<span class="btn btn-success">Đã hoàn thành</span>'; break;
                                    case 4: $status = '<span class="btn btn-danger">Đã hủy</span>'; break;
                                }
                                echo $status;
                                ?>
                            </td>
                            <td>
                                <a href="index.php?act=view-order&id=<?= $order['don_hang_id'] ?>" 
                                   class="btn btn-info btn-sm">
                                    Xem chi tiết 
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>