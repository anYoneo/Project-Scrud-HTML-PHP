# PSB Online — Sistem Penerimaan Siswa Baru

> Sistem manajemen penerimaan siswa baru berbasis web menggunakan **Laravel 11 + Bootstrap 5**
> Dibangun ulang dari legacy PHP procedural menjadi arsitektur MVC yang bersih, aman, dan maintainable.

## ✨ Fitur
- 🔐 Login admin yang aman (bcrypt password hashing)
- 📋 CRUD lengkap data peserta
- 🔍 Pencarian & filter peserta
- 🖨️ Cetak bukti pendaftaran (print-friendly)
- 📊 Laporan daftar peserta
- 📱 Responsive design (mobile-friendly)
- 🛡️ Perlindungan CSRF, SQL Injection, dan Session Hijacking
- 🗑️ Soft delete (data tidak hilang permanen)
- 🏙️ Auto-complete kecamatan via API
- 📁 Upload foto peserta dengan validasi

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 11 (PHP 8.2+) |
| Frontend | Bootstrap 5.3 + Bootstrap Icons |
| Database | MySQL 8.0+ |
| ORM | Eloquent (prepared statements otomatis) |
| Auth | Custom session-based middleware |

## 🚀 Instalasi

```bash
git clone https://github.com/anYoneo/Project-Scrud-HTML-PHP.git
cd Project-Scrud-HTML-PHP
composer install
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dengan konfigurasi database Anda:
```env
DB_DATABASE=db_psb_online
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

Jalankan migration dan seeder:
```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

## 🔑 Default Login

| Field | Value |
|---|---|
| Username | `admin` |
| Password | `Admin@12345` |

> ⚠️ Ganti password setelah login pertama!

## 📁 Struktur Proyek

```
Project-Scrud-HTML-PHP/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # AuthController, PesertaController, dll
│   │   ├── Middleware/     # AuthCheck.php
│   │   └── Requests/       # LoginRequest, PesertaRequest
│   └── Models/             # Admin, Kecamatan, Pendaftaran
├── database/
│   ├── migrations/         # Schema database
│   └── seeders/            # Data awal (admin + kecamatan)
├── resources/views/
│   ├── auth/               # Login view
│   ├── dashboard/          # Dashboard view
│   ├── peserta/            # CRUD views
│   ├── laporan/            # Cetak bukti & daftar
│   └── layouts/            # Main layout (sidebar + topbar)
└── routes/web.php          # Semua routes
```

## 🔒 Keamanan

| Risiko Lama | Fix Baru |
|---|---|
| MD5 password | `Hash::make()` bcrypt |
| SQL Injection | Eloquent ORM (prepared statements) |
| Tidak ada CSRF | Laravel CSRF middleware di semua form |
| Hardcoded credentials | `.env` file (tidak di-commit) |
| No session validation | `AuthCheck` middleware di semua route admin |
| File upload tidak aman | Validasi MIME type + size limit |
