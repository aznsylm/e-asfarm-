# Dashboard Admin E-Asfarm - Dokumentasi

## Fitur Utama

Dashboard admin telah dirombak dengan tampilan modern dan sistem CRUD menggunakan modal popup untuk 4 modul utama:

### 1. Kelola Pengguna
- **Tambah Pengguna**: Username, Email, Password, Nama Lengkap, No. WA, Padukuhan/Desa, Jenis Kelamin, Tanggal Lahir
- **Edit Pengguna**: Semua field dapat diubah, password opsional saat edit
- **Hapus Pengguna**: Konfirmasi sebelum menghapus
- **Validasi**: 
  - Username minimal 3 karakter, harus unik
  - Email valid dan unik
  - Password minimal 8 karakter
  - No. WA hanya angka, 10-15 digit
  - Semua field wajib diisi

### 2. Kelola Artikel
- **Tambah Artikel**: Judul, Kategori (Farmasi/Gizi/Bidan), Konten, Gambar
- **Edit Artikel**: Semua field dapat diubah, gambar opsional saat edit
- **Hapus Artikel**: Menghapus artikel dan file gambar
- **Validasi**:
  - Judul minimal 5 karakter
  - Konten minimal 20 karakter
  - Gambar max 2MB, format image
  - Kategori wajib dipilih

### 3. Kelola Tanya Jawab (FAQ)
- **Tambah FAQ**: Kategori, Pertanyaan, Jawaban
- **Edit FAQ**: Semua field dapat diubah
- **Hapus FAQ**: Konfirmasi sebelum menghapus
- **Validasi**:
  - Pertanyaan minimal 10 karakter
  - Jawaban minimal 10 karakter
  - Kategori wajib dipilih (1=Farmasi, 2=Gizi, 3=Bidan)

### 4. Kelola Unduhan
- **Tambah File**: Judul, Kategori, File PDF, Thumbnail
- **Edit File**: Semua field dapat diubah, PDF dan thumbnail opsional saat edit
- **Hapus File**: Menghapus file PDF dan thumbnail
- **Validasi**:
  - Judul minimal 5 karakter
  - PDF max 5MB, format .pdf
  - Thumbnail max 2MB, format image
  - Kategori wajib dipilih (1=Edukasi, 2=Panduan)

## Cara Menggunakan

1. **Login** sebagai admin di `/login`
2. **Akses Dashboard** di `/admin/dashboard`
3. **Pilih Tab** sesuai modul yang ingin dikelola
4. **Klik Tombol Tambah** untuk membuat data baru
5. **Isi Form** di modal popup dengan lengkap
6. **Klik Simpan** untuk menyimpan data
7. **Edit/Hapus** menggunakan tombol aksi di tabel

## Struktur File

### Controllers
- `app/Controllers/Admins/DashboardController.php` - Controller utama untuk semua CRUD

### Views
- `app/Views/admins/dashboard-new.php` - View dashboard dengan tabs dan modals
- `app/Views/layouts/admin-new.php` - Layout admin dengan sidebar

### Models
- `app/Models/UserModel.php` - Model pengguna
- `app/Models/Post/PostModel.php` - Model artikel
- `app/Models/Faq/FaqModel.php` - Model FAQ
- `app/Models/Upload/FileModel.php` - Model file unduhan

### Routes
Semua route CRUD ada di `app/Config/Routes.php` dengan prefix `/admin/dashboard/`

## Upload Directories
- `public/uploads/posts/` - Gambar artikel
- `public/uploads/pdf/` - File PDF
- `public/uploads/pdf/thumbnails/` - Thumbnail PDF

## Teknologi
- **Backend**: CodeIgniter 4
- **Frontend**: Bootstrap 5, jQuery
- **Icons**: Tabler Icons
- **AJAX**: Untuk operasi CRUD tanpa reload halaman

## Keamanan
- Semua input divalidasi di server-side
- File upload dibatasi ukuran dan tipe
- XSS protection dengan `esc()` function
- CSRF protection aktif
- Admin filter untuk proteksi route

## Catatan Penting
- Pastikan folder `public/uploads/` writable
- Backup database sebelum operasi hapus massal
- Gambar dan PDF yang dihapus akan terhapus permanen dari server
- Validasi berjalan di server, error akan ditampilkan via alert
