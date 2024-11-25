<div class="container mt-5">
    <h2 class="text-center mb-4">Thêm RAM</h2>
    <form action="index.php?act=addRam" method="POST">
        <div class="mb-3">
            <label for="dung_luong" class="form-label">Dung lượng RAM</label>
            <input type="text" class="form-control" id="dung_luong" 
                name="dung_luong" placeholder="Ví dụ: 8GB" required>
        </div>

        <div class="mb-3">
            <label for="mo_ta" class="form-label">Giá tăng</label>
            <input class="form-control" id="gia_tang" name="gia_tang"></input>
        </div>

        <div class="mb-3">
            <label for="trang_thai" class="form-label">Trạng thái</label>
            <select class="form-select" id="trang_thai" name="trang_thai">
                <option value="1">Hoạt động</option>
                <option value="0">Ngừng hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm RAM</button>
        <a href="index.php?act=listRam" class="btn btn-secondary">Quay lại</a>
    </form>
</div>