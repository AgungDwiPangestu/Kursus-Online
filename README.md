# 📚 Sistem Manajemen Kursus Online

> **Proyek Akhir Mata Kuliah Teknologi Framework - Semester 5**  
> Universitas Teknologi Digital Indonesia (UTDI)

---

## 📌 Deskripsi Project

Sistem Manajemen Kursus Online adalah aplikasi web berbasis **Laravel** yang dirancang untuk mengelola:

-   **👨‍🏫 Pengajar** (Instructors) - Dosen/instruktur yang mengajar kursus
-   **📖 Kursus** (Courses) - Mata kuliah/kursus yang ditawarkan
-   **👨‍🎓 Peserta** (Students) - Mahasiswa yang mendaftar kursus

Aplikasi ini menerapkan **arsitektur MVC**, **Eloquent ORM**, dan **role-based access control** dengan 3 level user: Admin, Pengajar, dan Peserta.

---

## 🎯 Fitur Utama

### 🔐 Authentication & Authorization

-   Sistem login/register dengan Laravel Breeze
-   3 role user: **Admin**, **Pengajar**, **Peserta**
-   Akses halaman berdasarkan role (middleware protection)

### 👨‍🏫 Fitur Admin

-   ✅ CRUD lengkap untuk Pengajar, Kursus, dan Peserta
-   ✅ Melihat statistik di dashboard
-   ✅ Melihat semua data kursus dan enrollment

### 👨‍🏫 Fitur Pengajar

-   ✅ Melihat **hanya kursus yang diampu sendiri**
-   ✅ Melihat daftar peserta yang terdaftar di kursusnya
-   ✅ Dashboard dengan statistik kursus pribadi

### 👨‍🎓 Fitur Peserta

-   ✅ Melihat semua kursus yang tersedia
-   ✅ Mendaftar (enroll) ke kursus
-   ✅ Melihat kursus yang sudah diikuti di dashboard

### 🎨 UI/UX Modern

-   Design gradient modern dengan Bootstrap 5.3
-   Responsive layout (mobile-friendly)
-   Card dengan hover effects
-   Navigation bar dengan role-based menu

---

## 🏗️ Arsitektur & Teknologi

| Komponen           | Teknologi             |
| ------------------ | --------------------- |
| **Framework**      | Laravel 12.44.0       |
| **PHP Version**    | PHP 8.3+              |
| **Database**       | MySQL                 |
| **ORM**            | Eloquent              |
| **Authentication** | Laravel Breeze        |
| **Frontend**       | Blade + Bootstrap 5.3 |
| **Icons**          | Bootstrap Icons       |
| **Build Tool**     | Vite                  |

---

## 🗄️ Database Schema

### Entity Relationship Diagram (ERD)

```
┌─────────────┐       ┌──────────────┐       ┌─────────────┐
│   USERS     │       │  PENGAJAR    │       │   KURSUS    │
├─────────────┤       ├──────────────┤       ├─────────────┤
│ id          │◄──────│ user_id      │       │ id          │
│ name        │       │ id           │◄──────│ pengajar_id │
│ email       │       │ nama_pengajar│       │ nama_kursus │
│ password    │       │ email        │       │ deskripsi   │
│ role        │       │ keahlian     │       └──────┬──────┘
└─────────────┘       └──────────────┘              │
      │                                             │
      │         ┌─────────────────┐                 │
      │         │ ENROLLMENTS     │                 │
      │         ├─────────────────┤                 │
      └────────►│ user_id         │                 │
                │ kursus_id       │◄────────────────┘
                │ status          │
                │ tanggal_daftar  │
                │ tanggal_selesai │
                └─────────────────┘
                       │
                       ▼
              ┌─────────────┐
              │   PESERTA   │
              ├─────────────┤
              │ id          │
              │ kursus_id   │
              │ nama_peserta│
              │ email       │
              └─────────────┘
```

### Tabel Users

