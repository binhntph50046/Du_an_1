<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <h4 class="fs-16 mb-1">Cập Nhật Sản Phẩm</h4>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="./?act=updateProduct" method="post" enctype="multipart/form-data">
                        <?php if (!isset($product) || !is_array($product)): ?>
                            <div class="alert alert-danger">Không có dữ liệu sản phẩm</div>
                        <?php else: ?>
                            <div class="mb-3">
                                <input type="hidden" name="san_pham_id" value="<?= htmlspecialchars($product['san_pham_id'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" id="categoryName"
                                    name="ten_san_pham" required value="<?= htmlspecialchars($product['ten_san_pham'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="gia" class="form-label">Giá</label>
                                <input type="text" class="form-control" id="gia"
                                    name="gia" required value="<?= $product['gia'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="categoryImage" class="form-label">Hình Ảnh</label>
                                <?php if (!empty($product['hinh'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= $product['hinh'] ?>" alt="Ảnh sản phẩm" style="max-width: 200px;">
                                    </div>
                                <?php endif; ?>
                                <input type="text" class="form-control" id="categoryImage" name="old_img"
                                    value="<?= $product['hinh'] ?>" hidden>
                                <input type="file" name="hinh">
                            </div>
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Ngày Nhập</label>
                                <input type="date" class="form-control" id="categoryName"
                                    name="ngay_nhap" required value="<?= $product['ngay_nhap'] ?>">
                            </div>z
                            <div class="mb-3">
                                <label for="categoryDescription" class="form-label">Mô Tả</label>
                                <textarea class="form-control" id="categoryDescription" name="mo_ta" rows="3"><?= htmlspecialchars($product['mo_ta']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Lượt Xem</label>
                                <input type="text" class="form-control" id="categoryName"
                                    name="so_luot_xem" value="<?= $product['so_luot_xem'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="categoryStatus" class="form-label">Trạng Thái</label>
                                <select class="form-select" id="categoryStatus" name="trang_thai" required>
                                    <option value="1" <?= $product['trang_thai'] == 1 ? 'selected' : '' ?>>Còn</option>
                                    <option value="0" <?= $product['trang_thai'] == 0 ? 'selected' : '' ?>>Hết</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="categoryStatus" class="form-label">Danh Mục ID</label>
                                <input type="text" class="form-control" id="categoryName"
                                    name="danh_muc_id" value="<?= $product['danh_muc_id'] ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <a href="?act=listProducts" class="btn btn-secondary">Quay lại Danh
                                Sách</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>