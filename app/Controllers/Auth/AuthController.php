<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    private $sessionData;

    public function __construct()
    {
        $this->sessionData = session()->get();
    }
    public function login()
    {
        $session = session();

        // Jika user sudah login, redirect ke dashboard
        if ($session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        $page_name = 'pages/auth/login_page';
        $role_id = $this->sessionData['role'] ?? '0';

        $data = [
            'role_id' => $role_id
        ];

        return view($page_name, $data);
    }

    public function processLogin()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cek user berdasarkan email
        $user = $model->where('email', $email)->first();

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => true
                ];
                $session->set($sessionData);

                return redirect()->to('/dashboard')->with('success', 'Login berhasil');
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }

    public function register()
    {
        $page_name = 'pages/auth/register_page';
        $role_id = $this->sessionData['role'] ?? '0';

        $data = [
            'role_id' => $role_id
        ];

        return view($page_name, $data);
    }

    public function processRegister()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');

        // Validasi input
        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            return redirect()->back()->with('error', 'Semua field wajib diisi');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Email tidak valid');
        }

        if ($password !== $confirm_password) {
            return redirect()->back()->with('error', 'Password dan Konfirmasi Password tidak cocok');
        }

        // Cek apakah email sudah terdaftar
        $existingUser = $model->where('email', $email)->first();
        if ($existingUser) {
            return redirect()->back()->with('error', 'Email sudah terdaftar');
        }

        // Simpan user ke database
        $newUserData = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'staff'
        ];

        $model->insert($newUserData);

        return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil, silakan login');
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/')->with('success', 'Berhasil logout');
    }
}
