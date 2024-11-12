<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .container {
            width: 1200px;
            margin-left: 280px;
            padding: 20px;
        }
        
        .page-header {
            margin-top: 80px;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table {
            background-color: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        
        .table thead {
            background-color: #f8f9fa;
        }
        
        .table th {
            border-bottom: 2px solid #dee2e6;
            padding: 15px;
            font-weight: 600;
            color: #495057;
        }
        
        .table td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-locked {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .role-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .role-admin {
            background-color: #cce5ff;
            color: #004085;
        }
        
        .role-user {
            background-color: #e2e3e5;
            color: #383d41;
        }
        
        .btn-action {
            padding: 5px 10px;
            margin: 0 2px;
        }
        
        .add-user-btn {
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 500;
        }
        
        .add-user-btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    
<div class="container">
    <div class="page-header">
        <h4 class="mb-0">Quản lý người dùng</h4>
        <a href="index.php?act=create" class="btn btn-primary add-user-btn">
            <i class="fas fa-user-plus"></i> Thêm 
        </a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Thông tin</th>
                    <th>Liên hệ</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['tai_khoan_id'] ?></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?= $user['hinh'] ?>" alt="User Image" class="user-image me-3">
                            <div>
                                <h6 class="mb-0"><?= $user['ho_va_ten'] ?></h6>
                                <small class="text-muted">
                                    <i class="fas fa-user-shield me-1"></i>
                                    <?= $user['vai_tro'] == 1 ? 'Quản trị viên' : 'Khách hàng' ?>
                                </small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <i class="fas fa-envelope me-1"></i> <?= $user['email'] ?>
                        </div>
                        <div>
                            <i class="fas fa-phone me-1"></i> <?= $user['so_dien_thoai'] ?>
                        </div>
                    </td>
                    <td>
                        <span class="role-badge <?= $user['vai_tro'] == 1 ? 'role-admin' : 'role-user' ?>">
                            <?= $user['vai_tro'] == 1 ? 'Quản trị viên' : 'Khách hàng' ?>
                        </span>
                    </td>
                    <td>
                        <span class="status-badge <?= $user['trang_thai'] == 1 ? 'status-active' : 'status-locked' ?>">
                            <?= $user['trang_thai'] == 1 ? 'Hoạt động' : 'Bị khóa' ?>
                        </span>
                    </td>
                    <td>
                        <a href="index.php?act=updateUser&id=<?= $user['tai_khoan_id'] ?>" 
                           class="btn btn-warning btn-action" 
                           title="Sửa">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?act=delete&id=<?= $user['tai_khoan_id'] ?>" 
                           class="btn btn-danger btn-action" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')"
                           title="Xóa">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>