<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['NIM', 'nama', 'umur', 'password'];

    // otomatis handle created_at & updated_at
    protected $useTimestamps = true;

    // Helper method untuk login
    public function getByNIM(string $nim)
    {
        return $this->where('NIM', $nim)->first();
    }
}