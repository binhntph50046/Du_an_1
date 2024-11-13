<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPHONE STORE</title>
    <link rel="stylesheet" href="./assets/css/client/Home.css">
    <link rel="stylesheet" href="./assets/css//client/Header.css">
    <link rel="stylesheet" href="./assets/css/client/Footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    .old-price {
        color: #999;
        text-decoration: line-through;
        font-size: 10px;
    }

    .current-price {
        color: #d70018;
        font-weight: bold;
        font-size: 25px;
    }
</style>
<body>
    <?php
    include("header.php");
    ?>
    <div class="category-list">
        <div class="banner">
            <img src="../../Upload/Product/a" alt="">
            <?php include "./views/slideShow.php"; ?>
            <div class="category-item">
                <h3>SẢN PHẨM MỚI</h3>
                <div class="product-list">
                    <?php foreach($newProducts as $product): ?>
                        <div class="product-box">
                            <img src="../Upload/Product/<?= basename($product['hinh']) ?>" alt="<?= htmlspecialchars($product['ten_san_pham']) ?>">
                            <div class="product-infor">
                                <div class="product-name"><?= htmlspecialchars($product['ten_san_pham']) ?></div>

                                <div class="product-price">
                                    <span class="old-price"><?= number_format($product['gia'] * 1.2) ?>₫</span>
                                    <span class="current-price"><?= number_format($product['gia']) ?>₫</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="category-item"></div>
            <h4>Top 10 sản phẩm</h4>
            <div class="product-list">
                <?php foreach($topProducts as $product): ?>
                    <div class="product-box">
                        <img src="../Upload/Product/<?= basename($product['hinh']) ?>" alt="<?= htmlspecialchars($product['ten_san_pham']) ?>">
                        <div class="product-infor">
                            <div class="product-name"><?= htmlspecialchars($product['ten_san_pham']) ?></div>
                            <div class="product-price">
                                <span class="old-price"><?= number_format($product['gia'] * 1.2) ?>₫</span>
                                <span class="current-price"><?= number_format($product['gia']) ?>₫</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php require_once("Footer.php"); ?>
    <script src="./assets/js/slideShow.js"></script>
</body>

</html>