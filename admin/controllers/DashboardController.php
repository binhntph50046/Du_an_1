<?php
class DashboardController {
    private $dashboardModel;

    public function __construct() {
        $this->dashboardModel = new DashboardModel();
    }

    public function index() {
        $statistics = $this->dashboardModel->getStatistics();
        $recentOrders = $this->dashboardModel->getRecentOrders();
        require_once './views/layout/static.php';
    }
}