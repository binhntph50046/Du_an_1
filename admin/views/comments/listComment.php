<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <h1 class="fs-16 mb-1">List Comments</h1>
                    <p class="text-muted mb-0">List comments now !!</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Content</th>
                                <th>ID User</th>
                                <th>ID Product</th>
                                <th>Date Comment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listComment as $key => $Comment) : ?>
                                <!-- <tr>
                                    <td><?= $Comment['binh_luan_id'] ?></td>
                                    <td><?= $Comment['noi_dung'] ?></td>
                                    <td><?= $Comment['tai_khoan_id'] ?></td>
                                    <td><?= $Comment['san_pham_id'] ?></td>
                                    <td><?= $Comment['ngay_binh_luan'] ?></td>
                                    <td><?= $Comment['trang_thai'] == 1 ? 'Hoạt động' : 'Ngừng hoạt động' ?></td>
                                    <td>
                                        <a href="?act=form-edit-slide&slide_id=<?= $Comment['slide_id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="?act=delete-slide&slide_id=<?= $Comment['slide_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa slide này không?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr> -->
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- <a href="?act=form-add-slide" class="btn btn-primary mb-3">Thêm slide</a> -->
                </div>
            </div>
        </div>
    </div>
</div>