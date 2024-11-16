<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-locked {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
    </style>
</head>

<body>

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
                                    <th>Condition</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listComment as $key => $Comment) : ?>
                                    <tr>
                                        <td><?= $Comment['binh_luan_id'] ?></td>
                                        <td><?= $Comment['noi_dung'] ?></td>
                                        <td><?= $Comment['tai_khoan_id'] ?></td>
                                        <td><?= $Comment['san_pham_id'] ?></td>
                                        <td><?= $Comment['ngay_binh_luan'] ?></td>
                                        <td>
                                            <span class="status-badge <?= $Comment['trang_thai'] == 1 ? 'status-active' : 'status-locked' ?>">
                                                <?= $Comment['trang_thai'] == 1 ? 'Hoạt động' : 'Chưa duyệt' ?>
                                            </span>

                                        </td>
                                        <td>
                                            <a href="?act=deleteComments&binh_luan_id=<?php echo $Comment['binh_luan_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment !?')"><i class="fas fa-trash"></i></a>
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


</body>

</html>