<?php

namespace App\Controllers\Admin\Monitoring;

use App\Controllers\BaseController;
use App\Models\Monitoring\MonitoringIbuHamilModel;
use App\Models\Monitoring\KunjunganModel;
use App\Models\Monitoring\KunjunganAntropometriModel;
use App\Models\MonitoringBalita\MonitoringBalitaModel;
use App\Models\MonitoringRemaja\MonitoringRemajaModel;
use App\Models\PadukuhanModel;

class LaporanController extends BaseController
{
    protected $monitoringModel;
    protected $kunjunganModel;
    protected $antropometriModel;
    protected $padukuhanModel;
    protected $balitaModel;
    protected $remajaModel;

    public function __construct()
    {
        $this->monitoringModel = new MonitoringIbuHamilModel();
        $this->kunjunganModel = new KunjunganModel();
        $this->antropometriModel = new KunjunganAntropometriModel();
        $this->padukuhanModel = new PadukuhanModel();
        $this->balitaModel = new MonitoringBalitaModel();
        $this->remajaModel = new MonitoringRemajaModel();
    }

    private function getAdminInfo()
    {
        $userId = session()->get('id');
        $db = \Config\Database::connect();
        
        // Raw query untuk memastikan data terambil
        $sql = "SELECT u.username, u.phone_number, p.nama_padukuhan 
                FROM users u 
                LEFT JOIN padukuhan p ON p.id = u.padukuhan_id 
                WHERE u.id = ?";
        
        $query = $db->query($sql, [$userId]);
        $currentUser = $query->getRowArray();
        
        // Default values
        $adminName = session()->get('username') ?? 'Admin';
        $adminPhone = '-';
        $adminPadukuhan = '-';
        
        if($currentUser) {
            if(!empty($currentUser['username'])) {
                $adminName = $currentUser['username'];
            }
            if(!empty($currentUser['phone_number'])) {
                $adminPhone = $currentUser['phone_number'];
            }
            if(!empty($currentUser['nama_padukuhan'])) {
                $adminPadukuhan = $currentUser['nama_padukuhan'];
            }
        }
        
        return [
            'adminName' => $adminName,
            'adminPhone' => $adminPhone,
            'adminPadukuhan' => $adminPadukuhan
        ];
    }

    public function index()
    {
        $role = session()->get('role');
        $padukuhanId = session()->get('padukuhan_id');
        
        // Get parameters
        $tab = $this->request->getGet('tab') ?? 'ibu-hamil';
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $search = $this->request->getGet('search') ?? '';
        
        // Get totals for cards
        $totalIbuHamil = $this->getTotalIbuHamil($padukuhanId);
        $totalBalita = $this->getTotalBalita($padukuhanId);
        $totalRemaja = $this->getTotalRemaja($padukuhanId);
        
        // Get data list based on tab with pagination
        $dataList = $this->getDataByTab($tab, $padukuhanId, $bulan, $tahun, $search);
        
        $data = [
            'title' => 'Data Statistik & Laporan',
            'tab' => $tab,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'search' => $search,
            'totalIbuHamil' => $totalIbuHamil,
            'totalBalita' => $totalBalita,
            'totalRemaja' => $totalRemaja,
            'dataList' => $dataList,
            'pager' => $this->getPager($tab, $padukuhanId, $bulan, $tahun, $search)
        ];
        
        return view('admin/monitoring/laporan', $data);
    }

