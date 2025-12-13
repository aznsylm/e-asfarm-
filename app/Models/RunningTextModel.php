<?php

namespace App\Models;

use CodeIgniter\Model;

class RunningTextModel extends Model
{
    protected $table = 'running_text_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['item_type', 'item_id', 'display_order', 'is_active'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getRunningTextItems()
    {
        return $this->select('running_text_items.*, posters.title as poster_title, posters.link_drive as poster_link, moduls.title as modul_title, moduls.link_drive as modul_link')
            ->join('posters', 'posters.id = running_text_items.item_id AND running_text_items.item_type = "poster"', 'left')
            ->join('moduls', 'moduls.id = running_text_items.item_id AND running_text_items.item_type = "modul"', 'left')
            ->where('running_text_items.is_active', 1)
            ->orderBy('running_text_items.display_order', 'ASC')
            ->limit(5)
            ->findAll();
    }
}
