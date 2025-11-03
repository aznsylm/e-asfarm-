<?php

namespace App\Controllers\Admins;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Category\CategoryModel;
use App\Models\Comment\CommentModel;
use App\Models\Post\PostModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\View\ViewDecoratorInterface;
use App\Models\Faq\FaqModel;

class AdminsController extends BaseController
{
    // Method login custom sudah dihapus, sekarang pakai Shield


    public function dashboard($page = 1, $perPage = 10)
    {
        helper('auth');
        
        $user = current_user();

        $post = new PostModel();
        $category = new CategoryModel();
        $userModel = new UserModel();


        $numPosts = $post->countAllResults();
        $numCategory = $category->countAllResults();
        $numUser = $userModel->countAllResults();


        // Menghitung total entri
        $totalRows = $post->countAll();

        // Menghitung jumlah halaman
        $totalPages = ceil($totalRows / $perPage);

        // Menghitung offset
        $offset = ($page - 1) * $perPage;

        // mendapatkan data untuk halaman tertentu
        $allPost = $post->findAll($perPage, $offset);

        $data = [
            'user' => $user,
            'totalRows' => $totalRows,
            'totalPages' => $totalPages,
            'offset' => $offset,
            'allPost' => $allPost,
            'numPosts' => $numPosts,
            'numCategory' => $numCategory,
            'numUser' => $numUser
        ];
        
        return view('admins/dashboard', $data);
    }

    public function allAdmin()
    {
        $userModel = new \App\Models\UserModel();
        $dataUser = $userModel->where('role', 'admin')->findAll();

        $data = [
            'dataUser' => $dataUser,
            'user' => current_user()
        ];

        return view('admins/all-admin', $data);
    }

    public function createAdmin()
    {
        $data = [
            'user' => current_user()
        ];

        return view('admins/create-users', $data);
    }

    // public function storeAdmin()
    // {
    //     // Memvalidasi input
    //     $validationRules = [
    //         'username' => 'required',
    //         'email' => 'required|valid_email|is_unique[users.email]',
    //         'password' => 'required|min_length[8]',
    //     ];

    //     if (!$this->validate($validationRules)) {
    //         return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
    //     }

    //     // Menyiapkan data untuk disimpan
    //     $data = [
    //         'username' => $this->request->getPost('username'),
    //         'email' => $this->request->getPost('email'),
    //         'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    //     ];

    //     // simpan ke database

    //     $userModel = new UserModel();
    //     $userModel->insert($data);

    //     // Memeriksa apakah penyimpanan berhasil
    //     if ($userModel->affectedRows() > 0) {
    //         return redirect()->to(base_url('admin/all-admin'))->with('success', 'User added successfully.');
    //     } else {
    //         return redirect()->back()->withInput()->with('error', 'Failed to save user.');
    //     }
    // }

    public function allCategories()
    {
        $categori = new CategoryModel();
        $allCategories = $categori->findAll();

        $data = [
            'allCategories' => $allCategories,
            'user' => current_user()
        ];

        return view('admins/all-categories', $data);
    }

    public function createCategories()
    {
        $data = [
            'user' => current_user()
        ];

        return view('admins/create-categories', $data);
    }

    public function storeCategories()
    {


        $categoryModel = new CategoryModel();

        // Pastikan data dikirim melalui metode POST dan ada data yang diterima
        if ($this->request->getMethod() === 'post' && $this->request->getPost()) {

            // Ambil data dari formulir
            $name = $this->request->getPost('name');

            // Pastikan nama kategori tidak kosong
            if (!empty($name)) {
                // Periksa apakah kategori sudah ada dalam basis data
                if ($categoryModel->where('name', $name)->countAllResults() > 0) {
                    return redirect()->back()->withInput()->with('error', 'Kategori sudah ada, masukan kategori berbeda.');
                }

                // Data yang akan disimpan
                $data = [
                    "name" => $name,
                ];

                // Simpan data ke dalam basis data
                $categoryModel->save($data);

                // Periksa apakah penyimpanan berhasil
                if ($categoryModel->affectedRows() > 0) {
                    return redirect()->to(base_url('admin/all-categories'))->with('create', 'Category added successfully.');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Failed to save category.');
                }
            } else {
                // Jika nama kategori kosong, kembalikan ke halaman sebelumnya dengan pesan kesalahan
                return redirect()->back()->withInput()->with('error', 'Form tidak boleh kosong.');
            }
        } else {
            // Jika tidak ada data yang dikirim, kembalikan ke halaman sebelumnya dengan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'No data submitted.');
        }
    }

