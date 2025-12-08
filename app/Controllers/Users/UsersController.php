<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\ArticleModel;

class UsersController extends BaseController
{
    public function dashboard()
    {
        helper('auth');
        
        $user = current_user();
        $articleModel = new ArticleModel();

        // Statistik artikel user
        $totalArtikel = $articleModel->where('author_id', $user->id)->countAllResults();
        $artikelPending = $articleModel->where('author_id', $user->id)->where('status', 'pending')->countAllResults();
        $artikelApproved = $articleModel->where('author_id', $user->id)->where('status', 'approved')->countAllResults();
        $artikelRejected = $articleModel->where('author_id', $user->id)->where('status', 'rejected')->countAllResults();

        // Artikel terbaru user
        $artikelTerbaru = $articleModel->where('author_id', $user->id)
                                   ->orderBy('created_at', 'DESC')
                                   ->limit(5)
                                   ->find();

        $data = [
            'user' => $user,
            'totalArtikel' => $totalArtikel,
            'artikelPending' => $artikelPending,
            'artikelApproved' => $artikelApproved,
            'artikelRejected' => $artikelRejected,
            'artikelTerbaru' => $artikelTerbaru
        ];

        return view('users/dashboard', $data);
    }

    public function artikelSaya()
    {
        helper('auth');
        
        $user = current_user();
        $articleModel = new ArticleModel();

        // Ambil semua artikel user dengan pagination
        $artikelSaya = $articleModel->where('author_id', $user->id)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);

        $data = [
            'user' => $user,
            'artikelSaya' => $artikelSaya,
            'pager' => $articleModel->pager
        ];

