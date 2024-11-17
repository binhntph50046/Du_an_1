<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Danh sách đơn hàng</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>#<?= $order['don_hang_id'] ?></td>
                                    <td>
                                        <p class="mb-0"><strong><?= $order['ho_va_ten'] ?></strong></p>
                                        <small class="text-muted"><?= $order['email'] ?></small><br>
                                        <small class="text-muted"><?= $order['so_dien_thoai'] ?></small>
                                    </td>
                                    <td>
                                        <?php if (!empty($order['ten_san_pham'])): 
                                            // Lấy danh sách tên sản phẩm không trùng lặp
                                            $ten_san_phams = array_unique(explode(',', $order['ten_san_pham']));
                                        ?>
                                            <div class="product-item mb-2">
                                                <img src="<?= htmlspecialchars($order['hinh_anh']) ?>" 
                                                     alt="Product Image"
                                                     class="product-image"
                                                     onerror="this.src='../Upload/Product/default.jpg'">
                                                <div class="product-info">
                                                    <?php 
                                                    // Hiển thị tên sản phẩm đầu tiên
                                                    echo (trim($ten_san_phams[0]));
                                                    
                                                    // Nếu có nhiều hơn 1 sản phẩm
                                                    if (count($ten_san_phams) > 1) {
                                                        echo ' <span class="text-muted">(+' . (count($ten_san_phams) - 1) . ' sản phẩm khác)</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($order['ngay_dat'])) ?></td>
                                    <td>
                                        <?php
                                        // Tính tổng tiền từ chi tiết đơn hàng
                                        $final_total = $order['tong_tien'];
                                        // Hiển thị tổng tiền đã được tính sẵn từ database
                                        echo number_format($final_total, 0, ',', '.') . 'đ';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $status = '';
                                        switch($order['trang_thai']) {
                                            case 1: 
                                                $status = '<span class="badge bg-warning">Chờ xử lý</span>';
                                                break;
                                            case 2:
                                                $status = '<span class="badge bg-info">Đang xử lý</span>';
                                                break;
                                            case 3:
                                                $status = '<span class="badge bg-success">Đã giao</span>';
                                                break;
                                            case 4:
                                                $status = '<span class="badge bg-danger">Đã hủy</span>';
                                                break;
                                        }
                                        echo $status;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="index.php?act=view-order&id=<?= $order['don_hang_id'] ?>" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if ($order['trang_thai'] == 4): ?>
                                        <a href="index.php?act=delete-order&id=<?= $order['don_hang_id'] ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
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
    </div>
</div>