| Column   | Type    | Description                    |
| -------- | ------- | ------------------------------ |
| id       | BIGINT  | Primary Key                    |
| name     | VARCHAR | Nama user                      |
| email    | VARCHAR | Email (unique)                 |
| password | VARCHAR | Password (hashed)              |
| role     | ENUM    | 'admin', 'pengajar', 'peserta' |

### Tabel Pengajar

| Column        | Type    | Description            |
| ------------- | ------- | ---------------------- |
| id            | BIGINT  | Primary Key            |
| user_id       | BIGINT  | Foreign Key → users.id |
| nama_pengajar | VARCHAR | Nama lengkap pengajar  |
| email         | VARCHAR | Email pengajar         |
| keahlian      | VARCHAR | Bidang keahlian        |

### Tabel Kursus

| Column      | Type    | Description               |
| ----------- | ------- | ------------------------- |
| id          | BIGINT  | Primary Key               |
| pengajar_id | BIGINT  | Foreign Key → pengajar.id |
| nama_kursus | VARCHAR | Nama kursus               |
| deskripsi   | TEXT    | Deskripsi kursus          |

### Tabel Peserta

| Column       | Type    | Description             |
| ------------ | ------- | ----------------------- |
| id           | BIGINT  | Primary Key             |
| kursus_id    | BIGINT  | Foreign Key → kursus.id |
| nama_peserta | VARCHAR | Nama peserta            |
| email        | VARCHAR | Email peserta           |

### Tabel Enrollments

| Column          | Type      | Description                |
| --------------- | --------- | -------------------------- |
| id              | BIGINT    | Primary Key                |
| user_id         | BIGINT    | Foreign Key → users.id     |
| kursus_id       | BIGINT    | Foreign Key → kursus.id    |
| status          | VARCHAR   | 'active', 'completed'      |
| tanggal_daftar  | TIMESTAMP | Tanggal pendaftaran        |
| tanggal_selesai | TIMESTAMP | Tanggal selesai (nullable) |

---

## 📁 Struktur Project

```
sistem-manajemen-kursus-online/
│
├── 📂 app/
│   ├── 📂 Http/Controllers/
│   │   ├── KursusController.php      # CRUD Kursus + Enrollment
│   │   ├── PengajarController.php    # CRUD Pengajar
│   │   ├── PesertaController.php     # CRUD Peserta
│   │   └── ProfileController.php     # Profile management
│   │
│   └── 📂 Models/
│       ├── User.php                  # Model User dengan role
│       ├── Pengajar.php              # Model Pengajar
│       ├── Kursus.php                # Model Kursus
│       ├── Peserta.php               # Model Peserta
│       └── Enrollment.php            # Model Enrollment
│
├── 📂 database/
│   ├── 📂 migrations/
│   │   ├── create_users_table.php
│   │   ├── create_pengajar_table.php
│   │   ├── create_kursus_table.php
│   │   ├── create_peserta_table.php
│   │   ├── create_enrollments_table.php
│   │   └── add_role_to_users_table.php
│   │
│   └── 📂 seeders/
│       ├── DatabaseSeeder.php        # Main seeder
│       ├── AdminSeeder.php           # Seed admin account
│       ├── KursusSeeder.php          # Seed 12 kursus + 6 pengajar
│       ├── PengajarUserSeeder.php    # Seed 6 akun pengajar
│       └── PesertaUserSeeder.php     # Seed 100 akun peserta
│
├── 📂 resources/views/
│   ├── 📂 layouts/
│   │   ├── app.blade.php             # Layout authenticated
│   │   ├── guest.blade.php           # Layout auth pages
│   │   └── public.blade.php          # Layout public dengan navbar
│   │
│   ├── 📂 auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   │
│   ├── 📂 pengajar/
│   │   ├── index.blade.php           # List pengajar
│   │   ├── show.blade.php            # Detail pengajar
│   │   ├── create.blade.php          # Form tambah
│   │   └── edit.blade.php            # Form edit
│   │
│   ├── 📂 kursus/
│   │   ├── index.blade.php           # List kursus
│   │   ├── show.blade.php            # Detail kursus
│   │   ├── create.blade.php          # Form tambah
│   │   ├── edit.blade.php            # Form edit
│   │   └── peserta.blade.php         # List peserta per kursus
│   │
│   ├── 📂 peserta/
│   │   ├── index.blade.php           # List peserta (grouped)
│   │   ├── show.blade.php            # Detail peserta
│   │   ├── create.blade.php          # Form tambah
│   │   └── edit.blade.php            # Form edit
│   │
│   ├── dashboard.blade.php           # Dashboard per role
│   └── welcome.blade.php             # Homepage
│
└── 📂 routes/
    └── web.php                       # All routes
```

