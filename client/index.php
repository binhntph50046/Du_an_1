<?php
session_start();
include '../admin/commons/env.php';
include '../admin/commons/function.php';
include "./models/pdo.php";
include "./controllers/HomeController.php";
include "./models/ProductModel.php";

$conn = pdo_get_connection();
$controller = new HomeController($conn);
$controller->index();
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'register':
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $address = $_POST['address'];
                $phonenumber = $_POST['phonenumber'];
                insert_taikhoan($name, $email, $pass, $address, $phonenumber);
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
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $check_email = check_user($email, $pass);
                if (is_array($check_email)) {
                    $_SESSION['email'] = $check_email;
                    $thongbao1 = "Đăng nhập thành công!!";
                    echo "
                        <script>
                            alert('$thongbao1');
                            setTimeout( function() {
                                window.location.href = 'index.php';
                            }, 500)
                        </script>";
                } else {
                    $thongbao2 = "Sai email hoặc mật khẩu chưa đúng!!";
                    echo "<script>alert('$thongbao2')</script>";
                }
            }
            include "./views/login.php";
            break;
        default:
            break;
    }
}
