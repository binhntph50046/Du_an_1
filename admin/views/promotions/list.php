<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản lý khuyến mãi</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="index.php?act=add-promotion" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm khuyến mãi mới
            </a>
            <a href="index.php?act=delete-expired-promotions" class="btn btn-danger" 
               onclick="return confirm('Bạn có chắc muốn xóa tất cả khuyến mãi đã hết hạn?');">
                Xóa khuyến mãi hết hạn
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên khuyến mãi</th>
                            <th>Sản phẩm áp dụng</th>
                            <th>Giảm giá</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($promotions as $promotion): ?>
                            <tr>
                                <td><?= $promotion['khuyen_mai_id'] ?></td>
                                <td><?= $promotion['ten_khuyen_mai'] ?></td>
                                <td>
                                    <?php
                                    $products = $this->promotionModel->getPromotionProducts($promotion['khuyen_mai_id']);
                                    foreach ($products as $index => $product) {
                                        echo $product['ten_san_pham'];
                                        if ($index < count($products) - 1) {
                                            echo ", ";
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($promotion['phan_tram_giam'] > 0): ?>
                                        <span class="text-danger">-<?= $promotion['phan_tram_giam'] ?>%</span>
                                    <?php endif; ?>
                                    <?php if ($promotion['giam_gia'] > 0): ?>
                                        <?= $promotion['phan_tram_giam'] > 0 ? ' + ' : '' ?>
                                        <span class="text-danger">-<?= number_format($promotion['giam_gia'], 0, ',', '.') ?>đ</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y', strtotime($promotion['ngay_bat_dau'])) ?> - 
                                    <?= date('d/m/Y', strtotime($promotion['ngay_ket_thuc'])) ?>
                                </td>
                                <td>
                                    <?php
                                    $today = date('Y-m-d');
                                    if ($today < $promotion['ngay_bat_dau']): ?>
                                        <span class="btn btn-warning">Sắp diễn ra</span>
                                    <?php elseif ($today > $promotion['ngay_ket_thuc']): ?>
                                        <span class="btn btn-secondary">Đã kết thúc</span>
                                    <?php else: ?>
                                        <span class="btn btn-success">Đang diễn ra</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="index.php?act=edit-promotion&id=<?= $promotion['khuyen_mai_id'] ?>" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
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