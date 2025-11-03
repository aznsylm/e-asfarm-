# HTTPS Setup Guide

## Development (Localhost)
Saat development di localhost, HTTPS **TIDAK PERLU** diaktifkan.

Setting saat ini di `.env`:
```
app.forceGlobalSecureRequests = false
```

## Production (Hosting)

### Langkah 1: Install SSL Certificate
Pastikan hosting sudah punya SSL certificate. Pilihan:
- **Let's Encrypt** (Gratis) - biasanya ada di cPanel
- **Cloudflare SSL** (Gratis) - aktifkan di Cloudflare dashboard
- **SSL berbayar** dari provider hosting

### Langkah 2: Aktifkan HTTPS Enforcement
Edit file `.env` di server production:
```
app.forceGlobalSecureRequests = true
```

### Langkah 3: Update Base URL
Ganti `http://` jadi `https://` di `.env`:
```
app.baseURL = 'https://yourdomain.com/'
```

### Langkah 4: Clear Cache
Jalankan command di server:
```bash
php spark cache:clear
```

## Troubleshooting

### Mixed Content Warning
Jika ada warning "Mixed Content" di browser:
- Cek semua link gambar/CSS/JS
- Ganti `http://` jadi `https://`
- Atau pakai protocol-relative: `//domain.com/image.jpg`

### Redirect Loop
Jika terjadi redirect loop:
- Cek apakah hosting pakai reverse proxy (Cloudflare, nginx)
- Tambahkan di `.env`:
```
app.proxyIPs = ['CLOUDFLARE_IP_RANGES']
```

### SSL Not Working
- Pastikan SSL certificate sudah aktif di hosting
- Cek dengan: https://www.ssllabs.com/ssltest/
- Tunggu 5-10 menit setelah install SSL

## Keamanan Tambahan

### HTTP Strict Transport Security (HSTS)
CodeIgniter otomatis set HSTS header saat `forceGlobalSecureRequests = true`.

Browser akan:
- Selalu pakai HTTPS untuk domain ini
- Tidak bisa bypass SSL warning
- Cache setting ini selama 1 tahun

## Verifikasi
Setelah setup, cek:
1. Buka `http://yourdomain.com` → harus redirect ke `https://`
2. Cek icon gembok di browser
3. Coba login → harus tetap HTTPS
4. Cek semua halaman tidak ada mixed content warning
