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
        
        // Get monitoring data
        $monitoringIbuHamil = new \App\Models\Monitoring\MonitoringIbuHamilModel();
        $monitoringBalita = new \App\Models\MonitoringBalita\MonitoringBalitaModel();
        $monitoringRemaja = new \App\Models\MonitoringRemaja\MonitoringRemajaModel();
        
        $dataIbuHamil = $monitoringIbuHamil->where('user_id', $user->id)->where('status', 'active')->first();
        $dataBalita = $monitoringBalita->where('user_id', $user->id)->first();
        $dataRemaja = $monitoringRemaja->where('user_id', $user->id)->where('status', 'active')->first();
        
        $alerts = [];
        $lastVisit = null;
        
        // Check Ibu Hamil alerts
        if ($dataIbuHamil) {
            $kunjunganModel = new \App\Models\Monitoring\KunjunganModel();
            $antropometriModel = new \App\Models\Monitoring\KunjunganAntropometriModel();
            $identitasModel = new \App\Models\Monitoring\MonitoringIdentitasModel();
            $keluhanModel = new \App\Models\Monitoring\KunjunganKeluhanModel();
            
            $lastKunjungan = $kunjunganModel->where('monitoring_id', $dataIbuHamil['id'])->orderBy('tanggal_kunjungan', 'DESC')->first();
            $identitas = $identitasModel->where('monitoring_id', $dataIbuHamil['id'])->first();
            
            if ($lastKunjungan) {
                $lastVisit = $lastKunjungan['tanggal_kunjungan'];
                $antropometri = $antropometriModel->where('kunjungan_id', $lastKunjungan['id'])->first();
                $keluhan = $keluhanModel->where('kunjungan_id', $lastKunjungan['id'])->first();
                
                if ($antropometri) {
                    $td = explode('/', $antropometri['tekanan_darah']);
                    if (count($td) == 2 && ($td[0] >= 140 || $td[1] >= 90)) {
                        $alerts[] = ['type' => 'danger', 'icon' => 'heartbeat', 'message' => 'Tekanan darah tinggi: '.$antropometri['tekanan_darah'].' mmHg. Segera konsultasi!'];
                    }
                    if ($antropometri['lila'] < 23.5) {
                        $alerts[] = ['type' => 'warning', 'icon' => 'ruler', 'message' => 'LILA rendah: '.$antropometri['lila'].' cm. Risiko KEK!'];
                    }
                }
                
                if ($keluhan && !empty($keluhan['keluhan'])) {
                    $keluhanArray = json_decode($keluhan['keluhan'], true);
                    if (is_array($keluhanArray) && (in_array('Pucat', $keluhanArray) || in_array('Pusing', $keluhanArray) || in_array('Lemas', $keluhanArray))) {
                        $alerts[] = ['type' => 'warning', 'icon' => 'exclamation-circle', 'message' => 'Gejala anemia terdeteksi. Konsultasi dengan tenaga kesehatan!'];
                    }
                }
                
                if ($identitas && !empty($identitas['rencana_tanggal_persalinan'])) {
                    $hpl = strtotime($identitas['rencana_tanggal_persalinan']);
                    $today = strtotime(date('Y-m-d'));
                    $diff = ($hpl - $today) / 86400;
                    if ($diff > 0 && $diff <= 14) {
                        $alerts[] = ['type' => 'info', 'icon' => 'calendar-check', 'message' => 'HPL tinggal '.round($diff).' hari lagi!'];
                    }
                }
            }
        }
        
        // Check Balita alerts
        if ($dataBalita) {
            $kunjunganBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
            $lastKunjunganBalita = $kunjunganBalitaModel->where('monitoring_balita_id', $dataBalita['id'])->orderBy('tanggal_kunjungan', 'DESC')->first();
            
            if ($lastKunjunganBalita) {
                if (!$lastVisit) $lastVisit = $lastKunjunganBalita['tanggal_kunjungan'];
                
                $antropometriBalita = new \App\Models\MonitoringBalita\KunjunganBalitaAntropometriModel();
                $imunisasiModel = new \App\Models\MonitoringBalita\KunjunganBalitaImunisasiModel();
                $giziModel = new \App\Models\MonitoringBalita\KunjunganBalitaGiziModel();
                $keluhanBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaKeluhanModel();
                
                $antropometri = $antropometriBalita->where('kunjungan_balita_id', $lastKunjunganBalita['id'])->first();
                $imunisasi = $imunisasiModel->where('kunjungan_balita_id', $lastKunjunganBalita['id'])->first();
                $gizi = $giziModel->where('kunjungan_balita_id', $lastKunjunganBalita['id'])->first();
                $keluhanBalita = $keluhanBalitaModel->where('kunjungan_balita_id', $lastKunjunganBalita['id'])->first();
                
                if ($imunisasi && $imunisasi['status_imunisasi'] == 'belum_lengkap') {
                    $alerts[] = ['type' => 'warning', 'icon' => 'syringe', 'message' => 'Imunisasi belum lengkap. Segera lengkapi!'];
                }
                if ($antropometri && $antropometri['berat_badan'] < 10) {
                    $alerts[] = ['type' => 'danger', 'icon' => 'weight', 'message' => 'Berat badan kurang: '.$antropometri['berat_badan'].' kg!'];
                }
                if ($gizi && $gizi['vitamin_a'] == 'tidak') {
                    $alerts[] = ['type' => 'warning', 'icon' => 'capsules', 'message' => 'Belum dapat Vitamin A!'];
                }
                if ($keluhanBalita && ($keluhanBalita['demam'] || $keluhanBalita['diare'])) {
                    $keluhan = [];
                    if ($keluhanBalita['demam']) $keluhan[] = 'demam';
                    if ($keluhanBalita['diare']) $keluhan[] = 'diare';
                    $alerts[] = ['type' => 'danger', 'icon' => 'thermometer-half', 'message' => 'Keluhan serius: '.implode(', ', $keluhan).'!'];
                }
            }
        }
        
        // Check Remaja alerts
        if ($dataRemaja) {
            $kunjunganRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
            $lastKunjunganRemaja = $kunjunganRemajaModel->where('monitoring_id', $dataRemaja['id'])->orderBy('tanggal_kunjungan', 'DESC')->first();
            
            if ($lastKunjunganRemaja) {
                if (!$lastVisit) $lastVisit = $lastKunjunganRemaja['tanggal_kunjungan'];
                
                $antropometriRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaAntropometriModel();
                $anemiaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaAnemiaModel();
                $gayaHidupModel = new \App\Models\MonitoringRemaja\KunjunganRemajaGayaHidupModel();
                $suplementasiRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaSuplementasiModel();
                
                $antropometri = $antropometriRemajaModel->where('kunjungan_id', $lastKunjunganRemaja['id'])->first();
                $anemia = $anemiaModel->where('kunjungan_id', $lastKunjunganRemaja['id'])->first();
                $gayaHidup = $gayaHidupModel->where('kunjungan_id', $lastKunjunganRemaja['id'])->first();
                $suplementasi = $suplementasiRemajaModel->where('kunjungan_id', $lastKunjunganRemaja['id'])->first();
                
                if ($antropometri) {
                    $td = explode('/', $antropometri['tekanan_darah']);
                    if (count($td) == 2 && ($td[0] >= 140 || $td[1] >= 90)) {
                        $alerts[] = ['type' => 'danger', 'icon' => 'heartbeat', 'message' => 'Tekanan darah tinggi: '.$antropometri['tekanan_darah'].' mmHg!'];
                    }
                }
                if ($suplementasi && isset($suplementasi['dapat_ttd']) && $suplementasi['dapat_ttd'] == 'ya' && isset($suplementasi['minum_ttd']) && $suplementasi['minum_ttd'] == 'tidak') {
                    $alerts[] = ['type' => 'warning', 'icon' => 'pills', 'message' => 'TTD tidak diminum. Penting untuk mencegah anemia!'];
                }
                if ($anemia && isset($anemia['ada_gejala_anemia']) && $anemia['ada_gejala_anemia'] == 'ya') {
                    $alerts[] = ['type' => 'warning', 'icon' => 'exclamation-triangle', 'message' => 'Gejala anemia terdeteksi!'];
                }
                if ($gayaHidup && isset($gayaHidup['frekuensi_sarapan']) && $gayaHidup['frekuensi_sarapan'] == 'tidak_pernah') {
                    $alerts[] = ['type' => 'info', 'icon' => 'utensils', 'message' => 'Tidak pernah sarapan. Penting untuk energi harian!'];
                }
            }
        }
        
        $data = [
            'user' => $user,
            'hasIbuHamil' => !empty($dataIbuHamil),
            'hasBalita' => !empty($dataBalita),
            'hasRemaja' => !empty($dataRemaja),
            'alerts' => $alerts,
            'lastVisit' => $lastVisit
        ];

        return view('users/dashboard', $data);
    }

    public function artikelSaya()
    {
        helper('auth');
        
        $user = current_user();
        $articleModel = new ArticleModel();
        $categoryModel = new \App\Models\CategoryModel();

        // Ambil semua artikel user dengan pagination
        $artikelSaya = $articleModel->where('author_id', $user->id)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);
        
        // Ambil kategori artikel
        $artikelCategories = $categoryModel->getByType('artikel');

        $data = [
            'user' => $user,
            'artikelSaya' => $artikelSaya,
            'artikelCategories' => $artikelCategories,
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
        
        $monitoringBalitaModel = new \App\Models\MonitoringBalita\MonitoringBalitaModel();
        $identitasModel = new \App\Models\MonitoringBalita\MonitoringBalitaIdentitasModel();
        $kunjunganModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
        $antropometriModel = new \App\Models\MonitoringBalita\KunjunganBalitaAntropometriModel();
        $keluhanModel = new \App\Models\MonitoringBalita\KunjunganBalitaKeluhanModel();
        $imunisasiModel = new \App\Models\MonitoringBalita\KunjunganBalitaImunisasiModel();
        $swamedikasModel = new \App\Models\MonitoringBalita\KunjunganBalitaSwamedikasModel();
        $giziModel = new \App\Models\MonitoringBalita\KunjunganBalitaGiziModel();
        $kpspModel = new \App\Models\MonitoringBalita\KunjunganBalitaKpspModel();
        
        $monitoring = $monitoringBalitaModel->where('user_id', $user->id)->first();
        
        if (!$monitoring) {
            $data = [
                'user' => $user,
                'title' => 'Monitoring Kesehatan Balita & Anak',
                'hasMonitoring' => false
            ];
            return view('users/monitoring-balita', $data);
        }
        
        $identitas = $identitasModel->where('monitoring_balita_id', $monitoring['id'])->first();
        $kunjunganList = $kunjunganModel->where('monitoring_balita_id', $monitoring['id'])
                                        ->orderBy('kunjungan_ke', 'DESC')
                                        ->findAll();
        
        $allKunjungan = [];
        foreach ($kunjunganList as $kunjungan) {
            $detail = [
                'kunjungan' => $kunjungan,
                'antropometri' => $antropometriModel->where('kunjungan_balita_id', $kunjungan['id'])->first(),
                'keluhan' => $keluhanModel->where('kunjungan_balita_id', $kunjungan['id'])->first(),
                'imunisasi' => $imunisasiModel->where('kunjungan_balita_id', $kunjungan['id'])->first(),
                'swamedikasi' => $swamedikasModel->where('kunjungan_balita_id', $kunjungan['id'])->first(),
                'gizi' => $giziModel->where('kunjungan_balita_id', $kunjungan['id'])->first(),
                'kpsp' => $kpspModel->where('kunjungan_balita_id', $kunjungan['id'])->first()
            ];
            $allKunjungan[] = $detail;
        }
        
        $data = [
            'user' => $user,
            'title' => 'Monitoring Kesehatan Balita & Anak',
            'hasMonitoring' => true,
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'allKunjungan' => $allKunjungan,
            'totalKunjungan' => count($kunjunganList)
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

    public function hubungiKami()
    {
        helper('auth');
        $currentUser = current_user();
        
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($currentUser->id);
        
        $adminContacts = [];
        $padukuhanName = null;
        if ($user['padukuhan_id']) {
            $adminContacts = $userModel->where('padukuhan_id', $user['padukuhan_id'])
                                       ->where('role', 'admin')
                                       ->findAll();
            
            $padukuhanModel = new \App\Models\PadukuhanModel();
            $padukuhan = $padukuhanModel->find($user['padukuhan_id']);
            $padukuhanName = $padukuhan['nama_padukuhan'] ?? null;
        }
        
        $data = [
            'user' => $currentUser,
            'title' => 'Hubungi Kami',
            'adminContacts' => $adminContacts,
            'padukuhanName' => $padukuhanName
        ];

        return view('users/hubungi-kami', $data);
    }
}