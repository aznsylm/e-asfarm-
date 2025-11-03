<?php

namespace App\Controllers\Admins;

use App\Controllers\BaseController;
use App\Models\Upload\FileCategoriModel;
use App\Models\Upload\FileModel;
use CodeIgniter\HTTP\ResponseInterface;

class PdfController extends BaseController
{
    public function index()
    {
        $session = session();
        $user = auth()->user();
        $fileCategori = new FileCategoriModel();
        $fileModel = new FileModel();

        $filescategories = $fileCategori->findAll();
        $files = $fileModel
            ->select('files.*, filescategories.name AS category_name')
            ->join('filescategories', 'files.category_id = filescategories.id', 'left')
            ->findAll();

        return view('admins/manager-pdf', compact('session', 'user', 'filescategories', 'files'));
    }

    public function uploadPdfForm()
    {
        $session = session();
        $user = auth()->user();
        $fileCategori = new FileCategoriModel();
        $filescategories = $fileCategori->findAll();

        return view('admins/upload-pdf', compact('session', 'user', 'filescategories'));
    }

    public function uploadPdf()
    {

        $fileModel = new FileModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'pdffile' => 'uploaded[pdffile]|max_size[pdffile,10240]|mime_in[pdffile,application/pdf]',
            'image' => 'uploaded[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png]',
            'title' => 'required',
            'category_id' => 'required'
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }


        // Handle PDF upload
        $pdfFile = $this->request->getFile('pdffile');
        if ($pdfFile->isValid() && !$pdfFile->hasMoved()) {
            $pdfFile->move('public/assets/uploadfile/pdf_file');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah PDF');
        }

        // Handle Image upload
        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            $image->move('public/assets/uploadfile/images');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah gambar');
        }

        // Data to insert
        $data = [
            'title' => $this->request->getPost('title'),
            'category_id' => $this->request->getPost('category_id'),
            'pdffile' => $pdfFile->getClientName(),
            'image' => $image->getClientName(),
        ];

        $fileModel->save($data);

        if ($fileModel->affectedRows() > 0) {
            return redirect()->to(base_url('admin/manager-pdf'))->with('success', 'post created success');
        } else {
            return redirect()->to('admins/upload-pdf')->with('errors', 'Terjadi kesalahan dalam pengunggahan file.');
        }
    }

    public function editPdf($id)
    {
        $session = session();
        $fileCategori = new FileCategoriModel();
        $fileModel = new FileModel();

        $filescategories = $fileCategori->findAll();
        $files = $fileModel->find($id);

        return view('admins/edit_pdf_view', compact('session', 'filescategories', 'files'));
    }

    public function updatePdf($id)
    {
        if ($this->request->getMethod() == 'post') {
            $fileModel = new FileModel();

            // Validasi input
            if (!$this->validate([
                'title' => 'required|min_length[3]',
                'category' => 'required'
            ])) {
                return redirect()->back()->withInput()->with('errors', \Config\Services::validation()->getErrors());
            }

            // Data yang akan diupdate
            $data = [
                'title' => $this->request->getPost('title'),
                'category_id' => $this->request->getPost('category')
            ];

            // Update data
            $fileModel->update($id, $data);

            return redirect()->to('manager.pdf')->with('message', 'File PDF berhasil diperbarui!');
        }
    }

    public function deletePdf($id)
    {
        $fileModel = new FileModel();
        $file = $fileModel->find($id);

        // Pastikan file ditemukan sebelum mencoba menghapus
        if (!$file) {
            return redirect()->to('admins/manager-pdf')->with('error', 'File tidak ditemukan!');
        }

        // Hapus file PDF dan gambar jika ada
        if (file_exists('public/assets/uploadfile/pdf_file/' . $file['pdffile'])) {
            unlink('public/assets/uploadfile/pdf_file/' . $file['pdffile']);
        } else {
            return redirect()->to('admins/manager-pdf')->with('error', 'PDF file tidak ditemukan!');
        }

        if (file_exists('public/assets/uploadfile/images/' . $file['image'])) {
            unlink('public/assets/uploadfile/images/' . $file['image']);
        } else {
            return redirect()->to('admins/manager-pdf')->with('error', 'Image file tidak ditemukan!');
        }

        // Hapus data dari database
        $fileModel->delete($id);

        return redirect()->to('admin/manager-pdf')->with('message', 'File PDF berhasil dihapus!');
    }

    public function category($name)
    {
        $session = session();  //menginisialisasi objec sesi
        $filecategotiesmodel = new FileCategoriModel();
        $fileModel = new FileModel();

        

        // Cari category berdasarkan 'name'
        $category = $filecategotiesmodel->where('name', $name)->first();

        // Jika kategori tidak ditemukan, bisa redireksi atau tampilkan error
        if (!$category) {
            return redirect()->to('/admin/faq-index')->with('error', 'Category not found');
        }

        // Ambil data FAQ berdasarkan 'category_id'
        $fils = $fileModel->where('category_id', $category['id'])->findAll();


        return view('admins/faq-categori', compact('category', 'files', 'session'));


    }
}