---

## 🚀 Panduan Instalasi

### Prasyarat (Prerequisites)

Pastikan komputer sudah terinstall:

-   ✅ **PHP** >= 8.2
-   ✅ **Composer** (PHP Package Manager)
-   ✅ **MySQL** >= 5.7 atau MariaDB
-   ✅ **Node.js** >= 18 & **npm**
-   ✅ **Git** (untuk clone repository)

### Step-by-Step Installation

#### 1️⃣ Clone Repository

```bash
git clone <repository-url>
cd sistem-manajemen-kursus-online
```

#### 2️⃣ Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

#### 3️⃣ Konfigurasi Environment

```bash
# Copy file environment
copy .env.example .env

# Generate application key
php artisan key:generate
```

Edit file `.env` dan sesuaikan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sm_kursus_online
DB_USERNAME=root
DB_PASSWORD=
```

#### 4️⃣ Setup Database

```sql
-- Buat database di MySQL
CREATE DATABASE sm_kursus_online;
```

```bash
# Jalankan migrations
php artisan migrate

# Jalankan semua seeders (PENTING!)
php artisan db:seed
```

#### 5️⃣ Jalankan Aplikasi

```bash
# Terminal 1 - Laravel Server
php artisan serve

# Terminal 2 - Vite (untuk CSS/JS)
npm run dev
```

#### 6️⃣ Akses Aplikasi

Buka browser: **http://127.0.0.1:8000**

---

## 👥 Akun Login untuk Demo

Setelah menjalankan `php artisan db:seed`, tersedia akun-akun berikut:

### 🔴 Admin (Full Access)

| Field    | Value                                  |
| -------- | -------------------------------------- |
| Email    | `admin@example.com`                    |
| Password | `password`                             |
| Akses    | CRUD semua data, lihat semua statistik |

### 🟢 Pengajar (6 Akun Tersedia)

| Nama             | Email                       | Kursus Yang Diampu    |
| ---------------- | --------------------------- | --------------------- |
| Dr. Budi Santoso | `pengajar@example.com`      | Laravel, Node.js      |
| Sarah Johnson    | `sarah.johnson@example.com` | React, Vue.js         |
| Ahmad Hidayat    | `ahmad.hidayat@example.com` | Docker, AWS           |
| Lisa Martinez    | `lisa.martinez@example.com` | Flutter, React Native |
| Rudi Hermawan    | `rudi.hermawan@example.com` | Data Science, ML      |
| Maya Putri       | `maya.putri@example.com`    | Full Stack, MERN      |

> **Password semua pengajar**: `password`

### 🔵 Peserta (100+ Akun)

| Field    | Value                                          |
| -------- | ---------------------------------------------- |
| Email    | `peserta@example.com` (dan 100+ random emails) |
| Password | `password`                                     |
| Akses    | Lihat kursus, enroll ke kursus                 |

---

## 🎬 Panduan Demo untuk Dosen

### Demo 1: Login sebagai Admin

1. Buka http://127.0.0.1:8000
2. Klik **Login**
3. Masukkan: `admin@example.com` / `password`
4. **Tunjukkan**:
    - Dashboard dengan statistik
    - Menu Pengajar → CRUD lengkap
    - Menu Kursus → CRUD lengkap + lihat peserta
    - Menu Peserta → Lihat semua peserta (grouped by user)

### Demo 2: Login sebagai Pengajar

1. Logout dari admin
2. Login dengan: `sarah.johnson@example.com` / `password`
3. **Tunjukkan**:
    - Dashboard pengajar dengan statistik kursus pribadi
    - Menu Kursus → **Hanya muncul 2 kursus** (React & Vue.js)
    - Klik "Lihat Peserta" → Daftar mahasiswa yang enroll
    - Tidak ada tombol Create/Edit/Delete (bukan admin)

### Demo 3: Login sebagai Peserta

1. Logout dari pengajar
2. Login dengan: `peserta@example.com` / `password`
3. **Tunjukkan**:
    - Dashboard peserta dengan kursus yang diikuti
    - Menu Kursus → Lihat semua kursus
    - Klik Detail kursus → Tombol "Daftar Kursus"
    - Proses enrollment ke kursus baru

### Demo 4: Fitur Enrollment

1. Login sebagai peserta baru atau existing
2. Buka halaman Kursus
3. Pilih kursus yang belum diikuti
4. Klik "Daftar Kursus"
5. Lihat konfirmasi berhasil
6. Cek di Dashboard → kursus muncul di daftar

### Demo 5: Menunjukkan Database

1. Buka MySQL/phpMyAdmin
2. Tunjukkan tabel-tabel:
    - `users` - 109 records (1 admin + 6 pengajar + 102 peserta)
    - `pengajar` - 6 records dengan user_id
    - `kursus` - 12 records
    - `enrollments` - 289+ records
    - `peserta` - 289+ records

---

## 📊 Data Statistik (Setelah Seeding)

| Entitas     | Jumlah |
| ----------- | ------ |
| Total Users | 109    |
| Admin       | 1      |
| Pengajar    | 6      |
| Peserta     | 102    |
| Kursus      | 12     |
| Enrollments | 289+   |

### Distribusi Peserta per Kursus

| Kursus                                | Jumlah Peserta |
| ------------------------------------- | -------------- |
| Backend Development dengan Laravel    | ~29            |
| Node.js & Express Backend Development | ~21            |
| Frontend Development dengan React     | ~27            |
| Vue.js untuk Pemula                   | ~17            |
| DevOps dengan Docker & Kubernetes     | ~20            |
| Cloud Computing dengan AWS            | ~16            |
| Mobile Development dengan Flutter     | ~18            |
| React Native untuk Mobile Apps        | ~33            |
| Data Science dengan Python            | ~25            |
| Machine Learning Fundamentals         | ~26            |
| Full Stack Web Development            | ~25            |
| MERN Stack Development                | ~32            |

---

## 🔗 Eloquent Relationships

```php
// User.php
public function pengajar() {
    return $this->hasOne(Pengajar::class);
}
public function enrollments() {
    return $this->hasMany(Enrollment::class);
}

