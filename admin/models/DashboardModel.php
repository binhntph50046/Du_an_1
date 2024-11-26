<?php
class DashboardModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getStatistics() {
        try {
            // Tổng số người dùng
            $userQuery = "SELECT COUNT(*) as total_users FROM tai_khoan WHERE vai_tro = 0";
            $userStmt = $this->conn->query($userQuery);
            $totalUsers = $userStmt->fetch(PDO::FETCH_ASSOC)['total_users'];

            // Tổng số đơn hàng
            $orderQuery = "SELECT COUNT(*) as total_orders FROM don_hang";
            $orderStmt = $this->conn->query($orderQuery);
            $totalOrders = $orderStmt->fetch(PDO::FETCH_ASSOC)['total_orders'];

            // Tổng doanh thu
            $revenueQuery = "SELECT SUM(tong_tien) as total_revenue FROM don_hang WHERE trang_thai = 3";
            $revenueStmt = $this->conn->query($revenueQuery);
            $totalRevenue = $revenueStmt->fetch(PDO::FETCH_ASSOC)['total_revenue'];

            // Tổng lượt xem sản phẩm
            $viewQuery = "SELECT SUM(so_luot_xem) as total_views FROM san_pham";
            $viewStmt = $this->conn->query($viewQuery);
            $totalViews = $viewStmt->fetch(PDO::FETCH_ASSOC)['total_views'];

            return [
                'total_users' => $totalUsers,
                'total_orders' => $totalOrders, 
                'total_revenue' => $totalRevenue,
                'total_views' => $totalViews
            ];
        } catch(PDOException $e) {
            error_log("Lỗi thống kê: " . $e->getMessage());
            return false;
        }
    }
} 