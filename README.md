# Sistem Manajemen Kursus Online Sederhana (Laravel)

> **IMPORTANT CONTEXT FOR GITHUB COPILOT & AI ASSISTANTS**  
> This README defines **STRICT REQUIREMENTS** for this project.  
> Any generated code MUST follow the rules and constraints below.

---

## 📌 Project Overview

This is a **Laravel-based web application** for managing:

-   Pengajar (Instructors)
-   Kursus (Courses)
-   Peserta (Participants)

The project is developed as an **Academic Final Project (Proyek Akhir)** and must strictly apply **MVC architecture**, **Eloquent ORM**, and **resource-based CRUD**.

---

## 🧱 Core Technical Requirements (DO NOT VIOLATE)

-   Framework: **Laravel**
-   Architecture Pattern: **MVC**
-   Database: **MySQL**
-   ORM: **Eloquent**
-   Routing: **Resource Controllers only**
-   Validation: **Form Request only**
-   Business logic must NOT be placed inside `routes/web.php`

---

## 🗄 Database Schema (FIXED & MANDATORY)

### Table: `pengajar`

| Column        | Type                 |
| ------------- | -------------------- |
| id            | BIGINT (Primary Key) |
| nama_pengajar | VARCHAR              |
| email         | VARCHAR              |
| keahlian      | VARCHAR              |

---

### Table: `kursus`

| Column      | Type                               |
| ----------- | ---------------------------------- |
| id          | BIGINT (Primary Key)               |
| pengajar_id | BIGINT (Foreign Key → pengajar.id) |
| nama_kursus | VARCHAR                            |
| deskripsi   | TEXT                               |

---

### Table: `peserta`

| Column       | Type                             |
| ------------ | -------------------------------- |
| id           | BIGINT (Primary Key)             |
| kursus_id    | BIGINT (Foreign Key → kursus.id) |
| nama_peserta | VARCHAR                          |
| email        | VARCHAR                          |

---

## 🔗 Eloquent Relationships (MANDATORY)

```php
// Pengajar.php
public function kursus()
{
    return $this->hasMany(Kursus::class);
}

// Kursus.php
public function pengajar()
{
    return $this->belongsTo(Pengajar::class);
}

public function peserta()
{
    return $this->hasMany(Peserta::class);
}

// Peserta.php
public function kursus()
{
    return $this->belongsTo(Kursus::class);
}
```

Controllers (RESOURCE CONTROLLERS ONLY)

Controllers that MUST exist:

PengajarController

KursusController

PesertaController

Rules:

Use php artisan make:controller --resource

Controllers must use Eloquent ORM

No database queries inside Blade views
Route::resource('pengajar', PengajarController::class);
Route::resource('kursus', KursusController::class);
Route::resource('peserta', PesertaController::class)
->only(['index', 'create', 'store']);
❌ No business logic inside routes/web.php

---

## 🚀 Installation & Setup Guide

### Prerequisites

Pastikan sistem Anda sudah memiliki:

-   **PHP** >= 8.2
-   **Composer** (PHP Package Manager)
-   **MySQL** >= 5.7 atau MariaDB
-   **Node.js** & **npm** (untuk Vite & Tailwind CSS)
-   **Git** (opsional)

### Step 1: Clone Repository

```bash
git clone <repository-url>
cd sistem-manajemen-kursus-online
```

### Step 2: Install Dependencies

Install PHP dependencies:

```bash
composer install
```

Install Node.js dependencies:

```bash
npm install
```

### Step 3: Environment Configuration

Copy file `.env.example` menjadi `.env`:

```bash
copy .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sm_kursus_online
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Create Database

Buat database MySQL baru:

```sql
CREATE DATABASE sm_kursus_online;
```

### Step 6: Run Migrations

```bash
php artisan migrate
```

### Step 7: Seed Database (Optional but Recommended)

Jalankan seeder untuk mengisi data awal:

```bash
php artisan db:seed
```

### Step 8: Run Development Server

Terminal 1 - Laravel Server:

```bash
php artisan serve
```

Terminal 2 - Vite Dev Server (untuk hot reload CSS/JS):

```bash
npm run dev
```

### Step 9: Access Application

Buka browser dan akses: **http://127.0.0.1:8000**

---

## 👥 Default Login Accounts

Setelah menjalankan `php artisan db:seed`, Anda dapat login dengan akun berikut:

### Admin Account

-   **Email**: `admin@example.com`
-   **Password**: `password`
-   **Role**: Administrator
-   **Akses**: Full access ke semua fitur (Create, Read, Update, Delete)

### Pengajar Account

-   **Email**: `pengajar@example.com`
-   **Password**: `password`
-   **Role**: Pengajar (Instructor)
-   **Akses**: Manage kursus yang diampu

### Peserta Account

-   **Email**: `peserta@example.com`
-   **Password**: `password`
-   **Role**: Peserta (Student)
-   **Akses**: View kursus & enrollment

> **Note**: Untuk keamanan, **UBAH PASSWORD** setelah login pertama kali!

---

## 🎨 Features

### ✅ Authentication & Authorization

-   Login/Register menggunakan Laravel Breeze
-   Role-based access control (Admin, Pengajar, Peserta)
-   Protected routes dengan middleware

### ✅ Course Management (Kursus)

-   CRUD lengkap untuk kursus
-   Relasi dengan pengajar
-   Sistem enrollment untuk peserta

### ✅ Instructor Management (Pengajar)

-   CRUD lengkap untuk pengajar
-   View kursus yang diampu
-   Profile management

### ✅ Student Management (Peserta)

-   Enrollment system
-   View enrolled courses
-   Progress tracking

### ✅ Modern UI/UX

-   Gradient design dengan Tailwind CSS
-   Responsive layout
-   Interactive cards dengan hover effects
-   Dashboard dengan statistik

---

## 📂 Project Structure

```
sistem-manajemen-kursus-online/
├── app/
│   ├── Http/Controllers/
│   │   ├── PengajarController.php
│   │   ├── KursusController.php
│   │   └── PesertaController.php
│   └── Models/
│       ├── Pengajar.php
│       ├── Kursus.php
│       ├── Peserta.php
│       ├── Enrollment.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php (Authenticated)
│       │   ├── guest.blade.php (Auth pages)
│       │   └── public.blade.php (Public pages)
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── pengajar/
│       ├── kursus/
│       ├── peserta/
│       ├── dashboard.blade.php
│       └── welcome.blade.php
└── routes/
    └── web.php
```

---

## 🛠 Tech Stack

-   **Backend**: Laravel 12.x, PHP 8.3
-   **Frontend**: Blade Templates, Tailwind CSS, Bootstrap 5.3
-   **Database**: MySQL
-   **Build Tool**: Vite
-   **Authentication**: Laravel Breeze
-   **Icons**: Bootstrap Icons

---

## 🐛 Troubleshooting

### Issue: Vite not loading styles

**Solution**: Pastikan Vite dev server berjalan (`npm run dev`)

### Issue: Database connection error

**Solution**: Periksa konfigurasi `.env` dan pastikan MySQL service aktif

### Issue: 500 Internal Server Error

**Solution**: Jalankan `php artisan key:generate` dan clear cache:

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Issue: Permission denied (storage/logs)

**Solution**: Set permission folder storage:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## 📝 License

This project is developed for academic purposes (Proyek Akhir Semester 5).

---

## 👨‍💻 Developer

**Teknologi Framework - Pertemuan 14**  
Universitas Teknologi Digital Indonesia (UTDI)

---

## 📧 Support

Untuk pertanyaan atau masalah, silakan buka issue di repository atau kontak developer.
