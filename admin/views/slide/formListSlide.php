<div class="row">
    <div class="col">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?= $_SESSION['message_type'] ?>" style="display: block">
                <?= $_SESSION['message'] ?>
            </div>
            <?php
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            ?>
        <?php endif; ?>
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <h1 class="fs-16 mb-1">Danh Sách Slide</h1>
                    <p class="text-muted mb-0">Danh sách các slide hiện có.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <a href="?act=form-add-slide" class="btn btn-primary mb-3">Thêm slide</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listSlide as $key => $Slide) : ?>
                                <tr>
                                    <td><?= $Slide['slide_id'] ?></td>
                                    <td><img src="<?= $Slide['img'] ?>" style="width: 100px;"></td>
                                    <td><?= $Slide['trang_thai'] == 1 ? 'Hoạt động' : 'Ngừng hoạt động' ?></td>
                                    <td>
                                        <a href="?act=form-edit-slide&slide_id=<?= $Slide['slide_id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="?act=delete-slide&slide_id=<?= $Slide['slide_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa slide này không?')"><i class="fas fa-trash"></i></a>
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