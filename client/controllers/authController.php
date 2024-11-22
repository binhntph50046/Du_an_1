<?php
class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if (isset($_POST['submit'])) {
            $data = [
                'ho_va_ten' => $_POST['name'],
                'email' => $_POST['email'],
                'mat_khau' => $_POST['pass'],
                'dia_chi' => $_POST['address'], 
                'so_dien_thoai' => $_POST['phonenumber'],
                'hinh' => '../Upload/User/nam.jpg'
            ];

            $success = $this->userModel->create($data);
            
            if ($success) {
                $thongbao = "Đăng ký thành công. Vui lòng đăng nhập!!";
                echo "<script>
                    alert('$thongbao');
                    setTimeout(function() {
                        window.location.href = './?act=login';
                    }, 1000);
                  </script>";
            }
        }
        include "./views/register.php";
    }

    public function login() {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            
            $user = $this->userModel->login($email, $pass);
            
            if ($user) {
                $_SESSION['email'] = $user;
                $thongbao1 = "Đăng nhập thành công!!";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 900)
                </script>";
            } else {
                $thongbao2 = "Sai email hoặc mật khẩu!!";
                echo "<script>alert('$thongbao2')</script>";
            }
        }
        include "./views/login.php";
    }
    public function logout() {
        unset($_SESSION['email']);
        header('Location: index.php');
        exit();
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $this->userModel->getPasswordByEmail($email);
            
            if ($password) {
                include "./views/forgot-password.php";
            } else {
                $error = "Email does not exist in the system!";
                include "./views/forgot-password.php";
            }
        } else {
            include "./views/forgot-password.php";
        }
    }
} 