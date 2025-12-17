# 🚀 E-Asfarm - Panduan Deployment ke Production

## 📋 Daftar Isi
1. [Persiapan Sebelum Deploy](#persiapan-sebelum-deploy)
2. [Konfigurasi File yang Harus Diubah](#konfigurasi-file-yang-harus-diubah)
3. [Setup Server Production](#setup-server-production)
4. [Setup Database](#setup-database)
5. [Setup HTTPS (SSL)](#setup-https-ssl)
6. [Upload & Deploy](#upload--deploy)
7. [Testing Production](#testing-production)
8. [Troubleshooting](#troubleshooting)

---

## 📦 Persiapan Sebelum Deploy

### ✅ Checklist Persiapan:
- [ ] Domain sudah terdaftar (contoh: e-asfarm.com)
- [ ] Hosting/VPS sudah siap (PHP 7.4+, MySQL 5.7+)
- [ ] Akses cPanel/SSH tersedia
- [ ] Backup database lokal
- [ ] Backup semua file project
- [ ] Icon PWA sudah disiapkan (3 ukuran)

### 📊 Spesifikasi Server Minimum:
```
PHP Version: 7.4 atau lebih tinggi
MySQL: 5.7 atau lebih tinggi
Disk Space: 500 MB (minimal)
RAM: 512 MB (minimal)
Extensions: intl, mbstring, json, mysqlnd, libcurl
```

---

## 🔧 Konfigurasi File yang Harus Diubah

### 1️⃣ **File: `.env`** (PALING PENTING!)

**Lokasi:** `e-asfarm/.env`

#### **Yang Harus Diubah:**

```env
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------
CI_ENVIRONMENT = production  # ← UBAH dari development

# Disable Debug Toolbar
toolbar.enabled = false  # ← Pastikan false

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------
app.baseURL = 'https://e-asfarm.com/'  # ← UBAH ke domain production

# HTTPS Enforcement (set true saat production)
app.forceGlobalSecureRequests = true  # ← UBAH ke true

# Session Timeout (30 menit = 1800 detik)
app.sessionTimeout = 1800  # ← Sesuaikan jika perlu

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
database.default.hostname = localhost  # ← Sesuaikan dengan hosting
database.default.database = nama_database_production  # ← UBAH
database.default.username = user_database_production  # ← UBAH
database.default.password = password_database_production  # ← UBAH
database.default.DBDriver = MySQLi
```

#### **⚠️ PENTING:**
- **JANGAN** commit file `.env` ke Git/repository public
- Simpan backup `.env` di tempat aman
- Gunakan password database yang kuat

---

### 2️⃣ **File: `app/Config/App.php`**

**Lokasi:** `e-asfarm/app/Config/App.php`

#### **Yang Harus Diubah:**

```php
// Baris 18
public string $baseURL = 'https://e-asfarm.com/';  // ← UBAH

// Baris 130
public bool $forceGlobalSecureRequests = true;  // ← UBAH ke true

// Baris 109 (Opsional - untuk timezone Indonesia)
public string $appTimezone = 'Asia/Jakarta';  // ← UBAH dari UTC
```

---

### 3️⃣ **File: `public/manifest.json`** (PWA)

**Lokasi:** `e-asfarm/public/manifest.json`

#### **Yang Harus Diubah:**

```json
{
  "name": "E-Asfarm - Sistem Monitoring Kesehatan",
  "short_name": "E-Asfarm",
  "description": "Platform monitoring kesehatan ibu hamil, balita, dan remaja berbasis etnomedisin",
  "start_url": "https://e-asfarm.com/",  // ← UBAH ke domain production
  "scope": "/",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#047d78",
  ...
}
```

#### **⚠️ CATATAN:**
- Jika menggunakan subdomain (contoh: app.e-asfarm.com), ubah `start_url` sesuai
- Pastikan icon PWA sudah diupload ke folder `public/assets/images/logos/`

---

### 4️⃣ **File: `public/sw.js`** (Service Worker)

**Lokasi:** `e-asfarm/public/sw.js`

#### **Yang Harus Diubah:**

```javascript
// Baris 1 - Update cache version setiap deploy
const CACHE_NAME = 'e-asfarm-v3';  // ← INCREMENT version (v2 → v3)

// Baris 2 - BASE_URL sudah dinamis, tidak perlu diubah
const BASE_URL = self.location.origin;  // ✅ Otomatis menyesuaikan
```

#### **⚠️ PENTING:**
- **Selalu increment cache version** setiap kali deploy update
- Contoh: v2 → v3 → v4 (agar user dapat update terbaru)
- BASE_URL sudah otomatis, tidak perlu diubah manual

---

### 5️⃣ **File: `.htaccess`** (URL Rewriting)

**Lokasi:** `e-asfarm/public/.htaccess`

#### **Pastikan File Ini Ada:**

```apache
# Disable directory browsing
Options -Indexes

# Prevent access to .env file
<Files .env>
    Order allow,deny
    Deny from all
</Files>

# CodeIgniter URL Rewriting
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    
    # Redirect to HTTPS (Production)
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    
    # Remove index.php from URL
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>

# Prevent access to system folders
<IfModule mod_rewrite.c>
    RewriteRule ^(app|writable|tests)(/.*)?$ - [F,L,NC]
</IfModule>

# Set default charset
AddDefaultCharset UTF-8

# Enable compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>

# Browser caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

#### **⚠️ CATATAN:**
- File ini harus ada di folder `public/`
- Jika hosting tidak support `.htaccess`, gunakan `nginx.conf` (tanyakan ke hosting)

---

### 6️⃣ **File: `writable/` Permissions**

**Lokasi:** `e-asfarm/writable/`

#### **Set Permission:**

```bash
# Via SSH/Terminal
chmod -R 755 writable/
chmod -R 755 writable/cache/
chmod -R 755 writable/logs/
chmod -R 755 writable/session/
chmod -R 755 writable/uploads/

# Via cPanel File Manager
# Klik kanan folder → Change Permissions → 755
```

#### **Folder yang Harus Writable:**
- `writable/cache/`
- `writable/logs/`
- `writable/session/`
- `writable/uploads/`

---

## 🖥️ Setup Server Production

### **Opsi 1: Shared Hosting (cPanel)**

#### **Langkah-langkah:**

1. **Upload File via cPanel File Manager atau FTP:**
   ```
   - Upload semua file ke folder public_html/
   - Atau buat subfolder: public_html/e-asfarm/
   ```

2. **Struktur Folder di Server:**
   ```
   public_html/
   ├── app/
   ├── public/
   │   ├── index.php
   │   ├── .htaccess
   │   ├── manifest.json
   │   ├── sw.js
   │   └── assets/
   ├── writable/
   ├── vendor/
   ├── .env
   └── ...
   ```

3. **Set Document Root ke Folder `public/`:**
   - cPanel → Domains → Manage → Document Root
   - Ubah dari `/public_html` ke `/public_html/public`
   - Atau buat subdomain yang point ke folder `public/`

4. **Verifikasi PHP Version:**
   - cPanel → Select PHP Version
   - Pilih PHP 7.4 atau 8.0+
   - Enable extensions: intl, mbstring, mysqlnd

---

### **Opsi 2: VPS (Ubuntu/CentOS)**

#### **Langkah-langkah:**

1. **Install LAMP Stack:**
   ```bash
   # Update system
   sudo apt update && sudo apt upgrade -y
   
   # Install Apache
   sudo apt install apache2 -y
   
   # Install PHP 8.0
   sudo apt install php8.0 php8.0-cli php8.0-common php8.0-mysql php8.0-mbstring php8.0-intl php8.0-curl -y
   
   # Install MySQL
   sudo apt install mysql-server -y
   ```

2. **Upload File via SCP/SFTP:**
   ```bash
   scp -r e-asfarm/ user@server:/var/www/html/
   ```

3. **Set Permissions:**
   ```bash
   sudo chown -R www-data:www-data /var/www/html/e-asfarm
   sudo chmod -R 755 /var/www/html/e-asfarm
   sudo chmod -R 755 /var/www/html/e-asfarm/writable
   ```

4. **Configure Apache Virtual Host:**
   ```apache
   <VirtualHost *:80>
       ServerName e-asfarm.com
       ServerAlias www.e-asfarm.com
       DocumentRoot /var/www/html/e-asfarm/public
       
       <Directory /var/www/html/e-asfarm/public>
           Options -Indexes +FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
       
       ErrorLog ${APACHE_LOG_DIR}/e-asfarm-error.log
       CustomLog ${APACHE_LOG_DIR}/e-asfarm-access.log combined
   </VirtualHost>
   ```

5. **Enable Rewrite Module:**
   ```bash
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```

---

## 🗄️ Setup Database

### **1. Export Database dari Localhost:**

```bash
# Via phpMyAdmin
1. Buka phpMyAdmin
2. Pilih database "blogci4"
3. Klik tab "Export"
4. Pilih "Quick" atau "Custom"
5. Format: SQL
6. Klik "Go" → Download file .sql

# Via Command Line
mysqldump -u root -p blogci4 > e-asfarm-backup.sql
```

---

### **2. Import Database ke Production:**

#### **Via cPanel:**
```
1. cPanel → phpMyAdmin
2. Buat database baru (contoh: easfarm_db)
3. Buat user database baru
4. Assign user ke database dengan ALL PRIVILEGES
5. Pilih database → Import
6. Upload file .sql → Go
```

#### **Via SSH:**
```bash
mysql -u username -p database_name < e-asfarm-backup.sql
```

---

### **3. Update Credentials di `.env`:**

```env
database.default.hostname = localhost
database.default.database = easfarm_db  # ← Nama database production
database.default.username = easfarm_user  # ← User database production
database.default.password = P@ssw0rd!Strong  # ← Password database production
```

---

## 🔒 Setup HTTPS (SSL)

### **⚠️ WAJIB untuk PWA!**

PWA **TIDAK AKAN JALAN** tanpa HTTPS (kecuali localhost).

---

### **Opsi 1: Let's Encrypt (GRATIS) - RECOMMENDED**

#### **Via cPanel:**
```
1. cPanel → SSL/TLS Status
2. Pilih domain → Run AutoSSL
3. Tunggu proses selesai (5-10 menit)
4. SSL otomatis aktif
```

#### **Via SSH (Certbot):**
```bash
# Install Certbot
sudo apt install certbot python3-certbot-apache -y

# Generate SSL Certificate
sudo certbot --apache -d e-asfarm.com -d www.e-asfarm.com

# Auto-renewal (cron job)
sudo certbot renew --dry-run
```

---

### **Opsi 2: Cloudflare (GRATIS + CDN)**

```
1. Daftar di cloudflare.com
2. Tambahkan domain e-asfarm.com
3. Update nameserver domain ke Cloudflare
4. SSL/TLS → Full (Strict)
5. Otomatis dapat HTTPS + CDN gratis
```

**Keuntungan Cloudflare:**
- ✅ SSL gratis
- ✅ CDN global (loading lebih cepat)
- ✅ DDoS protection
- ✅ Cache otomatis

---

### **Opsi 3: SSL Berbayar**

Beli SSL dari:
- Namecheap: $8-15/tahun
- GoDaddy: $70-300/tahun
- Comodo: $50-200/tahun

---

## 📤 Upload & Deploy

### **Checklist Upload:**

- [ ] Upload semua file project
- [ ] Upload database (.sql)
- [ ] Set permissions folder `writable/`
- [ ] Upload icon PWA (3 ukuran)
- [ ] Update file `.env`
- [ ] Update `manifest.json`
- [ ] Increment cache version di `sw.js`
- [ ] Test `.htaccess` berfungsi

---

### **File yang TIDAK Perlu Diupload:**

```
❌ .git/
❌ .gitignore
❌ node_modules/ (jika ada)
❌ tests/
❌ .env.example
❌ README.md (opsional)
❌ DEPLOYMENT-GUIDE.md (opsional)
```

---

### **File yang WAJIB Diupload:**

```
✅ app/
✅ public/
✅ writable/
✅ vendor/
✅ .env (dengan konfigurasi production)
✅ spark
```

---

## 🧪 Testing Production

### **1. Test Basic Functionality:**

```
✅ Buka https://e-asfarm.com
✅ Test login admin
✅ Test halaman beranda
✅ Test halaman monitoring
✅ Test upload file (artikel, poster, modul)
✅ Test form input monitoring
```

---

### **2. Test PWA:**

```
✅ Buka Chrome DevTools (F12)
✅ Tab Application → Manifest (harus muncul)
✅ Tab Application → Service Workers (harus registered)
✅ Tab Application → Cache Storage (harus ada cache)
✅ Klik icon "Install" di address bar
✅ Test offline mode (disconnect internet)
✅ Test banner slider offline
```

---

### **3. Test Performance:**

```
✅ Google PageSpeed Insights: https://pagespeed.web.dev
✅ GTmetrix: https://gtmetrix.com
✅ WebPageTest: https://www.webpagetest.org
```

**Target Score:**
- Performance: 80+ (mobile), 90+ (desktop)
- Accessibility: 90+
- Best Practices: 90+
- SEO: 90+

---

### **4. Test Security:**

```
✅ SSL Labs: https://www.ssllabs.com/ssltest/
✅ Security Headers: https://securityheaders.com
✅ Test SQL Injection (manual)
✅ Test XSS (manual)
✅ Test CSRF token
```

---

## 🐛 Troubleshooting

### **Problem 1: Error 500 Internal Server Error**

**Solusi:**
```bash
# Check error log
tail -f writable/logs/log-*.log

# Check Apache error log
tail -f /var/log/apache2/error.log

# Common causes:
1. Permission writable/ folder (chmod 755)
2. .htaccess syntax error
3. PHP version tidak support
4. Missing PHP extensions
```

---

### **Problem 2: PWA Tidak Bisa Install**

**Solusi:**
```
1. Pastikan HTTPS aktif (wajib!)
2. Check manifest.json valid (Chrome DevTools)
3. Check service worker registered
4. Clear cache browser (Ctrl+Shift+Delete)
5. Hard refresh (Ctrl+F5)
```

---

### **Problem 3: Database Connection Failed**

**Solusi:**
```
1. Check credentials di .env
2. Check database exists
3. Check user has privileges
4. Check hostname (localhost vs 127.0.0.1)
5. Test connection via phpMyAdmin
```

---

### **Problem 4: Assets (CSS/JS/Images) Tidak Load**

**Solusi:**
```
1. Check baseURL di .env
2. Check .htaccess rewrite rules
3. Check file permissions (755)
4. Clear browser cache
5. Check path assets (case-sensitive di Linux)
```

---

### **Problem 5: Service Worker Tidak Update**

**Solusi:**
```
1. Increment CACHE_NAME di sw.js (v2 → v3)
2. Hard refresh browser (Ctrl+Shift+R)
3. Chrome DevTools → Application → Service Workers → Unregister
4. Clear cache storage
5. Reload page
```

---

## 📊 Monitoring Production

### **Tools Monitoring:**

1. **Uptime Monitoring:**
   - UptimeRobot: https://uptimerobot.com (gratis)
   - Pingdom: https://www.pingdom.com

2. **Error Tracking:**
   - Sentry: https://sentry.io (gratis tier)
   - Rollbar: https://rollbar.com

3. **Analytics:**
   - Google Analytics
   - Matomo (self-hosted)

4. **Server Monitoring:**
   - cPanel → Metrics
   - New Relic (berbayar)
   - Datadog (berbayar)

---

## 📝 Maintenance Checklist

### **Harian:**
- [ ] Check error logs
- [ ] Monitor uptime
- [ ] Check disk space

### **Mingguan:**
- [ ] Backup database
- [ ] Check security updates
- [ ] Review analytics

### **Bulanan:**
- [ ] Full backup (database + files)
- [ ] Update dependencies (composer update)
- [ ] Security audit
- [ ] Performance review

---

## 🆘 Support & Kontak

Jika ada masalah saat deployment:

1. **Check Documentation:**
   - CodeIgniter 4: https://codeigniter.com/user_guide/
   - PWA: https://web.dev/progressive-web-apps/

2. **Community:**
   - CodeIgniter Forum: https://forum.codeigniter.com
   - Stack Overflow: https://stackoverflow.com/questions/tagged/codeigniter-4

3. **Hosting Support:**
   - Hubungi support hosting Anda
   - Berikan error log untuk troubleshooting

---

## ✅ Final Checklist Sebelum Go Live

- [ ] Semua file terupload
- [ ] Database terimport
- [ ] `.env` sudah dikonfigurasi production
- [ ] HTTPS aktif dan valid
- [ ] PWA bisa diinstall
- [ ] Service Worker berfungsi
- [ ] Offline mode berfungsi
- [ ] Login admin berfungsi
- [ ] Semua fitur tested
- [ ] Performance score 80+
- [ ] Backup tersimpan aman
- [ ] Monitoring tools aktif

---

**🎉 Selamat! E-Asfarm siap production!**

---

**Dibuat:** 17 Desember 2024  
**Versi:** 1.0  
**Project:** E-Asfarm - Sistem Monitoring Kesehatan
