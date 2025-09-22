<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MahasiswaModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login', [
            'title' => 'Login Sistem Akademik'
        ]);
    }

    public function login()
    {
        $session = session();
        $userModel = new UserModel();
        $mahasiswaModel = new MahasiswaModel();

        $usernameOrNIM = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek apakah login sebagai admin (tabel users)
        $user = $userModel->where('username', $usernameOrNIM)->first();
        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'logged_in' => true,
            ]);
            return redirect()->to('/admin/dashboard');
        }

        // Cek apakah login sebagai mahasiswa (tabel mahasiswa)
        $mahasiswa = $mahasiswaModel->where('NIM', $usernameOrNIM)->first();
        if ($mahasiswa && password_verify($password, $mahasiswa['password'])) {
            $session->set([
                'user_id' => $mahasiswa['id'],
                'username' => $mahasiswa['NIM'], // Gunakan NIM sebagai username
                'nama' => $mahasiswa['nama'], // Simpan nama untuk dashboard
                'role' => 'student',
                'logged_in' => true,
            ]);
            return redirect()->to('/student/dashboard');
        }

        return redirect()->to('/login')->with('error', 'Username/NIM atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}