<?php

namespace App\Controllers\FieldList;

use App\Controllers\BaseController;
use App\Models\LapanganModel;
use CodeIgniter\HTTP\ResponseInterface;

class FieldListController extends BaseController
{
    private $lapanganModel;
    private $sessionData;

    public function __construct()
    {
        $this->lapanganModel = new LapanganModel();
        $this->sessionData = session()->get();
    }

    public function index()
    {
        $page_name = 'pages/fieldlist/field_list_page';
        $role_id = $this->sessionData['role'] ?? '0';
        $username = $this->sessionData['username'] ?? 'Guest';
        $get_lapangan = $this->lapanganModel->getAll();

        $data = [
            'role_id' => $role_id,
            'get_lapangan' => $get_lapangan,
            'username' => $username
        ];

        return view($page_name, $data);
    }

    public function addData()
    {
        $page_name = 'pages/fieldlist/add_field_list_page';
        $role_id = $this->sessionData['role'] ?? '0';
        $username = $this->sessionData['username'] ?? 'Guest';

        $data = [
            'role_id' => $role_id,
            'username' => $username
        ];

        return view($page_name, $data);
    }

    public function save()
    {
        $request = service('request');

        // Ambil data dari request
        $nama = $request->getPost('nama');
        $tipe_lantai = $request->getPost('tipe_lantai');
        $harga_per_jam = $request->getPost('harga_per_jam');
        $fasilitas = $request->getPost('fasilitas');
        $status_lapangan = $request->getPost('status_lapangan');
        $username = $this->sessionData['username'] ?? 'Guest';

        // Validasi jika ada input kosong
        if (empty($nama) || empty($tipe_lantai) || empty($harga_per_jam)) {
            return $this->response->setJSON([
                'status' => 'ERROR',
                'message' => 'Harap isi semua field yang diperlukan!',
            ]);
        }

        // Persiapkan data untuk insert
        $data = [
            'nama' => $nama,
            'tipe_lantai' => $tipe_lantai,
            'harga_per_jam' => $harga_per_jam,
            'fasilitas' => $fasilitas,
            'status' => $status_lapangan,
            'delete_sts' => 0,
            'created_user' => $username,
        ];

        try {
            $this->lapanganModel->insert($data);

            return $this->response->setJSON([
                'status' => 'OK',
                'message' => 'Data Lapangan berhasil disimpan!',
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'ERROR',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    public function editData($id)
    {
        $page_name = 'pages/fieldlist/edit_field_list_page';
        $role_id = $this->sessionData['role'] ?? '0';

        $lapangan = $this->lapanganModel->find($id);

        if (!$lapangan) {
            return redirect()->to('field-list')->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'role_id' => $role_id,
            'lapangan' => $lapangan
        ];

        return view($page_name, $data);
    }

    public function update($id)
    {
        $request = service('request');

        $nama = $request->getPost('nama');
        $tipe_lantai = $request->getPost('tipe_lantai');
        $harga_per_jam = $request->getPost('harga_per_jam');
        $fasilitas = $request->getPost('fasilitas');
        $status_lapangan = $request->getPost('status_lapangan');

        $data = [
            'nama' => $nama,
            'tipe_lantai' => $tipe_lantai,
            'harga_per_jam' => $harga_per_jam,
            'fasilitas' => $fasilitas,
            'status' => $status_lapangan,
        ];

        try {
            $this->lapanganModel->update($id, $data);

            $status = "OK";
            $message = "Update successfull!";
            $log = "";

            $response = array(
                "status" => $status,
                "message" => $message,
                "log" => $log
            );
            echo json_encode($response);

            // return $this->response->setJSON([
            //     'status' => 'OK',
            //     'message' => 'Data berhasil diperbarui!'
            // ]);
        } catch (\Exception $e) {
            // return $this->response->setJSON([
            //     'status' => 'ERROR',
            //     'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            // ]);

            $status = "ERROR";
            $message = "Update Data Failed!" . $e->getMessage();
            $log = "";

            $response = array(
                "status" => $status,
                "message" => $message,
                "log" => $log
            );
            echo json_encode($response);
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        $data = [
            'delete_sts' => 1
        ];

        $updated = $this->lapanganModel->update($id, $data);

        if ($updated) {
            $status = "OK";
            $message = "The transaction was successful!";
            $log = "";
        } else {
            $status = "ERROR";
            $message = "Delete Data Failed!";
            $log = "";
        }

        $response = array(
            "status" => $status,
            "message" => $message,
            "log" => $log
        );
        echo json_encode($response);
    }
}
