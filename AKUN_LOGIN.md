# AKUN LOGIN E-ASFARM

## 🔐 AKUN YANG TERSEDIA

### 1. SUPER ADMIN (Hanya 1 akun)
- **Email**: `superadmin@e-asfarm.com`
- **Password**: `SuperAdmin123!`
- **Role**: `superadmin`
- **Akses**: Semua fitur + kelola admin + pengaturan sistem

### 2. ADMIN (4 akun tersedia)
- **Email**: `admin@gmail.com` | **Password**: `admin123`
- **Email**: `user2@gmail.com` | **Password**: `user123`
- **Email**: `user4@gmail.com` | **Password**: `user123`
- **Email**: `admin4@gmail.com` | **Password**: `admin123`
- **Role**: `admin`
- **Akses**: Kelola artikel, FAQ, unduhan, database kader

### 3. PENGGUNA TERDAFTAR (2 akun tersedia)
- **Email**: `aizansyalim25@gmail.com` | **Password**: `user123`
- **Email**: `pengguna@gmail.com` | **Password**: `user123`
- **Role**: `pengguna`
- **Akses**: Buat artikel (perlu approval), lihat dashboard

## 📝 ALUR PENDAFTARAN

### Untuk Pengguna Biasa:
1. Klik "Daftar" di halaman login
2. Isi form registrasi
3. Otomatis mendapat role `pengguna`
4. Bisa login dan akses dashboard pengguna

### Untuk Admin:
1. **TIDAK BISA DAFTAR SENDIRI**
2. Harus dibuat oleh Super Admin melalui dashboard
3. Super Admin → Kelola Admin → Tambah Admin

### Untuk Super Admin:
1. **HANYA 1 AKUN** (sudah ada di sistem)
2. **TIDAK BISA DAFTAR BARU**
3. Gunakan akun yang sudah tersedia

## 🚀 REDIRECT SETELAH LOGIN
- **Pengguna** → `/pengguna/dashboard`
- **Admin** → `/admin/dashboard`
- **Super Admin** → `/superadmin/dashboard`