// Pengajar.php
public function user() {
    return $this->belongsTo(User::class);
}
public function kursus() {
    return $this->hasMany(Kursus::class);
}

// Kursus.php
public function pengajar() {
    return $this->belongsTo(Pengajar::class);
}
public function peserta() {
    return $this->hasMany(Peserta::class);
}
public function enrollments() {
    return $this->hasMany(Enrollment::class);
}

// Peserta.php
public function kursus() {
    return $this->belongsTo(Kursus::class);
}

// Enrollment.php
public function user() {
    return $this->belongsTo(User::class);
}
public function kursus() {
    return $this->belongsTo(Kursus::class);
}
```

---

## 🛣️ Routes Overview

| Method | URI                  | Action              | Middleware  |
| ------ | -------------------- | ------------------- | ----------- |
| GET    | /                    | Homepage            | -           |
| GET    | /login               | Login page          | guest       |
| POST   | /login               | Login action        | guest       |
| GET    | /register            | Register page       | guest       |
| POST   | /register            | Register action     | guest       |
| GET    | /dashboard           | Dashboard           | auth        |
| GET    | /pengajar            | List pengajar       | -           |
| GET    | /pengajar/{id}       | Detail pengajar     | -           |
| GET    | /pengajar/create     | Form tambah         | auth, admin |
| POST   | /pengajar            | Store pengajar      | auth, admin |
| GET    | /pengajar/{id}/edit  | Form edit           | auth, admin |
| PUT    | /pengajar/{id}       | Update pengajar     | auth, admin |
| DELETE | /pengajar/{id}       | Delete pengajar     | auth, admin |
| GET    | /kursus              | List kursus         | -           |
| GET    | /kursus/{id}         | Detail kursus       | -           |
| GET    | /kursus/{id}/peserta | List peserta kursus | auth        |
| POST   | /kursus/{id}/enroll  | Enroll to kursus    | auth        |
| GET    | /peserta             | List peserta        | -           |

---

## 🐛 Troubleshooting

### ❌ Error: "SQLSTATE[HY000] [1049] Unknown database"

```bash
# Buat database terlebih dahulu
mysql -u root -e "CREATE DATABASE sm_kursus_online"
```

### ❌ Error: "Vite manifest not found"

```bash
# Jalankan Vite di terminal terpisah
npm run dev
```

### ❌ Error: "500 Internal Server Error"

```bash
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### ❌ Error: "Class not found"

