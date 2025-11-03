<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Form Basic</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="./">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Form Tambah Artikel Baru
                                    </span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3"></h4>
                        <form method="post" action="<?= url_to('posts.update', $post['id']); ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="tb-fname" placeholder="Tambahkan judul disini" name="title" id="website" value="<?= $post['title']; ?>" />
                                        <label for="tb-fname">Judul</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload gambar</label>
                                    <input class="form-control" type="file" name="image" id="formFile" />
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="category">Kategori Artikel</label>
                                    <select class="form-select" name="category">
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category['name']; ?>" <?= ($category['name'] == $post['category']) ? 'selected' : ''; ?>>
                                                <?= esc($category['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="editor">
                                                <?= $post['body']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden Input untuk Body Artikel -->
                                <input type="hidden" name="body" id="body" />

                                <div class="col-12">
                                    <div class="d-md-flex align-items-center">
                                        <div class="ms-auto mt-3 mt-md-0">
                                            <button type="submit" name="submit" class="btn btn-primary hstack gap-6">
                                                <i class="ti ti-send fs-4"></i>
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan JavaScript di bawah sini -->
<script>
    // Isi konten editor dengan data body artikel yang ada
    quill.root.innerHTML = '<?= esc($post['body']); ?>';

    // Pastikan ini dijalankan setelah editor Anda diinisialisasi
    document.querySelector('form').addEventListener('submit', function() {
        var bodyContent = document.getElementById('editor').innerHTML; // Ambil konten editor
        document.getElementById('body').value = bodyContent; // Masukkan ke dalam hidden input
    });
</script>

<?= $this->endSection(); ?>