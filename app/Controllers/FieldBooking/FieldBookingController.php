<?php

namespace App\Controllers\FieldBooking;

use App\Controllers\BaseController;
use App\Models\LapanganModel;
use App\Models\FieldBookingModel;
use CodeIgniter\HTTP\ResponseInterface;

class FieldBookingController extends BaseController
{

    private $lapanganModel;
    private $fieldBookingModel;
    private $sessionData;

    public function __construct()
    {
        $this->lapanganModel = new LapanganModel();
        $this->fieldBookingModel = new FieldBookingModel();
        $this->sessionData = session()->get();
    }

    public function index()
    {
        $page_name = 'pages/fieldbooking/field_booking_page';
        $role_id = $this->sessionData['role'] ?? '0';
        $username = $this->sessionData['username'] ?? 'Guest';

        // $get_lapangan = $this->lapanganModel->getAll();
        $get_lapangan = $this->lapanganModel->getLapanganWithBooked();

        $data = [
            'role_id' => $role_id,
            'get_lapangan' => $get_lapangan,
            'username' => $username
        ];

        return view($page_name, $data);
    }

    public function formBooking($id)
    {
        $page_name = 'pages/fieldbooking/form_booking_page';
        $role_id = $this->sessionData['role'] ?? '0';
        $username = $this->sessionData['username'] ?? 'Guest';

        // Debugging: Pastikan ID diterima dengan benar
        if (!is_numeric($id)) {
            throw new \Exception("Invalid Lapangan ID");
        }

        // Ambil data lapangan berdasarkan ID
        $get_lapangan = $this->lapanganModel->getLapangan($id);

        if (!$get_lapangan) {
            return redirect()->to('/field-booking')->with('error', 'Lapangan tidak ditemukan.');
        }

        $data = [
            'role_id' => $role_id,
            'get_lapangan' => $get_lapangan,
            'username' => $username
        ];

        return view($page_name, $data);
    }

    public function save()
    {
        $request = service('request');

        $lapangan_id = $request->getPost('lapangan_id');
        $nama_customer = $request->getPost('nama_customer');
        $nomor_telefon_customer = $request->getPost('nomor_telefon_customer');
        $email_customer = $request->getPost('email_customer');
        $booking_date = $request->getPost('booking_date');
        $start_time = $request->getPost('start_time');
        $end_time = $request->getPost('end_time');
        $total_price = $request->getPost('total_price');
        $payment_method = $request->getPost('payment_method');

        $bukti_pembayaran = null;

        if ($payment_method === 'Transfer') {
            $bukti_file = $request->getFile('bukti_pembayaran');

            if ($bukti_file && $bukti_file->isValid() && !$bukti_file->hasMoved()) {
                // Validasi ekstensi dan ukuran file jika diperlukan
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $maxSize = 2 * 1024 * 1024; // 2MB

                if (!in_array($bukti_file->getMimeType(), $allowedTypes)) {
                    return $this->response->setJSON([
                        'status' => 'ERROR',
                        'message' => 'Format bukti pembayaran harus berupa JPG, JPEG, atau PNG.',
                    ]);
                }

                if ($bukti_file->getSize() > $maxSize) {
                    return $this->response->setJSON([
                        'status' => 'ERROR',
                        'message' => 'Ukuran file bukti pembayaran tidak boleh lebih dari 2MB.',
                    ]);
                }

                // Simpan file ke direktori uploads
                $newName = $bukti_file->getRandomName();
                $uploadPath = FCPATH . 'uploads/bukti_pembayaran/';

                // Pastikan direktori ada
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $bukti_file->move($uploadPath, $newName);
                $bukti_pembayaran = 'uploads/bukti_pembayaran/' . $newName;
            } else {
                return $this->response->setJSON([
                    'status' => 'ERROR',
                    'message' => 'Bukti pembayaran tidak valid atau gagal diunggah.',
                ]);
            }
        } else {
            $bukti_pembayaran = "";
        }

        $data = [
            'lapangan_id' => $lapangan_id,
            'nama_customer' => $nama_customer,
            'nomor_telefon_customer' => $nomor_telefon_customer,
            'email_customer' => $email_customer,
            'booking_date' => $booking_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'total_price' => $total_price,
            'payment_method' => $payment_method,
            'payment_status' => $payment_method == 'Transfer' ? 'Pending' : 'Paid',
            'booking_status' => 'Booked',
            'bukti_transfer' => $bukti_pembayaran
        ];

        try {
            $this->fieldBookingModel->insert($data);

            return $this->response->setJSON([
                'status' => 'OK',
                'message' => 'Data Booking berhasil disimpan!',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'ERROR',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }
}
