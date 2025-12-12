<?php

namespace App\Controllers\Posts;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\DownloadModel;
use CodeIgniter\HTTP\ResponseInterface;

class PostsController extends BaseController
{
    public function index()
    {
        $articles = new ArticleModel();
        $title = 'Semua Artikel';

        $cArtikel = $articles->where('status', 'approved')->orderBy('id', 'DESC')->paginate(12);
        
        $numCategories = [
            ['name' => 'Farmasi', 'id' => 1, 'count_posts' => $articles->where(['category' => 'Farmasi', 'status' => 'approved'])->countAllResults(false)],
            ['name' => 'Gizi', 'id' => 2, 'count_posts' => $articles->where(['category' => 'Gizi', 'status' => 'approved'])->countAllResults(false)],
            ['name' => 'Bidan', 'id' => 3, 'count_posts' => $articles->where(['category' => 'Bidan', 'status' => 'approved'])->countAllResults(false)]
        ];

        $popPosts = $articles->where('status', 'approved')->orderBy('id', 'DESC')->limit(3)->findAll();
        $popPosts = array_map(fn($item) => (object)$item, $popPosts);

        $pager = $articles->pager;
        $name = 'semua';

        return view('post/category', compact('cArtikel', 'name', 'numCategories', 'popPosts', 'title', 'pager'));
    }
    public function category($name)
    {
        $articles = new ArticleModel();
        $title = 'Kategori';
        $categoryName = ucfirst($name);

        $cArtikel = $articles->where(['category' => $categoryName, 'status' => 'approved'])->orderBy('id', 'DESC')->paginate(9);

        $numCategories = [
            ['name' => 'Farmasi', 'id' => 1, 'count_posts' => $articles->where(['category' => 'Farmasi', 'status' => 'approved'])->countAllResults(false)],
            ['name' => 'Gizi', 'id' => 2, 'count_posts' => $articles->where(['category' => 'Gizi', 'status' => 'approved'])->countAllResults(false)],
            ['name' => 'Bidan', 'id' => 3, 'count_posts' => $articles->where(['category' => 'Bidan', 'status' => 'approved'])->countAllResults(false)]
        ];

        $popPosts = $articles->where(['category' => $categoryName, 'status' => 'approved'])->orderBy('id', 'DESC')->limit(1)->findAll();
        $popPosts = array_map(fn($item) => (object)$item, $popPosts);

        $pager = $articles->pager;

        return view('post/category', compact('cArtikel', 'name', 'numCategories', 'popPosts', 'title', 'pager'));
    }

    // page artikel
    public function singlePost($slugOrId)
    {
        $articleModel = new ArticleModel();
        $title = 'Artikel';

        // Cek apakah slug atau ID
        if (is_numeric($slugOrId)) {
            $artikel = $articleModel->find($slugOrId);
        } else {
            $artikel = $articleModel->getBySlug($slugOrId);
        }
        
        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Track views dengan session (unique per session)
        $session = session();
        $viewedArticles = $session->get('viewed_articles') ?? [];
        
        if (!in_array($artikel['id'], $viewedArticles)) {
            // Increment views
            $articleModel->set('views', 'views + 1', false)
                        ->where('id', $artikel['id'])
                        ->update();
            
            // Simpan ke session
            $viewedArticles[] = $artikel['id'];
            $session->set('viewed_articles', $viewedArticles);
            
            // Refresh data artikel untuk mendapatkan views terbaru
            $artikel = $articleModel->find($artikel['id']);
        }

        $numCategories = [
            ['name' => 'Farmasi', 'id' => 1, 'count_posts' => $articleModel->where(['category' => 'Farmasi', 'status' => 'approved'])->countAllResults(false)],
            ['name' => 'Gizi', 'id' => 2, 'count_posts' => $articleModel->where(['category' => 'Gizi', 'status' => 'approved'])->countAllResults(false)],
            ['name' => 'Bidan', 'id' => 3, 'count_posts' => $articleModel->where(['category' => 'Bidan', 'status' => 'approved'])->countAllResults(false)]
        ];

        $popPosts = $articleModel->where('status', 'approved')->orderBy('id', 'DESC')->limit(3)->findAll();
        $moreBlogPosts = $articleModel->where(['id !=' => $artikel['id'], 'status' => 'approved'])->orderBy('id', 'DESC')->limit(4)->findAll();
        
        // Artikel terkait (kategori sama, exclude artikel saat ini)
        $relatedArticles = $articleModel->where(['category' => $artikel['category'], 'id !=' => $artikel['id'], 'status' => 'approved'])->orderBy('id', 'DESC')->limit(5)->findAll();
        
        // Download terbaru
        $downloadModel = new DownloadModel();
        $latestDownload = $downloadModel->orderBy('id', 'DESC')->first();

        return view('post/single',  compact('title', 'artikel', 'numCategories', 'popPosts', 'moreBlogPosts', 'relatedArticles', 'latestDownload'));
    }

