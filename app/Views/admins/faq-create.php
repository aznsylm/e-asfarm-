<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Form Tanya Jawab</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="./">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Form Tambah Tanya Jawab Baru
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
                        <form method="post" action="<?= site_url('admin/simpan-tanya-jawab') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="form-label" for="category_id">Pilih Kategori Dahulu</label>
                                    <select class="form-select" name="category_id">
                                        <?php foreach ($tanyaJawabKategori as $kategori): ?>
                                            <option value="<?= $kategori['id'] ?>"><?= $kategori['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="tb-fname" placeholder="Tambahkan pertanyaan disini" name="pertanyaan" />
                                        <label for="tb-fname">Pertanyaan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="editor">
                                                <p>Isi jawaban pertanyaan</p>
                                                <p>Beberapa teks <strong>tebal</strong> awal</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden Input untuk Body Artikel -->
                                <input type="hidden" name="jawaban" id="body" />

                                <div class="col-12">
                                    <div class="d-md-flex align-items-center">
                                        <div class="ms-auto mt-3 mt-md-0">
                                            <button type="submit" name="submit" class="btn btn-primary hstack gap-6">
                                                <i class="ti ti-send fs-4"></i>
                                                Simpan
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
    // Pastikan ini dijalankan setelah editor Anda diinisialisasi
    document.querySelector('form').addEventListener('submit', function() {
        var bodyContent = document.getElementById('editor').innerHTML; // Ambil konten editor
        document.getElementById('body').value = bodyContent; // Masukkan ke dalam hidden input
    });
</script>





<?= $this->endSection(); ?>