    private function getTotalIbuHamil($padukuhanId)
    {
        $builder = $this->monitoringModel->select('monitoring_ibu_hamil.*')
            ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
            ->where('monitoring_ibu_hamil.status', 'active');
        
        if ($padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        return $builder->countAllResults();
    }

    private function getTotalBalita($padukuhanId)
    {
        $builder = $this->balitaModel->select('monitoring_balita.*')
            ->join('users', 'users.id = monitoring_balita.user_id');
        
        if ($padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        return $builder->countAllResults();
    }

    private function getTotalRemaja($padukuhanId)
    {
        $builder = $this->remajaModel->select('monitoring_remaja.*')
            ->join('users', 'users.id = monitoring_remaja.user_id');
        
        if ($padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        return $builder->countAllResults();
    }

    private function getDataByTab($tab, $padukuhanId, $bulan, $tahun, $search)
    {
        $perPage = 10;
        
        if ($tab === 'ibu-hamil') {
            $builder = $this->monitoringModel->select('monitoring_ibu_hamil.*, monitoring_identitas.nama_ibu, monitoring_identitas.usia_kehamilan, monitoring_identitas.rencana_tanggal_persalinan, users.username')
                ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
                ->join('monitoring_identitas', 'monitoring_identitas.monitoring_id = monitoring_ibu_hamil.id', 'left')
                ->where('monitoring_ibu_hamil.status', 'active');
            
            if ($padukuhanId) {
                $builder->where('users.padukuhan_id', $padukuhanId);
            }
            
            if ($search) {
                $builder->like('monitoring_identitas.nama_ibu', $search);
            }
            
            return $builder->paginate($perPage);
        } 
        elseif ($tab === 'balita') {
            $builder = $this->balitaModel->select('monitoring_balita.*, monitoring_balita_identitas.nama_anak, monitoring_balita_identitas.tanggal_lahir, users.username')
                ->join('users', 'users.id = monitoring_balita.user_id')
                ->join('monitoring_balita_identitas', 'monitoring_balita_identitas.monitoring_balita_id = monitoring_balita.id', 'left');
            
            if ($padukuhanId) {
                $builder->where('users.padukuhan_id', $padukuhanId);
            }
            
            if ($search) {
                $builder->like('monitoring_balita_identitas.nama_anak', $search);
            }
            
            return $builder->paginate($perPage);
        }
        elseif ($tab === 'remaja') {
            $builder = $this->remajaModel->select('monitoring_remaja.*, monitoring_remaja_identitas.nama_lengkap, monitoring_remaja_identitas.tanggal_lahir, monitoring_remaja_identitas.jenis_kelamin, users.username')
                ->join('users', 'users.id = monitoring_remaja.user_id')
                ->join('monitoring_remaja_identitas', 'monitoring_remaja_identitas.monitoring_id = monitoring_remaja.id', 'left');
            
            if ($padukuhanId) {
                $builder->where('users.padukuhan_id', $padukuhanId);
            }
            
            if ($search) {
                $builder->like('monitoring_remaja_identitas.nama_lengkap', $search);
            }
            
            return $builder->paginate($perPage);
        }
        
        return [];
    }

    private function getPager($tab, $padukuhanId, $bulan, $tahun, $search)
    {
        if ($tab === 'ibu-hamil') {
            return $this->monitoringModel->pager;
        } elseif ($tab === 'balita') {
            return $this->balitaModel->pager;
        } elseif ($tab === 'remaja') {
            return $this->remajaModel->pager;
        }
        return null;
    }

    private function getAllDataForExport($tab, $padukuhanId, $bulan, $tahun, $search)
    {
        if ($tab === 'ibu-hamil') {
            $builder = $this->monitoringModel->select('monitoring_ibu_hamil.*, monitoring_identitas.nama_ibu, monitoring_identitas.usia_kehamilan, monitoring_identitas.rencana_tanggal_persalinan, users.username')
                ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
                ->join('monitoring_identitas', 'monitoring_identitas.monitoring_id = monitoring_ibu_hamil.id', 'left')
                ->where('monitoring_ibu_hamil.status', 'active');
            
            if ($padukuhanId) $builder->where('users.padukuhan_id', $padukuhanId);
            if ($search) $builder->like('monitoring_identitas.nama_ibu', $search);
            
            return $builder->findAll();
        } 
        elseif ($tab === 'balita') {
            $builder = $this->balitaModel->select('monitoring_balita.*, monitoring_balita_identitas.nama_anak, monitoring_balita_identitas.tanggal_lahir, users.username')
                ->join('users', 'users.id = monitoring_balita.user_id')
                ->join('monitoring_balita_identitas', 'monitoring_balita_identitas.monitoring_balita_id = monitoring_balita.id', 'left');
            
            if ($padukuhanId) $builder->where('users.padukuhan_id', $padukuhanId);
            if ($search) $builder->like('monitoring_balita_identitas.nama_anak', $search);
            
            return $builder->findAll();
        }
        elseif ($tab === 'remaja') {
            $builder = $this->remajaModel->select('monitoring_remaja.*, monitoring_remaja_identitas.nama_lengkap, monitoring_remaja_identitas.tanggal_lahir, monitoring_remaja_identitas.jenis_kelamin, users.username')
                ->join('users', 'users.id = monitoring_remaja.user_id')
                ->join('monitoring_remaja_identitas', 'monitoring_remaja_identitas.monitoring_id = monitoring_remaja.id', 'left');
            
            if ($padukuhanId) $builder->where('users.padukuhan_id', $padukuhanId);
            if ($search) $builder->like('monitoring_remaja_identitas.nama_lengkap', $search);
            
            return $builder->findAll();
        }
        
        return [];
    }

    public function exportExcel()
    {
        $role = session()->get('role');
        $padukuhanId = session()->get('padukuhan_id');
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $search = $this->request->getGet('search') ?? '';
        
        $adminInfo = $this->getAdminInfo();
        extract($adminInfo);
        
        // Get all data from 3 categories
        $dataIbuHamil = $this->getAllDataForExport('ibu-hamil', $padukuhanId, $bulan, $tahun, $search);
        $dataBalita = $this->getAllDataForExport('balita', $padukuhanId, $bulan, $tahun, $search);
        $dataRemaja = $this->getAllDataForExport('remaja', $padukuhanId, $bulan, $tahun, $search);
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Info Admin');
        
        // Header
        $sheet->setCellValue('A1', 'LAPORAN MONITORING KESEHATAN - SEMUA KATEGORI');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        
        $sheet->setCellValue('A2', 'Periode: ' . date('F', mktime(0,0,0,$bulan,1)) . ' ' . $tahun);
        $sheet->mergeCells('A2:G2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
        
        // Admin Info
        $row = 4;
        $sheet->setCellValue('A'.$row, 'Padukuhan:'); $sheet->setCellValue('B'.$row, $adminPadukuhan);
        $sheet->setCellValue('D'.$row, 'Admin:'); $sheet->setCellValue('E'.$row, $adminName);
        $row++;
        $sheet->setCellValue('A'.$row, 'No. Telepon:'); $sheet->setCellValue('B'.$row, $adminPhone);
        $sheet->setCellValue('D'.$row, 'Tanggal Export:'); $sheet->setCellValue('E'.$row, date('d-m-Y'));
        $sheet->getStyle('A4:A5')->getFont()->setBold(true);
        $sheet->getStyle('D4:D5')->getFont()->setBold(true);
        
        // IBU HAMIL SHEET
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('Ibu Hamil');
        $row = 1;
        $sheet->setCellValue('A'.$row, 'DATA IBU HAMIL & MENYUSUI');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
        $row += 2;
        {
        $sheet->setCellValue('A'.$row, 'No');
        $sheet->setCellValue('B'.$row, 'Nama Ibu');
        $sheet->setCellValue('C'.$row, 'Usia Kehamilan');
        $sheet->setCellValue('D'.$row, 'Trimester');
        $sheet->setCellValue('E'.$row, 'HPL');
        $sheet->setCellValue('F'.$row, 'Kunjungan Bulan Ini');
        $sheet->setCellValue('G'.$row, 'Total Kunjungan');
        $sheet->setCellValue('H'.$row, 'Status');
        $sheet->getStyle('A'.$row.':H'.$row)->getFont()->setBold(true);
        $row++;
        $no = 1;
        $kunjunganModel = new \App\Models\Monitoring\KunjunganModel();
        foreach ($dataIbuHamil as $d) {
            $totalKunjungan = $kunjunganModel->where('monitoring_id', $d['id'])->countAllResults();
            $kunjunganBulanIni = $kunjunganModel->where('monitoring_id', $d['id'])
                ->where('MONTH(tanggal_kunjungan)', $bulan)
                ->where('YEAR(tanggal_kunjungan)', $tahun)
                ->countAllResults();
            $usiaKehamilan = $d['usia_kehamilan'] ?? 0;
            $trimester = $usiaKehamilan <= 13 ? 1 : ($usiaKehamilan <= 27 ? 2 : 3);
            $status = $totalKunjungan < 4 ? 'Perlu Perhatian' : 'Aktif';
            
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $d['nama_ibu'] ?? '-');
            $sheet->setCellValue('C'.$row, $usiaKehamilan . ' minggu');
            $sheet->setCellValue('D'.$row, 'Trimester ' . $trimester);
            $sheet->setCellValue('E'.$row, isset($d['rencana_tanggal_persalinan']) ? date('d/m/Y', strtotime($d['rencana_tanggal_persalinan'])) : '-');
            $sheet->setCellValue('F'.$row, $kunjunganBulanIni);
            $sheet->setCellValue('G'.$row, $totalKunjungan);
            $sheet->setCellValue('H'.$row, $status);
            $row++;
        }
        foreach(range('A','H') as $col) $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // BALITA SHEET
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('Balita');
        $row = 1;
        $sheet->setCellValue('A'.$row, 'DATA BALITA & ANAK');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
        $row += 2;
        {
        $sheet->setCellValue('A'.$row, 'No');
        $sheet->setCellValue('B'.$row, 'Nama Anak');
        $sheet->setCellValue('C'.$row, 'Usia');
        $sheet->setCellValue('D'.$row, 'Kunjungan Bulan Ini');
        $sheet->setCellValue('E'.$row, 'Total Kunjungan');
        $sheet->setCellValue('F'.$row, 'Status Gizi');
        $sheet->getStyle('A'.$row.':F'.$row)->getFont()->setBold(true);
        $row++;
        $no = 1;
        $kunjunganBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
        foreach ($dataBalita as $d) {
            $totalKunjungan = $kunjunganBalitaModel->where('monitoring_balita_id', $d['id'])->countAllResults();
            $kunjunganBulanIni = $kunjunganBalitaModel->where('monitoring_balita_id', $d['id'])
                ->where('MONTH(tanggal_kunjungan)', $bulan)
                ->where('YEAR(tanggal_kunjungan)', $tahun)
                ->countAllResults();
            $usia = '-';
            if(isset($d['tanggal_lahir'])) {
                $tglLahir = new \DateTime($d['tanggal_lahir']);
                $today = new \DateTime();
                $diff = $today->diff($tglLahir);
                $usia = $diff->y . ' thn ' . $diff->m . ' bln';
            }
            $statusGizi = $totalKunjungan < 6 ? 'Perlu Pemantauan' : 'Normal';
            
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $d['nama_anak'] ?? '-');
            $sheet->setCellValue('C'.$row, $usia);
            $sheet->setCellValue('D'.$row, $kunjunganBulanIni);
            $sheet->setCellValue('E'.$row, $totalKunjungan);
            $sheet->setCellValue('F'.$row, $statusGizi);
            $row++;
        }
        foreach(range('A','F') as $col) $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // REMAJA SHEET
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('Remaja');
        $row = 1;
        $sheet->setCellValue('A'.$row, 'DATA REMAJA');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
        $row += 2;
        {
        $sheet->setCellValue('A'.$row, 'No');
        $sheet->setCellValue('B'.$row, 'Nama');
        $sheet->setCellValue('C'.$row, 'Usia');
        $sheet->setCellValue('D'.$row, 'Jenis Kelamin');
        $sheet->setCellValue('E'.$row, 'Kunjungan Bulan Ini');
        $sheet->setCellValue('F'.$row, 'Total Kunjungan');
        $sheet->setCellValue('G'.$row, 'Status Anemia');
        $sheet->getStyle('A'.$row.':G'.$row)->getFont()->setBold(true);
        $row++;
        $no = 1;
        $kunjunganRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
        foreach ($dataRemaja as $d) {
            $totalKunjungan = $kunjunganRemajaModel->where('monitoring_id', $d['id'])->countAllResults();
            $kunjunganBulanIni = $kunjunganRemajaModel->where('monitoring_id', $d['id'])
                ->where('MONTH(tanggal_kunjungan)', $bulan)
                ->where('YEAR(tanggal_kunjungan)', $tahun)
                ->countAllResults();
            $usia = '-';
            if(isset($d['tanggal_lahir'])) {
                $tglLahir = new \DateTime($d['tanggal_lahir']);
                $today = new \DateTime();
                $diff = $today->diff($tglLahir);
                $usia = $diff->y . ' tahun';
            }
            $jenisKelamin = isset($d['jenis_kelamin']) ? ($d['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') : '-';
            $statusAnemia = $totalKunjungan < 4 ? 'Perlu Pemeriksaan' : 'Normal';
            
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $d['nama_lengkap'] ?? '-');
            $sheet->setCellValue('C'.$row, $usia);
            $sheet->setCellValue('D'.$row, $jenisKelamin);
            $sheet->setCellValue('E'.$row, $kunjunganBulanIni);
            $sheet->setCellValue('F'.$row, $totalKunjungan);
            $sheet->setCellValue('G'.$row, $statusAnemia);
            $row++;
        }
        foreach(range('A','G') as $col) $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $spreadsheet->setActiveSheetIndex(0);
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Laporan_Semua_Kategori_' . $bulan . '_' . $tahun . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }

    public function exportPdf()
    {
        $role = session()->get('role');
        $padukuhanId = session()->get('padukuhan_id');
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $search = $this->request->getGet('search') ?? '';
        
        $adminInfo = $this->getAdminInfo();
        extract($adminInfo);
        
        // Get all data from 3 categories
        $dataIbuHamil = $this->getAllDataForExport('ibu-hamil', $padukuhanId, $bulan, $tahun, $search);
        $dataBalita = $this->getAllDataForExport('balita', $padukuhanId, $bulan, $tahun, $search);
        $dataRemaja = $this->getAllDataForExport('remaja', $padukuhanId, $bulan, $tahun, $search);
        
        $html = view('admin/monitoring/laporan_all_pdf', [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'dataIbuHamil' => $dataIbuHamil,
            'dataBalita' => $dataBalita,
            'dataRemaja' => $dataRemaja,
            'adminName' => $adminName,
            'adminPhone' => $adminPhone,
            'adminPadukuhan' => $adminPadukuhan
        ]);
        
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $filename = 'Laporan_Semua_Kategori_' . $bulan . '_' . $tahun . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);
    }

    public function exportDetailExcel($tab, $id)
    {
        $adminInfo = $this->getAdminInfo();
        extract($adminInfo);
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        if ($tab === 'ibu-hamil') {
            $identitasModel = new \App\Models\Monitoring\MonitoringIdentitasModel();
            $identitas = $identitasModel->where('monitoring_id', $id)->first();
            $riwayatModel = new \App\Models\Monitoring\MonitoringRiwayatPenyakitModel();
            $riwayat = $riwayatModel->where('monitoring_id', $id)->first();
            $skriningModel = new \App\Models\Monitoring\MonitoringSkriningModel();
            $skrining = $skriningModel->where('monitoring_id', $id)->first();
            $kunjunganModel = new \App\Models\Monitoring\KunjunganModel();
            $kunjunganList = $kunjunganModel->getWithDetails($id);
            
            // Header
            $sheet->setCellValue('A1', 'SISTEM MONITORING KESEHATAN E-ASFARM');
            $sheet->mergeCells('A1:F1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            
            $sheet->setCellValue('A2', 'LAPORAN DETAIL MONITORING IBU HAMIL');
            $sheet->mergeCells('A2:F2');
            $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
            
            // Admin Info
            $row = 4;
            $sheet->setCellValue('A'.$row, 'Padukuhan:');
            $sheet->setCellValue('B'.$row, $adminPadukuhan);
            $sheet->setCellValue('D'.$row, 'Dicetak oleh:');
            $sheet->setCellValue('E'.$row, $adminName);
            $row++;
            $sheet->setCellValue('A'.$row, 'No. HP Admin:');
            $sheet->setCellValue('B'.$row, $adminPhone);
            $sheet->setCellValue('D'.$row, 'Tanggal:');
            $sheet->setCellValue('E'.$row, date('d/m/Y H:i:s'));
            $sheet->getStyle('A4:A5')->getFont()->setBold(true);
            $sheet->getStyle('D4:D5')->getFont()->setBold(true);
            
            // Data Identitas
            $row += 2;
            $sheet->setCellValue('A'.$row, 'DATA IDENTITAS');
            $sheet->getStyle('A'.$row)->getFont()->setBold(true)->setSize(12);
            $row++;
            $sheet->setCellValue('A'.$row, 'Nama Ibu');
            $sheet->setCellValue('B'.$row, $identitas['nama_ibu'] ?? '-');
            $sheet->setCellValue('D'.$row, 'Nama Suami');
            $sheet->setCellValue('E'.$row, $identitas['nama_suami'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'Usia Ibu');
            $sheet->setCellValue('B'.$row, ($identitas['usia_ibu'] ?? '-') . ' tahun');
            $sheet->setCellValue('D'.$row, 'Usia Suami');
            $sheet->setCellValue('E'.$row, ($identitas['usia_suami'] ?? '-') . ' tahun');
            $row++;
            $sheet->setCellValue('A'.$row, 'Usia Kehamilan');
            $sheet->setCellValue('B'.$row, ($identitas['usia_kehamilan'] ?? '-') . ' minggu');
            $sheet->setCellValue('D'.$row, 'Alamat');
            $sheet->setCellValue('E'.$row, $identitas['alamat'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'Nomor Telepon');
            $sheet->setCellValue('B'.$row, $identitas['nomor_telepon'] ?? '-');
            $sheet->setCellValue('D'.$row, 'Rencana Persalinan');
            $sheet->setCellValue('E'.$row, isset($identitas['rencana_tanggal_persalinan']) ? date('d/m/Y', strtotime($identitas['rencana_tanggal_persalinan'])) : '-');
            if($skrining) {
                $row++;
                $sheet->setCellValue('A'.$row, 'Tempat Persalinan');
                $sheet->setCellValue('B'.$row, $skrining['tempat_persalinan'] ?? '-');
                $sheet->setCellValue('D'.$row, 'Penolong Persalinan');
                $sheet->setCellValue('E'.$row, $skrining['penolong_persalinan'] ?? '-');
            }
            
            // Riwayat Penyakit
            if($riwayat) {
                $row += 2;
                $sheet->setCellValue('A'.$row, 'RIWAYAT PENYAKIT');
                $sheet->getStyle('A'.$row)->getFont()->setBold(true);
                $row++;
                if($riwayat['tidak_ada_riwayat'] === '1') {
                    $sheet->setCellValue('A'.$row, 'Tidak ada riwayat penyakit');
                } else {
                    $sheet->setCellValue('A'.$row, $riwayat['riwayat_penyakit']);
                }
                $sheet->mergeCells('A'.$row.':F'.$row);
            }
            
            // Riwayat Kunjungan
            $row += 2;
            $sheet->setCellValue('A'.$row, 'RIWAYAT KUNJUNGAN (' . count($kunjunganList) . ' Kunjungan)');
            $sheet->getStyle('A'.$row)->getFont()->setBold(true)->setSize(12);
            $row++;
            
            $no = 1;
            foreach ($kunjunganList as $k) {
                $sheet->setCellValue('A'.$row, 'Kunjungan ke-' . $k['kunjungan_ke'] . ' - ' . date('d/m/Y', strtotime($k['tanggal_kunjungan'])));
                $sheet->getStyle('A'.$row)->getFont()->setBold(true);
                $sheet->mergeCells('A'.$row.':F'.$row);
                $row++;
                
                if($k['antropometri']) {
                    $sheet->setCellValue('A'.$row, 'Antropometri:');
                    $sheet->setCellValue('B'.$row, 'TD: '.$k['antropometri']['tekanan_darah'].', BB: '.$k['antropometri']['berat_badan'].' kg, TB: '.$k['antropometri']['tinggi_badan'].' cm, LILA: '.$k['antropometri']['lila'].' cm');
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                if($k['keluhan']) {
                    $sheet->setCellValue('A'.$row, 'Keluhan:');
                    $sheet->setCellValue('B'.$row, str_replace(['[', ']', '"'], '', $k['keluhan']['keluhan']));
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                if($k['suplementasi']) {
                    $sheet->setCellValue('A'.$row, 'Suplementasi:');
                    $sheet->setCellValue('B'.$row, $k['suplementasi']['nama_suplemen'].' - '.$k['suplementasi']['status_pemberian'].' ('.$k['suplementasi']['jumlah_tablet'].' tablet, '.$k['suplementasi']['frekuensi'].')');
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                if($k['etnomedisin']) {
                    $sheet->setCellValue('A'.$row, 'Etnomedisin:');
                    if($k['etnomedisin']['menggunakan_obat_tradisional'] == '1') {
                        $sheet->setCellValue('B'.$row, 'Jenis: '.str_replace(['[', ']', '"'], '', $k['etnomedisin']['jenis_obat'] ?? '-').', Tujuan: '.str_replace(['[', ']', '"'], '', $k['etnomedisin']['tujuan_penggunaan'] ?? '-'));
                    } else {
                        $sheet->setCellValue('B'.$row, 'Tidak menggunakan obat tradisional');
                    }
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                $row++;
            }
        }
        elseif ($tab === 'balita') {
            $identitasModel = new \App\Models\MonitoringBalita\MonitoringBalitaIdentitasModel();
            $identitas = $identitasModel->where('monitoring_balita_id', $id)->first();
            $kunjunganBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
            $kunjunganList = $kunjunganBalitaModel->where('monitoring_balita_id', $id)->orderBy('kunjungan_ke', 'ASC')->findAll();
            
            $keluhanModel = new \App\Models\MonitoringBalita\KunjunganBalitaKeluhanModel();
            $giziModel = new \App\Models\MonitoringBalita\KunjunganBalitaGiziModel();
            $kpspModel = new \App\Models\MonitoringBalita\KunjunganBalitaKpspModel();
            $antropometriModel = new \App\Models\MonitoringBalita\KunjunganBalitaAntropometriModel();
            $imunisasiModel = new \App\Models\MonitoringBalita\KunjunganBalitaImunisasiModel();
            $swamedikasModel = new \App\Models\MonitoringBalita\KunjunganBalitaSwamedikasModel();
            
            foreach ($kunjunganList as &$k) {
                $k['keluhan'] = $keluhanModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['gizi'] = $giziModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['kpsp'] = $kpspModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['antropometri'] = $antropometriModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['imunisasi'] = $imunisasiModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['swamedikasi'] = $swamedikasModel->where('kunjungan_balita_id', $k['id'])->first();
            }
            
            $sheet->setCellValue('A1', 'SISTEM MONITORING KESEHATAN E-ASFARM');
            $sheet->mergeCells('A1:F1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            
            $sheet->setCellValue('A2', 'LAPORAN DETAIL MONITORING BALITA & ANAK');
            $sheet->mergeCells('A2:F2');
            $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
            
            $row = 4;
            $sheet->setCellValue('A'.$row, 'Padukuhan:');
            $sheet->setCellValue('B'.$row, $adminPadukuhan);
            $sheet->setCellValue('D'.$row, 'Dicetak oleh:');
            $sheet->setCellValue('E'.$row, $adminName);
            $row++;
            $sheet->setCellValue('A'.$row, 'No. HP Admin:');
            $sheet->setCellValue('B'.$row, $adminPhone);
            $sheet->setCellValue('D'.$row, 'Tanggal:');
            $sheet->setCellValue('E'.$row, date('d/m/Y H:i:s'));
            
            $row += 2;
            $sheet->setCellValue('A'.$row, 'DATA IDENTITAS');
            $sheet->getStyle('A'.$row)->getFont()->setBold(true)->setSize(12);
            $row++;
            $sheet->setCellValue('A'.$row, 'Nama Anak');
            $sheet->setCellValue('B'.$row, $identitas['nama_anak'] ?? '-');
            $sheet->setCellValue('D'.$row, 'Tanggal Lahir');
            $sheet->setCellValue('E'.$row, isset($identitas['tanggal_lahir']) ? date('d/m/Y', strtotime($identitas['tanggal_lahir'])) : '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'Jenis Kelamin');
            $sheet->setCellValue('B'.$row, $identitas['jenis_kelamin'] ?? '-');
            $sheet->setCellValue('D'.$row, 'Nama Wali');
            $sheet->setCellValue('E'.$row, $identitas['nama_wali'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'No. HP Wali');
            $sheet->setCellValue('B'.$row, $identitas['no_hp_wali'] ?? '-');
            
            $row += 2;
            $sheet->setCellValue('A'.$row, 'RIWAYAT KUNJUNGAN (' . count($kunjunganList) . ' Kunjungan)');
            $sheet->getStyle('A'.$row)->getFont()->setBold(true)->setSize(12);
            $row++;
            
            foreach ($kunjunganList as $kb) {
                $sheet->setCellValue('A'.$row, 'Kunjungan ke-' . $kb['kunjungan_ke'] . ' - ' . date('d/m/Y', strtotime($kb['tanggal_kunjungan'])));
                $sheet->getStyle('A'.$row)->getFont()->setBold(true);
                $sheet->mergeCells('A'.$row.':F'.$row);
                $row++;
                
                if($kb['antropometri']) {
                    $sheet->setCellValue('A'.$row, 'Antropometri:');
                    $sheet->setCellValue('B'.$row, 'BB: '.$kb['antropometri']['berat_badan'].' kg, TB: '.$kb['antropometri']['tinggi_badan'].' cm, LK: '.($kb['antropometri']['lingkar_kepala'] ?? '-').' cm');
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                if($kb['keluhan']) {
                    $keluhanList = [];
                    if($kb['keluhan']['batuk']) $keluhanList[] = 'Batuk';
                    if($kb['keluhan']['pilek']) $keluhanList[] = 'Pilek';
                    if($kb['keluhan']['demam']) $keluhanList[] = 'Demam';
                    if($kb['keluhan']['diare']) $keluhanList[] = 'Diare';
                    if($kb['keluhan']['sembelit']) $keluhanList[] = 'Sembelit';
                    if($kb['keluhan']['gtm']) $keluhanList[] = 'GTM';
                    $sheet->setCellValue('A'.$row, 'Keluhan:');
                    $sheet->setCellValue('B'.$row, !empty($keluhanList) ? implode(', ', $keluhanList) : 'Tidak ada');
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                if($kb['gizi']) {
                    $sheet->setCellValue('A'.$row, 'Data Gizi:');
                    $sheet->setCellValue('B'.$row, 'Vitamin A: '.($kb['gizi']['vitamin_a'] ? 'Ya' : 'Tidak').', Obat Cacing: '.($kb['gizi']['obat_cacing'] ? 'Ya' : 'Tidak'));
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                $row++;
            }
        }
        elseif ($tab === 'remaja') {
            $identitasModel = new \App\Models\MonitoringRemaja\MonitoringRemajaIdentitasModel();
            $identitas = $identitasModel->where('monitoring_id', $id)->first();
            $kunjunganRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
            $kunjunganList = $kunjunganRemajaModel->where('monitoring_id', $id)->orderBy('kunjungan_ke', 'ASC')->findAll();
            
            $anemiaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaAnemiaModel();
            $haidModel = new \App\Models\MonitoringRemaja\KunjunganRemajaHaidModel();
            $suplementasiModel = new \App\Models\MonitoringRemaja\KunjunganRemajaSuplementasiModel();
            $antropometriModel = new \App\Models\MonitoringRemaja\KunjunganRemajaAntropometriModel();
            $gayaHidupModel = new \App\Models\MonitoringRemaja\KunjunganRemajaGayaHidupModel();
            $swamedikasModel = new \App\Models\MonitoringRemaja\KunjunganRemajaSwamedikasModel();
            
            foreach ($kunjunganList as &$k) {
                $k['anemia'] = $anemiaModel->where('kunjungan_id', $k['id'])->first();
                $k['haid'] = $haidModel->where('kunjungan_id', $k['id'])->first();
                $k['suplementasi'] = $suplementasiModel->where('kunjungan_id', $k['id'])->first();
                $k['antropometri'] = $antropometriModel->where('kunjungan_id', $k['id'])->first();
                $k['gaya_hidup'] = $gayaHidupModel->where('kunjungan_id', $k['id'])->first();
                $k['swamedikasi'] = $swamedikasModel->where('kunjungan_id', $k['id'])->first();
            }
            
            $sheet->setCellValue('A1', 'SISTEM MONITORING KESEHATAN E-ASFARM');
            $sheet->mergeCells('A1:F1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            
            $sheet->setCellValue('A2', 'LAPORAN DETAIL MONITORING REMAJA');
            $sheet->mergeCells('A2:F2');
            $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
            
            $row = 4;
            $sheet->setCellValue('A'.$row, 'Padukuhan:');
            $sheet->setCellValue('B'.$row, $adminPadukuhan);
            $sheet->setCellValue('D'.$row, 'Dicetak oleh:');
            $sheet->setCellValue('E'.$row, $adminName);
            $row++;
            $sheet->setCellValue('A'.$row, 'No. HP Admin:');
            $sheet->setCellValue('B'.$row, $adminPhone);
            $sheet->setCellValue('D'.$row, 'Tanggal:');
            $sheet->setCellValue('E'.$row, date('d/m/Y H:i:s'));
            
            $row += 2;
            $sheet->setCellValue('A'.$row, 'DATA IDENTITAS');
            $sheet->getStyle('A'.$row)->getFont()->setBold(true)->setSize(12);
            $row++;
            $sheet->setCellValue('A'.$row, 'Nama Lengkap');
            $sheet->setCellValue('B'.$row, $identitas['nama_lengkap'] ?? '-');
            $sheet->setCellValue('D'.$row, 'NIK');
            $sheet->setCellValue('E'.$row, $identitas['nik'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'Tanggal Lahir');
            $sheet->setCellValue('B'.$row, isset($identitas['tanggal_lahir']) ? date('d/m/Y', strtotime($identitas['tanggal_lahir'])) : '-');
            $sheet->setCellValue('D'.$row, 'Jenis Kelamin');
            $sheet->setCellValue('E'.$row, isset($identitas['jenis_kelamin']) ? ($identitas['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') : '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'Nama Wali');
            $sheet->setCellValue('B'.$row, $identitas['nama_wali'] ?? '-');
            $sheet->setCellValue('D'.$row, 'No. HP Wali');
            $sheet->setCellValue('E'.$row, $identitas['no_hp_wali'] ?? '-');
            
            $row += 2;
            $sheet->setCellValue('A'.$row, 'RIWAYAT KUNJUNGAN (' . count($kunjunganList) . ' Kunjungan)');
            $sheet->getStyle('A'.$row)->getFont()->setBold(true)->setSize(12);
            $row++;
            
            foreach ($kunjunganList as $kr) {
                $sheet->setCellValue('A'.$row, 'Kunjungan ke-' . $kr['kunjungan_ke'] . ' - ' . date('d/m/Y', strtotime($kr['tanggal_kunjungan'])));
                $sheet->getStyle('A'.$row)->getFont()->setBold(true);
                $sheet->mergeCells('A'.$row.':F'.$row);
                $row++;
                
                if($kr['antropometri']) {
                    $sheet->setCellValue('A'.$row, 'Antropometri:');
                    $sheet->setCellValue('B'.$row, 'BB: '.$kr['antropometri']['berat_badan'].' kg, TB: '.$kr['antropometri']['tinggi_badan'].' cm, TD: '.$kr['antropometri']['tekanan_darah'].', LP: '.($kr['antropometri']['lingkar_perut'] ?? '-').' cm');
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                if($kr['anemia']) {
                    $sheet->setCellValue('A'.$row, 'Gejala Anemia:');
                    $sheet->setCellValue('B'.$row, str_replace(['[', ']', '"'], '', $kr['anemia']['gejala_anemia'] ?? 'Tidak ada'));
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                if($kr['suplementasi']) {
                    $sheet->setCellValue('A'.$row, 'Suplementasi:');
                    $sheet->setCellValue('B'.$row, 'Dapat TTD: '.($kr['suplementasi']['dapat_ttd'] ? 'Ya' : 'Tidak').', Minum TTD: '.($kr['suplementasi']['minum_ttd'] ? 'Ya' : 'Tidak').', Sarapan: '.($kr['suplementasi']['kebiasaan_sarapan'] ?? '-'));
                    $sheet->mergeCells('B'.$row.':F'.$row);
                    $row++;
                }
                $row++;
            }
        }
        
        // Footer
        $row += 2;
        $sheet->setCellValue('A'.$row, 'Dokumen ini dicetak secara otomatis dari Sistem Monitoring Kesehatan e-Asfarm.');
        $sheet->mergeCells('A'.$row.':F'.$row);
        $sheet->getStyle('A'.$row)->getFont()->setSize(9)->setItalic(true);
        $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');
        $row++;
        $sheet->setCellValue('A'.$row, 'Untuk informasi lebih lanjut, hubungi admin yang tertera di atas.');
        $sheet->mergeCells('A'.$row.':F'.$row);
        $sheet->getStyle('A'.$row)->getFont()->setSize(9)->setItalic(true);
        $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');
        
        foreach(range('A','F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Detail_' . ucwords(str_replace('-', '_', $tab)) . '_' . $id . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }

    public function exportDetailPdf($tab, $id)
    {
        $adminInfo = $this->getAdminInfo();
        extract($adminInfo);
        
        $data = [];
        $kunjungan = [];
        
        if ($tab === 'ibu-hamil') {
            // Get identitas
            $identitasModel = new \App\Models\Monitoring\MonitoringIdentitasModel();
            $identitas = $identitasModel->where('monitoring_id', $id)->first();
            
            // Get riwayat penyakit
            $riwayatModel = new \App\Models\Monitoring\MonitoringRiwayatPenyakitModel();
            $riwayat = $riwayatModel->where('monitoring_id', $id)->first();
            
            // Get skrining
            $skriningModel = new \App\Models\Monitoring\MonitoringSkriningModel();
            $skrining = $skriningModel->where('monitoring_id', $id)->first();
            
            // Get all kunjungan with details
            $kunjunganModel = new \App\Models\Monitoring\KunjunganModel();
            $kunjunganList = $kunjunganModel->getWithDetails($id);
        }
        elseif ($tab === 'balita') {
            // Get identitas
            $identitasModel = new \App\Models\MonitoringBalita\MonitoringBalitaIdentitasModel();
            $identitas = $identitasModel->where('monitoring_balita_id', $id)->first();
            
            // Get all kunjungan with details
            $kunjunganBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
            $kunjunganList = $kunjunganBalitaModel->where('monitoring_balita_id', $id)->orderBy('kunjungan_ke', 'ASC')->findAll();
            
            // Attach details to each kunjungan
            $keluhanModel = new \App\Models\MonitoringBalita\KunjunganBalitaKeluhanModel();
            $giziModel = new \App\Models\MonitoringBalita\KunjunganBalitaGiziModel();
            $kpspModel = new \App\Models\MonitoringBalita\KunjunganBalitaKpspModel();
            $antropometriModel = new \App\Models\MonitoringBalita\KunjunganBalitaAntropometriModel();
            $imunisasiModel = new \App\Models\MonitoringBalita\KunjunganBalitaImunisasiModel();
            $swamedikasModel = new \App\Models\MonitoringBalita\KunjunganBalitaSwamedikasModel();
            
            foreach ($kunjunganList as &$k) {
                $k['keluhan'] = $keluhanModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['gizi'] = $giziModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['kpsp'] = $kpspModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['antropometri'] = $antropometriModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['imunisasi'] = $imunisasiModel->where('kunjungan_balita_id', $k['id'])->first();
                $k['swamedikasi'] = $swamedikasModel->where('kunjungan_balita_id', $k['id'])->first();
            }
        }
        elseif ($tab === 'remaja') {
            // Get identitas
            $identitasModel = new \App\Models\MonitoringRemaja\MonitoringRemajaIdentitasModel();
            $identitas = $identitasModel->where('monitoring_id', $id)->first();
            
            // Get all kunjungan with details
            $kunjunganRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
            $kunjunganList = $kunjunganRemajaModel->where('monitoring_id', $id)->orderBy('kunjungan_ke', 'ASC')->findAll();
            
            // Attach details to each kunjungan
            $anemiaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaAnemiaModel();
            $haidModel = new \App\Models\MonitoringRemaja\KunjunganRemajaHaidModel();
            $suplementasiModel = new \App\Models\MonitoringRemaja\KunjunganRemajaSuplementasiModel();
            $antropometriModel = new \App\Models\MonitoringRemaja\KunjunganRemajaAntropometriModel();
            $gayaHidupModel = new \App\Models\MonitoringRemaja\KunjunganRemajaGayaHidupModel();
            $swamedikasModel = new \App\Models\MonitoringRemaja\KunjunganRemajaSwamedikasModel();
            
            foreach ($kunjunganList as &$k) {
                $k['anemia'] = $anemiaModel->where('kunjungan_id', $k['id'])->first();
                $k['haid'] = $haidModel->where('kunjungan_id', $k['id'])->first();
                $k['suplementasi'] = $suplementasiModel->where('kunjungan_id', $k['id'])->first();
                $k['antropometri'] = $antropometriModel->where('kunjungan_id', $k['id'])->first();
                $k['gaya_hidup'] = $gayaHidupModel->where('kunjungan_id', $k['id'])->first();
                $k['swamedikasi'] = $swamedikasModel->where('kunjungan_id', $k['id'])->first();
            }
        }
        
        $html = view('admin/monitoring/laporan_detail_pdf', [
            'tab' => $tab,
            'identitas' => $identitas ?? [],
            'riwayat' => $riwayat ?? null,
            'skrining' => $skrining ?? null,
            'kunjunganList' => $kunjunganList ?? [],
            'adminName' => $adminName,
            'adminPhone' => $adminPhone,
            'adminPadukuhan' => $adminPadukuhan
        ]);
        
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $filename = 'Detail_' . ucwords(str_replace('-', '_', $tab)) . '_' . $id . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);
    }

}






