<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header FPT Shop</title>
    <link rel="stylesheet" href="./assets/css/client/Header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .logo {
            width: 100px;
            height: 80px;
        }

        .top-bar {
            background-color: #66CDAA;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="top-bar">
            <div class="top-bar-child">
                <div>
                    <img src="../Upload/Img/logoip.png" alt="" class="logo">
                </div>
                <div class="menu-button"><i class="fa-solid fa-list"></i> Danh mục</div>

                <div class="content1">
                    <input type="text" class="search-bar" placeholder="Nhập tên điện thoại, máy tính, phụ kiện... cần tìm">
                    <button class="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                <div class="content2">
                    <a href="#" class="user-button"><i class="fa-solid fa-user"></i>
                        <?php
                        // $role = 1; // Lấy role từ session hoặc database
                        // if (isset($_SESSION['email']) && is_array($_SESSION['email'])) {
                        //     echo "Xin chào". $email;
                        // }
                        // var_dump($role);die();
                        if (isset($_SESSION['email']) && is_array($_SESSION['email'])){
                            // Giả sử $_SESSION['email'] chứa ['email' => 'user@example.com', 'role' => 1]
                            $email = $_SESSION['email']['email']; // Lấy giá trị email từ mảng
                            $username = $_SESSION['email']['ho_va_ten']; // Lấy giá trị email từ mảng
                            $role = $_SESSION['email']['vai_tro'];   // Lấy vai trò từ mảng

                            echo "Xin chào: " . htmlspecialchars($username);
                        }else{
                            $role = null;
                        }
                        ?>
                    </a>
                    <a href="#" class="cart-button"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
                    <div class="user-dropdown">
                        <?php if (!isset($role)) { ?>
                            <!-- Nếu người dùng chưa đăng nhập -->
                            <a href="?act=login" style="padding: 10px;">Đăng nhập</a>
                            <div>.</div>
                            <a href="?act=register" style="padding: 10px;">Đăng ký</a>
                        <?php } else { ?>
                            <!-- Nếu người dùng đã đăng nhập -->
                            <a href="./?act=logout" style="padding: 10px;">Đăng xuất</a>
                            <?php if ($role == 1) : ?>
                                <!-- Hiển thị "Đăng nhập quản trị" nếu role bằng 1 (admin) -->
                                <a href="../admin/index.php" style="padding: 10px;">Đăng nhập quản trị</a>
                            <?php endif; ?>
                        <?php } ?>
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
<!-- <div class="nav-links">
                    <a href="#">iphone 16</a>
                    <a href="#">laptop</a>
                    <a href="#">ipad</a>
                    <a href="#">samsung</a>
                    <a href="#">máy lọc nước</a>
                    <a href="#">sưởi ấm</a>
                    <a href="#">nồi lẩu</a>
                    <a href="#">robot hút bụi</a>
                </div> -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/client/Header.css">
    <link 
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="top-nav">
        <div class="container">
            <ul>
                <li><a href="#"><i class="fas fa-phone"></i> Hotline: 1900 1234</a></li>
                <li><a href="#"><i class="fas fa-envelope"></i> Email: support@example.com</a></li>
            </ul>
        </div>
    </div>

    <header class="main-header">
        <div class="container">
            <div class="logo">
                <img src="../Upload/Img/logoiphone-removebg-preview.png" alt="Logo">
            </div>
            
            <form class="search-form">
                <input type="text" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
            
            <div class="user-actions">
                <div class="user-profile">
                    <img src="../Upload/User/nam.jpg" alt="User">
                </div>
                <a href="#" class="cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </div>
    </header>
</body>
</html> -->