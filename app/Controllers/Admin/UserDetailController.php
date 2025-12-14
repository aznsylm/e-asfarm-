<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PadukuhanModel;
use App\Models\Monitoring\MonitoringIbuHamilModel;
use App\Models\Monitoring\MonitoringIdentitasModel;
use App\Models\Monitoring\MonitoringRiwayatPenyakitModel;
use App\Models\Monitoring\MonitoringSkriningModel;
use App\Models\Monitoring\KunjunganModel;
use App\Models\MonitoringBalita\MonitoringBalitaModel;
use App\Models\MonitoringBalita\MonitoringBalitaIdentitasModel;
use App\Models\MonitoringBalita\KunjunganBalitaModel;
use App\Models\MonitoringBalita\KunjunganBalitaKeluhanModel;
use App\Models\MonitoringBalita\KunjunganBalitaGiziModel;
use App\Models\MonitoringBalita\KunjunganBalitaKpspModel;
use App\Models\MonitoringBalita\KunjunganBalitaAntropometriModel;
use App\Models\MonitoringBalita\KunjunganBalitaImunisasiModel;
use App\Models\MonitoringBalita\KunjunganBalitaSwamedikasModel;
use App\Models\MonitoringRemaja\MonitoringRemajaModel;
use App\Models\MonitoringRemaja\MonitoringRemajaIdentitasModel;
use App\Models\MonitoringRemaja\KunjunganRemajaModel;
use App\Models\MonitoringRemaja\KunjunganRemajaAnemiaModel;
use App\Models\MonitoringRemaja\KunjunganRemajaHaidModel;
use App\Models\MonitoringRemaja\KunjunganRemajaSuplementasiModel;
use App\Models\MonitoringRemaja\KunjunganRemajaAntropometriModel;
use App\Models\MonitoringRemaja\KunjunganRemajaGayaHidupModel;
use App\Models\MonitoringRemaja\KunjunganRemajaSwamedikasModel;

class UserDetailController extends BaseController
{
    public function index($userId)
    {
        $userModel = new UserModel();
        $padukuhanModel = new PadukuhanModel();
        
        // Get user data
        $user = $userModel->find($userId);
        if (!$user) {
            return redirect()->to('/admin/dashboard')->with('error', 'User tidak ditemukan');
        }
        
        // Get padukuhan
        $padukuhan = null;
        if ($user['padukuhan_id']) {
            $padukuhan = $padukuhanModel->find($user['padukuhan_id']);
        }
        
        // === IBU HAMIL ===
        $monitoringIbuHamil = (new MonitoringIbuHamilModel())->getByUserId($userId);
        $identitasIbuHamil = null;
        $riwayatIbuHamil = null;
        $skriningIbuHamil = null;
        $kunjunganIbuHamil = [];
        
        if ($monitoringIbuHamil) {
            $identitasIbuHamil = (new MonitoringIdentitasModel())->where('monitoring_id', $monitoringIbuHamil['id'])->first();
            $riwayatIbuHamil = (new MonitoringRiwayatPenyakitModel())->where('monitoring_id', $monitoringIbuHamil['id'])->first();
            $skriningIbuHamil = (new MonitoringSkriningModel())->where('monitoring_id', $monitoringIbuHamil['id'])->first();
            $kunjunganIbuHamil = (new KunjunganModel())->getWithDetails($monitoringIbuHamil['id']);
        }
        
        // === BALITA & ANAK ===
        $monitoringBalita = (new MonitoringBalitaModel())->where('user_id', $userId)->first();
        $identitasBalita = null;
        $kunjunganBalita = [];
        
        if ($monitoringBalita) {
            $identitasBalita = (new MonitoringBalitaIdentitasModel())->where('monitoring_balita_id', $monitoringBalita['id'])->first();
            $kunjunganList = (new KunjunganBalitaModel())->where('monitoring_balita_id', $monitoringBalita['id'])->orderBy('kunjungan_ke', 'ASC')->findAll();
            
            $keluhanModel = new KunjunganBalitaKeluhanModel();
            $giziModel = new KunjunganBalitaGiziModel();
            $kpspModel = new KunjunganBalitaKpspModel();
            $antropometriModel = new KunjunganBalitaAntropometriModel();
            $imunisasiModel = new KunjunganBalitaImunisasiModel();
            $swamedikasModel = new KunjunganBalitaSwamedikasModel();
            
            foreach ($kunjunganList as &$kunjungan) {
                $kunjungan['keluhan'] = $keluhanModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['gizi'] = $giziModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['kpsp'] = $kpspModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['antropometri'] = $antropometriModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['imunisasi'] = $imunisasiModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['swamedikasi'] = $swamedikasModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
            }
            $kunjunganBalita = $kunjunganList;
        }
        
        // === REMAJA ===
        $monitoringRemaja = (new MonitoringRemajaModel())->where('user_id', $userId)->first();
        $identitasRemaja = null;
        $kunjunganRemaja = [];
        
        if ($monitoringRemaja) {
            $identitasRemaja = (new MonitoringRemajaIdentitasModel())->where('monitoring_id', $monitoringRemaja['id'])->first();
            $kunjunganList = (new KunjunganRemajaModel())->where('monitoring_id', $monitoringRemaja['id'])->orderBy('kunjungan_ke', 'ASC')->findAll();
            
            $anemiaModel = new KunjunganRemajaAnemiaModel();
            $haidModel = new KunjunganRemajaHaidModel();
            $suplementasiModel = new KunjunganRemajaSuplementasiModel();
            $antropometriModel = new KunjunganRemajaAntropometriModel();
            $gayaHidupModel = new KunjunganRemajaGayaHidupModel();
            $swamedikasModel = new KunjunganRemajaSwamedikasModel();
            
            foreach ($kunjunganList as &$kunjungan) {
                $kunjungan['anemia'] = $anemiaModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['haid'] = $haidModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['suplementasi'] = $suplementasiModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['antropometri'] = $antropometriModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['gaya_hidup'] = $gayaHidupModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['swamedikasi'] = $swamedikasModel->where('kunjungan_id', $kunjungan['id'])->first();
            }
            $kunjunganRemaja = $kunjunganList;
        }
        
        $data = [
            'title' => 'Detail Pengguna',
            'user' => $user,
            'padukuhan' => $padukuhan,
            // Ibu Hamil
            'monitoring' => $monitoringIbuHamil,
            'identitas' => $identitasIbuHamil,
            'riwayat' => $riwayatIbuHamil,
            'skrining' => $skriningIbuHamil,
            'kunjunganList' => $kunjunganIbuHamil,
            // Balita
            'monitoringBalita' => $monitoringBalita,
            'identitasBalita' => $identitasBalita,
            'kunjunganBalita' => $kunjunganBalita,
            // Remaja
            'monitoringRemaja' => $monitoringRemaja,
            'identitasRemaja' => $identitasRemaja,
            'kunjunganRemaja' => $kunjunganRemaja,
        ];
        
        return view('admin/user-detail', $data);
    }

