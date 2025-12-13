<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kelola Running Text Homepage</h3>
        <p class="card-text text-muted mb-0"><small>Pilih maksimal 5 poster/modul untuk ditampilkan di running text homepage</small></p>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Selected Items -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Item Terpilih (<?= count($selectedItems) ?>/5)</h5>
                        <small class="text-muted">Drag untuk mengubah urutan tampilan</small>
                    </div>
                    <div class="card-body p-0">
                        <div id="selected-items" class="list-group list-group-flush" style="min-height: 200px;">
                            <?php if(empty($selectedItems)): ?>
                                <div class="list-group-item text-center text-muted py-5">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>Belum ada item terpilih</p>
                                </div>
                            <?php else: ?>
                                <?php foreach($selectedItems as $item): ?>
                                    <div class="list-group-item d-flex align-items-center" data-type="<?= $item['item_type'] ?>" data-id="<?= $item['item_id'] ?>">
                                        <i class="fas fa-grip-vertical text-muted mr-3" style="cursor: move;"></i>
                                        <span class="badge badge-<?= $item['item_type'] == 'poster' ? 'primary' : 'success' ?> mr-2"><?= strtoupper($item['item_type']) ?></span>
                                        <span class="flex-grow-1">
                                            <?php if($item['item_type'] == 'poster'): ?>
                                                <?php 
                                                $poster = (new \App\Models\PosterModel())->find($item['item_id']);
                                                echo esc($poster['title'] ?? 'Item tidak ditemukan');
                                                ?>
                                            <?php else: ?>
                                                <?php 
                                                $modul = (new \App\Models\ModulModel())->find($item['item_id']);
                                                echo esc($modul['title'] ?? 'Item tidak ditemukan');
                                                ?>
                                            <?php endif; ?>
                                        </span>
                                        <button type="button" class="btn btn-sm btn-danger remove-item ml-2">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="save-btn" class="btn btn-primary btn-block">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Available Items -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Daftar Poster & Modul</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" id="search-items" class="form-control" placeholder="Cari poster atau modul...">
                        </div>
                        <div id="available-items" style="max-height: 450px; overflow-y: auto;">
                            <h6 class="text-primary border-bottom pb-2">Poster</h6>
                            <?php if(empty($posters)): ?>
                                <p class="text-muted text-center py-3">Tidak ada poster tersedia</p>
                            <?php else: ?>
                                <?php foreach($posters as $poster): ?>
                                    <div class="list-group-item list-group-item-action available-item d-flex align-items-center" data-type="poster" data-id="<?= $poster['id'] ?>" data-title="<?= esc($poster['title']) ?>">
                                        <span class="badge badge-primary mr-2">POSTER</span>
                                        <span class="flex-grow-1"><?= esc($poster['title']) ?></span>
                                        <button type="button" class="btn btn-sm btn-success add-item">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <h6 class="text-success border-bottom pb-2 mt-4"><i class="fas fa-book"></i> Modul</h6>
                            <?php if(empty($moduls)): ?>
                                <p class="text-muted text-center py-3">Tidak ada modul tersedia</p>
                            <?php else: ?>
                                <?php foreach($moduls as $modul): ?>
                                    <div class="list-group-item list-group-item-action available-item d-flex align-items-center" data-type="modul" data-id="<?= $modul['id'] ?>" data-title="<?= esc($modul['title']) ?>">
                                        <span class="badge badge-success mr-2">MODUL</span>
                                        <span class="flex-grow-1"><?= esc($modul['title']) ?></span>
                                        <button type="button" class="btn btn-sm btn-success add-item">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectedContainer = document.getElementById('selected-items');
    const availableContainer = document.getElementById('available-items');
    const searchInput = document.getElementById('search-items');
    const saveBtn = document.getElementById('save-btn');

    // Sortable for drag & drop
    new Sortable(selectedContainer, {
        animation: 150,
        handle: '.fa-grip-vertical',
        ghostClass: 'bg-light'
    });

    // Add item
    availableContainer.addEventListener('click', function(e) {
        if (e.target.closest('.add-item')) {
            const item = e.target.closest('.available-item');
            const count = selectedContainer.children.length;
            
            if (count >= 5) {
                alert('Maksimal 5 item!');
                return;
            }

            const type = item.dataset.type;
            const id = item.dataset.id;
            const title = item.dataset.title;
            
            // Check duplicate
            const exists = Array.from(selectedContainer.children).some(el => 
                el.dataset.type === type && el.dataset.id === id
            );
            
            if (exists) {
                alert('Item sudah dipilih!');
                return;
            }

            const newItem = document.createElement('div');
            newItem.className = 'list-group-item';
            newItem.dataset.type = type;
            newItem.dataset.id = id;
            newItem.innerHTML = `
                <i class="fas fa-grip-vertical me-2"></i>
                <span class="badge bg-${type === 'poster' ? 'primary' : 'success'}">${type.toUpperCase()}</span>
                ${title}
                <button type="button" class="btn btn-sm btn-danger float-end remove-item">
                    <i class="fas fa-times"></i>
                </button>
            `;
            selectedContainer.appendChild(newItem);
        }
    });

    // Remove item
    selectedContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-item')) {
            e.target.closest('.list-group-item').remove();
        }
    });

    // Search
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.available-item').forEach(item => {
            const title = item.dataset.title.toLowerCase();
            item.style.display = title.includes(query) ? '' : 'none';
        });
    });

    // Save
    saveBtn.addEventListener('click', function() {
        const items = Array.from(selectedContainer.children).map(el => ({
            type: el.dataset.type,
            id: el.dataset.id
        }));

        if (items.length === 0) {
            alert('Pilih minimal 1 item!');
            return;
        }

        fetch('<?= base_url('admin/kelola-running-text/save') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'items=' + encodeURIComponent(JSON.stringify(items))
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Running text berhasil disimpan!');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan!');
            console.error(error);
        });
    });
});
</script>

<style>
#selected-items .list-group-item {
    cursor: move;
    user-select: none;
    transition: background-color 0.2s;
}
#selected-items .list-group-item:hover {
    background-color: #f8f9fa;
}
.available-item {
    cursor: pointer;
    transition: all 0.2s;
}
.available-item:hover {
    background-color: #e9ecef;
}
.fa-grip-vertical {
    cursor: move;
}
.badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}
</style>

<?= $this->endSection() ?>
