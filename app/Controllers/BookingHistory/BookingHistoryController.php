<?php

namespace App\Controllers\BookingHistory;

use App\Controllers\BaseController;
use App\Models\FieldBookingModel;
use CodeIgniter\HTTP\ResponseInterface;

class BookingHistoryController extends BaseController
{
    private $fieldBookingModel;
    private $sessionData;

    public function __construct()
    {
        $this->fieldBookingModel = new FieldBookingModel();
        $this->sessionData = session()->get();
    }

    public function index()
    {
        $page_name = 'pages/bookinghistory/booking_history_page';
        $role_id = $this->sessionData['role'] ?? '0';
        $username = $this->sessionData['username'] ?? 'Guest';

        $history = $this->fieldBookingModel->getBookingWithLapangan();

        $data = [
            'role_id' => $role_id,
            'history' => $history,
            'username' => $username
        ];

        return view($page_name, $data);
    }
}