```bash
composer dump-autoload
```

### ❌ Data tidak muncul setelah migrate

```bash
# Jalankan semua seeder
php artisan db:seed

# Atau fresh migrate + seed
php artisan migrate:fresh --seed
```

---

## 📝 Catatan Penting

1. **Selalu jalankan `npm run dev`** di terminal terpisah untuk styling
2. **Jalankan `php artisan db:seed`** untuk data demo
3. Semua password default adalah: **`password`**
4. Role pengajar hanya melihat kursus yang diampu
5. Peserta dapat enroll ke kursus manapun

---

## 👨‍💻 Developer

**Mata Kuliah**: Teknologi Framework - Pertemuan 14  
**Institusi**: Universitas Teknologi Digital Indonesia (UTDI)  
**Semester**: 5 (Lima)  
**Tahun**: 2026

---

## 📄 License

Project ini dikembangkan untuk keperluan akademis (Proyek Akhir Semester 5).

---

## 🙏 Acknowledgements

Terima kasih kepada:

-   **Laravel Team** - Framework PHP yang luar biasa
-   **Bootstrap Team** - CSS Framework yang responsif
-   **Faker PHP** - Library untuk generate data dummy
-   **Laravel Breeze** - Starter kit authentication
-   **Vite** - Build tool yang super cepat

---

## 🌟 Support This Project

Jika project ini bermanfaat, berikan ⭐ star di repository!

---

## 📞 Contact & Support

Untuk pertanyaan, saran, atau kolaborasi:

-   📧 **Email**: [Hubungi Developer]
-   🐛 **Bug Report**: Buka issue di repository
-   💡 **Feature Request**: Buka issue dengan label "enhancement"

---

<div align="center">

### 🎨 Crafted with ❤️ by

# 🔫 ApGuns

[![Made with Laravel](https://img.shields.io/badge/Made%20with-Laravel-red?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap)](https://getbootstrap.com)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql)](https://mysql.com)

---

**🎓 Proyek Akhir Teknologi Framework**  
**Universitas Teknologi Digital Indonesia (UTDI)**  
**Semester 5 - Tahun 2026**

---

> _"Code is like humor. When you have to explain it, it's bad."_ - Cory House

---

![Visitors](https://img.shields.io/badge/Thanks%20for-Visiting!-brightgreen?style=flat-square)

**© 2026 ApGuns - All Rights Reserved**

</div>