    public function editCategories($id)
    {
        $categoriModel = new CategoryModel();
        $categories = $categoriModel->find($id);

        $data = [
            'categories' => $categories,
            'user' => current_user()
        ];

        return view('admins/edit-categories', $data);
    }

    public function updateCategories($id)
    {
        $categoriModel = new CategoryModel();

        $data = [
            "name" => $this->request->getPost('name'),
        ];

        $categoriModel->update($id, $data);
        // Periksa apakah penyimpanan berhasil
        if ($categoriModel->affectedRows() > 0) {
            return redirect()->to(base_url('admin/all-categories'))->with('update', 'Category update successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to save category.');
        }
    }

    public function deleteCategories($id)
    {


        $categoriModel = new CategoryModel();

        $categoriModel->delete($id);

        if ($categoriModel->affectedRows() > 0) {
            return redirect()->to(base_url('admin/all-categories'))->with('delete', 'Category deleted successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to save category.');
        }
    }

    // ---- crud artikel post ------

    public function allPosts($page = 1, $perPage = 10)
    {
        $postsModel = new PostModel();

        // Menghitung total entri
        $totalRows = $postsModel->countAll();

        // Menghitung jumlah halaman
        $totalPages = ceil($totalRows / $perPage);

        // Menghitung offset
        $offset = ($page - 1) * $perPage;

        // mendapatkan data untuk halaman tertentu
        $allPost = $postsModel->findAll($perPage, $offset);

        $data = [
            'allPost' => $allPost,
            'totalPages' => $totalPages,
            'page' => $page,
            'perPage' => $perPage,
            'user' => current_user()
        ];

        return view('admins/all-post', $data);
    }

    public function createPost()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        $data = [
            'categories' => $categories,
            'user' => current_user()
        ];

