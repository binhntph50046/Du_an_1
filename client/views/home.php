<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPHONE STORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/client/Header.css">
    <link rel="stylesheet" href="../assets/css/client/Footer.css">
    <link rel="stylesheet" href="./assets/css/client/Home.css">
</head>
<body>
    <?php include "views/header.php"; ?>
    <div class="category-list">
        <div class="banner">
            <?php 
            include "views/slideShow.php"; 
            ?>
            <div class="category-item">
                <h3>SẢN PHẨM MỚI</h3>
                <div class="product-list">
                    <?php foreach ($products as $product): ?>
                        <a href="?act=product-detail&id=<?= $product['san_pham_id'] ?>" class="product-box">
                            <img src="<?= $product['hinh_sp'] ?>" alt="kh có ảnh">
                            <div class="product-infor">
                                <div class="product-name"><?= $product['ten_san_pham'] ?></div>
                                <div class="product-price"><?= number_format($product['gia'], 0, ',', '.') ?><span>₫</span></div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="category-item">
            <h4>TOP 10 SẢN PHẨM XEM NHIỀU NHẤT</h4>
            <div class="product-list">
                <?php foreach ($dstop10 as $product): ?>
                    <a href="?act=product-detail&id=<?= $product['san_pham_id'] ?>" class="product-box">
                        <img src="<?= $product['hinh_sp'] ?>" alt="<?= $product['ten_san_pham'] ?>">
                        <div class="product-infor">
                            <div class="product-name"><?= $product['ten_san_pham'] ?></div>
                            <div class="product-price"><?= number_format($product['gia'], 0, ',', '.') ?><span>₫</span></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php include "views/footer.php"; ?>
</body>
</html>