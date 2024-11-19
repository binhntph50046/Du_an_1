<?php
session_start();
include "./models/user.php";
include "./models/pdo.php";

include "./models/sanpham.php";


$products = loadAll_sanpham_home();

include "./models/slide.php";

// Lấy danh sách slides hoạt động
$listSlides = getSlides();


if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
            // case '/':
            //     include "./views/home.php";
            //     break;
            // case 'sanpham':
            //     if (isset($_POST['kyw']) && $_POST['kyw'] != "") {
            //         $kyw = $_POST['kyw'];
            //     } else {
            //         $kyw = "";
            //     }
            //     if (isset($_GET['iddm']) && $_GET['iddm'] > 0) {
            //         $iddm = $_GET['iddm'];
            //     } else {
            //         $iddm = 0;
            //     }
            //     $dssp = loadAll_sanpham($kyw, $iddm);
            //     $tendm = load_ten_dm($iddm);
            //     include "./view/home.php";
            //     break;
        case 'register':
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $address = $_POST['address'];
                $phonenumber = $_POST['phonenumber'];
                $defaultImage = '../Upload/User/nam.jpg';
                insert_taikhoan($name, $email, $pass, $address, $phonenumber, $defaultImage);
                $thongbao = "Đăng ký thành công. Vui lòng đăng nhập!!";

                // Hiển thị thông báo và chuyển hướng
                echo "<script>
                        alert('$thongbao');
                        setTimeout(function() {
                            window.location.href = './?act=login';
                        }, 1000);
                      </script>";
            }
            include "./views/register.php";
            break;
        case 'login':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $check_email = check_user($email, $pass);
                if (is_array($check_email)) {
                    $_SESSION['email'] = $check_email;
                    // var_dump($_SESSION['email']);die();
                    $thongbao1 = "Đăng nhập thành công!!";
                    echo "
                        <script>
                            setTimeout( function() {
                                window.location.href = 'index.php';
                            }, 900)
                        </script>";
                } else {
                    $thongbao2 = "Sai email hoặc mật khẩu chưa đúng!!";
                    echo "<script>alert('$thongbao2')</script>";
                }
            }
            include "./views/login.php";
            break;
        case 'logout':
            unset($_SESSION['email']);
            header('Location: index.php');
            exit();
            break;
        
        default:
            include "./views/home.php";
            break;
    }
} else {
    include "./views/home.php";
}
