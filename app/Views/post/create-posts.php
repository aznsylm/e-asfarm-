<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="comment-form-wrap pt-5">


        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <h3 class="mb-5">Form Membuat Artikel Baru</h3>
        <form action="<?= route_to('artikel.simpan') ?>" method="POST" class="p-5 bg-light" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="title">Judul *</label>
                <input type="text" placeholder="Judul artikel" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Kategori *</label>
                <select name="category" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Farmasi">Farmasi</option>
                    <option value="Gizi">Gizi</option>
                    <option value="Bidan">Bidan</option>
                </select>
            </div><br>

            <div class="form-group">
                <label for="image">Gambar Utama * 
                    <i class="bi bi-question-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Format: JPG, JPEG, PNG, WEBP | Maksimal: 2MB | Resolusi disarankan: 1200x630px"></i>
                </label>
                <input type="file" name="image" class="form-control" accept="image/jpeg,image/jpg,image/png,image/webp" required>
                <small class="text-muted"><i class="bi bi-info-circle"></i> Format: JPG, PNG, WEBP | Max: 2MB</small>
            </div>

            <div class="form-group">
                <label for="content">Isi Artikel *</label>
                <textarea placeholder="Tulis konten artikel..." name="content" id="content" cols="30" rows="10" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Create Post" class="btn btn-primary">
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