        return view('admins/create-post', $data);
    }

    public function storePost()
    {
        $session = session();
        $postModel = new PostModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
            'body' => 'required',
            'category' => 'required',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $img = $this->request->getFile('image');
        // Handle Image upload
        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            $image->move('assets/images/blog');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah gambar');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            "image" => $img->getClientName(),
            'body' => $this->request->getPost('body'),
            'category' => $this->request->getPost('category'),
            'user_id' => session()->get('id'), // Jika ada kolom user_id
            'user_name' => session()->get('name') // Jika ada kolom user_name
        ];

        // Simpan data artikel
        $postModel->save($data);

        // cek apakah berhasil
        if ($postModel->affectedRows() > 0) {
            return redirect()->to(base_url('admin/all-posts'))->with('success', 'Post created successfully.');
        } else {
            // Penanganan jika terjadi kesalahan
            return redirect()->back()->withInput()->with('error', 'Failed to save Articel');
        }
    }

    // edit artikel
    public function editPost($id)
    {
        $postModel = new PostModel();
        $categoryModel = new CategoryModel();

        $post = $postModel->find($id);
        $categories = $categoryModel->findAll();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'user' => current_user()
        ];

        return view('admins/edit-post', $data);
    }

    // update artikel
    public function updatePost($id)
    {
        $postModel = new PostModel();

        // Validasi input
        if (!$this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required',
            'category' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $data = [
            'title' => $this->request->getPost('title'),
            'body' => $this->request->getPost('body'),
            'category' => $this->request->getPost('category'),  // Pastikan kategori yang dipilih terkirim
        ];

        // Update artikel
        $postModel->update($id, $data);

        // Redirect ke halaman daftar artikel setelah berhasil
        return redirect()->to(base_url('admin/all-posts'))->with('success', 'Post updated successfully.');
    }

    //  delete artikel
    public function deletePost($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);

        if (!$post) {
            return redirect()->to('admin/all-posts')->with('error', 'Artikel tidak ditemukan!');
        }

        // Pastikan path file benar
        $imagePath = FCPATH . 'assets/images/blog/' . $post['image'];

        // Periksa apakah file ada sebelum menghapus
        if (!empty($post['image']) && file_exists($imagePath)) {
            unlink($imagePath);
        } else {
            // Lanjutkan penghapusan artikel meskipun file gambar tidak ada
            // return redirect()->with('error', 'File gambar tidak ditemukan!');
        }

        // Hapus artikel dari database
        $postModel->delete($id);

        return redirect()->to('admin/all-posts')->with('success', 'Artikel berhasil dihapus.');
    }

    public function pinjauPost($id)
    {
        $post = new PostModel();
        $artikel = $post->find($id);

        $data = [
            'artikel' => $artikel,
            'user' => current_user()
        ];

        return view('admins/pinjau-post', $data);
    }

    // -- crud faq ===

    public function allFaqs()
    {
        $faqModel = new FaqModel();
        $faqs = $faqModel->findAll();
        
        $data = [
            'faqs' => $faqs,
            'user' => current_user()
        ];
        
        return view('admins/faq-index', $data);
    }

    public function createFaq()
    {
        $data = [
            'user' => current_user()
        ];
        
        return view('admins/create-faq', $data);
    }

    public function storeFaq()
    {
        if (!$this->validate([
            'kategori' => 'required',
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ])) {
            return redirect()->to('/admin/faq/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        $faqModel = new FaqModel();
        $faqModel->save([
            'kategori' => $this->request->getPost('kategori'),
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'jawaban' => $this->request->getPost('jawaban'),
        ]);

        return redirect()->to(base_url('admin/all-faqs'))->with('message', 'FAQ berhasil ditambahkan!');
    }

    public function editFaq($id)
    {
        $faqModel = new FaqModel();
        $faq = $faqModel->find($id);
        
        $data = [
            'faq' => $faq,
            'user' => current_user()
        ];
        
        return view('admins/edit-faq', $data);
    }

    public function updateFaq($id)
    {
        if (!$this->validate([
            'kategori' => 'required',
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ])) {
            return redirect()->to('/admin/faq/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
        }

        $faqModel = new FaqModel();
        $faqModel->update($id, [
            'kategori' => $this->request->getPost('kategori'),
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'jawaban' => $this->request->getPost('jawaban'),
        ]);

        return redirect()->to(base_url('admin/all-faqs'))->with('message', 'FAQ berhasil diperbarui!');
    }

    public function deleteFaq($id)
    {
        $faqModel = new FaqModel();
        $faqModel->delete($id);

        return redirect()->to(base_url('admin/all-faqs'))->with('message', 'FAQ berhasil dihapus!');
    }

    public function databaseKader()
    {
        $data = [
            'title' => 'Database Kader',
            'user' => auth()->user()
        ];
        
        return view('admins/database-kader', $data);
    }

    public function tambahKader()
    {
        $data = [
            'title' => 'Tambah Kader',
            'user' => auth()->user()
        ];
        
        return view('admins/tambah-kader', $data);
    }

    public function approvePost($id)
    {
        // Logic untuk menyetujui artikel
        return redirect()->back()->with('success', 'Artikel berhasil disetujui');
    }

    public function rejectPost($id)
    {
        // Logic untuk menolak artikel
        return redirect()->back()->with('success', 'Artikel berhasil ditolak');
    }
}
