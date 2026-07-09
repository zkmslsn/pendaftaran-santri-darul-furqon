# Deploy Laravel ke Render

Project ini menggunakan Docker dengan PHP 8.2, Apache, Composer production, dan
aset Vite yang sudah dibangun. Apache melayani aplikasi dari folder `public` dan
mendengarkan port yang diberikan Render melalui environment variable `PORT`.

## 1. Siapkan repository

Pastikan branch `main` sudah dikirim ke GitHub. Jangan commit `.env`, `vendor`,
`node_modules`, atau kredensial database. Semuanya sudah dikecualikan oleh
`.gitignore` dan `.dockerignore`.

## 2. Buat Web Service

1. Di Render Dashboard, pilih **New > Web Service**.
2. Hubungkan repository GitHub project ini dan pilih branch `main`.
3. Pilih runtime **Docker**. Render akan menggunakan `Dockerfile` di root.
4. Health Check Path diisi `/up`.
5. Jangan mengisi Docker Command; image sudah menjalankan Apache melalui
   entrypoint.

## 3. Atur environment variables

Isi nilai berikut di menu **Environment** milik Web Service. Gunakan data MySQL
online, bukan database lokal:

```text
APP_NAME=Pendaftaran Santri Darul Furqon
APP_ENV=production
APP_KEY=<hasil php artisan key:generate --show>
APP_DEBUG=false
APP_URL=https://<nama-service>.onrender.com
ASSET_URL=https://<nama-service>.onrender.com
LOG_CHANNEL=stderr
LOG_LEVEL=info

DB_CONNECTION=mysql
DB_HOST=<host-mysql-online>
DB_PORT=3306
DB_DATABASE=<nama-database>
DB_USERNAME=<username-database>
DB_PASSWORD=<password-database>
```

Tambahkan environment variable lain yang dipakai aplikasi (misalnya konfigurasi
mail atau WhatsApp) langsung di Render. Jangan menaruh nilai rahasia tersebut di
file project.

`APP_KEY` dapat dibuat di komputer lokal dengan:

```bash
php artisan key:generate --show
```

## 4. Jalankan migrasi

Pada paid Web Service, isi **Pre-Deploy Command** berikut agar migrasi dijalankan
sebelum setiap versi baru aktif:

```bash
php artisan migrate --force
```

Free Web Service tidak menyediakan Shell atau Pre-Deploy Command. Jika memakai
paket Free dan database belum dimigrasikan, isi **Docker Command** sementara
dengan:

```bash
/bin/sh -c "php artisan migrate --force && apache2-foreground"
```

Setelah deploy berhasil, Docker Command boleh dikosongkan kembali agar service
menggunakan `CMD` bawaan image. Jangan menjalankan seeder production kecuali
memang sudah meninjau data yang akan dibuat.

## 5. Penyimpanan file upload

Filesystem instance Render bersifat ephemeral. Agar dokumen upload tetap ada
setelah restart atau deploy, gunakan Render Persistent Disk pada paid service
dengan mount path:

```text
/var/www/html/storage/app
```

Alternatifnya, konfigurasi Laravel Filesystem ke object storage yang persisten.
Free Web Service tidak mendukung Persistent Disk, sehingga object storage
dibutuhkan agar upload tidak hilang saat service restart atau spin down.
Container otomatis membuat `public/storage` dan mengatur permission `storage`
serta `bootstrap/cache` saat startup.

## Catatan operasional

- Jangan menjalankan `php artisan config:cache` sebelum seluruh environment
  variable di Render lengkap.
- Setelah environment variable diubah, lakukan deploy/restart service.
- Database tidak di-hardcode di image; Laravel membacanya dari environment
  variables Render.

Dokumentasi terkait: [Docker di Render](https://render.com/docs/docker),
[port Web Service](https://render.com/docs/web-services),
[Pre-Deploy Command](https://render.com/docs/deploys), dan
[Persistent Disk](https://render.com/docs/disks).
