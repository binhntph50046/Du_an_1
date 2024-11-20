<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Thêm khuyến mãi mới</h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="index.php?act=add-promotion" method="POST">
                <div class="form-group">
                    <label>Tên khuyến mãi</label>
                    <input type="text" class="form-control" name="ten_khuyen_mai" required>
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" name="mo_ta" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label>Phần trăm giảm (%)</label>
                    <input type="number" class="form-control" name="phan_tram_giam" 
                           min="0" max="100" step="0.1">
                </div>

                <div class="form-group">
                    <label>Số tiền giảm</label>
                    <input type="number" class="form-control" name="giam_gia" 
                           min="0" step="1000">
                </div>

                <div class="form-group">
                    <label>Ngày bắt đầu</label>
                    <input type="date" class="form-control" name="ngay_bat_dau" required>
                </div>

                <div class="form-group">
                    <label>Ngày kết thúc</label>
                    <input type="date" class="form-control" name="ngay_ket_thuc" required>
                </div>

                <div class="form-group">
                    <label>Chọn sản phẩm áp dụng</label>
                    <select multiple class="form-control" name="products[]" required>
                        <?php foreach ($allProducts as $product): ?>
                            <option value="<?= $product['san_pham_id'] ?>">
                                <?= $product['ten_san_pham'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Thêm khuyến mãi</button>
                <a href="index.php?act=list-promotions" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div> 