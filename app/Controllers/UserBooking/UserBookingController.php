<?php

namespace App\Controllers\UserBooking;

use App\Controllers\BaseController;
use App\Models\FieldBookingModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserBookingController extends BaseController
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
        $page_name = 'pages/userbooking/user_booking_page';
        $role_id = $this->sessionData['role'] ?? '0';
        $username = $this->sessionData['username'] ?? 'Guest';

        $get_booking_field = $this->fieldBookingModel->getBookingWithLapangan();

        $data = [
            'role_id' => $role_id,
            'get_booking_field' => $get_booking_field,
            'username' => $username
        ];

        return view($page_name, $data);
    }

    public function confirmPayment($id)
    {
        if (!is_numeric($id)) {
            throw new \Exception("Invalid Booking ID");
        }

        $data = [
            'payment_status' => "Paid"
        ];

        try {
            $this->fieldBookingModel->update($id, $data);

            return $this->response->setJSON([
                'status' => 'OK',
                'message' => 'Konfirmasi berhasil!',
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'ERROR',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }
}
