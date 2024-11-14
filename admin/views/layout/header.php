<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | iPhone Store Admin Panel</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/libs/jsvectormap/css/jsvectormap.min.css" />
    <link rel="stylesheet" href="assets/css/icons.min.css" />
    <link rel="stylesheet" href="assets/css/app.min.css" />
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            font-family: Arial, sans-serif;
            color: #333;
            border-radius: 8px;
            /* Bo tròn các góc của bảng */
            overflow: hidden;
            /* Để bo tròn các góc của bảng */
        }

        .table th,
        .table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            /* Độ dày và màu sắc của đường viền */
            text-align: center;
            /* Căn giữa theo chiều ngang */
            vertical-align: middle;
            /* Căn giữa theo chiều dọc */
        }

        .table th {
            background-color: #f4f4f4;
            /* Màu nền tiêu đề */
            color: #333;
            font-weight: bold;
        }

        .table tr {
            transition: background-color 0.3s ease;
            /* Hiệu ứng chuyển màu mượt */
        }

        .table tr:hover {
            background-color: #f1f1f1;
            /* Màu nền khi rê chuột qua dòng */
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <nav class="navbar-header d-flex">
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm"><img src="assets/images/logo-sm.png" alt="" height="22"></span>
                            <span class="logo-lg"><img src="assets/images/logo-dark.png" alt="" height="17"></span>
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn" id="topnav-hamburger-icon">
                        <span class="hamburger-icon"><span></span><span></span><span></span></span>
                    </button>
                    <form class="app-search d-none d-md-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options">
                            <span class="mdi mdi-magnify search-widget-icon"></span>
                        </div>
                    </form>
                    <div class="d-flex align-items-center ms-auto">
                        <div class="dropdown ms-1 topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown">
                                <img id="header-lang-img" src="assets/images/flags/us.svg" alt="Header Language" height="20" class="rounded">
                            </button>
                        </div>
                        <div class="dropdown ms-1 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                                    <span class="text-start ms-xl-2 d-none d-xl-inline-block fw-medium">
                                        <?php
                                        session_start();
                                            if (isset($_SESSION['email']) && is_array($_SESSION['email'])){
                                                $username = $_SESSION['email']['ho_va_ten']; 
                                                echo htmlspecialchars($username);
                                            }
                                        ?>
                                    </span>
                                </span>
                            </button>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <?php include './views/layout/sidebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid"></div>