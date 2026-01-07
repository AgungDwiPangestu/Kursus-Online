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
