<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header FPT Shop</title>
    <link rel="stylesheet" href="./assets/css/client/Header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="header">

        <div class="top-bar">
            <div class="top-bar-child">
                <div class="content">
                    <img src="../Upload/Img/logoip.png" alt="" class="logo">
                    <div class="menu-button"><i class="fa-solid fa-list"></i> Danh mục</div>
                </div>

                <div class="content1">
                    <input type="text" class="search-bar" placeholder="Nhập tên điện thoại, máy tính, phụ kiện... cần tìm">
                    <button class="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                <div class="content2">
                    <div class="content3">
                        <a href="#" class="user-button user-container"><i class="fa-solid fa-user"></i>
                            <?php
                            if (isset($_SESSION['email']) && is_array($_SESSION['email'])) {
                                $email = $_SESSION['email']['email'];
                                $username = $_SESSION['email']['ho_va_ten'];
                                $role = $_SESSION['email']['vai_tro'];
                                echo htmlspecialchars($username);
                            } else {
                                $role = null;
                            }
                            ?>
                        </a>
                        <div class="user-dropdown">
                            <?php if (!isset($role)) { ?>
                                <a href="?act=login" style="padding: 10px;">Đăng nhập</a>
                                <div class="hidden1">.</div>
                                <a href="?act=register" style="padding: 10px;">Đăng ký</a>
                            <?php } else { ?>
                                <a href="./?act=logout" style="padding: 10px;">Đăng xuất</a>
                                <div class="hidden1">.</div>
                                <?php if ($role == 1) : ?>
                                    <a href="../admin/index.php" style="padding: 10px;">Đăng nhập quản trị</a>
                                <?php endif; ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="content4">
                        <a href="#" class="cart-button cart-container"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="deal-bar">
            <span class="deal-icon">⚡</span>
            <span>Deal chớp nhoáng</span>
            <span>|</span>
            <span>Săn iPhone 16 Pro Max từ 33.490K tại TikTok Shop</span>
            <span>|</span>
            <span>Black Friday trúng iPhone 16 Pro Max</span>
        </div>
    </div>

</body>

</html>