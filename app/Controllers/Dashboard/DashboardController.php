<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\FieldBookingModel;
use App\Models\LapanganModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    private $sessionData;
    private $fieldBookingModel;
    private $lapanganModel;

    public function __construct()
    {
        $this->sessionData = session()->get();
        $this->fieldBookingModel = new FieldBookingModel();
        $this->lapanganModel = new LapanganModel();
    }

    public function index()
    {
        $page_name = 'pages/dashboard/dashboard_page';
        $role_id = $this->sessionData['role'] ?? '0';
        $username = $this->sessionData['username'] ?? 'Guest';

        $history = $this->fieldBookingModel->getBookingWithLapangan();
        $total_bookings = count($history);
        $today_bookings = $this->fieldBookingModel->countTodayBookings();
        $total_fields = $this->lapanganModel->countAllField();
        $recent_bookings = $this->fieldBookingModel->getTodayBookings();

        $data = [
            'role_id' => $role_id,
            'username' => $username,
            'total_bookings' => $total_bookings,
            'today_bookings' => $today_bookings,
            'total_fields' => $total_fields,
            'recent_bookings' => $recent_bookings
        ];

        // var_dump($data);
        // die;

        return view($page_name, $data);
    }
}
