<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<!-- Custom CSS -->
<style>
    .btn-outline-teal {
        color: #047d78;
        border-color: #047d78;
        background: transparent;
    }
    .btn-outline-teal:hover {
        color: #fff;
        background-color: #047d78;
        border-color: #047d78;
    }

    /* Running text */
    .running-text-wrapper {
        overflow: hidden;
        padding: 0.25rem 0;
    }
    .running-text-container {
        display: flex;
        height: 45px;
    }
    @media (min-width: 992px) {
        .running-text-wrapper {
            padding: 0.5rem 0;
        }
        .running-text-container {
            max-width: 1320px;
            margin: 0 auto;
        }
    }
    .running-text-label {
        background: #047d78;
        color: #fff;
        padding: 12px 20px;
        font-weight: 600;
        font-size: 15px;
        white-space: nowrap;
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }
    .running-text-content {
        flex: 1;
        overflow-x: auto;
        overflow-y: hidden;
        position: relative;
        background: #fff;
        scroll-behavior: smooth;
        scrollbar-width: none;
        -ms-overflow-style: none;
        -webkit-overflow-scrolling: touch;
    }
    .running-text-content::-webkit-scrollbar {
        display: none;
    }
    .running-text-marquee {
        display: flex;
        padding: 12px 0;
        width: max-content;
    }
    .running-text-marquee.auto-scroll {
        animation: scroll-left 20s linear infinite;
    }
    .running-text-marquee:hover {
        animation-play-state: paused;
    }
    .running-text-item {
        white-space: nowrap;
        padding: 0 30px;
        color: #047d78;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s;
        flex-shrink: 0;
    }
    .running-text-item:hover {
        text-decoration: underline;
        color: #036661;
    }
    .running-text-separator {
        color: #047d78;
        padding: 0 10px;
        flex-shrink: 0;
    }

    @keyframes scroll-left {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    @media (max-width: 768px) {
        .running-text-label {
            font-size: 13px;
            padding: 12px 15px;
        }
        .running-text-item {
            font-size: 13px;
        }
        .running-text-marquee.auto-scroll {
            animation-duration: 12s;
        }
    }

    /* Mobile breadcrumb */
    @media (max-width: 767.98px) {
        .breadcrumb-mobile {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 0.5rem !important;
        }
        .breadcrumb-links {
            font-size: 0.75rem !important;
            gap: 0.5rem !important;
        }
        .breadcrumb-links iconify-icon {
            font-size: 0.875rem !important;
        }
    }

    /* Category tabs - horizontal scroll on mobile */
    .tabs-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .category-tabs-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
        scroll-behavior: smooth;
        flex: 1;
    }
    .category-tabs-wrapper::-webkit-scrollbar {
        display: none;
    }
    .category-tabs {
        display: flex;
        gap: 0.5rem;
        flex-wrap: nowrap;
        padding-bottom: 0.5rem;
    }
    .category-tabs .btn {
        white-space: nowrap;
        flex-shrink: 0;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        min-height: 44px;
    }
    .scroll-btn {
        background: white;
        border: 1px solid #047d78;
        color: #047d78;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .scroll-btn:hover {
        background: #047d78;
        color: white;
    }
    @media (max-width: 767.98px) {
        .scroll-btn { display: flex; }
    }
    @media (max-width: 576px) {
        .category-tabs .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
        }
        .category-tabs .btn i {
            display: none;
        }
    }

    /* Accordion mobile optimization */
    .faq-accordion .accordion-item {
        border: none;
        margin-bottom: 0.75rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .faq-accordion .accordion-button {
        background: #047d78;
        color: white;
        border: none;
        padding: 1rem;
        font-weight: 600;
        font-size: 0.875rem;
        line-height: 1.4;
        min-height: 48px;
        touch-action: manipulation;
        word-break: break-word;
    }
    .faq-accordion .accordion-button:not(.collapsed) {
        background: #036663;
        box-shadow: none;
    }
    .faq-accordion .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        flex-shrink: 0;
        margin-left: 0.5rem;
    }
    .faq-accordion .accordion-body {
        padding: 1rem;
        background: #fff;
        line-height: 1.6;
        color: #4a5568;
        font-size: 0.875rem;
    }
    @media (min-width: 768px) {
        .faq-accordion .accordion-item {
            margin-bottom: 1rem;
        }
        .faq-accordion .accordion-button {
            padding: 1.25rem 1.5rem;
            font-size: 1rem;
        }
        .faq-accordion .accordion-body {
            padding: 1.5rem;
            font-size: 0.95rem;
            line-height: 1.7;
        }
    }

    /* Mobile spacing */
    @media (max-width: 767.98px) {
        .py-4 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }
        .mb-4 {
            margin-bottom: 1rem !important;
        }
    }