    public function exportPdf($userId)
    {
        $userModel = new UserModel();
        $padukuhanModel = new PadukuhanModel();
        
        $user = $userModel->find($userId);
        if (!$user) {
            return redirect()->to('/admin/dashboard')->with('error', 'User tidak ditemukan');
        }
        
        $padukuhan = $user['padukuhan_id'] ? $padukuhanModel->find($user['padukuhan_id']) : null;
        
        $dataIbuHamil = $this->getLastVisitIbuHamil($userId);
        $dataBalita = $this->getLastVisitBalita($userId);
        $dataRemaja = $this->getLastVisitRemaja($userId);
        
        $data = [
            'user' => $user,
            'padukuhan' => $padukuhan,
            'dataIbuHamil' => $dataIbuHamil,
            'dataBalita' => $dataBalita,
            'dataRemaja' => $dataRemaja
        ];
        
        $html = view('admin/user_export_pdf', $data);
        
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('monitoring_' . $user['username'] . '.pdf', ['Attachment' => false]);
    }

    public function exportExcel($userId)
    {
        $userModel = new UserModel();
        $padukuhanModel = new PadukuhanModel();
        
        $user = $userModel->find($userId);
        if (!$user) {
            return redirect()->to('/admin/dashboard')->with('error', 'User tidak ditemukan');
        }
        
        $padukuhan = $user['padukuhan_id'] ? $padukuhanModel->find($user['padukuhan_id']) : null;
        
        $dataIbuHamil = $this->getLastVisitIbuHamil($userId);
        $dataBalita = $this->getLastVisitBalita($userId);
        $dataRemaja = $this->getLastVisitRemaja($userId);
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        
        // Sheet 1: User Info
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Info Pengguna');
        $sheet->setCellValue('A1', 'DATA MONITORING KESEHATAN');
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('A3', 'Username');
        $sheet->setCellValue('B3', $user['username']);
        $sheet->setCellValue('A4', 'Email');
        $sheet->setCellValue('B4', $user['email']);
        $sheet->setCellValue('A5', 'No. WhatsApp');
        $sheet->setCellValue('B5', $user['phone_number'] ?? '-');
        $sheet->setCellValue('A6', 'Padukuhan');
        $sheet->setCellValue('B6', $padukuhan['nama_padukuhan'] ?? '-');
        $sheet->getStyle('A3:A6')->getFont()->setBold(true);
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(30);
        
        // Sheet 2: Ibu Hamil
        if ($dataIbuHamil) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle('Ibu Hamil');
            $row = 1;
            $sheet->setCellValue('A' . $row, 'DATA IBU HAMIL');
            $sheet->mergeCells('A1:B1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
            $row += 2;
            $sheet->setCellValue('A' . $row, 'Nama Ibu');
            $sheet->setCellValue('B' . $row++, $dataIbuHamil['identitas']['nama_ibu']);
            $sheet->setCellValue('A' . $row, 'Nama Suami');
            $sheet->setCellValue('B' . $row++, $dataIbuHamil['identitas']['nama_suami'] ?? '-');
            $sheet->setCellValue('A' . $row, 'Usia Kehamilan');
            $sheet->setCellValue('B' . $row++, $dataIbuHamil['identitas']['usia_kehamilan'] . ' minggu');
            $sheet->setCellValue('A' . $row, 'Rencana Persalinan');
            $sheet->setCellValue('B' . $row++, date('d-m-Y', strtotime($dataIbuHamil['identitas']['rencana_tanggal_persalinan'])));
            $row++;
            $sheet->setCellValue('A' . $row, 'KUNJUNGAN TERAKHIR');
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);
            $row++;
            $sheet->setCellValue('A' . $row, 'Tanggal Kunjungan');
            $sheet->setCellValue('B' . $row++, date('d-m-Y', strtotime($dataIbuHamil['kunjungan']['tanggal_kunjungan'])));
            $sheet->setCellValue('A' . $row, 'Kunjungan ke-');
            $sheet->setCellValue('B' . $row++, $dataIbuHamil['kunjungan']['kunjungan_ke']);
            if ($dataIbuHamil['antropometri']) {
                $sheet->setCellValue('A' . $row, 'Tekanan Darah');
                $sheet->setCellValue('B' . $row++, $dataIbuHamil['antropometri']['tekanan_darah']);
                $sheet->setCellValue('A' . $row, 'Berat Badan');
                $sheet->setCellValue('B' . $row++, $dataIbuHamil['antropometri']['berat_badan'] . ' kg');
                $sheet->setCellValue('A' . $row, 'Tinggi Badan');
                $sheet->setCellValue('B' . $row++, $dataIbuHamil['antropometri']['tinggi_badan'] . ' cm');
                $sheet->setCellValue('A' . $row, 'LILA');
                $sheet->setCellValue('B' . $row++, $dataIbuHamil['antropometri']['lila'] . ' cm');
            }
            $sheet->getStyle('A3:A' . ($row-1))->getFont()->setBold(true);
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(35);
        }
        
