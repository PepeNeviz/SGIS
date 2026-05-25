# SGIS (Student Growth Information System)

SGIS adalah website sistem informasi siswa berbasis Laravel yang dirancang untuk membantu sekolah dalam memantau perkembangan akademik dan skill siswa SMK.

Website ini memiliki beberapa role seperti siswa, guru, dan BK yang masing-masing memiliki dashboard dan fitur berbeda sesuai kebutuhan mereka.

SGIS tidak hanya menampilkan nilai siswa, tetapi juga memberikan rekomendasi karir dan jurusan kuliah berdasarkan performa akademik dan skill siswa.

Project ini dibuat sebagai proyek Pemrograman Web kelas XI RPL.

---

# Features

## Student
- Dashboard siswa modern
- Melihat rata-rata nilai
- Melihat perkembangan nilai
- Grafik perkembangan akademik
- Skill progress
- Rekomendasi karir
- Rekomendasi jurusan kuliah

## Teacher
- Dashboard guru
- Input nilai siswa
- Melihat data siswa

## BK
- Dashboard BK
- Monitoring perkembangan siswa

## Authentication
- Login multi-role
- Middleware role system

---

# Tech Stack

- Laravel 13
- Tailwind CSS
- MySQL
- Vite
- Blade
- Chart.js

---

# Screenshots

## Student Dashboard
Tambahkan screenshot di sini

## Grades Page
Tambahkan screenshot di sini

---

# 🎥 Demo Video

Masukkan link video demo di sini

---

# Team
Nama Kelompok : Ngangguk-ngangguk🙂‍↕🙂‍↕
- Ilham Fattahilah Elandi
- Rafif Akbar Maliq Firdaus
- Ziven Larendra

---

# Installation

```bash
git clone https://github.com/PepeNeviz/SGIS.git
cd SGIS
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```
