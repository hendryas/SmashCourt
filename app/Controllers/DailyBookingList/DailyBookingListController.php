<?php

namespace App\Controllers\DailyBookingList;

use App\Controllers\BaseController;
use App\Models\FieldBookingModel;
use CodeIgniter\HTTP\ResponseInterface;

class DailyBookingListController extends BaseController
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
        $page_name = 'pages/dailybookinglist/daily_booking_list_page';
        $role_id = $this->sessionData['role'] ?? '0';
        $username = $this->sessionData['username'] ?? 'Guest';

        $bookings = $this->fieldBookingModel->getBookingWithLapangan();

        $data = [
            'role_id' => $role_id,
            'bookings' => $bookings,
            'username' => $username
        ];

        return view($page_name, $data);
    }

    public function confirmAttendance($id)
    {
        if (!is_numeric($id)) {
            throw new \Exception("Invalid Booking ID");
        }

        $data = [
            'booking_status' => "Completed"
        ];

        try {
            $this->fieldBookingModel->update($id, $data);

            return $this->response->setJSON([
                'status' => 'OK',
                'message' => 'Konfirmasi kehadiran berhasil!',
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'ERROR',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }
}
