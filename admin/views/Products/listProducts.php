<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="container" style="max-width:100%">
                <h1>Danh Sách Sản Phẩm</h1>
                <a href="./?act=formAddProducts" class="btn btn-primary" style="margin: 10px 0px;">Thêm </a>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá Sản Phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Ngày Nhập</th>
                                    <th>Mô tả</th>
                                    <th>Số Lượng Xem</th>
                                    <th>Trạng thái</th>
                                    <th>Danh Mục ID</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($listProducts as $key => $product): ?>

                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $product['ten_san_pham'] ?></td>
                                        <td><?= $product['gia'] ?></td>
                                        <td><img src="<?= $product['hinh'] ?>" alt="" style="width: 100px;"></td>
                                        <td><?= $product['ngay_nhap'] ?></td>
                                        <td><?= $product['mo_ta'] ?></td>
                                        <td><?= $product['so_luot_xem'] ?></td>
                                        <td><?= $product['trang_thai'] == 1 ? 'Còn' : 'Hết' ?></td>
                                        <td><?= $product['danh_muc_id'] ?></td>
                                        <td>
                                            <a href="./?act=formEditProducts&id=<?= $product['san_pham_id'] ?>" class="btn btn-warning btn-sm" ><i class="fas fa-edit"></i></a>
                                            <a href="./?act=deleteProduct&id=<?= $product['san_pham_id'] ?>"
                                                onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')"
                                                class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i></a>
                                        </td>

                                    </tr>



                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                </body>


            </div>
        </div>
    </div>
