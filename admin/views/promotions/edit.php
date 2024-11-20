<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Sửa khuyến mãi</h1>
    
    <form action="index.php?act=edit-promotion&id=<?= $promotion['khuyen_mai_id'] ?>" method="POST">
        <div class="form-group">
            <label>Tên khuyến mãi</label>
            <input type="text" class="form-control" name="ten_khuyen_mai" 
                   value="<?= $promotion['ten_khuyen_mai'] ?>" required>
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control" name="mo_ta" rows="3"><?= $promotion['mo_ta'] ?></textarea>
        </div>

        <div class="form-group">
            <label>Phần trăm giảm (%)</label>
            <input type="number" class="form-control" name="phan_tram_giam" 
                   value="<?= $promotion['phan_tram_giam'] ?>"
                   min="0" max="100" step="0.1">
        </div>

        <div class="form-group">
            <label>Số tiền giảm (VNĐ)</label>
            <input type="number" class="form-control" name="giam_gia" 
                   value="<?= $promotion['giam_gia'] ?>"
                   min="0" step="1000">
        </div>

        <div class="form-group">
            <label>Ngày bắt đầu</label>
            <input type="date" class="form-control" name="ngay_bat_dau" 
                   value="<?= $promotion['ngay_bat_dau'] ?>" required>
        </div>

        <div class="form-group">
            <label>Ngày kết thúc</label>
            <input type="date" class="form-control" name="ngay_ket_thuc" 
                   value="<?= $promotion['ngay_ket_thuc'] ?>" required>
        </div>

        <div class="form-group">
            <label>Chọn sản phẩm áp dụng</label>
            <select multiple class="form-control" name="products[]" required>
                <?php foreach ($allProducts as $product): ?>
                    <option value="<?= $product['san_pham_id'] ?>" 
                            <?= in_array($product['san_pham_id'], $promotionProducts) ? 'selected' : '' ?>>
                        <?= $product['ten_san_pham'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?act=list-promotions" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<style>
    .form-group {
        margin-bottom: 1rem;
    }
    select[multiple] {
        height: 200px;
    }
</style> 