        return view('users/artikel-saya', $data);
    }

    public function monitoring($category = 'ibu_hamil')
    {
        helper('auth');
        
        $user = current_user();
        
        // Load models
        $monitoringModel = new \App\Models\Monitoring\MonitoringIbuHamilModel();
        $identitasModel = new \App\Models\Monitoring\MonitoringIdentitasModel();
        $riwayatPenyakitModel = new \App\Models\Monitoring\MonitoringRiwayatPenyakitModel();
        $skriningModel = new \App\Models\Monitoring\MonitoringSkriningModel();
        $kunjunganModel = new \App\Models\Monitoring\KunjunganModel();
        $kunjunganAntropometriModel = new \App\Models\Monitoring\KunjunganAntropometriModel();
        $kunjunganKeluhanModel = new \App\Models\Monitoring\KunjunganKeluhanModel();
        $kunjunganSuplementasiModel = new \App\Models\Monitoring\KunjunganSuplementasiModel();
        $kunjunganEtnomedisinModel = new \App\Models\Monitoring\KunjunganEtnomedisinModel();
        
        // Cek apakah user memiliki data monitoring
        $monitoring = $monitoringModel->where('user_id', $user->id)
                                      ->where('category', $category)
                                      ->where('status', 'active')
                                      ->first();
        
        if (!$monitoring) {
            // Jika belum ada data monitoring
            $data = [
                'user' => $user,
                'title' => 'Monitoring Kesehatan Ibu Hamil & Menyusui',
                'category' => $category,
                'hasMonitoring' => false
            ];
            return view('users/monitoring', $data);
        }
        
        // Ambil data master
        $identitas = $identitasModel->where('monitoring_id', $monitoring['id'])->first();
        $riwayatPenyakit = $riwayatPenyakitModel->where('monitoring_id', $monitoring['id'])->first();
        $skrining = $skriningModel->where('monitoring_id', $monitoring['id'])->first();
        
        // Ambil semua kunjungan
        $kunjunganList = $kunjunganModel->where('monitoring_id', $monitoring['id'])
                                        ->orderBy('kunjungan_ke', 'DESC')
                                        ->findAll();
        
        // Ambil detail untuk SEMUA kunjungan
        $allKunjungan = [];
        $kunjunganTerakhir = null;
        
        foreach ($kunjunganList as $index => $kunjungan) {
            $detail = [
                'kunjungan' => $kunjungan,
                'antropometri' => $kunjunganAntropometriModel->where('kunjungan_id', $kunjungan['id'])->first(),
                'keluhan' => $kunjunganKeluhanModel->where('kunjungan_id', $kunjungan['id'])->first(),
                'suplementasi' => $kunjunganSuplementasiModel->where('kunjungan_id', $kunjungan['id'])->first(),
                'etnomedisin' => $kunjunganEtnomedisinModel->where('kunjungan_id', $kunjungan['id'])->first()
            ];
            
            // Decode JSON fields
            if (!empty($detail['keluhan']['keluhan'])) {
                $detail['keluhan']['keluhan_array'] = json_decode($detail['keluhan']['keluhan'], true) ?? [];
            }
            if (!empty($detail['suplementasi']['efek_samping'])) {
                $detail['suplementasi']['efek_samping_array'] = json_decode($detail['suplementasi']['efek_samping'], true) ?? [];
            }
            if (!empty($detail['etnomedisin']['jenis_obat'])) {
                $detail['etnomedisin']['jenis_obat_array'] = json_decode($detail['etnomedisin']['jenis_obat'], true) ?? [];
            }
            if (!empty($detail['etnomedisin']['tujuan_penggunaan'])) {
                $detail['etnomedisin']['tujuan_penggunaan_array'] = json_decode($detail['etnomedisin']['tujuan_penggunaan'], true) ?? [];
            }
            
            $allKunjungan[] = $detail;
            
            // Kunjungan terakhir (index 0 karena sudah DESC)
            if ($index === 0) {
                $kunjunganTerakhir = $detail;
            }
        }
        
        // Decode JSON fields untuk riwayat penyakit
        if ($riwayatPenyakit && !empty($riwayatPenyakit['riwayat_penyakit'])) {
            $riwayatPenyakit['riwayat_penyakit_array'] = json_decode($riwayatPenyakit['riwayat_penyakit'], true) ?? [];
        }

        $data = [
            'user' => $user,
            'title' => 'Monitoring Kesehatan Ibu Hamil & Menyusui',
            'category' => $category,
            'hasMonitoring' => true,
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'riwayatPenyakit' => $riwayatPenyakit,
            'skrining' => $skrining,
            'kunjunganTerakhir' => $kunjunganTerakhir,
            'allKunjungan' => $allKunjungan,
            'totalKunjungan' => count($kunjunganList)
        ];

        return view('users/monitoring', $data);
    }

    public function monitoringRemaja()
    {
        helper('auth');
        $user = current_user();
        
        $monitoringRemajaModel = new \App\Models\MonitoringRemaja\MonitoringRemajaModel();
        $identitasModel = new \App\Models\MonitoringRemaja\MonitoringRemajaIdentitasModel();
        $kunjunganModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
        $antropometriModel = new \App\Models\MonitoringRemaja\KunjunganRemajaAntropometriModel();
        $anemiaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaAnemiaModel();
        $haidModel = new \App\Models\MonitoringRemaja\KunjunganRemajaHaidModel();
        $gayaHidupModel = new \App\Models\MonitoringRemaja\KunjunganRemajaGayaHidupModel();
        $suplementasiModel = new \App\Models\MonitoringRemaja\KunjunganRemajaSuplementasiModel();
        $swamedikasModel = new \App\Models\MonitoringRemaja\KunjunganRemajaSwamedikasModel();
        
        $monitoring = $monitoringRemajaModel->where('user_id', $user->id)
                                            ->where('category', 'remaja')
                                            ->where('status', 'active')
                                            ->first();
        
        if (!$monitoring) {
            $data = [
                'user' => $user,
                'title' => 'Monitoring Kesehatan Remaja',
                'hasMonitoring' => false
            ];
            return view('users/monitoring-remaja', $data);
        }
        
        $identitas = $identitasModel->where('monitoring_id', $monitoring['id'])->first();
        $kunjunganList = $kunjunganModel->where('monitoring_id', $monitoring['id'])
                                        ->orderBy('kunjungan_ke', 'DESC')
                                        ->findAll();
        
        $allKunjungan = [];
        foreach ($kunjunganList as $kunjungan) {
            $detail = [
                'kunjungan' => $kunjungan,
                'antropometri' => $antropometriModel->where('kunjungan_id', $kunjungan['id'])->first(),
                'anemia' => $anemiaModel->where('kunjungan_id', $kunjungan['id'])->first(),
                'haid' => $haidModel->where('kunjungan_id', $kunjungan['id'])->first(),
                'gaya_hidup' => $gayaHidupModel->where('kunjungan_id', $kunjungan['id'])->first(),
                'suplementasi' => $suplementasiModel->where('kunjungan_id', $kunjungan['id'])->first(),
                'swamedikasi' => $swamedikasModel->where('kunjungan_id', $kunjungan['id'])->first()
            ];
            $allKunjungan[] = $detail;
        }
        
        $data = [
            'user' => $user,
            'title' => 'Monitoring Kesehatan Remaja',
            'hasMonitoring' => true,
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'allKunjungan' => $allKunjungan,
            'totalKunjungan' => count($kunjunganList)
        ];

        return view('users/monitoring-remaja', $data);
    }

    public function monitoringBalita()
    {
        helper('auth');
        $user = current_user();
        
        // Untuk saat ini, selalu tampilkan belum ada data
        // Karena fitur balita belum diimplementasi
        $data = [
            'user' => $user,
            'title' => 'Monitoring Kesehatan Balita & Anak',
            'hasMonitoring' => false
        ];

        return view('users/monitoring-balita', $data);
    }

    // CRUD ARTIKEL PENGGUNA
    public function tambahArtikel()
    {
        $this->response->setContentType('application/json');
        helper('auth');
        $user = current_user();

        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'User tidak terautentikasi']);
        }

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'content' => 'required|min_length[20]',
            'category' => 'required',
            'image' => 'uploaded[image]|max_size[image,2048]|ext_in[image,jpg,jpeg,png,webp]'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $articleModel = new ArticleModel();
        $image = $this->request->getFile('image');
        
        if (!$image->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'File gambar tidak valid: ' . $image->getErrorString()]);
        }
        
        $imageName = $image->getRandomName();
        
        if (!$image->move(FCPATH . 'uploads/articles', $imageName)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengupload gambar']);
        }

        $title = $this->request->getPost('title');
        $slug = $articleModel->generateSlug($title);
        $content = $this->request->getPost('content');
        $seoTitle = $this->request->getPost('seo_title') ?: $title;
        $metaDesc = $this->request->getPost('meta_description') ?: substr(strip_tags($content), 0, 160);

        $data = [
            'title' => $title,
            'slug' => $slug,
            'seo_title' => $seoTitle,
            'meta_description' => $metaDesc,
            'content' => $content,
            'category' => $this->request->getPost('category'),
            'image' => $imageName,
            'author_id' => $user->id,
            'author_name' => $user->username,
            'status' => 'pending'
        ];

        if ($articleModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil dibuat dan menunggu persetujuan admin']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan artikel']);
    }

    public function ubahArtikel($id)
    {
        $this->response->setContentType('application/json');
        helper('auth');
        $user = current_user();
        
        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);

        if (!$article || $article['author_id'] != $user->id) {
            return $this->response->setJSON(['success' => false, 'message' => 'Artikel tidak ditemukan atau Anda tidak memiliki akses']);
        }

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'content' => 'required|min_length[20]',
            'category' => 'required'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
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
            'status' => 'pending'
        ];

        if ($this->request->getFile('image')->isValid()) {
            if (file_exists(FCPATH . 'uploads/articles/' . $article['image'])) {
                unlink(FCPATH . 'uploads/articles/' . $article['image']);
            }

            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/articles', $imageName);
            $data['image'] = $imageName;
        }

        if ($articleModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil diubah dan menunggu persetujuan admin']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah artikel']);
    }

    public function hapusArtikel($id)
    {
        $this->response->setContentType('application/json');
        helper('auth');
        $user = current_user();
        
        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);

        if (!$article || $article['author_id'] != $user->id) {
            return $this->response->setJSON(['success' => false, 'message' => 'Artikel tidak ditemukan atau Anda tidak memiliki akses']);
        }

        if (file_exists(FCPATH . 'uploads/articles/' . $article['image'])) {
            unlink(FCPATH . 'uploads/articles/' . $article['image']);
        }

        if ($articleModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus artikel']);
    }
}