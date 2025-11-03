<?php

namespace App\Controllers\Unduhan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DownloadModel;

class Unduhan extends BaseController
{
    protected $downloadModel;

    public function __construct()
    {
        $this->downloadModel = new DownloadModel();
    }

    public function index($category = null)
    {
        $edukasi = $this->downloadModel->where('category', 'Edukasi')->findAll();
        $panduan = $this->downloadModel->where('category', 'Panduan')->findAll();

        return view('pages/unduhan', compact('edukasi', 'panduan'));
    }

    public function download($id)
    {
        $file = $this->fileModel->find($id);
        
        if (!$file) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        $filePath = FCPATH . 'public/assets/uploadfile/pdf_file/' . $file['pdffile'];
        
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server');
        }

        return $this->response->download($filePath, null)->setFileName($file['title'] . '.pdf');
    }
}
