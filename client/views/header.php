<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FPT Shop - Điện thoại, Laptop, Phụ kiện chính hãng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/client/Header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    
</style>

<body>
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo và Danh mục -->
                    <div class="col-md-3 d-flex align-items-center">
                        <a href="index.php" class="logo me-3">
                            <img src="../Upload/Img/logoip.png" alt="Logo">
                        </a>
                        <div class="category-dropdown">
                            <button class="category-btn" onclick="toggleCategoryMenu(event)">
                                <i class="fas fa-bars"></i>
                                <span>Danh mục</span>
                            </button>
                            <div class="category-menu" id="categoryDropdown">
                                <a class="dropdown-item" href="?model=iphone15">
                                    <i class="fab fa-apple"></i>
                                    iPhone 15 Series
                                </a>
                                <a class="dropdown-item" href="?model=iphone14">
                                    <i class="fab fa-apple"></i>
                                    iPhone 14 Series
                                </a>
                                <a class="dropdown-item" href="?model=iphone13">
                                    <i class="fab fa-apple"></i>
                                    iPhone 13 Series
                                </a>
                                <a class="dropdown-item" href="?model=iphone12">
                                    <i class="fab fa-apple"></i>
                                    iPhone 12 Series
                                </a>
                                <a class="dropdown-item" href="?model=iphone11">
                                    <i class="fab fa-apple"></i>
                                    iPhone 11 Series
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <div class="col-md-6">
                        <div class="search-wrapper">
                            <input type="text" class="form-control search-input" 
                                   placeholder="Bạn cần tìm gì hôm nay?">
                            <button class="btn btn-search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>

                    <!-- User Actions -->
                    <div class="col-md-3">
                        <div class="user-actions">
                            <div class="action-group">
                                <div class="dropdown">
                                    <a href="#" class="action-link dropdown-toggle">
                                        <div class="account-trigger" onclick="toggleAccountMenu(event)">
                                            <?php if(isset($_SESSION['email'])): ?>
                                                <img src="<?php echo $_SESSION['email']['hinh']; ?>" alt="Avatar" class="avatar-small">
                                                <span><?php echo $_SESSION['email']['ho_va_ten']; ?></span>
                                            <?php else: ?>
                                                <i class="fas fa-user"></i>
                                                <span>Tài khoản</span>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    <div class="account-dropdown" id="accountDropdown">
                                        <?php if(isset($_SESSION['email'])): ?>
                                            <?php if($_SESSION['email']['vai_tro'] == 1): ?>
                                                <a href="../admin/index.php">
                                                    <i class="fas fa-cogs"></i>
                                                    Quản trị
                                                </a>
                                            <?php endif; ?>
                                            <a href="?act=logout">
                                                <i class="fas fa-sign-out-alt"></i>
                                                Đăng xuất
                                            </a>
                                        <?php else: ?>
                                            <a href="?act=login">Đăng nhập</a>
                                            <a href="?act=register">Đăng ký</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <a href="?act=cart" class="action-link">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Giỏ hàng</span>
                                </a>
                            </div>
                        </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        function toggleAccountMenu(event) {
            event.preventDefault();
            event.stopPropagation();
            const dropdown = document.getElementById('accountDropdown');
            dropdown.classList.toggle('show');
        }

        function toggleCategoryMenu(event) {
            event.preventDefault();
            event.stopPropagation();
            const dropdown = document.getElementById('categoryDropdown');
            dropdown.classList.toggle('show');
        }

        // Cập nhật window.onclick để xử lý cả 2 loại dropdown
        window.onclick = function(event) {
            if (!event.target.closest('.dropdown') && !event.target.closest('.category-dropdown')) {
                const dropdowns = document.getElementsByClassName('account-dropdown');
                const categoryDropdown = document.getElementById('categoryDropdown');
                
                for (let dropdown of dropdowns) {
                    if (dropdown.classList.contains('show')) {
                        dropdown.classList.remove('show');
                    }
                }
                
                if (categoryDropdown && categoryDropdown.classList.contains('show')) {
                    categoryDropdown.classList.remove('show');
                }
            }
        }
        </script>
</body>

</html>