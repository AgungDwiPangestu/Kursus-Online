# Sistem Manajemen Kursus Online - Dokumentasi Fitur Login & Admin

## 🎯 Perubahan yang Dilakukan

### 1. **Authentication System**

-   ✅ Laravel Breeze diinstall untuk sistem login/register
-   ✅ Halaman login, register, forgot password tersedia
-   ✅ Email verification (opsional)

### 2. **Role-Based Access Control**

#### Database Changes:

-   **users table**: Ditambahkan kolom `role` dengan nilai: `admin`, `pengajar`, `peserta`
-   **enrollments table** (BARU): Untuk tracking pendaftaran peserta ke kursus
    -   user_id
    -   kursus_id
    -   status: pending, active, completed, cancelled
    -   tanggal_daftar
    -   tanggal_selesai
-   **pengajar table**: Ditambahkan `user_id` untuk link dengan users

#### Model Updates:

-   **User Model**:

    ```php
    - isAdmin()    // Cek apakah user adalah admin
    - isPengajar() // Cek apakah user adalah pengajar
    - isPeserta()  // Cek apakah user adalah peserta
    - enrollments() // Relasi dengan enrollments
    - pengajar()    // Relasi dengan pengajar (untuk user pengajar)
    ```

-   **Enrollment Model** (BARU):

    ```php
    - belongsTo(User)
    - belongsTo(Kursus)
    ```

-   **Pengajar Model**:

    ```php
    - belongsTo(User) // Link ke user account
    ```

-   **Kursus Model**:
    ```php
    - enrollments()   // Semua enrollments untuk kursus ini
    - enrolledUsers() // Semua user yang terdaftar di kursus ini
    ```

### 3. **Middleware Protection**

#### AdminMiddleware:

-   Melindungi route yang hanya bisa diakses admin
-   Redirect ke login jika belum login
-   Return 403 forbidden jika bukan admin

#### Route Structure:

```php
// Public routes (siapa saja bisa akses)
GET /                          // Homepage
GET /pengajar                  // Lihat daftar pengajar
GET /pengajar/{id}             // Detail pengajar
GET /kursus                    // Lihat daftar kursus
GET /kursus/{id}               // Detail kursus
GET /peserta                   // Lihat daftar peserta
GET /peserta/{id}              // Detail peserta

// Authenticated users only
GET /dashboard                 // Dashboard
GET /profile/edit              // Edit profile
PATCH /profile                 // Update profile
DELETE /profile                // Delete account

// Admin only (CRUD operations)
GET /pengajar/create           // Form tambah pengajar
POST /pengajar                 // Simpan pengajar baru
GET /pengajar/{id}/edit        // Form edit pengajar
PUT /pengajar/{id}             // Update pengajar
DELETE /pengajar/{id}          // Hapus pengajar

GET /kursus/create             // Form tambah kursus
POST /kursus                   // Simpan kursus baru
GET /kursus/{id}/edit          // Form edit kursus
PUT /kursus/{id}               // Update kursus
DELETE /kursus/{id}            // Hapus kursus

GET /peserta/create            // Form tambah peserta
POST /peserta                  // Simpan peserta baru
GET /peserta/{id}/edit         // Form edit peserta
PUT /peserta/{id}              // Update peserta
DELETE /peserta/{id}           // Hapus peserta
```

### 4. **View Updates**

#### Homepage (welcome.blade.php):

-   ✅ Tombol Login/Register untuk guest
-   ✅ Menu Dashboard + Profile untuk user yang sudah login
-   ✅ Dropdown dengan opsi Logout

#### Index Views (pengajar, kursus, peserta):

-   ✅ Tombol "Tambah" hanya tampil untuk admin
-   ✅ Tombol Edit/Hapus hanya tampil untuk admin
-   ✅ User biasa hanya bisa melihat (view only)

## 👥 User Accounts (untuk testing)

| Email                | Password | Role     | Akses                      |
| -------------------- | -------- | -------- | -------------------------- |
| admin@example.com    | password | admin    | Semua akses CRUD           |
| pengajar@example.com | password | pengajar | View only (untuk sekarang) |
| peserta@example.com  | password | peserta  | View only (untuk sekarang) |

## 🚀 Cara Testing

1. **Akses website**: http://127.0.0.1:8000
2. **Lihat kursus**: Klik menu "Kursus" → Bisa lihat tanpa login
3. **Login sebagai admin**:
    - Email: admin@example.com
    - Password: password
    - Setelah login, tombol "Tambah Kursus", "Edit", "Hapus" akan muncul
4. **Login sebagai user biasa**:
    - Email: peserta@example.com
    - Password: password
    - Tombol CRUD tidak akan terlihat (hanya bisa view)
5. **Coba akses direct**: http://127.0.0.1:8000/kursus/create
    - Jika admin: bisa akses
    - Jika bukan admin: error 403 Forbidden

## 📊 Struktur Database yang Sudah Diperbaiki

### Proses Bisnis Kursus Online:

1. **Users** (Akun login untuk semua orang)

    - Admin: mengelola data
    - Pengajar: punya akun dan link ke table pengajar
    - Peserta: punya akun dan bisa daftar ke kursus

2. **Pengajar** (Data pengajar)

    - Terhubung ke Users (user_id)
    - Mengajar banyak Kursus

3. **Kursus** (Data kursus)

    - Diajar oleh 1 Pengajar
    - Bisa diikuti banyak Peserta (via Enrollments)

4. **Enrollments** (Pendaftaran kursus)

    - User mendaftar ke Kursus
    - Status: pending → active → completed/cancelled
    - Track tanggal mulai dan selesai

5. **Peserta** (Data peserta lama - opsional)
    - Masih ada untuk backward compatibility
    - Bisa digunakan untuk data peserta per kursus

## 🎨 Fitur Tambahan yang Bisa Dikembangkan

-   [ ] Dashboard berbeda untuk admin/pengajar/peserta
-   [ ] Fitur enrollment: peserta bisa daftar kursus sendiri
-   [ ] Pengajar bisa manage kursus mereka sendiri
-   [ ] Progress tracking untuk peserta
-   [ ] Certificate setelah selesai kursus
-   [ ] Payment system untuk kursus berbayar
-   [ ] Rating & review untuk kursus

## 📝 Notes

-   Semua migration sudah dijalankan
-   Database sudah berisi data sample (12 kursus, 6 pengajar)
-   Frontend assets sudah di-build
-   Server running di http://127.0.0.1:8000
