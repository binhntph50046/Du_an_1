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

<body>
    <?php
    include("header.php");
    ?>
    <div class="category-list">
        <div class="banner">
            <?php 
            // Truyền biến $listSlides vào view slideShow
            include "./views/slideShow.php"; 
            ?>
            <div class="category-item">
                <h3>SẢN PHẨM MỚI</h3>
                <div class="product-list">
                    <div class="product-box">
                        <img src="../Upload/Product/a1.jpg" alt="">
                        <div class="product-infor">
                            <div class="product-name">Iphone 13</div>
                            <div class="product-price">13.990.000<span>₫</span></div>
                        </div>
                    </div> 
                <?php foreach ($products as $product): ?>
                    <div class="product-box">
                        <img src="<?= htmlspecialchars($product['hinh_sp'] ?? 'kh có ảnh') ?>">
                        <div class="product-infor">
                            <div class="product-name"><?= htmlspecialchars($product['ten_san_pham'] ?? 'Sản phẩm không rõ') ?></div>
                            <div class="product-price"><?= number_format($product['gia'] ?? 0, 0, ',', '.') ?><span>₫</span></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- top 10 sp -->
        <!-- <div class="category-item">
            <h4>TOP 10 SẢN PHẨM</h4>
            <div class="product-list">
                <a href="#" class="product-box">
                    <img src="../Upload/Product/a11.jpg" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone 13</div>
                        <div class="product-price">13.990.000<span>₫</span></div>
                    </div>
                </a>
                <div class="product-box">
                    <img src="../Upload/Product/a12.jpg" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone 11</div>
                        <div class="product-price">15.990.000<span>₫</span></div>
                    </div>
                </div>
                <div class="product-box">
                    <img src="../Upload/Product/a13.jpg" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone X</div>
                        <div class="product-price">7.990.000<span>₫</span></div>
                    </div>
                </div>
                <div class="product-box">
                    <img src="../Upload/Product/a14.jpg" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone XS</div>
                        <div class="product-price">9.990.000<span>₫</span></div>
                    </div>
                </div>
                <div class="product-box">
                    <img src="../Upload/Product/a15.webp" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone XS Max</div>
                        <div class="product-price">8.990.000<span>₫</span></div>
                    </div>
                </div>
            </div>
            <div class="product-list">
                <div class="product-box">
                    <img src="../Upload/Product/a28.png" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone 8</div>
                        <div class="product-price">6.990.000<span>₫</span></div>
                    </div>
                </div>
                <div class="product-box">
                    <img src="../Upload/Product/a17.webp" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone 7</div>
                        <div class="product-price">9.690.000<span>₫</span></div>
                    </div>
                </div>
                <div class="product-box">
                    <img src="../Upload/Product/a18.webp" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone 5</div>
                        <div class="product-price">3.990.000<span>₫</span></div>
                    </div>
                </div>
                <div class="product-box">
                    <img src="../Upload/Product/a19.jpeg" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone 12</div>
                        <div class="product-price">19.990.000<span>₫</span></div>
                    </div>
                </div>
                <div class="product-box">
                    <img src="../Upload/Product/a20.webp" alt="">
                    <div class="product-infor">
                        <div class="product-name">Iphone 7</div>
                        <div class="product-price">5.990.000<span>₫</span></div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <?php require_once("Footer.php"); ?>
    <script src="./assets/js/slideShow.js"></script>
</body>

</html>