        // Sheet 3: Balita
        if ($dataBalita) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle('Balita');
            $row = 1;
            $sheet->setCellValue('A' . $row, 'DATA BALITA & ANAK');
            $sheet->mergeCells('A1:B1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
            $row += 2;
            $sheet->setCellValue('A' . $row, 'Nama Anak');
            $sheet->setCellValue('B' . $row++, $dataBalita['identitas']['nama_anak']);
            $sheet->setCellValue('A' . $row, 'Tanggal Lahir');
            $sheet->setCellValue('B' . $row++, date('d-m-Y', strtotime($dataBalita['identitas']['tanggal_lahir'])));
            $sheet->setCellValue('A' . $row, 'Nama Wali');
            $sheet->setCellValue('B' . $row++, $dataBalita['identitas']['nama_wali'] ?? '-');
            $row++;
            $sheet->setCellValue('A' . $row, 'KUNJUNGAN TERAKHIR');
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);
            $row++;
            $sheet->setCellValue('A' . $row, 'Tanggal Kunjungan');
            $sheet->setCellValue('B' . $row++, date('d-m-Y', strtotime($dataBalita['kunjungan']['tanggal_kunjungan'])));
            $sheet->setCellValue('A' . $row, 'Kunjungan ke-');
            $sheet->setCellValue('B' . $row++, $dataBalita['kunjungan']['kunjungan_ke']);
            if ($dataBalita['antropometri']) {
                $sheet->setCellValue('A' . $row, 'Berat Badan');
                $sheet->setCellValue('B' . $row++, $dataBalita['antropometri']['berat_badan'] . ' kg');
                $sheet->setCellValue('A' . $row, 'Tinggi Badan');
                $sheet->setCellValue('B' . $row++, $dataBalita['antropometri']['tinggi_badan'] . ' cm');
                $sheet->setCellValue('A' . $row, 'Lingkar Kepala');
                $sheet->setCellValue('B' . $row++, ($dataBalita['antropometri']['lingkar_kepala'] ?? '-') . ' cm');
            }
            if ($dataBalita['gizi']) {
                $sheet->setCellValue('A' . $row, 'Vitamin A');
                $sheet->setCellValue('B' . $row++, $dataBalita['gizi']['vitamin_a'] ? 'Sudah' : 'Belum');
                $sheet->setCellValue('A' . $row, 'Obat Cacing');
                $sheet->setCellValue('B' . $row++, $dataBalita['gizi']['obat_cacing'] ? 'Sudah' : 'Belum');
            }
            $sheet->getStyle('A3:A' . ($row-1))->getFont()->setBold(true);
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(35);
        }
        
        // Sheet 4: Remaja
        if ($dataRemaja) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle('Remaja');
            $row = 1;
            $sheet->setCellValue('A' . $row, 'DATA REMAJA');
            $sheet->mergeCells('A1:B1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
            $row += 2;
            $sheet->setCellValue('A' . $row, 'Nama Lengkap');
            $sheet->setCellValue('B' . $row++, $dataRemaja['identitas']['nama_lengkap']);
            $sheet->setCellValue('A' . $row, 'NIK');
            $sheet->setCellValue('B' . $row++, $dataRemaja['identitas']['nik'] ?? '-');
            $sheet->setCellValue('A' . $row, 'Tanggal Lahir');
            $sheet->setCellValue('B' . $row++, date('d-m-Y', strtotime($dataRemaja['identitas']['tanggal_lahir'])));
            $sheet->setCellValue('A' . $row, 'Jenis Kelamin');
            $sheet->setCellValue('B' . $row++, $dataRemaja['identitas']['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan');
            $row++;
            $sheet->setCellValue('A' . $row, 'KUNJUNGAN TERAKHIR');
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);
            $row++;
            $sheet->setCellValue('A' . $row, 'Tanggal Kunjungan');
            $sheet->setCellValue('B' . $row++, date('d-m-Y', strtotime($dataRemaja['kunjungan']['tanggal_kunjungan'])));
            $sheet->setCellValue('A' . $row, 'Kunjungan ke-');
            $sheet->setCellValue('B' . $row++, $dataRemaja['kunjungan']['kunjungan_ke']);
            if ($dataRemaja['antropometri']) {
                $sheet->setCellValue('A' . $row, 'Berat Badan');
                $sheet->setCellValue('B' . $row++, $dataRemaja['antropometri']['berat_badan'] . ' kg');
                $sheet->setCellValue('A' . $row, 'Tinggi Badan');
                $sheet->setCellValue('B' . $row++, $dataRemaja['antropometri']['tinggi_badan'] . ' cm');
                $sheet->setCellValue('A' . $row, 'Tekanan Darah');
                $sheet->setCellValue('B' . $row++, $dataRemaja['antropometri']['tekanan_darah']);
                $sheet->setCellValue('A' . $row, 'Lingkar Perut');
                $sheet->setCellValue('B' . $row++, ($dataRemaja['antropometri']['lingkar_perut'] ?? '-') . ' cm');
            }
            if ($dataRemaja['suplementasi']) {
                $sheet->setCellValue('A' . $row, 'Dapat TTD');
                $sheet->setCellValue('B' . $row++, $dataRemaja['suplementasi']['dapat_ttd'] ? 'Ya' : 'Tidak');
                $sheet->setCellValue('A' . $row, 'Minum TTD');
                $sheet->setCellValue('B' . $row++, $dataRemaja['suplementasi']['minum_ttd'] ? 'Ya' : 'Tidak');
            }
            $sheet->getStyle('A3:A' . ($row-1))->getFont()->setBold(true);
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(35);
        }
        
        $spreadsheet->setActiveSheetIndex(0);
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="monitoring_' . $user['username'] . '.xlsx"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }

    private function getLastVisitIbuHamil($userId)
    {
        $monitoring = (new MonitoringIbuHamilModel())->getByUserId($userId);
        if (!$monitoring) return null;
        
        $identitas = (new MonitoringIdentitasModel())->where('monitoring_id', $monitoring['id'])->first();
        $kunjungan = (new KunjunganModel())->where('monitoring_id', $monitoring['id'])->orderBy('tanggal_kunjungan', 'DESC')->orderBy('id', 'DESC')->first();
        
        if (!$kunjungan) return null;
        
        $kunjunganAntropometriModel = new \App\Models\Monitoring\KunjunganAntropometriModel();
        $kunjunganKeluhanModel = new \App\Models\Monitoring\KunjunganKeluhanModel();
        $kunjunganSuplementasiModel = new \App\Models\Monitoring\KunjunganSuplementasiModel();
        
        return [
            'identitas' => $identitas,
            'kunjungan' => $kunjungan,
            'antropometri' => $kunjunganAntropometriModel->where('kunjungan_id', $kunjungan['id'])->first(),
            'keluhan' => $kunjunganKeluhanModel->where('kunjungan_id', $kunjungan['id'])->first(),
            'suplementasi' => $kunjunganSuplementasiModel->where('kunjungan_id', $kunjungan['id'])->first()
        ];
    }

    private function getLastVisitBalita($userId)
    {
        $monitoring = (new MonitoringBalitaModel())->where('user_id', $userId)->first();
        if (!$monitoring) return null;
        
        $identitas = (new MonitoringBalitaIdentitasModel())->where('monitoring_balita_id', $monitoring['id'])->first();
        $kunjungan = (new KunjunganBalitaModel())->where('monitoring_balita_id', $monitoring['id'])->orderBy('tanggal_kunjungan', 'DESC')->orderBy('id', 'DESC')->first();
        
        if (!$kunjungan) return null;
        
        return [
            'identitas' => $identitas,
            'kunjungan' => $kunjungan,
            'antropometri' => (new KunjunganBalitaAntropometriModel())->where('kunjungan_balita_id', $kunjungan['id'])->first(),
            'keluhan' => (new KunjunganBalitaKeluhanModel())->where('kunjungan_balita_id', $kunjungan['id'])->first(),
            'imunisasi' => (new KunjunganBalitaImunisasiModel())->where('kunjungan_balita_id', $kunjungan['id'])->first(),
            'swamedikasi' => (new KunjunganBalitaSwamedikasModel())->where('kunjungan_balita_id', $kunjungan['id'])->first(),
            'gizi' => (new KunjunganBalitaGiziModel())->where('kunjungan_balita_id', $kunjungan['id'])->first(),
            'kpsp' => (new KunjunganBalitaKpspModel())->where('kunjungan_balita_id', $kunjungan['id'])->first()
        ];
    }

    private function getLastVisitRemaja($userId)
    {
        $monitoring = (new MonitoringRemajaModel())->where('user_id', $userId)->first();
        if (!$monitoring) return null;
        
        $identitas = (new MonitoringRemajaIdentitasModel())->where('monitoring_id', $monitoring['id'])->first();
        $kunjungan = (new KunjunganRemajaModel())->where('monitoring_id', $monitoring['id'])->orderBy('tanggal_kunjungan', 'DESC')->orderBy('id', 'DESC')->first();
        
        if (!$kunjungan) return null;
        
        return [
            'identitas' => $identitas,
            'kunjungan' => $kunjungan,
            'antropometri' => (new KunjunganRemajaAntropometriModel())->where('kunjungan_id', $kunjungan['id'])->first(),
            'anemia' => (new KunjunganRemajaAnemiaModel())->where('kunjungan_id', $kunjungan['id'])->first(),
            'suplementasi' => (new KunjunganRemajaSuplementasiModel())->where('kunjungan_id', $kunjungan['id'])->first(),
            'gaya_hidup' => (new KunjunganRemajaGayaHidupModel())->where('kunjungan_id', $kunjungan['id'])->first(),
            'swamedikasi' => (new KunjunganRemajaSwamedikasModel())->where('kunjungan_id', $kunjungan['id'])->first(),
            'haid' => (new KunjunganRemajaHaidModel())->where('kunjungan_id', $kunjungan['id'])->first()
        ];
    }

    public function exportAllCategoriesPdf($userId)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT u.username, u.phone_number, p.nama_padukuhan FROM users u LEFT JOIN padukuhan p ON p.id = u.padukuhan_id WHERE u.id = ?", [$userId]);
        $adminInfo = $query->getRowArray();
        
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        if (!$user) {
            return redirect()->to('/admin/dashboard')->with('error', 'User tidak ditemukan');
        }
        
        // IBU HAMIL
        $dataIbuHamil = null;
        $monitoring = (new MonitoringIbuHamilModel())->getByUserId($userId);
        if ($monitoring) {
            $identitas = (new MonitoringIdentitasModel())->where('monitoring_id', $monitoring['id'])->first();
            $riwayat = (new MonitoringRiwayatPenyakitModel())->where('monitoring_id', $monitoring['id'])->first();
            $skrining = (new MonitoringSkriningModel())->where('monitoring_id', $monitoring['id'])->first();
            $kunjungan = (new KunjunganModel())->getWithDetails($monitoring['id']);
            $dataIbuHamil = ['identitas' => $identitas, 'riwayat' => $riwayat, 'skrining' => $skrining, 'kunjungan' => $kunjungan];
        }
        
        // BALITA
        $dataBalita = null;
        $monitoringBalita = (new MonitoringBalitaModel())->where('user_id', $userId)->first();
        if ($monitoringBalita) {
            $identitas = (new MonitoringBalitaIdentitasModel())->where('monitoring_balita_id', $monitoringBalita['id'])->first();
            $kunjunganList = (new KunjunganBalitaModel())->where('monitoring_balita_id', $monitoringBalita['id'])->orderBy('kunjungan_ke', 'ASC')->findAll();
            foreach ($kunjunganList as &$k) {
                $k['keluhan'] = (new KunjunganBalitaKeluhanModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['gizi'] = (new KunjunganBalitaGiziModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['kpsp'] = (new KunjunganBalitaKpspModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['antropometri'] = (new KunjunganBalitaAntropometriModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['imunisasi'] = (new KunjunganBalitaImunisasiModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['swamedikasi'] = (new KunjunganBalitaSwamedikasModel())->where('kunjungan_balita_id', $k['id'])->first();
            }
            $dataBalita = ['identitas' => $identitas, 'kunjungan' => $kunjunganList];
        }
        
        // REMAJA
        $dataRemaja = null;
        $monitoringRemaja = (new MonitoringRemajaModel())->where('user_id', $userId)->first();
        if ($monitoringRemaja) {
            $identitas = (new MonitoringRemajaIdentitasModel())->where('monitoring_id', $monitoringRemaja['id'])->first();
            $kunjunganList = (new KunjunganRemajaModel())->where('monitoring_id', $monitoringRemaja['id'])->orderBy('kunjungan_ke', 'ASC')->findAll();
            foreach ($kunjunganList as &$k) {
                $k['anemia'] = (new KunjunganRemajaAnemiaModel())->where('kunjungan_id', $k['id'])->first();
                $k['haid'] = (new KunjunganRemajaHaidModel())->where('kunjungan_id', $k['id'])->first();
                $k['suplementasi'] = (new KunjunganRemajaSuplementasiModel())->where('kunjungan_id', $k['id'])->first();
                $k['antropometri'] = (new KunjunganRemajaAntropometriModel())->where('kunjungan_id', $k['id'])->first();
                $k['gaya_hidup'] = (new KunjunganRemajaGayaHidupModel())->where('kunjungan_id', $k['id'])->first();
                $k['swamedikasi'] = (new KunjunganRemajaSwamedikasModel())->where('kunjungan_id', $k['id'])->first();
            }
            $dataRemaja = ['identitas' => $identitas, 'kunjungan' => $kunjunganList];
        }
        
        $data = [
            'adminInfo' => $adminInfo,
            'user' => $user,
            'dataIbuHamil' => $dataIbuHamil,
            'dataBalita' => $dataBalita,
            'dataRemaja' => $dataRemaja
        ];
        
        $html = view('admin/user_all_categories_pdf', $data);
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('monitoring_lengkap_' . $user['username'] . '.pdf', ['Attachment' => false]);
    }

    public function exportAllCategoriesExcel($userId)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT u.username, u.phone_number, p.nama_padukuhan FROM users u LEFT JOIN padukuhan p ON p.id = u.padukuhan_id WHERE u.id = ?", [$userId]);
        $adminInfo = $query->getRowArray();
        
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        if (!$user) {
            return redirect()->to('/admin/dashboard')->with('error', 'User tidak ditemukan');
        }
        
        // IBU HAMIL
        $dataIbuHamil = null;
        $monitoring = (new MonitoringIbuHamilModel())->getByUserId($userId);
        if ($monitoring) {
            $identitas = (new MonitoringIdentitasModel())->where('monitoring_id', $monitoring['id'])->first();
            $riwayat = (new MonitoringRiwayatPenyakitModel())->where('monitoring_id', $monitoring['id'])->first();
            $skrining = (new MonitoringSkriningModel())->where('monitoring_id', $monitoring['id'])->first();
            $kunjungan = (new KunjunganModel())->getWithDetails($monitoring['id']);
            $dataIbuHamil = ['identitas' => $identitas, 'riwayat' => $riwayat, 'skrining' => $skrining, 'kunjungan' => $kunjungan];
        }
        
        // BALITA
        $dataBalita = null;
        $monitoringBalita = (new MonitoringBalitaModel())->where('user_id', $userId)->first();
        if ($monitoringBalita) {
            $identitas = (new MonitoringBalitaIdentitasModel())->where('monitoring_balita_id', $monitoringBalita['id'])->first();
            $kunjunganList = (new KunjunganBalitaModel())->where('monitoring_balita_id', $monitoringBalita['id'])->orderBy('kunjungan_ke', 'ASC')->findAll();
            foreach ($kunjunganList as &$k) {
                $k['keluhan'] = (new KunjunganBalitaKeluhanModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['gizi'] = (new KunjunganBalitaGiziModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['kpsp'] = (new KunjunganBalitaKpspModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['antropometri'] = (new KunjunganBalitaAntropometriModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['imunisasi'] = (new KunjunganBalitaImunisasiModel())->where('kunjungan_balita_id', $k['id'])->first();
                $k['swamedikasi'] = (new KunjunganBalitaSwamedikasModel())->where('kunjungan_balita_id', $k['id'])->first();
            }
            $dataBalita = ['identitas' => $identitas, 'kunjungan' => $kunjunganList];
        }
        
        // REMAJA
        $dataRemaja = null;
        $monitoringRemaja = (new MonitoringRemajaModel())->where('user_id', $userId)->first();
        if ($monitoringRemaja) {
            $identitas = (new MonitoringRemajaIdentitasModel())->where('monitoring_id', $monitoringRemaja['id'])->first();
            $kunjunganList = (new KunjunganRemajaModel())->where('monitoring_id', $monitoringRemaja['id'])->orderBy('kunjungan_ke', 'ASC')->findAll();
            foreach ($kunjunganList as &$k) {
                $k['anemia'] = (new KunjunganRemajaAnemiaModel())->where('kunjungan_id', $k['id'])->first();
                $k['haid'] = (new KunjunganRemajaHaidModel())->where('kunjungan_id', $k['id'])->first();
                $k['suplementasi'] = (new KunjunganRemajaSuplementasiModel())->where('kunjungan_id', $k['id'])->first();
                $k['antropometri'] = (new KunjunganRemajaAntropometriModel())->where('kunjungan_id', $k['id'])->first();
                $k['gaya_hidup'] = (new KunjunganRemajaGayaHidupModel())->where('kunjungan_id', $k['id'])->first();
                $k['swamedikasi'] = (new KunjunganRemajaSwamedikasModel())->where('kunjungan_id', $k['id'])->first();
            }
            $dataRemaja = ['identitas' => $identitas, 'kunjungan' => $kunjunganList];
        }
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Info Admin');
        
        $row = 1;
        $sheet->setCellValue('A'.$row, 'LAPORAN MONITORING KESEHATAN LENGKAP');
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $row += 2;
        $sheet->setCellValue('A'.$row, 'Padukuhan'); $sheet->setCellValue('B'.$row++, $adminInfo['nama_padukuhan'] ?? '-');
        $sheet->setCellValue('A'.$row, 'Admin'); $sheet->setCellValue('B'.$row++, $adminInfo['username'] ?? '-');
        $sheet->setCellValue('A'.$row, 'No. Telepon'); $sheet->setCellValue('B'.$row++, $adminInfo['phone_number'] ?? '-');
        $sheet->setCellValue('A'.$row, 'Tanggal Export'); $sheet->setCellValue('B'.$row++, date('d-m-Y'));
        $row++;
        $sheet->setCellValue('A'.$row, 'Username Pasien'); $sheet->setCellValue('B'.$row++, $user['username']);
        $sheet->getStyle('A3:A'.$row)->getFont()->setBold(true);
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(35);
        
        // IBU HAMIL SHEET
        if ($dataIbuHamil) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle('Ibu Hamil');
            $row = 1;
            $sheet->setCellValue('A'.$row, 'DATA IBU HAMIL');
            $sheet->mergeCells('A1:B1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
            $row += 2;
            $i = $dataIbuHamil['identitas'];
            $sheet->setCellValue('A'.$row, 'Nama Ibu'); $sheet->setCellValue('B'.$row++, $i['nama_ibu']);
            $sheet->setCellValue('A'.$row, 'Nama Suami'); $sheet->setCellValue('B'.$row++, $i['nama_suami'] ?? '-');
            $sheet->setCellValue('A'.$row, 'Usia Kehamilan'); $sheet->setCellValue('B'.$row++, $i['usia_kehamilan'].' minggu');
            $sheet->setCellValue('A'.$row, 'HPL'); $sheet->setCellValue('B'.$row++, date('d-m-Y', strtotime($i['rencana_tanggal_persalinan'])));
            $sheet->getStyle('A3:A'.($row-1))->getFont()->setBold(true);
            $row++;
            
            foreach ($dataIbuHamil['kunjungan'] as $idx => $k) {
                $sheet->setCellValue('A'.$row, 'KUNJUNGAN KE-'.$k['kunjungan_ke']);
                $sheet->getStyle('A'.$row)->getFont()->setBold(true);
                $row++;
                $sheet->setCellValue('A'.$row, 'Tanggal'); $sheet->setCellValue('B'.$row++, date('d-m-Y', strtotime($k['tanggal_kunjungan'])));
                if ($k['antropometri']) {
                    $a = $k['antropometri'];
                    $sheet->setCellValue('A'.$row, 'TD'); $sheet->setCellValue('B'.$row++, $a['tekanan_darah']);
                    $sheet->setCellValue('A'.$row, 'BB'); $sheet->setCellValue('B'.$row++, $a['berat_badan'].' kg');
                    $sheet->setCellValue('A'.$row, 'TB'); $sheet->setCellValue('B'.$row++, $a['tinggi_badan'].' cm');
                    $sheet->setCellValue('A'.$row, 'LILA'); $sheet->setCellValue('B'.$row++, $a['lila'].' cm');
                }
                $row++;
            }
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(35);
        }
        
        // BALITA SHEET
        if ($dataBalita) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle('Balita');
            $row = 1;
            $sheet->setCellValue('A'.$row, 'DATA BALITA & ANAK');
            $sheet->mergeCells('A1:B1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
            $row += 2;
            $i = $dataBalita['identitas'];
            $sheet->setCellValue('A'.$row, 'Nama Anak'); $sheet->setCellValue('B'.$row++, $i['nama_anak']);
            $sheet->setCellValue('A'.$row, 'Tanggal Lahir'); $sheet->setCellValue('B'.$row++, date('d-m-Y', strtotime($i['tanggal_lahir'])));
            $sheet->setCellValue('A'.$row, 'Nama Wali'); $sheet->setCellValue('B'.$row++, $i['nama_wali'] ?? '-');
            $sheet->getStyle('A3:A'.($row-1))->getFont()->setBold(true);
            $row++;
            
            foreach ($dataBalita['kunjungan'] as $k) {
                $sheet->setCellValue('A'.$row, 'KUNJUNGAN KE-'.$k['kunjungan_ke']);
                $sheet->getStyle('A'.$row)->getFont()->setBold(true);
                $row++;
                $sheet->setCellValue('A'.$row, 'Tanggal'); $sheet->setCellValue('B'.$row++, date('d-m-Y', strtotime($k['tanggal_kunjungan'])));
                if ($k['antropometri']) {
                    $a = $k['antropometri'];
                    $sheet->setCellValue('A'.$row, 'BB'); $sheet->setCellValue('B'.$row++, $a['berat_badan'].' kg');
                    $sheet->setCellValue('A'.$row, 'TB'); $sheet->setCellValue('B'.$row++, $a['tinggi_badan'].' cm');
                    $sheet->setCellValue('A'.$row, 'LK'); $sheet->setCellValue('B'.$row++, ($a['lingkar_kepala'] ?? '-').' cm');
                }
                if ($k['gizi']) {
                    $sheet->setCellValue('A'.$row, 'Vitamin A'); $sheet->setCellValue('B'.$row++, $k['gizi']['vitamin_a'] ? 'Ya' : 'Tidak');
                    $sheet->setCellValue('A'.$row, 'Obat Cacing'); $sheet->setCellValue('B'.$row++, $k['gizi']['obat_cacing'] ? 'Ya' : 'Tidak');
                }
                $row++;
            }
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(35);
        }
        
        // REMAJA SHEET
        if ($dataRemaja) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle('Remaja');
            $row = 1;
            $sheet->setCellValue('A'.$row, 'DATA REMAJA');
            $sheet->mergeCells('A1:B1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
            $row += 2;
            $i = $dataRemaja['identitas'];
            $sheet->setCellValue('A'.$row, 'Nama'); $sheet->setCellValue('B'.$row++, $i['nama_lengkap']);
            $sheet->setCellValue('A'.$row, 'NIK'); $sheet->setCellValue('B'.$row++, $i['nik'] ?? '-');
            $sheet->setCellValue('A'.$row, 'Tanggal Lahir'); $sheet->setCellValue('B'.$row++, date('d-m-Y', strtotime($i['tanggal_lahir'])));
            $sheet->setCellValue('A'.$row, 'Jenis Kelamin'); $sheet->setCellValue('B'.$row++, $i['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan');
            $sheet->getStyle('A3:A'.($row-1))->getFont()->setBold(true);
            $row++;
            
            foreach ($dataRemaja['kunjungan'] as $k) {
                $sheet->setCellValue('A'.$row, 'KUNJUNGAN KE-'.$k['kunjungan_ke']);
                $sheet->getStyle('A'.$row)->getFont()->setBold(true);
                $row++;
                $sheet->setCellValue('A'.$row, 'Tanggal'); $sheet->setCellValue('B'.$row++, date('d-m-Y', strtotime($k['tanggal_kunjungan'])));
                if ($k['antropometri']) {
                    $a = $k['antropometri'];
                    $sheet->setCellValue('A'.$row, 'BB'); $sheet->setCellValue('B'.$row++, $a['berat_badan'].' kg');
                    $sheet->setCellValue('A'.$row, 'TB'); $sheet->setCellValue('B'.$row++, $a['tinggi_badan'].' cm');
                    $sheet->setCellValue('A'.$row, 'TD'); $sheet->setCellValue('B'.$row++, $a['tekanan_darah']);
                    $sheet->setCellValue('A'.$row, 'LP'); $sheet->setCellValue('B'.$row++, ($a['lingkar_perut'] ?? '-').' cm');
                }
                if ($k['suplementasi']) {
                    $sheet->setCellValue('A'.$row, 'Dapat TTD'); $sheet->setCellValue('B'.$row++, $k['suplementasi']['dapat_ttd'] ? 'Ya' : 'Tidak');
                    $sheet->setCellValue('A'.$row, 'Minum TTD'); $sheet->setCellValue('B'.$row++, $k['suplementasi']['minum_ttd'] ? 'Ya' : 'Tidak');
                }
                $row++;
            }
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(35);
        }
        
        $spreadsheet->setActiveSheetIndex(0);
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="monitoring_lengkap_'.$user['username'].'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
