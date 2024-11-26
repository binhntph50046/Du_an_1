<?php
class DashboardController {
    private $dashboardModel;

    public function __construct() {
        $this->dashboardModel = new DashboardModel();
    }

    public function index() {
        $statistics = $this->dashboardModel->getStatistics();
        require_once './views/layout/static.php';
    }
}