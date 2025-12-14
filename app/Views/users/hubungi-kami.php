<?= $this->extend('layouts/user_layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background:#047d78;color:#fff;">
                <h3 class="card-title"><i class="fas fa-phone-alt"></i> Hubungi Tenaga Ahli Kami</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Jika Anda memiliki pertanyaan atau membutuhkan konsultasi kesehatan, silakan hubungi tenaga ahli kami melalui kontak di bawah ini:</p>
            </div>
        </div>
    </div>
</div>



<?php if (isset($adminContacts) && !empty($adminContacts)): ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background:#047d78;color:#fff;">
                <h3 class="card-title">Admin Padukuhan <?= esc($padukuhanName) ?></h3>
            </div>
            <div class="card-body">
                <?php foreach ($adminContacts as $admin): ?>
                <div class="row align-items-center <?= $admin !== end($adminContacts) ? 'mb-3 pb-3 border-bottom' : '' ?>">
                    <div class="col-md-8 col-12 mb-2 mb-md-0">
                        <h5 class="font-weight-bold mb-2"><?= esc($admin['full_name'] ?: $admin['username']) ?></h5>
                        <p class="text-muted mb-0"><?= esc($admin['phone_number']) ?></p>
                    </div>
                    <div class="col-md-4 col-12 text-md-right">
                        <a href="https://wa.me/62<?= ltrim(esc($admin['phone_number']), '0') ?>" target="_blank" class="btn btn-success btn-block">
                            <i class="fab fa-whatsapp"></i> Hubungi Admin
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <img src="<?= base_url('assets/images/frontend-pages/Nurul.webp') ?>" alt="apt. Nurul Kusumawardani" class="rounded-circle mb-3" style="width:150px;height:150px;object-fit:cover;">
                <h5 class="font-weight-bold">apt. Nurul Kusumawardani, M. Farm</h5>
                <p class="text-muted mb-2">Apoteker Klinis</p>
                <p class="text-muted small mb-3"><i class="fas fa-phone"></i> 081902808231</p>
                <a href="https://wa.me/6281902808231" target="_blank" class="btn btn-success btn-block">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <img src="<?= base_url('assets/images/frontend-pages/Emelda.webp') ?>" alt="apt. Emelda" class="rounded-circle mb-3" style="width:150px;height:150px;object-fit:cover;">
                <h5 class="font-weight-bold">apt. Emelda, M.Farm</h5>
                <p class="text-muted mb-2">Apoteker Fokus Pada Bidang Etnomedisin</p>
                <p class="text-muted small mb-3"><i class="fas fa-phone"></i> 085752334536</p>
                <a href="https://wa.me/6285752334536" target="_blank" class="btn btn-success btn-block">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <img src="<?= base_url('assets/images/frontend-pages/Eliza.webp') ?>" alt="apt. Eliza Dwinta" class="rounded-circle mb-3" style="width:150px;height:150px;object-fit:cover;">
                <h5 class="font-weight-bold">apt. Eliza Dwinta, M.Pharm.,SCI</h5>
                <p class="text-muted mb-2">Apoteker Fokus Pada Kesehatan Mental</p>
                <p class="text-muted small mb-3"><i class="fas fa-phone"></i> 082226351616</p>
                <a href="https://wa.me/6282226351616" target="_blank" class="btn btn-success btn-block">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <img src="<?= base_url('assets/images/frontend-pages/Silvia.webp') ?>" alt="Silvia Rizki Syah Putri" class="rounded-circle mb-3" style="width:150px;height:150px;object-fit:cover;">
                <h5 class="font-weight-bold">Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb</h5>
                <p class="text-muted mb-2">Bidan</p>
                <p class="text-muted small mb-3"><i class="fas fa-phone"></i> 088233780554</p>
                <a href="https://wa.me/62088233780554" target="_blank" class="btn btn-success btn-block">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <img src="<?= base_url('assets/images/frontend-pages/Adelia.webp') ?>" alt="Adelia Kholila Putri" class="rounded-circle mb-3" style="width:150px;height:150px;object-fit:cover;">
                <h5 class="font-weight-bold">Adelia Kholila Putri, S.Keb</h5>
                <p class="text-muted mb-2">Bidan</p>
                <p class="text-muted small mb-3"><i class="fas fa-phone"></i> 081297161149</p>
                <a href="https://wa.me/6281297161149" target="_blank" class="btn btn-success btn-block">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <img src="<?= base_url('assets/images/frontend-pages/Indah.webp') ?>" alt="Wiji Indah Lestari" class="rounded-circle mb-3" style="width:150px;height:150px;object-fit:cover;">
                <h5 class="font-weight-bold">Wiji Indah Lestari, S.Gz., M.K.M</h5>
                <p class="text-muted mb-2">Ahli Gizi</p>
                <p class="text-muted small mb-3"><i class="fas fa-phone"></i> 082293679312</p>
                <a href="https://wa.me/6282293679312" target="_blank" class="btn btn-success btn-block">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
            <h5><i class="fas fa-info-circle"></i> Informasi</h5>
            <ul class="mb-0">
                <li>Layanan konsultasi tersedia pada hari kerja (Senin - Jumat)</li>
                <li>Waktu respon maksimal 1x24 jam</li>
                <li>Untuk kondisi darurat, segera hubungi fasilitas kesehatan terdekat</li>
                <li>Konsultasi bersifat gratis dan rahasia</li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
