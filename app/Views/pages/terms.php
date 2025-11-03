<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body p-5">
                    <h1 class="mb-4">Syarat dan Ketentuan</h1>
                    
                    <h3>1. Penerimaan Syarat</h3>
                    <p>Dengan mengakses dan menggunakan website E-Asfarm, Anda menyetujui untuk terikat dengan syarat dan ketentuan ini.</p>
                    
                    <h3>2. Penggunaan Layanan</h3>
                    <p>Website ini menyediakan informasi kesehatan ibu dan anak. Informasi yang disediakan hanya untuk tujuan edukasi dan tidak menggantikan konsultasi medis profesional.</p>
                    
                    <h3>3. Akun Pengguna</h3>
                    <p>Pengguna bertanggung jawab untuk menjaga keamanan akun dan password mereka. Setiap aktivitas yang terjadi di bawah akun Anda adalah tanggung jawab Anda.</p>
                    
                    <h3>4. Konten</h3>
                    <p>Semua konten yang Anda publikasikan harus sesuai dengan nilai-nilai kesehatan dan tidak melanggar hukum yang berlaku.</p>
                    
                    <h3>5. Privasi</h3>
                    <p>Kami menghormati privasi Anda. Silakan baca Kebijakan Privasi kami untuk informasi lebih lanjut.</p>
                    
                    <h3>6. Perubahan Syarat</h3>
                    <p>Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan berlaku setelah dipublikasikan di website.</p>
                    
                    <div class="mt-4">
                        <p><strong>Terakhir diperbarui:</strong> <?= date('d F Y') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>