    // menulis komentar pada artikel
    public function storeComment($id)
    {
        // cek login
        // if (!service('auth')->isLoggedIn()) {
        //     return redirect()->to(base_url('login'))->with('error','Anda harus login terlebih dahulu untuk menambahkan komentar');
        // }

        $commments = new CommentModel();

        // validasi
        $data = [
            "user_name" => auth()->user()->username,
            "comment" => $this->request->getPost('comment'),
            "post_id" => $id,
        ];

        // simpan ke database
        $commments->save($data);

        // cek apakah berhasil
        if ($commments->affectedRows() > 0) {
            return redirect()->to(base_url('posts/single/' . $id))->with('create', 'Comment saved successfully');
        } else {
            // Penanganan jika terjadi kesalahan
            return redirect()->back()->withInput()->with('error', 'Failed to save comment');
        }
    }

    // create artikel
    public function createPost()
    {
        $category = new CategoryModel();

        // validasi login / belum
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

        // mengambil data semua kategory
        $categories = $category->getCategories();;
        return view('post/create-posts', compact('categories'));
    }

    // function validasi create artikel
    public function storetePost()
    {

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

        //input image
        $img = $this->request->getFile('image');
        $img->move('public/assets/images/' . 'blog');


        // input data
        $data = [
            "title" => $this->request->getPost('title'),
            "image" => $img->getClientName(),
            "body" => $this->request->getPost('body'),
            "user_id" => auth()->user()->id,
            "user_name" => auth()->user()->username,
            "category" => $this->request->getPost('category'),

        ];

        // simpan ke database
        $postModel->save($data);

        // cek apakah berhasil
        if ($postModel->affectedRows() > 0) {
            return redirect()->to(base_url('posts/create-posts'))->with('create', 'Articel saved successfully');
        } else {
            // Penanganan jika terjadi kesalahan
            return redirect()->back()->withInput()->with('error', 'Failed to save Articel');
        }
    }


    // delete artikel
    public function deletePost($id)
    {
        $postModel = new PostModel();

        // Validasi login
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

        // Dapatkan data artikel berdasarkan ID
        $post = $postModel->find($id);

        // Periksa apakah pengguna memiliki hak untuk menghapus artikel
        if ($post && auth()->user()->id == $post['user_id']) {
            // Hapus artikel
            if ($postModel->delete($id)) {
                return redirect()->to(base_url())->with('delete', 'Artikel berhasil dihapus');
            } else {
                return redirect()->to(base_url())->with('error', 'Gagal menghapus artikel');
            }
        } else {
            return redirect()->to(base_url())->with('error', 'Anda tidak memiliki izin untuk menghapus artikel');
        }
    }

    // edit artikel
    public function editPost($id)
    {
        $post = new PostModel();
        $category = new CategoryModel();

        //    memanggil data dengan id
        $edPost = $post->find($id);

        // validasi belum login
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

        // validasi page edit artikel sesuai user berdasarkan id
        if (auth()->user()->id == $edPost['user_id']) {
            // mengambil data semua kategory
            $categories = $category->getCategories();;

            return view('post/edit-post', compact('edPost', 'categories'));
        } else {
            return redirect()->to(base_url());
        }
    }

    // Method dengan nama Indonesia
    public function kategori($name)
    {
        return $this->category($name);
    }

    public function bacaArtikel($id)
    {
        return $this->singlePost($id);
    }

    public function simpanKomentar($id)
    {
        return $this->storeComment($id);
    }

