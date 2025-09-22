<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 🔒 Cek login
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu!');
        }

        // 🔒 Cek role jika diminta (misal: auth:admin atau auth:student)
        if ($arguments && isset($arguments[0])) {
            $requiredRole = $arguments[0];
            if ($session->get('role') !== $requiredRole) {
                return redirect()->to('/login')->with('error', 'Akses ditolak!');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak dipakai, tapi bisa untuk misalnya mencegah akses balik ke /login kalau sudah login
    }
}
