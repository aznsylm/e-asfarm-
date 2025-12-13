<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\RunningTextModel;
use App\Models\PosterModel;
use App\Models\ModulModel;

class RunningTextController extends BaseController
{
    public function index()
    {
        // Check superadmin role
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak');
        }

        $runningTextModel = new RunningTextModel();
        $posterModel = new PosterModel();
        $modulModel = new ModulModel();

        $selectedItems = $runningTextModel->orderBy('display_order', 'ASC')->findAll();
        $posters = $posterModel->findAll();
        $moduls = $modulModel->findAll();
        $title = 'Kelola Running Text';

        return view('admin/running-text/index', compact('selectedItems', 'posters', 'moduls', 'title'));
    }

    public function save()
    {
        // Check superadmin role
        if (session()->get('role') !== 'superadmin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak']);
        }

        $itemsJson = $this->request->getPost('items');
        $items = json_decode($itemsJson, true);

        if (!$items || !is_array($items) || count($items) > 5) {
            return $this->response->setJSON(['success' => false, 'message' => 'Maksimal 5 item']);
        }

        $runningTextModel = new RunningTextModel();
        
        // Delete all existing items
        $runningTextModel->where('id >', 0)->delete();

        // Insert new items
        foreach ($items as $index => $item) {
            $runningTextModel->insert([
                'item_type' => $item['type'],
                'item_id' => $item['id'],
                'display_order' => $index + 1,
                'is_active' => 1
            ]);
        }

        return $this->response->setJSON(['success' => true, 'message' => 'Running text berhasil disimpan']);
    }
}
