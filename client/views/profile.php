<?php include 'header.php'; ?>

<div class="container my-4 ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #111827b5;">
                    <h4 class="mb-0">Thông tin cá nhân</h4>
                    <button class="btn btn-light" onclick="toggleEdit()">
                        <i class="fas fa-edit"></i> Chỉnh sửa
                    </button>
                </div>
                <div class="card-body">
                    <!-- Hiển thị thông tin -->
                    <div id="info-display" class="row mb-4">
                        <div class="col-md-3 text-center ">
                            <img src="<?php echo $_SESSION['email']['hinh']; ?>"
                                alt="Avatar"
                                class="rounded-circle img-thumbnail"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label class="fw-bold">Họ và tên:</label>
                                <p><?php echo $_SESSION['email']['ho_va_ten']; ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Email:</label>
                                <p><?php echo $_SESSION['email']['email']; ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Số điện thoại:</label>
                                <p><?php echo $_SESSION['email']['so_dien_thoai']; ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Địa chỉ:</label>
                                <p><?php echo $_SESSION['email']['dia_chi']; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Form chỉnh sửa -->
                    <div id="edit-form" class="row mb-4" style="display: none;">
                        <form action="?act=update-profile" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Ảnh đại diện hiện tại</label>
                                    <div class="text-center mb-3">
                                        <img src="<?php echo $_SESSION['email']['hinh']; ?>"
                                            alt="Current Avatar"
                                            class="rounded-circle img-thumbnail"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <input type="hidden" name="hinh_cu" value="<?php echo $_SESSION['email']['hinh']; ?>">
                                    <label class="form-label">Chọn ảnh mới (không bắt buộc)</label>
                                    <input type="file" name="hinh" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" name="ho_va_ten" class="form-control"
                                        value="<?php echo $_SESSION['email']['ho_va_ten']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control"
                                        value="<?php echo $_SESSION['email']['email']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="number" name="so_dien_thoai" class="form-control"
                                        value="<?php echo $_SESSION['email']['so_dien_thoai']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <textarea name="dia_chi" class="form-control" required><?php echo $_SESSION['email']['dia_chi']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
                                    <input type="password" name="mat_khau" class="form-control">
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary" onclick="toggleEdit()">Hủy</button>
                                    <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>

                                </div>
                            </div>
                        </form>
                            <!-- <form action="?act=delete-account" method="POST" style="display:inline;">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản?');">Xóa tài khoản</button>
                            </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleEdit() {
        const infoDisplay = document.getElementById('info-display');
        const editForm = document.getElementById('edit-form');

        if (infoDisplay.style.display !== 'none') {
            infoDisplay.style.display = 'none';
            editForm.style.display = 'block';
        } else {
            infoDisplay.style.display = 'flex';
            editForm.style.display = 'none';
        }
    }
</script>

<?php include 'footer.php'; ?>