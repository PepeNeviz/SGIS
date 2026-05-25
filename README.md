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

## Login Page
<img width="960" height="413" alt="image" src="https://github.com/user-attachments/assets/ab848959-879d-4056-b010-5c2bcfd294b3" />


## Student Dashboard
<img width="626" height="824" alt="image" src="https://github.com/user-attachments/assets/5009ce29-0847-4e29-a315-8fc7ef19e6e3" />


## Grades Page (Student)
<img width="626" height="824" alt="image" src="https://github.com/user-attachments/assets/2a8ecb23-2965-4423-9dae-adcc36807fae" />


## Teacher Dashboard
<img width="960" height="412" alt="image" src="https://github.com/user-attachments/assets/10177fde-031f-4536-b13f-730faaf99dcb" />


## List Student Page (Teacher)
<img width="960" height="249" alt="image" src="https://github.com/user-attachments/assets/2ab84a32-e8b3-4751-a409-02de1999d7a1" />


## Grades Page (Teacher)
<img width="309" height="300" alt="image" src="https://github.com/user-attachments/assets/250586a0-cac5-4b52-826a-05dd0e85bcfb" />


## BK Dashboard
<img width="948" height="411" alt="image" src="https://github.com/user-attachments/assets/ff569a76-4963-4963-84b8-51675f0560ee" />


## List Student Page (BK)
<img width="1919" height="643" alt="image" src="https://github.com/user-attachments/assets/56988b23-2ff3-435f-ae75-a0e61468b758" />


## Monitoring Student Page
<img width="309" height="293" alt="image" src="https://github.com/user-attachments/assets/60c06884-efbc-47a0-869c-a01f4c9aa63d" />

---

# 🎥 Demo Video

## Student 
https://github.com/user-attachments/assets/739358bb-fc9a-42f1-842f-1f856b8008e7

## Teacher
https://github.com/user-attachments/assets/b543baf4-dfeb-4cf6-a8a6-96753e3c6756

## BK
https://github.com/user-attachments/assets/413cb3f1-35b1-4080-916a-56e5b874b6e3

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
