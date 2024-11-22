<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/client/Header.css">
    <link rel="stylesheet" href="./assets/css/client/Footer.css">
</head>
<body>
    <?php include "views/header.php"; ?>
    
    <div class="container my-5">
        <div class="text-center">
            <i class="fas fa-check-circle text-success" style="font-size: 64px;"></i>
            <h1 class="mt-4">Đặt hàng thành công!</h1>
            <p class="lead">Cảm ơn bạn đã đặt hàng. Mã đơn hàng của bạn là: #<?= $_GET['id'] ?></p>
            <div class="mt-4">
                <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>

    <?php include "views/footer.php"; ?>
</body>
</html> 