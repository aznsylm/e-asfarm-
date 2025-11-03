<?php

namespace App\Controllers\Admin\Monitoring;

use App\Controllers\BaseController;
use App\Models\Monitoring\MonitoringIbuHamilModel;
use App\Models\Monitoring\KunjunganModel;
use App\Models\Monitoring\KunjunganAntropometriModel;
use App\Models\PadukuhanModel;

class LaporanController extends BaseController
{
    protected $monitoringModel;
    protected $kunjunganModel;
    protected $antropometriModel;
    protected $padukuhanModel;

    public function __construct()
    {
        $this->monitoringModel = new MonitoringIbuHamilModel();
        $this->kunjunganModel = new KunjunganModel();
        $this->antropometriModel = new KunjunganAntropometriModel();
        $this->padukuhanModel = new PadukuhanModel();
    }

    public function index()
    {
        $role = session()->get('role');
        $padukuhanId = session()->get('padukuhan_id');
        
        // Get filter from request
        $filterPadukuhan = $this->request->getGet('padukuhan');
        $periode = $this->request->getGet('periode') ?? 'bulan_ini';
        
        // Admin hanya lihat data padukuhan sendiri
        if ($role === 'admin') {
            $filterPadukuhan = $padukuhanId;
        }
        
        // Get date range based on periode
        $dateRange = $this->getDateRange($periode);
        
        // Get statistics
        $stats = $this->getStatistics($filterPadukuhan, $dateRange);
        
        // Get chart data
        $chartData = $this->getChartData($filterPadukuhan, $dateRange);
        
        // Get patient list
        $patientList = $this->getPatientList($filterPadukuhan);
        
        $data = [
            'title' => 'Data Statistik & Laporan',
            'stats' => $stats,
            'chartData' => $chartData,
            'patientList' => $patientList,
            'padukuhanList' => $this->padukuhanModel->findAll(),
            'selectedPadukuhan' => $filterPadukuhan,
            'periode' => $periode,
            'role' => $role
        ];
        
        return view('admin/monitoring/laporan', $data);
    }

    private function getDateRange($periode)
    {
        $today = date('Y-m-d');
        
        switch ($periode) {
            case 'hari_ini':
                return ['start' => $today, 'end' => $today];
            case 'minggu_ini':
                return ['start' => date('Y-m-d', strtotime('monday this week')), 'end' => $today];
            case 'bulan_ini':
                return ['start' => date('Y-m-01'), 'end' => date('Y-m-t')];
            case 'tahun_ini':
                return ['start' => date('Y-01-01'), 'end' => date('Y-12-31')];
            default:
                return ['start' => date('Y-m-01'), 'end' => date('Y-m-t')];
        }
    }

    private function getStatistics($padukuhanId, $dateRange)
    {
        $db = \Config\Database::connect();
        
        // Total pasien aktif
        $builder = $db->table('monitoring_ibu_hamil')
                     ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
                     ->where('monitoring_ibu_hamil.status', 'active');
        
        if ($padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        $totalPasien = $builder->countAllResults();
        
        // Total kunjungan periode ini
        $builder = $db->table('kunjungan')
                     ->join('monitoring_ibu_hamil', 'monitoring_ibu_hamil.id = kunjungan.monitoring_id')
                     ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
                     ->where('kunjungan.tanggal_kunjungan >=', $dateRange['start'])
                     ->where('kunjungan.tanggal_kunjungan <=', $dateRange['end']);
        
        if ($padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        $totalKunjungan = $builder->countAllResults();
        
        // Pasien risiko tinggi (TD > 140/90 atau LILA < 23.5)
        $risikoTinggi = 0; // Simplified for now
        
        return [
            'total_pasien' => $totalPasien,
            'total_kunjungan' => $totalKunjungan,
            'risiko_tinggi' => $risikoTinggi
        ];
    }

    private function getChartData($padukuhanId, $dateRange)
    {
        $db = \Config\Database::connect();
        
        // Get TD data for chart
        $builder = $db->table('kunjungan_antropometri')
                     ->select('kunjungan.tanggal_kunjungan, kunjungan_antropometri.tekanan_darah')
                     ->join('kunjungan', 'kunjungan.id = kunjungan_antropometri.kunjungan_id')
                     ->join('monitoring_ibu_hamil', 'monitoring_ibu_hamil.id = kunjungan.monitoring_id')
                     ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
                     ->where('kunjungan.tanggal_kunjungan >=', $dateRange['start'])
                     ->where('kunjungan.tanggal_kunjungan <=', $dateRange['end']);
        
        if ($padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        $tdData = $builder->orderBy('kunjungan.tanggal_kunjungan', 'ASC')->get()->getResultArray();
        
        // Process TD data
        $labels = [];
        $sistolik = [];
        $diastolik = [];
        
        foreach ($tdData as $row) {
            $labels[] = date('d M', strtotime($row['tanggal_kunjungan']));
            $td = explode('/', $row['tekanan_darah']);
            $sistolik[] = isset($td[0]) ? (int)$td[0] : 0;
            $diastolik[] = isset($td[1]) ? (int)$td[1] : 0;
        }
        
        return [
            'labels' => $labels,
            'sistolik' => $sistolik,
            'diastolik' => $diastolik
        ];
    }

    private function getPatientList($padukuhanId)
    {
        return $this->monitoringModel->getAllWithUserInfo($padukuhanId);
    }

    public function ibuHamil()
    {
        $data = ['title' => 'Laporan Ibu Hamil & Menyusui'];
        return view('admin/laporan/ibu-hamil', $data);
    }

    public function balita()
    {
        $data = ['title' => 'Laporan Balita & Anak'];
        return view('admin/laporan/balita', $data);
    }

    public function remaja()
    {
        $data = ['title' => 'Laporan Remaja'];
        return view('admin/laporan/remaja', $data);
    }
}
