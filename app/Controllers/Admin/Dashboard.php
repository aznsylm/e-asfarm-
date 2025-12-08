<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ArticleModel;
use App\Models\Faq\FaqModel;
use App\Models\DownloadModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $articleModel;
    protected $faqModel;
    protected $downloadModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->articleModel = new ArticleModel();
        $this->faqModel = new FaqModel();
        $this->downloadModel = new DownloadModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        return view('admin/dashboard', $data);
    }

    public function kelolaPengguna()
    {
        $user = $this->getAuthUser();
        $userRole = session()->get('role') ?? 'admin';
        $padukuhanId = session()->get('padukuhan_id');
        
        $query = $this->userModel;
        if ($userRole === 'admin' && $padukuhanId) {
            $query = $query->where('padukuhan_id', $padukuhanId);
        }
        
        $data = [
            'user' => $user,
            'users' => $query->paginate(10),
            'pager' => $this->userModel->pager,
            'articles' => [],
            'faqs' => [],
            'downloads' => [],
            'title' => 'Kelola Pengguna'
        ];

        return view('admin/kelola-pengguna', $data);
    }

    public function kelolaAdmin()
    {
        $user = $this->getAuthUser();
        $users = $this->userModel->findAll();

        $data = [
            'user' => $user,
            'users' => $users ?? [],
            'articles' => $this->articleModel->orderBy('created_at', 'DESC')->findAll() ?? [],
            'pending_articles' => $this->articleModel->getByStatus('pending') ?? [],
            'faqs' => $this->faqModel->findAll() ?? [],
            'downloads' => $this->downloadModel->findAll() ?? [],
            'title' => 'Kelola Admin'
        ];

        return view('admin/kelola-admin', $data);
    }

    public function kelolaArtikel()
    {
        $userRole = session()->get('role') ?? 'admin';
        $padukuhanId = session()->get('padukuhan_id');
        
        if ($userRole === 'admin' && $padukuhanId) {
            $approvedArticles = $this->articleModel->select('articles.*')
                ->join('users', 'users.id = articles.author_id')
                ->where('articles.status', 'approved')
                ->where('users.padukuhan_id', $padukuhanId)
                ->orderBy('articles.created_at', 'DESC')
                ->paginate(10, 'approved');
            $pagerApproved = $this->articleModel->pager;
            
            $pendingArticles = $this->articleModel->select('articles.*')
                ->join('users', 'users.id = articles.author_id')
                ->where('articles.status', 'pending')
                ->where('users.padukuhan_id', $padukuhanId)
                ->orderBy('articles.created_at', 'DESC')
                ->paginate(10, 'pending');
            $pagerPending = $this->articleModel->pager;
            
            $rejectedArticles = $this->articleModel->select('articles.*')
                ->join('users', 'users.id = articles.author_id')
                ->where('articles.status', 'rejected')
                ->where('users.padukuhan_id', $padukuhanId)
                ->orderBy('articles.created_at', 'DESC')
                ->paginate(10, 'rejected');
            $pagerRejected = $this->articleModel->pager;
        } else {
            $approvedArticles = $this->articleModel->where('status', 'approved')->orderBy('created_at', 'DESC')->paginate(10, 'approved');
            $pagerApproved = $this->articleModel->pager;
            
            $pendingArticles = $this->articleModel->where('status', 'pending')->orderBy('created_at', 'DESC')->paginate(10, 'pending');
            $pagerPending = $this->articleModel->pager;
            
            $rejectedArticles = $this->articleModel->where('status', 'rejected')->orderBy('created_at', 'DESC')->paginate(10, 'rejected');
            $pagerRejected = $this->articleModel->pager;
        }

        // Gabungkan semua artikel untuk JavaScript
        $allArticles = array_merge(
            $approvedArticles,
            $pendingArticles,
            $rejectedArticles
        );

        $data = [
            'approvedArticles' => $approvedArticles,
            'pagerApproved' => $pagerApproved,
            'pendingArticles' => $pendingArticles,
            'pagerPending' => $pagerPending,
            'rejectedArticles' => $rejectedArticles,
            'pagerRejected' => $pagerRejected,
            'users' => [],
            'articles' => $allArticles,
            'faqs' => [],
            'downloads' => [],
            'title' => 'Kelola Artikel',
            'userRole' => $userRole,
            'adminPadukuhanId' => $padukuhanId
        ];

        return view('admin/kelola-artikel', $data);
    }

    public function kelolaFaq()
    {
        $data = [
            'faqs' => $this->faqModel->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->faqModel->pager,
            'users' => [],
            'articles' => [],
            'downloads' => [],
            'title' => 'Kelola FAQ'
        ];

        return view('admin/kelola-faq', $data);
    }

    public function kelolaUnduhan()
    {
        $data = [
            'downloads' => $this->downloadModel->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->downloadModel->pager,
            'users' => [],
            'articles' => [],
            'faqs' => [],
            'title' => 'Kelola Unduhan'
        ];

        return view('admin/kelola-unduhan', $data);
    }

    private function getAuthUser()
    {
        $user = auth()->user();
        if (!$user) {
            $userId = session()->get('user_id') ?? 1;
            $userData = $this->userModel->find($userId);
            $user = (object)['id' => $userData['id'] ?? 1, 'username' => $userData['username'] ?? 'Admin', 'email' => $userData['email'] ?? 'admin@e-asfarm.com', 'role' => $userData['role'] ?? 'admin'];
        }
        return $user;
    }

    // CRUD PENGGUNA
    public function tambahPengguna()
    {
        $this->response->setContentType('application/json');
        $userRole = session()->get('role') ?? 'admin';
        $requestedRole = $this->request->getPost('role') ?? 'pengguna';

        // Admin can only create 'pengguna'
        if ($userRole === 'admin' && $requestedRole !== 'pengguna') {
            return $this->response->setJSON(['success' => false, 'message' => 'Anda tidak memiliki akses untuk membuat user dengan role tersebut']);
        }

        // SuperAdmin cannot create 'superadmin'
        if ($requestedRole === 'superadmin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akun SuperAdmin tidak dapat dibuat melalui dashboard']);
        }

        if (!$this->validate([
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'phone_number' => 'required|regex_match[/^08[0-9]{8,13}$/]',
            'padukuhan_id' => 'required'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        // Admin auto-set padukuhan_id from their session
        $padukuhanId = $this->request->getPost('padukuhan_id');
        if ($userRole === 'admin') {
            $padukuhanId = session()->get('padukuhan_id');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'phone_number' => $this->request->getPost('phone_number'),
            'role' => $requestedRole,
            'padukuhan_id' => $padukuhanId,
            'active' => 1
        ];

        if ($this->userModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Pengguna berhasil ditambahkan']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan pengguna']);
    }

    public function ubahPengguna($id)
    {
        $this->response->setContentType('application/json');
        $userRole = session()->get('role') ?? 'admin';
        $targetUser = $this->userModel->find($id);

        // Admin can only edit 'pengguna'
        if ($userRole === 'admin' && $targetUser['role'] !== 'pengguna') {
            return $this->response->setJSON(['success' => false, 'message' => 'Anda tidak memiliki akses untuk mengubah user ini']);
        }

        // Cannot change role to superadmin
        if ($this->request->getPost('role') === 'superadmin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak dapat mengubah role menjadi SuperAdmin']);
        }

        if (!$this->validate([
            'username' => "required|min_length[3]|is_unique[users.username,id,$id]",
            'email' => "required|valid_email|is_unique[users.email,id,$id]",
            'phone_number' => 'required|regex_match[/^08[0-9]{8,13}$/]',
            'password' => 'permit_empty|min_length[8]',
            'padukuhan_id' => 'required'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'padukuhan_id' => $this->request->getPost('padukuhan_id')
        ];

        // SuperAdmin can change role
        if ($userRole === 'superadmin' && $this->request->getPost('role')) {
            $data['role'] = $this->request->getPost('role');
        }

        // Only hash password if not empty
        $password = $this->request->getPost('password');
        if (!empty($password) && trim($password) !== '') {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($this->userModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Pengguna berhasil diubah']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah pengguna']);
    }

    public function hapusPengguna($id)
    {
        $this->response->setContentType('application/json');
        $userRole = session()->get('role') ?? 'admin';
        $currentUserId = session()->get('user_id') ?? auth()->id();
        $targetUser = $this->userModel->find($id);

        // Cannot delete yourself
        if ($id == $currentUserId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Anda tidak dapat menghapus akun sendiri']);
        }

        // Cannot delete superadmin
        if ($targetUser['role'] === 'superadmin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akun SuperAdmin tidak dapat dihapus']);
        }

        // Admin can only delete 'pengguna'
        if ($userRole === 'admin' && $targetUser['role'] !== 'pengguna') {
            return $this->response->setJSON(['success' => false, 'message' => 'Anda tidak memiliki akses untuk menghapus user ini']);
        }

        if ($this->userModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Pengguna berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus pengguna']);
    }

    // CRUD ARTIKEL
    public function tambahArtikel()
    {
        $this->response->setContentType('application/json');

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'content' => 'required|min_length[20]',
            'category' => 'required',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $user = $this->getAuthUser();
        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();
        $image->move(FCPATH . 'uploads/articles', $imageName);

        $status = (in_array($user->role, ['admin', 'superadmin'])) ? 'approved' : 'pending';
        $title = $this->request->getPost('title');
        $slug = $this->articleModel->generateSlug($title);
        $seoTitle = $this->request->getPost('seo_title') ?: $title;
        $metaDesc = $this->request->getPost('meta_description') ?: substr(strip_tags($this->request->getPost('content')), 0, 160);

        // Set padukuhan_id: NULL untuk admin/superadmin, ambil dari user untuk pengguna biasa
        $padukuhanId = null;
        if ($user->role === 'pengguna') {
            $userData = $this->userModel->find($user->id);
            $padukuhanId = $userData['padukuhan_id'] ?? null;
        }

        $data = [
            'title' => $title,
            'slug' => $slug,
            'seo_title' => $seoTitle,
            'meta_description' => $metaDesc,
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category'),
            'image' => $imageName,
            'author_id' => $user->id,
            'author_name' => $user->username,
            'padukuhan_id' => $padukuhanId,
            'status' => $status
        ];

        if ($this->articleModel->insert($data)) {
            $message = ($status == 'approved') ? 'Artikel berhasil dipublish' : 'Artikel berhasil dibuat, menunggu persetujuan admin';
            return $this->response->setJSON(['success' => true, 'message' => $message]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan artikel']);
    }

    public function ubahArtikel($id)
    {
        $this->response->setContentType('application/json');

        // Validasi akses
        $userRole = session()->get('role') ?? 'admin';
        $padukuhanId = session()->get('padukuhan_id');
        
        if (!$this->articleModel->canAdminManage($id, $padukuhanId, $userRole)) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Anda hanya bisa mengedit artikel dari pengguna di padukuhan Anda'
            ]);
        }

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'content' => 'required|min_length[20]',
            'category' => 'required'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $title = $this->request->getPost('title');
        $article = $this->articleModel->find($id);
        
        $data = [
            'title' => $title,
            'slug' => $this->articleModel->generateSlug($title, $id),
            'seo_title' => $this->request->getPost('seo_title') ?: $title,
            'meta_description' => $this->request->getPost('meta_description') ?: substr(strip_tags($this->request->getPost('content')), 0, 160),
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category')
        ];

        if ($this->request->getFile('image')->isValid()) {
            if ($article && file_exists(FCPATH . 'uploads/articles/' . $article['image'])) {
                unlink(FCPATH . 'uploads/articles/' . $article['image']);
            }

            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/articles', $imageName);
            $data['image'] = $imageName;
        }

        if ($this->articleModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil diubah']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah artikel']);
    }

    public function hapusArtikel($id)
    {
        $this->response->setContentType('application/json');

        // Validasi akses
        $userRole = session()->get('role') ?? 'admin';
        $padukuhanId = session()->get('padukuhan_id');
        
        if (!$this->articleModel->canAdminManage($id, $padukuhanId, $userRole)) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Anda hanya bisa menghapus artikel dari pengguna di padukuhan Anda'
            ]);
        }

        $article = $this->articleModel->find($id);
        if ($article && file_exists(FCPATH . 'uploads/articles/' . $article['image'])) {
            unlink(FCPATH . 'uploads/articles/' . $article['image']);
        }

        if ($this->articleModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus artikel']);
    }

    public function setujuiArtikel($id)
    {
        $this->response->setContentType('application/json');
        $user = $this->getAuthUser();
        $userRole = session()->get('role') ?? 'admin';
        $padukuhanId = session()->get('padukuhan_id');

        // Validasi akses approve
        if (!$this->articleModel->canAdminManage($id, $padukuhanId, $userRole)) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Anda hanya bisa approve artikel dari pengguna di padukuhan Anda'
            ]);
        }

        if ($this->articleModel->approveArticle($id, $user->id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil disetujui']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyetujui artikel']);
    }

    public function tolakArtikel($id)
    {
        $this->response->setContentType('application/json');
        $userRole = session()->get('role') ?? 'admin';
        $padukuhanId = session()->get('padukuhan_id');

        // Validasi akses reject
        if (!$this->articleModel->canAdminManage($id, $padukuhanId, $userRole)) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Anda hanya bisa reject artikel dari pengguna di padukuhan Anda'
            ]);
        }

        if ($this->articleModel->rejectArticle($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil ditolak']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menolak artikel']);
    }

    public function updateStatusArtikel($id)
    {
        $this->response->setContentType('application/json');
        $userRole = session()->get('role') ?? 'admin';
        $padukuhanId = session()->get('padukuhan_id');
        $status = $this->request->getPost('status');

        // Validasi akses update status
        if (!$this->articleModel->canAdminManage($id, $padukuhanId, $userRole)) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Anda hanya bisa mengubah status artikel dari pengguna di padukuhan Anda'
            ]);
        }

        if (!in_array($status, ['pending', 'approved', 'rejected'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Status tidak valid']);
        }

        $data = ['status' => $status];
        
        if ($status === 'approved') {
            $user = $this->getAuthUser();
            $data['approved_by'] = $user->id;
            $data['approved_at'] = date('Y-m-d H:i:s');
        } else {
            $data['approved_by'] = null;
            $data['approved_at'] = null;
        }

        if ($this->articleModel->update($id, $data)) {
            $statusText = [
                'pending' => 'Pending',
                'approved' => 'Approved & Published',
                'rejected' => 'Rejected'
            ];
            return $this->response->setJSON(['success' => true, 'message' => 'Status artikel berhasil diubah menjadi ' . $statusText[$status]]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah status artikel']);
    }

    // CRUD FAQ
    public function tambahFaq()
    {
        $this->response->setContentType('application/json');

        if (!$this->validate([
            'pertanyaan' => 'required|min_length[10]',
            'jawaban' => 'required|min_length[10]',
            'category' => 'required'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'jawaban' => $this->request->getPost('jawaban'),
            'category' => $this->request->getPost('category')
        ];

        if ($this->faqModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'FAQ berhasil ditambahkan']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan FAQ']);
    }

    public function ubahFaq($id)
    {
        $this->response->setContentType('application/json');

        if (!$this->validate([
            'pertanyaan' => 'required|min_length[10]',
            'jawaban' => 'required|min_length[10]',
            'category' => 'required'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'jawaban' => $this->request->getPost('jawaban'),
            'category' => $this->request->getPost('category')
        ];

        if ($this->faqModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'FAQ berhasil diubah']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah FAQ']);
    }

    public function hapusFaq($id)
    {
        $this->response->setContentType('application/json');

        if ($this->faqModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'FAQ berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus FAQ']);
    }

    // CRUD UNDUHAN
    public function tambahUnduhan()
    {
        $this->response->setContentType('application/json');

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'category' => 'required',
            'link_drive' => 'required|valid_url',
            'thumbnail' => 'uploaded[thumbnail]|max_size[thumbnail,2048]|is_image[thumbnail]'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $thumbnail = $this->request->getFile('thumbnail');
        $thumbnailName = $thumbnail->getRandomName();
        $thumbnail->move(FCPATH . 'uploads/downloads', $thumbnailName);

        $data = [
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category'),
            'link_drive' => $this->request->getPost('link_drive'),
            'thumbnail' => $thumbnailName
        ];

        if ($this->downloadModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Unduhan berhasil ditambahkan']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan unduhan']);
    }

    public function ubahUnduhan($id)
    {
        $this->response->setContentType('application/json');

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'category' => 'required',
            'link_drive' => 'required|valid_url'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category'),
            'link_drive' => $this->request->getPost('link_drive')
        ];

        if ($this->request->getFile('thumbnail')->isValid()) {
            $download = $this->downloadModel->find($id);
            if ($download && file_exists(FCPATH . 'uploads/downloads/' . $download['thumbnail'])) {
                unlink(FCPATH . 'uploads/downloads/' . $download['thumbnail']);
            }

            $thumbnail = $this->request->getFile('thumbnail');
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move(FCPATH . 'uploads/downloads', $thumbnailName);
            $data['thumbnail'] = $thumbnailName;
        }

        if ($this->downloadModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Unduhan berhasil diubah']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah unduhan']);
    }

    public function hapusUnduhan($id)
    {
        $this->response->setContentType('application/json');

        $download = $this->downloadModel->find($id);
        if ($download && file_exists(FCPATH . 'uploads/downloads/' . $download['thumbnail'])) {
            unlink(FCPATH . 'uploads/downloads/' . $download['thumbnail']);
        }

        if ($this->downloadModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Unduhan berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus unduhan']);
    }
}
