<?php

namespace App\Controllers\Admins;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Faq\FaqCategoriesModel;
use App\Models\Faq\FaqModel;

class AdminsFaqController extends BaseController
{
    public function index()
    {
        $session = session();
        $faqcategotiesmodel = new FaqCategoriesModel();
        $faqModel = new FaqModel();

        $tanyaJawabKategori = $faqcategotiesmodel->findAll();
        $tanyaJawab = $faqModel->findAll();

        return view('admins/faq-index', compact('tanyaJawab', 'session', 'tanyaJawabKategori'));
    }

    public function create()
    {
        $session = session();
        $faqcategotiesmodel = new FaqCategoriesModel();
        $tanyaJawabKategori = $faqcategotiesmodel->findAll();

        return view('admins/faq-create', compact('session', 'tanyaJawabKategori'));
    }

    public function store()
    {
        $faqModel = new FaqModel();
        $faqModel->save([
            'category_id' => $this->request->getPost('category_id'),
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'jawaban' => $this->request->getPost('jawaban')
        ]);

        return redirect()->to('admin/semua-tanya-jawab');
    }

    public function deleted($id)
    {

        $faqModel = new FaqModel();

        $faqModel->delete($id);

        session()->setFlashdata('success', 'Post deleted successfully.');

        return redirect()->to(base_url('admin/semua-tanya-jawab'))->with('success', 'Tanya jawab berhasil dihapus.');

    }

    public function category($name)
    {
        $session = session();  //menginisialisasi objec sesi
        $faqcategotiesmodel = new FaqCategoriesModel();
        $faqModel = new FaqModel();

        

        // Cari category berdasarkan 'name'
        $kategori = $faqcategotiesmodel->where('name', $name)->first();

        // Jika kategori tidak ditemukan, bisa redireksi atau tampilkan error
        if (!$kategori) {
            return redirect()->to('/admin/semua-tanya-jawab')->with('error', 'Kategori tidak ditemukan');
        }

        // Ambil data FAQ berdasarkan 'category_id'
        $tanyaJawab = $faqModel->where('category_id', $kategori['id'])->findAll();

        return view('admins/faq-categori', compact('kategori', 'tanyaJawab', 'session'));


    }
}