</style>

<!-- Breadcrumb -->
<section class="py-4">
    <div class="container-fluid">
        <div class="d-flex justify-content-between breadcrumb-mobile">
            <h2 class="fs-5 fs-md-4 fw-bold mb-0">
                Tanya Jawab <?php 
                    if ($kategori['name'] == 'kehamilan') echo 'Kehamilan';
                    elseif ($kategori['name'] == 'menyusui') echo 'Menyusui';
                    elseif ($kategori['name'] == 'persalinan') echo 'Persalinan';
                    elseif ($kategori['name'] == 'vaksin') echo 'Vaksin';
                    elseif ($kategori['name'] == 'nutrisi') echo 'Nutrisi';
                    else echo ucfirst($kategori['name']);
                ?>
            </h2>
            <div class="d-flex align-items-center breadcrumb-links" style="gap: 0.5rem;">
                <a href="<?= base_url('/'); ?>" class="text-muted fw-bold link-primary text-uppercase" style="font-size: 0.875rem;">
                    E-asfarm
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="text-muted" style="font-size: 1rem;"></iconify-icon>
                <a href="#" class="text-muted fw-bold link-primary text-uppercase" style="font-size: 0.875rem;">
                    Tanya Jawab
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="text-muted" style="font-size: 1rem;"></iconify-icon>
                <a href="#" class="text-primary link-primary fw-bold text-uppercase" style="font-size: 0.875rem;">
                    <?php 
                        if ($kategori['name'] == 'kehamilan') echo 'Kehamilan';
                        elseif ($kategori['name'] == 'menyusui') echo 'Menyusui';
                        elseif ($kategori['name'] == 'persalinan') echo 'Persalinan';
                        elseif ($kategori['name'] == 'vaksin') echo 'Vaksin';
                        elseif ($kategori['name'] == 'nutrisi') echo 'Nutrisi';
                        else echo ucfirst($kategori['name']);
                    ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-4">
    <div class="container-fluid">
        <!-- Running Text Tenaga Ahli -->
        <div class="running-text-wrapper mb-4">
            <div class="running-text-container">
                <div class="running-text-label">
                    <i class="fas fa-user-md me-2"></i> Hubungi Kami
                </div>
                <div class="running-text-content" id="runningContent">
                    <div class="running-text-marquee auto-scroll" id="runningMarquee">
                        <a href="https://wa.me/6281902808231" target="_blank" class="running-text-item">Apoteker Klinis (apt. Nurul Kusumawardani, M. Farm)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="running-text-item">Apoteker Etnomedisin (apt. Emelda, M.Farm)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="running-text-item">Apoteker Kesehatan Mental (apt. Eliza Dwinta, M.Pharm.,SCI)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/62088233780554" target="_blank" class="running-text-item">Bidan (Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/6281297161149" target="_blank" class="running-text-item">Bidan (Adelia Kholila Putri, S.Keb)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/6282293679312" target="_blank" class="running-text-item">Ahli Gizi (Wiji Indah Lestari, S.Gz., M.K.M)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/6281902808231" target="_blank" class="running-text-item">Apoteker Klinis (apt. Nurul Kusumawardani, M. Farm)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="running-text-item">Apoteker Etnomedisin (apt. Emelda, M.Farm)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="running-text-item">Apoteker Kesehatan Mental (apt. Eliza Dwinta, M.Pharm.,SCI)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/62088233780554" target="_blank" class="running-text-item">Bidan (Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/6281297161149" target="_blank" class="running-text-item">Bidan (Adelia Kholila Putri, S.Keb)</a>
                        <span class="running-text-separator">•</span>
                        <a href="https://wa.me/6282293679312" target="_blank" class="running-text-item">Ahli Gizi (Wiji Indah Lestari, S.Gz., M.K.M)</a>
                        <span class="running-text-separator">•</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori Tabs -->
        <div class="mb-4">
            <div class="tabs-container">
                <button class="scroll-btn" onclick="scrollTabs(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="category-tabs-wrapper" id="tabsWrapper">
                    <div class="category-tabs">
                        <a href="<?= base_url('tanya-jawab/kehamilan'); ?>" class="btn <?= $kategori['name'] == 'kehamilan' ? 'btn-teal' : 'btn-outline-teal' ?>">
                            <i class="fas fa-baby me-2"></i>Kehamilan
                        </a>
                        <a href="<?= base_url('tanya-jawab/menyusui'); ?>" class="btn <?= $kategori['name'] == 'menyusui' ? 'btn-teal' : 'btn-outline-teal' ?>">
                            <i class="fas fa-heart me-2"></i>Menyusui
                        </a>
                        <a href="<?= base_url('tanya-jawab/persalinan'); ?>" class="btn <?= $kategori['name'] == 'persalinan' ? 'btn-teal' : 'btn-outline-teal' ?>">
                            <i class="fas fa-hospital me-2"></i>Persalinan
                        </a>
                        <a href="<?= base_url('tanya-jawab/vaksin'); ?>" class="btn <?= $kategori['name'] == 'vaksin' ? 'btn-teal' : 'btn-outline-teal' ?>">
                            <i class="fas fa-syringe me-2"></i>Vaksin
                        </a>
                        <a href="<?= base_url('tanya-jawab/nutrisi'); ?>" class="btn <?= $kategori['name'] == 'nutrisi' ? 'btn-teal' : 'btn-outline-teal' ?>">
                            <i class="fas fa-apple-alt me-2"></i>Nutrisi
                        </a>
                        <a href="<?= base_url('tanya-jawab/etnomedisin'); ?>" class="btn <?= $kategori['name'] == 'etnomedisin' ? 'btn-teal' : 'btn-outline-teal' ?>">
                            <i class="fas fa-leaf me-2"></i>Etnomedisin
                        </a>
                    </div>
                </div>
                <button class="scroll-btn" onclick="scrollTabs(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- FAQ Accordion -->
        <?php if (!empty($tanyaJawab)): ?>
            <div class="accordion faq-accordion" id="faqAccordion">
                <?php foreach ($tanyaJawab as $i => $item): ?>
                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header" id="heading<?= $i; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i; ?>" aria-expanded="false" aria-controls="collapse<?= $i; ?>">
                                <?= esc($item['pertanyaan']); ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i; ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-grow-1" style="text-align: justify;">
                                        <?php
                                        // Sanitize: hanya izinkan tag HTML aman
                                        $body = $item['jawaban'];
                                        $body = strip_tags($body, '<p><strong><em><u><a><ol><ul><li><br><h1><h2><h3><h4><h5><h6><blockquote>');
                                        $body = preg_replace('/\s?class="[^"]*ql-[^"]*"/', '', $body);
                                        $body = preg_replace('/<p><\/p>/', '', $body);
                                        ?>
                                        <?= $body; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-4 py-md-5">
                <i class="fas fa-question-circle text-muted" style="font-size: 3rem;"></i>
                <h4 class="mt-3 text-muted fs-8 fs-md-15">Belum Ada Pertanyaan</h4>
                <p class="text-muted fs-8 fs-md-15">Tidak ada pertanyaan tersedia untuk kategori ini saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
function scrollTabs(direction) {
    const wrapper = document.getElementById('tabsWrapper');
    const scrollAmount = 200;
    wrapper.scrollLeft += direction * scrollAmount;
}

let autoScrollTimeout;
function pauseAutoScroll() {
    const marquee = document.getElementById('runningMarquee');
    marquee.classList.remove('auto-scroll');
    clearTimeout(autoScrollTimeout);
    autoScrollTimeout = setTimeout(() => {
        marquee.classList.add('auto-scroll');
    }, 3000);
}

document.addEventListener("DOMContentLoaded", function() {
    // Auto-expand first FAQ item
    const firstAccordion = document.querySelector('#collapse0');
    const firstButton = document.querySelector('[data-bs-target="#collapse0"]');
    if (firstAccordion && firstButton) {
        firstAccordion.classList.add('show');
        firstButton.classList.remove('collapsed');
        firstButton.setAttribute('aria-expanded', 'true');
    }

    // Running text scroll detection
    const runningContent = document.getElementById('runningContent');
    if (runningContent) {
        runningContent.addEventListener('scroll', pauseAutoScroll);
        runningContent.addEventListener('touchstart', pauseAutoScroll);
    }
});
</script>

<?= $this->endSection() ?>