<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Product Detail</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="./">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Product Detail
                                    </span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="shop-detail">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div id="sync1" class="owl-carousel owl-theme">
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s1.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s2.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s3.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s4.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s5.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s6.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s7.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s8.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s9.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s10.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s11.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s12.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                            </div>

                            <div id="sync2" class="owl-carousel owl-theme">
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s1.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s2.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s3.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s4.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s5.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s6.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s7.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s8.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s9.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s10.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s11.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                                <div class="item rounded overflow-hidden">
                                    <img src="../assets/images/products/s12.jpg" alt="matdash-img" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="shop-content">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge text-bg-success fs-2 fw-semibold">In Stock</span>
                                    <span class="fs-2">books</span>
                                </div>
                                <h4>Curology Face wash</h4>
                                <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ex arcu, tincidunt
                                    bibendum felis.</p>
                                <h4 class="fw-semibold mb-3">
                                    <del class="fs-5 text-muted">$350</del> $275
                                </h4>
                                <div class="d-flex align-items-center gap-8 pb-4 border-bottom">
                                    <ul class="list-unstyled d-flex align-items-center mb-0">
                                        <li>
                                            <a class="me-1" href="javascript:void(0)">
                                                <i class="ti ti-star text-warning fs-4"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="me-1" href="javascript:void(0)">
                                                <i class="ti ti-star text-warning fs-4"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="me-1" href="javascript:void(0)">
                                                <i class="ti ti-star text-warning fs-4"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="me-1" href="javascript:void(0)">
                                                <i class="ti ti-star text-warning fs-4"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="ti ti-star text-warning fs-4"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <a href="javascript:void(0)">(236 reviews)</a>
                                </div>
                                <div class="d-flex align-items-center gap-8 py-7">
                                    <h6 class="mb-0 fs-4 fw-semibold">Colors:</h6>
                                    <a class="rounded-circle d-block text-bg-primary p-6" href="javascript:void(0)"></a>
                                </div>
                                <div class="d-flex align-items-center gap-7 pb-7 mb-7 border-bottom">
                                    <h6 class="mb-0 fs-4 fw-semibold">QTY:</h6>
                                    <div class="input-group input-group-sm rounded">
                                        <button class="btn minus min-width-40 py-0 border-end border-muted fs-5 border-end-0 text-muted" type="button" id="add1">
                                            <i class="ti ti-minus"></i>
                                        </button>
                                        <input type="text" class="min-width-40 flex-grow-0 border border-muted text-muted fs-4 fw-semibold form-control text-center qty" placeholder="" aria-label="Example text with button addon" aria-describedby="add1" value="1">
                                        <button class="btn min-width-40 py-0 border border-muted fs-5 border-start-0 text-muted add" type="button" id="addo2">
                                            <i class="ti ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center gap-6 pt-8 mb-7">
                                    <a href="javascript:void(0)" class="btn d-block btn-primary px-5 py-8 mb-6 mb-sm-0">Buy Now</a>
                                    <a href="javascript:void(0)" class="btn d-block btn-danger px-7 py-8">Add to Cart</a>
                                </div>
                                <p class="mb-0">Dispatched in 2-3 weeks</p>
                                <a href="javascript:void(0)">Why the longer time for delivery?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>