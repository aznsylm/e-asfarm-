<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role', 'full_name', 'nik', 'phone_number', 'address', 'gender', 'birth_date', 'active', 'padukuhan_id', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi',
            'min_length' => 'Username minimal 3 karakter',
            'max_length' => 'Username maksimal 50 karakter'
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 8 karakter'
        ],
        'full_name' => [
            'required' => 'Nama lengkap harus diisi',
            'alpha_space' => 'Nama lengkap hanya boleh huruf dan spasi',
            'max_length' => 'Nama lengkap maksimal 100 karakter'
        ],
        'phone_number' => [
            'required' => 'Nomor WA harus diisi',
            'numeric' => 'Nomor WA hanya boleh angka',
            'min_length' => 'Nomor WA minimal 10 digit',
            'max_length' => 'Nomor WA maksimal 15 digit'
        ],
        'village' => [
            'required' => 'Padukuhan/Desa harus dipilih',
            'in_list' => 'Padukuhan/Desa tidak valid'
        ],
        'gender' => [
            'required' => 'Jenis kelamin harus dipilih',
            'in_list' => 'Jenis kelamin tidak valid'
        ],
        'birth_date' => [
            'required' => 'Tanggal lahir harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ]
    ];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getUsersByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }

    public function createUser($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->insert($data);
    }

    public function getUsersByPadukuhan($padukuhanId)
    {
        return $this->where('padukuhan_id', $padukuhanId)->findAll();
    }

    public function getUsersWithPadukuhan()
    {
        return $this->select('users.*, padukuhan.nama_padukuhan')
                    ->join('padukuhan', 'padukuhan.id = users.padukuhan_id', 'left')
                    ->findAll();
    }

    protected $skipValidation = true;
}