<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="<?= base_url('asset/images/favicon.png'); ?>">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?= base_url('asset/fonts/icomoon/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('asset/fonts/flaticon/font/flaticon.css'); ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?= base_url('asset/css/tiny-slider.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/aos.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/glightbox.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/cssstyle.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('asset/css/flatpickr.min.css'); ?>">

    


    <title><?= $title ?? 'e-asfarm' ?></title>

</head>

<body>


    <?= $this->renderSection('content') ?>



    <!-- whatsapp -->
    <div class="whatsapp-icon">
        <a href="https://api.whatsapp.com/send?phone=6285745284228" target="_blank">
            <div class="whatsapp-content">
                <span>Halo, ada yang bisa Mimin bantu?</span>
                <img src="asset/images/wa.png" alt="Chat with us on WhatsApp">
            </div>
           
            
        </a>
    </div>

    <?php include('asset/footer.php') ?>


    <!-- Preloader/loading -->
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


    <script src="<?= base_url('asset/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('asset/js/tiny-slider.js'); ?>"></script>

    <script src="<?= base_url('asset/js/flatpickr.min.js'); ?>"></script>


    <script src="<?= base_url('asset/js/aos.js'); ?>"></script>
    <script src="<?= base_url('asset/js/glightbox.min.js'); ?>"></script>
    <script src="<?= base_url('asset/js/navbar.js'); ?>"></script>
    <script src="<?= base_url('asset/js/counter.js'); ?>"></script>
    <script src="<?= base_url('asset/js/custom.js'); ?>"></script>



</body>

</html>