<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Contact extends BaseController
{
    public function kirimEmail()
    {
        // Logic untuk mengirim email
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'pesan' => $this->request->getPost('pesan')
        ];

        // Implementasi pengiriman email di sini
        
        return redirect()->back()->with('success', 'Pesan berhasil dikirim');
    }

    public function sendEmail()
    {
        return $this->kirimEmail();
    }
}