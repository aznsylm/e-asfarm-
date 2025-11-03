<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="comment-form-wrap pt-5">

        <?php if (session()->getFlashdata('create')) : ?>
            <p class="alert alert-success"><?php echo session()->getFlashdata('create'); ?></p>
        <?php endif; ?>

        <h3 class="mb-5">Edit Artikel</h3>
        <form action="<?= route_to('artikel.perbarui', $edPost['id']) ?>" method="POST" class="p-5 bg-light" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Judul *</label>
                <input type="text" name="title" class="form-control" value="<?= esc($edPost['title']) ?>" required>
            </div>

            <div class="form-group">
                <label>Kategori *</label>
                <select name="category" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Farmasi" <?= $edPost['category'] === 'Farmasi' ? 'selected' : '' ?>>Farmasi</option>
                    <option value="Gizi" <?= $edPost['category'] === 'Gizi' ? 'selected' : '' ?>>Gizi</option>
                    <option value="Bidan" <?= $edPost['category'] === 'Bidan' ? 'selected' : '' ?>>Bidan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Gambar Saat Ini</label><br>
                <?php 
                $imgPath = file_exists(FCPATH.'uploads/articles/'.$edPost['image']) ? 'uploads/articles/'.$edPost['image'] : 'assets/images/blog/'.$edPost['image'];
                ?>
                <img src="<?= base_url($imgPath) ?>" width="200" class="mb-2" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22150%22%3E%3Crect fill=%22%23ddd%22 width=%22200%22 height=%22150%22/%3E%3C/svg%3E'">
                <label>Ganti Gambar (Opsional) 
                    <i class="bi bi-question-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Format: JPG, JPEG, PNG, WEBP | Maksimal: 2MB | Resolusi disarankan: 1200x630px"></i>
                </label>
                <input type="file" name="image" class="form-control" accept="image/jpeg,image/jpg,image/png,image/webp">
                <small class="text-muted"><i class="bi bi-info-circle"></i> Format: JPG, PNG, WEBP | Max: 2MB</small>
            </div>

            <div class="form-group">
                <label for="content">Isi Artikel *</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control" required><?= esc($edPost['content']) ?></textarea>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Update Post" class="btn btn-primary">
            </div>

        </form>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    CKEDITOR.replace('content', {
        height: 400,
        removeButtons: 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,Blockquote,BidiLtr,BidiRtl,Language,Unlink,Anchor,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Maximize,ShowBlocks,About'
    });
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>


<?= $this->endSection(); ?>