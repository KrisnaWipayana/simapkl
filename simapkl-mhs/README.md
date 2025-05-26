<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo" />
  </a>
</p>

<h1 align="center">Sistem Manajemen PKL (Magang)</h1>

<p align="center">
  <strong>Aplikasi berbasis Laravel untuk memudahkan pengelolaan kegiatan Praktik Kerja Lapangan (PKL) dengan antarmuka modern menggunakan Tailwind CSS dan Alpine.js.</strong>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## 🔍 Deskripsi Singkat

Sistem ini dirancang untuk membantu institusi pendidikan dan perusahaan dalam mengelola proses PKL (magang) secara digital. Fitur utama meliputi:

- Pendaftaran dan verifikasi peserta PKL.
- Pengelolaan jadwal dan penempatan peserta.
- Monitoring dan evaluasi kemajuan magang.
- Notifikasi dan komunikasi antar pihak terkait.

Dibangun dengan **Laravel** sebagai backend framework yang powerful, didukung oleh **Tailwind CSS** untuk tampilan yang responsif dan modern, serta **Alpine.js** untuk interaktivitas ringan di sisi frontend.

---

## 🛠️ Tech Stack

- **Backend:** Laravel (PHP Framework)
- **Frontend Styling:** Tailwind CSS
- **Interactivity:** Alpine.js
- **Database:** Sesuaikan dengan kebutuhan (MySQL, SQLite, dll)

---

## ⚙️ Panduan Instalasi

Pastikan beberapa tools berikut sudah terinstall agar sistem berjalan lancar:

- [Node.js](https://nodejs.org/en/download)
- [PHP](https://www.php.net/downloads.php)
- [XAMPP](https://www.apachefriends.org/download.html) (atau server lokal lain)
- [Composer](https://getcomposer.org/download/)
- [Git](https://git-scm.com/downloads) (opsional, tapi direkomendasikan)
- NPM (biasanya sudah tersedia setelah install Node.js)

---

## 🚀 Setup Project

Jalankan perintah berikut di terminal/cmd pada root project:

```bash
npm install           # Install dependencies frontend
composer install      # Install dependencies backend
php artisan key:generate  # Generate aplikasi key Laravel
git config user.email "email@example.com"  # Konfigurasi git user email (opsional)
