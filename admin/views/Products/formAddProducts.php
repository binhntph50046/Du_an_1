<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <h4 class="fs-16 mb-1">Thêm Sản Phẩm</h4>
                    <p class="text-muted mb-0">Thêm sản phẩm mới.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="./?act=postFormAdd" method="post" enctype="multipart/form-data">


                        <div class="mb-3">
                            <label for="categoryStatus" class="form-label">Danh Mục </label>

                            <?php
                            echo '<select name="danh_muc"  class="form-select" aria-label="Default select example">';
                            foreach ($categories as $item) {
                                echo '<option value="' . htmlspecialchars($item['danh_muc_id']) . '">'
                                    . htmlspecialchars($item['ten_danh_muc']) .
                                    '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>

                        <div class="mb-3">
                            <label for="productName" class="form-label">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="productName"
                                name="ten_san_pham" required>
                        </div>
                        <div class="mb-3">
                            <label for="gia" class="form-label">Giá</label>
                            <input type="text" class="form-control" id="gia"
                                name="gia" required>
                        </div>

                        <div class="mb-3">
                            <label for="productName" class="form-label">Ngày Nhập</label>
                            <input type="date" class="form-control" id="productName"
                                name="ngay_nhap" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryDescription" class="form-label">Mô Tả</label>
                            <textarea class="form-control" id="categoryDescription" name="mo_ta"
                                rows="3" required></textarea>
                        </div>
                       
                        <div class="mb-3">
                            <label for="productName" class="form-label">Hình Ảnh</label>
                            <input type="file" class="form-control" id="productName"
                                name="hinh_sp[]" multiple required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryStatus" class="form-label">Trạng Thái</label>
                            <select class="form-select" id="categoryStatus" name="trang_thai"
                                required>
                                <option value="2">Trạng thái</option>
                                <option value="1">Còn</option>
                                
                                <option value="0">Hết</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                        <a href="?act=listProducts" class="btn btn-secondary">Quay lại Danh
                            Sách</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
