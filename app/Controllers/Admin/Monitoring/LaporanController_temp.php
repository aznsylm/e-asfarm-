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
        $db = \Config\Database::connect();
        
        if ($tab === 'ibu-hamil') {
            // Get monitoring IDs that have kunjungan in selected month/year
            $subQuery = $db->table('kunjungan')
                ->distinct()
                ->select('monitoring_id')
                ->where('MONTH(tanggal_kunjungan)', $bulan)
                ->where('YEAR(tanggal_kunjungan)', $tahun)
                ->getCompiledSelect();
            
            $builder = $this->monitoringModel->select('monitoring_ibu_hamil.*, monitoring_identitas.nama_ibu, monitoring_identitas.usia_kehamilan, monitoring_identitas.rencana_tanggal_persalinan, users.username')
                ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
                ->join('monitoring_identitas', 'monitoring_identitas.monitoring_id = monitoring_ibu_hamil.id', 'left')
                ->where('monitoring_ibu_hamil.status', 'active')
                ->where("monitoring_ibu_hamil.id IN ($subQuery)", null, false);
            
            if ($padukuhanId) {
                $builder->where('users.padukuhan_id', $padukuhanId);
            }
            
            if ($search) {
                $builder->like('monitoring_identitas.nama_ibu', $search);
            }
            
            return $builder->paginate($perPage);
        } 
        elseif ($tab === 'balita') {
            // Get monitoring IDs that have kunjungan in selected month/year
            $subQuery = $db->table('kunjungan_balita')
                ->distinct()
                ->select('monitoring_balita_id')
                ->where('MONTH(tanggal_kunjungan)', $bulan)
                ->where('YEAR(tanggal_kunjungan)', $tahun)
                ->getCompiledSelect();
            
            $builder = $this->balitaModel->select('monitoring_balita.*, monitoring_balita_identitas.nama_anak, monitoring_balita_identitas.tanggal_lahir, users.username')
                ->join('users', 'users.id = monitoring_balita.user_id')
                ->join('monitoring_balita_identitas', 'monitoring_balita_identitas.monitoring_balita_id = monitoring_balita.id', 'left')
                ->where("monitoring_balita.id IN ($subQuery)", null, false);
            
            if ($padukuhanId) {
                $builder->where('users.padukuhan_id', $padukuhanId);
            }
            
            if ($search) {
                $builder->like('monitoring_balita_identitas.nama_anak', $search);
            }
            
            return $builder->paginate($perPage);
        }
        elseif ($tab === 'remaja') {
            // Get monitoring IDs that have kunjungan in selected month/year
            $subQuery = $db->table('kunjungan_remaja')
                ->distinct()
                ->select('monitoring_id')
                ->where('MONTH(tanggal_kunjungan)', $bulan)
                ->where('YEAR(tanggal_kunjungan)', $tahun)
                ->getCompiledSelect();
            
            $builder = $this->remajaModel->select('monitoring_remaja.*, monitoring_remaja_identitas.nama_lengkap, monitoring_remaja_identitas.tanggal_lahir, monitoring_remaja_identitas.jenis_kelamin, users.username')
                ->join('users', 'users.id = monitoring_remaja.user_id')
                ->join('monitoring_remaja_identitas', 'monitoring_remaja_identitas.monitoring_id = monitoring_remaja.id', 'left')
                ->where("monitoring_remaja.id IN ($subQuery)", null, false);
            
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
        $db = \Config\Database::connect();
        
        if ($tab === 'ibu-hamil') {
            $subQuery = $db->table('kunjungan')
                ->distinct()
                ->select('monitoring_id')
                ->where('MONTH(tanggal_kunjungan)', $bulan)
                ->where('YEAR(tanggal_kunjungan)', $tahun)
                ->getCompiledSelect();
            
            $builder = $this->monitoringModel->select('monitoring_ibu_hamil.*, monitoring_identitas.nama_ibu, monitoring_identitas.usia_kehamilan, monitoring_identitas.rencana_tanggal_persalinan, users.username')
                ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
                ->join('monitoring_identitas', 'monitoring_identitas.monitoring_id = monitoring_ibu_hamil.id', 'left')
                ->where('monitoring_ibu_hamil.status', 'active')
                ->where("monitoring_ibu_hamil.id IN ($subQuery)", null, false);
            
            if ($padukuhanId) $builder->where('users.padukuhan_id', $padukuhanId);
            if ($search) $builder->like('monitoring_identitas.nama_ibu', $search);
            
            return $builder->findAll();
        } 
        elseif ($tab === 'balita') {
            $subQuery = $db->table('kunjungan_balita')
                ->distinct()
                ->select('monitoring_balita_id')
                ->where('MONTH(tanggal_kunjungan)', $bulan)
                ->where('YEAR(tanggal_kunjungan)', $tahun)
                ->getCompiledSelect();
            
            $builder = $this->balitaModel->select('monitoring_balita.*, monitoring_balita_identitas.nama_anak, monitoring_balita_identitas.tanggal_lahir, users.username')
                ->join('users', 'users.id = monitoring_balita.user_id')
                ->join('monitoring_balita_identitas', 'monitoring_balita_identitas.monitoring_balita_id = monitoring_balita.id', 'left')
                ->where("monitoring_balita.id IN ($subQuery)", null, false);
            
            if ($padukuhanId) $builder->where('users.padukuhan_id', $padukuhanId);
            if ($search) $builder->like('monitoring_balita_identitas.nama_anak', $search);
            
            return $builder->findAll();
        }
        elseif ($tab === 'remaja') {
            $subQuery = $db->table('kunjungan_remaja')
                ->distinct()
                ->select('monitoring_id')
                ->where('MONTH(tanggal_kunjungan)', $bulan)
                ->where('YEAR(tanggal_kunjungan)', $tahun)
                ->getCompiledSelect();
            
            $builder = $this->remajaModel->select('monitoring_remaja.*, monitoring_remaja_identitas.nama_lengkap, monitoring_remaja_identitas.tanggal_lahir, monitoring_remaja_identitas.jenis_kelamin, users.username')
                ->join('users', 'users.id = monitoring_remaja.user_id')
                ->join('monitoring_remaja_identitas', 'monitoring_remaja_identitas.monitoring_id = monitoring_remaja.id', 'left')
                ->where("monitoring_remaja.id IN ($subQuery)", null, false);
            
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
        $tab = $this->request->getGet('tab') ?? 'ibu-hamil';
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $search = $this->request->getGet('search') ?? '';
        
        $dataList = $this->getAllDataForExport($tab, $padukuhanId, $bulan, $tahun, $search);
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Header
        $sheet->setCellValue('A1', 'LAPORAN MONITORING KESEHATAN');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        
        $sheet->setCellValue('A2', 'Periode: ' . date('F', mktime(0,0,0,$bulan,1)) . ' ' . $tahun);
        $sheet->mergeCells('A2:G2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
        
        // Table headers
        $row = 4;
        if ($tab === 'ibu-hamil') {
            $sheet->setCellValue('A'.$row, 'No');
            $sheet->setCellValue('B'.$row, 'Nama Ibu');
            $sheet->setCellValue('C'.$row, 'Usia Kehamilan');
            $sheet->setCellValue('D'.$row, 'Trimester');
            $sheet->setCellValue('E'.$row, 'HPL');
            $sheet->setCellValue('F'.$row, 'Kunjungan Bulan Ini');
            $sheet->setCellValue('G'.$row, 'Total Kunjungan');
            $sheet->setCellValue('H'.$row, 'Status');
            
            $row++;
            $no = 1;
            foreach ($dataList as $d) {
                $totalKunjungan = $this->kunjunganModel->where('monitoring_id', $d['id'])->countAllResults();
                $kunjunganBulanIni = $this->kunjunganModel->where('monitoring_id', $d['id'])
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
        }
        elseif ($tab === 'balita') {
            $sheet->setCellValue('A'.$row, 'No');
            $sheet->setCellValue('B'.$row, 'Nama Anak');
            $sheet->setCellValue('C'.$row, 'Usia');
            $sheet->setCellValue('D'.$row, 'Kunjungan Bulan Ini');
            $sheet->setCellValue('E'.$row, 'Total Kunjungan');
            $sheet->setCellValue('F'.$row, 'Status Gizi');
            
            $row++;
            $no = 1;
            $kunjunganBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
            foreach ($dataList as $d) {
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
        }
        elseif ($tab === 'remaja') {
            $sheet->setCellValue('A'.$row, 'No');
            $sheet->setCellValue('B'.$row, 'Nama');
            $sheet->setCellValue('C'.$row, 'Usia');
            $sheet->setCellValue('D'.$row, 'Jenis Kelamin');
            $sheet->setCellValue('E'.$row, 'Kunjungan Bulan Ini');
            $sheet->setCellValue('F'.$row, 'Total Kunjungan');
            $sheet->setCellValue('G'.$row, 'Status Anemia');
            
            $row++;
            $no = 1;
            $kunjunganRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
            foreach ($dataList as $d) {
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
        }
        
        // Auto size columns
        foreach(range('A','H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Laporan_' . ucwords(str_replace('-', '_', $tab)) . '_' . $bulan . '_' . $tahun . '.xlsx';
        
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
        $tab = $this->request->getGet('tab') ?? 'ibu-hamil';
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $search = $this->request->getGet('search') ?? '';
        
        $dataList = $this->getAllDataForExport($tab, $padukuhanId, $bulan, $tahun, $search);
        
        $html = view('admin/monitoring/laporan_pdf', [
            'tab' => $tab,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'dataList' => $dataList,
            'kunjunganModel' => $this->kunjunganModel
        ]);
        
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        
        $filename = 'Laporan_' . ucwords(str_replace('-', '_', $tab)) . '_' . $bulan . '_' . $tahun . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);
    }

    public function exportDetailExcel($tab, $id)
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        if ($tab === 'ibu-hamil') {
            $data = $this->monitoringModel->find($id);
            $kunjungan = $this->kunjunganModel->where('monitoring_id', $id)->orderBy('tanggal_kunjungan', 'ASC')->findAll();
            
            // Header
            $sheet->setCellValue('A1', 'LAPORAN DETAIL MONITORING IBU HAMIL');
            $sheet->mergeCells('A1:F1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            
            // Data Utama
            $row = 3;
            $sheet->setCellValue('A'.$row, 'Nama Ibu:');
            $sheet->setCellValue('B'.$row, $data['nama_ibu'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'NIK:');
            $sheet->setCellValue('B'.$row, $data['nik'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'Usia Kehamilan:');
            $sheet->setCellValue('B'.$row, ($data['usia_kehamilan'] ?? '-') . ' minggu');
            $row++;
            $sheet->setCellValue('A'.$row, 'HPHT:');
            $sheet->setCellValue('B'.$row, isset($data['hpht']) ? date('d/m/Y', strtotime($data['hpht'])) : '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'HPL:');
            $sheet->setCellValue('B'.$row, isset($data['hpl']) ? date('d/m/Y', strtotime($data['hpl'])) : '-');
            
            // Riwayat Kunjungan
            $row += 2;
            $sheet->setCellValue('A'.$row, 'RIWAYAT KUNJUNGAN');
            $sheet->getStyle('A'.$row)->getFont()->setBold(true);
            $row++;
            
            $sheet->setCellValue('A'.$row, 'No');
            $sheet->setCellValue('B'.$row, 'Tanggal');
            $sheet->setCellValue('C'.$row, 'Keluhan');
            $sheet->setCellValue('D'.$row, 'TD');
            $sheet->setCellValue('E'.$row, 'BB');
            $sheet->setCellValue('F'.$row, 'Catatan');
            $sheet->getStyle('A'.$row.':F'.$row)->getFont()->setBold(true);
            
            $row++;
            $no = 1;
            foreach ($kunjungan as $k) {
                $antropometri = $this->antropometriModel->where('kunjungan_id', $k['id'])->first();
                $sheet->setCellValue('A'.$row, $no++);
                $sheet->setCellValue('B'.$row, date('d/m/Y', strtotime($k['tanggal_kunjungan'])));
                $sheet->setCellValue('C'.$row, $k['keluhan'] ?? '-');
                $sheet->setCellValue('D'.$row, $antropometri['tekanan_darah'] ?? '-');
                $sheet->setCellValue('E'.$row, $antropometri['berat_badan'] ?? '-');
                $sheet->setCellValue('F'.$row, $k['catatan'] ?? '-');
                $row++;
            }
        }
        elseif ($tab === 'balita') {
            $data = $this->balitaModel->find($id);
            $kunjunganBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
            $kunjungan = $kunjunganBalitaModel->where('monitoring_balita_id', $id)->orderBy('tanggal_kunjungan', 'ASC')->findAll();
            
            $sheet->setCellValue('A1', 'LAPORAN DETAIL MONITORING BALITA');
            $sheet->mergeCells('A1:F1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            
            $row = 3;
            $sheet->setCellValue('A'.$row, 'Nama Anak:');
            $sheet->setCellValue('B'.$row, $data['nama_anak'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'NIK:');
            $sheet->setCellValue('B'.$row, $data['nik'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'Tanggal Lahir:');
            $sheet->setCellValue('B'.$row, isset($data['tanggal_lahir']) ? date('d/m/Y', strtotime($data['tanggal_lahir'])) : '-');
            
            $row += 2;
            $sheet->setCellValue('A'.$row, 'RIWAYAT KUNJUNGAN');
            $sheet->getStyle('A'.$row)->getFont()->setBold(true);
            $row++;
            
            $sheet->setCellValue('A'.$row, 'No');
            $sheet->setCellValue('B'.$row, 'Tanggal');
            $sheet->setCellValue('C'.$row, 'BB');
            $sheet->setCellValue('D'.$row, 'TB');
            $sheet->setCellValue('E'.$row, 'LK');
            $sheet->setCellValue('F'.$row, 'Catatan');
            $sheet->getStyle('A'.$row.':F'.$row)->getFont()->setBold(true);
            
            $row++;
            $no = 1;
            foreach ($kunjungan as $k) {
                $sheet->setCellValue('A'.$row, $no++);
                $sheet->setCellValue('B'.$row, date('d/m/Y', strtotime($k['tanggal_kunjungan'])));
                $sheet->setCellValue('C'.$row, $k['berat_badan'] ?? '-');
                $sheet->setCellValue('D'.$row, $k['tinggi_badan'] ?? '-');
                $sheet->setCellValue('E'.$row, $k['lingkar_kepala'] ?? '-');
                $sheet->setCellValue('F'.$row, $k['catatan'] ?? '-');
                $row++;
            }
        }
        elseif ($tab === 'remaja') {
            $data = $this->remajaModel->find($id);
            $kunjunganRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
            $kunjungan = $kunjunganRemajaModel->where('monitoring_id', $id)->orderBy('tanggal_kunjungan', 'ASC')->findAll();
            
            $sheet->setCellValue('A1', 'LAPORAN DETAIL MONITORING REMAJA');
            $sheet->mergeCells('A1:F1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            
            $row = 3;
            $sheet->setCellValue('A'.$row, 'Nama:');
            $sheet->setCellValue('B'.$row, $data['nama'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'NIK:');
            $sheet->setCellValue('B'.$row, $data['nik'] ?? '-');
            $row++;
            $sheet->setCellValue('A'.$row, 'Usia:');
            $sheet->setCellValue('B'.$row, ($data['usia'] ?? '-') . ' tahun');
            
            $row += 2;
            $sheet->setCellValue('A'.$row, 'RIWAYAT KUNJUNGAN');
            $sheet->getStyle('A'.$row)->getFont()->setBold(true);
            $row++;
            
            $sheet->setCellValue('A'.$row, 'No');
            $sheet->setCellValue('B'.$row, 'Tanggal');
            $sheet->setCellValue('C'.$row, 'BB');
            $sheet->setCellValue('D'.$row, 'TB');
            $sheet->setCellValue('E'.$row, 'TD');
            $sheet->setCellValue('F'.$row, 'Catatan');
            $sheet->getStyle('A'.$row.':F'.$row)->getFont()->setBold(true);
            
            $row++;
            $no = 1;
            foreach ($kunjungan as $k) {
                $sheet->setCellValue('A'.$row, $no++);
                $sheet->setCellValue('B'.$row, date('d/m/Y', strtotime($k['tanggal_kunjungan'])));
                $sheet->setCellValue('C'.$row, $k['berat_badan'] ?? '-');
                $sheet->setCellValue('D'.$row, $k['tinggi_badan'] ?? '-');
                $sheet->setCellValue('E'.$row, $k['tekanan_darah'] ?? '-');
                $sheet->setCellValue('F'.$row, $k['catatan'] ?? '-');
                $row++;
            }
        }
        
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
        $data = [];
        $kunjungan = [];
        
        if ($tab === 'ibu-hamil') {
            $data = $this->monitoringModel->find($id);
            $kunjungan = $this->kunjunganModel->where('monitoring_id', $id)->orderBy('tanggal_kunjungan', 'ASC')->findAll();
        }
        elseif ($tab === 'balita') {
            $data = $this->balitaModel->find($id);
            $kunjunganBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
            $kunjungan = $kunjunganBalitaModel->where('monitoring_balita_id', $id)->orderBy('tanggal_kunjungan', 'ASC')->findAll();
        }
        elseif ($tab === 'remaja') {
            $data = $this->remajaModel->find($id);
            $kunjunganRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
            $kunjungan = $kunjunganRemajaModel->where('monitoring_id', $id)->orderBy('tanggal_kunjungan', 'ASC')->findAll();
        }
        
        $html = view('admin/monitoring/laporan_detail_pdf', [
            'tab' => $tab,
            'data' => $data,
            'kunjungan' => $kunjungan,
            'antropometriModel' => $this->antropometriModel
        ]);
        
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $filename = 'Detail_' . ucwords(str_replace('-', '_', $tab)) . '_' . $id . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);
    }

}
