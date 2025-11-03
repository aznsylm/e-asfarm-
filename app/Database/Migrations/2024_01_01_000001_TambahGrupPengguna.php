<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TambahGrupPengguna extends Migration
{
    public function up()
    {
        // Tambah groups untuk sistem role
        $data = [
            [
                'title'       => 'pengguna',
                'name'        => 'pengguna',
                'description' => 'Pengguna terdaftar yang bisa menulis artikel'
            ],
            [
                'title'       => 'admin',
                'name'        => 'admin', 
                'description' => 'Administrator yang mengelola sistem'
            ],
            [
                'title'       => 'superadmin',
                'name'        => 'superadmin',
                'description' => 'Super Administrator dengan akses penuh'
            ]
        ];

        $this->db->table('auth_groups')->insertBatch($data);

        // Tambah permissions
        $permissions = [
            // Permissions untuk pengguna
            ['name' => 'artikel.buat.sendiri', 'description' => 'Buat artikel sendiri'],
            ['name' => 'artikel.edit.sendiri', 'description' => 'Edit artikel sendiri'],
            ['name' => 'artikel.hapus.sendiri', 'description' => 'Hapus artikel sendiri'],
            ['name' => 'dashboard.lihat', 'description' => 'Lihat dashboard pengguna'],
            
            // Permissions untuk admin
            ['name' => 'pengguna.lihat', 'description' => 'Lihat daftar pengguna'],
            ['name' => 'pengguna.edit', 'description' => 'Edit data pengguna'],
            ['name' => 'pengguna.hapus', 'description' => 'Hapus pengguna'],
            ['name' => 'kategori.*', 'description' => 'Kelola semua kategori'],
            ['name' => 'artikel.*', 'description' => 'Kelola semua artikel'],
            ['name' => 'artikel.setujui', 'description' => 'Setujui artikel pengguna'],
            ['name' => 'artikel.tolak', 'description' => 'Tolak artikel pengguna'],
            ['name' => 'faq.*', 'description' => 'Kelola FAQ'],
            ['name' => 'pdf.*', 'description' => 'Kelola file PDF'],
            ['name' => 'database_kader.lihat', 'description' => 'Lihat database kader'],
            
            // Permissions untuk superadmin
            ['name' => 'admin.buat', 'description' => 'Buat admin baru'],
            ['name' => 'admin.edit', 'description' => 'Edit data admin'],
            ['name' => 'admin.hapus', 'description' => 'Hapus admin'],
            ['name' => 'sistem.pengaturan', 'description' => 'Akses pengaturan sistem'],
            ['name' => 'audit.log', 'description' => 'Lihat audit log'],
            ['name' => 'database_kader.aktifkan', 'description' => 'Aktifkan fitur database kader']
        ];

        $this->db->table('auth_permissions')->insertBatch($permissions);
    }

    public function down()
    {
        // Hapus permissions
        $this->db->table('auth_permissions')->truncate();
        
        // Hapus groups
        $this->db->table('auth_groups')->truncate();
    }
}