<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <h1 class="fs-16 mb-1">Danh Sách Danh Mục</h1>
                    <p class="text-muted mb-0">Danh sách các danh mục sản phẩm hiện có.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Danh Mục</th>
                                <th>Hình ảnh</th>
                                <th>Mô Tả</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listCategory as $key => $Category) : ?>
                                <tr>
                                    <td><?= $Category['danh_muc_id'] ?></td>
                                    <td><?= $Category['ten_danh_muc'] ?></td>
                                    <td><img src="<?= $Category['hinh'] ?>" style="width: 100px;"></td>
                                    <td><?= $Category['mo_ta'] ?></td>
                                    <td><?= $Category['trang_thai'] == 1 ? 'Hoạt động' : 'Ngừng hoạt động' ?></td>
                                    <td>
                                        <a href="?act=form-edit-category&danh_muc_id=<?= $Category['danh_muc_id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="?act=delete-category&danh_muc_id=<?= $Category['danh_muc_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="?act=form-add-category" class="btn btn-primary mb-3">Thêm Danh Mục</a>
                </div>
            </div>
        </div>
    </div>
</div>