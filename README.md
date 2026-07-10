# Sistem Pendaftaran Santri Darul Furqon

Aplikasi Laravel 11 untuk pendaftaran santri putri, verifikasi admin, pemantauan pengasuh, status santri, serta ekspor Excel.

## Persyaratan

- PHP 8.2 atau lebih baru
- MariaDB/MySQL
- Composer
- Node.js dan npm

## Menjalankan proyek

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

Sesuaikan konfigurasi `DB_*` di `.env` sebelum menjalankan migration.

## Akun demo

- Admin: `admin@darulfurqon.test` / `password`
- Pengasuh: `pengasuh@darulfurqon.test` / `password`
- Santri: `santri@darulfurqon.test` / nomor induk `2026009`

Jalankan `php artisan db:seed` untuk membuat atau memperbarui data demo.

## Pemeriksaan kualitas

```bash
vendor/bin/pint --test
php artisan test
npm run build
```

Test menggunakan database `db_pendaftaran_santri_testing` sesuai `phpunit.xml`.
