<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'role', 'enrolled_courses', 'created_at'];

    // Optional: helper method
    public function getByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }
}