    public function buatArtikel()
    {
        helper('auth');
        if (!is_logged_in()) {
            return redirect()->to('/login');
        }
        return view('post/create-posts');
    }

    public function simpanArtikel()
    {
        helper('auth');
        if (!is_logged_in()) {
            return redirect()->to('/login');
        }

        $articleModel = new ArticleModel();

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]',
            'content' => 'required|min_length[20]',
            'category' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Periksa kembali form Anda.');
        }

        $img = $this->request->getFile('image');
        $imgName = $img->getRandomName();
        $img->move(FCPATH . 'uploads/articles', $imgName);

        $user = auth()->user();
        $userRole = session()->get('role') ?? 'pengguna';
        $status = in_array($userRole, ['admin', 'superadmin']) ? 'approved' : 'pending';
        
        $title = $this->request->getPost('title');
        $slug = $articleModel->generateSlug($title);
        $seoTitle = $this->request->getPost('seo_title') ?: $title;
        $content = $this->request->getPost('content');
        $metaDesc = $this->request->getPost('meta_description') ?: substr(strip_tags($content), 0, 160);

        $data = [
            'title' => $title,
            'slug' => $slug,
            'seo_title' => $seoTitle,
            'meta_description' => $metaDesc,
            'image' => $imgName,
            'content' => $content,
            'author_id' => $user->id,
            'author_name' => $user->username,
            'category' => $this->request->getPost('category'),
            'status' => $status
        ];

        if ($articleModel->insert($data)) {
            $message = $status === 'approved' ? 'Artikel berhasil dipublikasi' : 'Artikel berhasil disimpan dan menunggu persetujuan admin';
            return redirect()->to('/pengguna/artikel-saya')->with('success', $message);
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan artikel');
    }

    public function storePost()
    {
        return $this->simpanArtikel();
    }

    public function editArtikel($id)
    {
        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);

        if (!auth()->user() || !$article) {
            return redirect()->to('/login');
        }

        if (auth()->user()->id != $article['author_id']) {
            return redirect()->to('/')->with('error', 'Anda tidak memiliki akses');
        }

        return view('post/edit-post', ['edPost' => $article]);
    }

    public function perbaruiArtikel($id)
    {
        return $this->updatePost($id);
    }

    public function updatePost($id)
    {
        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);

        if (!auth()->user() || auth()->user()->id != $article['author_id']) {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'content' => 'required|min_length[20]',
            'category' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        
        $data = [
            'title' => $title,
            'slug' => $articleModel->generateSlug($title, $id),
            'seo_title' => $this->request->getPost('seo_title') ?: $title,
            'meta_description' => $this->request->getPost('meta_description') ?: substr(strip_tags($content), 0, 160),
            'content' => $content,
            'category' => $this->request->getPost('category'),
        ];

        $img = $this->request->getFile('image');
        if ($img && $img->isValid()) {
            if (file_exists(FCPATH . 'uploads/articles/' . $article['image'])) {
                unlink(FCPATH . 'uploads/articles/' . $article['image']);
            }
            $imgName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/articles', $imgName);
            $data['image'] = $imgName;
        }

        if ($articleModel->update($id, $data)) {
            return redirect()->to('/pengguna/artikel-saya')->with('success', 'Artikel berhasil diperbarui');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui artikel');
    }

    public function hapusArtikel($id)
    {
        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);

        if (!auth()->user() || !$article) {
            return redirect()->to('/login');
        }

        if (auth()->user()->id != $article['author_id']) {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        if (file_exists(FCPATH . 'uploads/articles/' . $article['image'])) {
            unlink(FCPATH . 'uploads/articles/' . $article['image']);
        }

        if ($articleModel->delete($id)) {
            return redirect()->to('/pengguna/artikel-saya')->with('success', 'Artikel berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus artikel');
    }

    public function cariArtikel()
    {
        return $this->searchPosts();
    }

    public function searchPosts()
    {
        $post = new PostModel();

        // memanggil keywor
        $keyword = $this->request->getPost('keyword');

        $searches = $post->like('title', $keyword)->findAll();
        
        

        if ($searches) {
            return view('post/searches', compact('searches', 'keyword'));
        }
    }
}
