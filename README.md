# Surabaya Prestige Motors

Website **Luxury Rent Car & Motorsport** di Surabaya dengan tema **Black and Gold**. Pengguna dapat melihat katalog kendaraan mewah, melakukan booking, dan memberi testimoni. Admin mengelola kendaraan dan booking lewat panel khusus yang tersembunyi di balik login.

Proyek ini dibuat untuk Ujian Akhir Semester mata kuliah Pemrograman Web.

## Fitur

**Autentikasi**
- Register, login, dan logout
- Dua role: `admin` dan `customer`

**Pengunjung dan customer**
1. Halaman beranda (hero, statistik, mobil unggulan, testimoni)
2. Katalog kendaraan
3. Filter kategori, pencarian, dan pengurutan harga
4. Halaman detail kendaraan
5. Booking kendaraan dengan perhitungan total harga otomatis dan pengecekan bentrok tanggal
6. Riwayat booking dan pembatalan booking (status `pending`)
7. Testimoni dan rating

**Admin** (hanya dapat diakses role `admin`)
8. Dashboard statistik (total armada, tersedia, customer, booking pending, pendapatan)
9. CRUD kendaraan dengan upload gambar lokal
10. Manajemen booking: filter dan ubah status (`pending`, `approved`, `completed`, `cancelled`)

## Teknologi

| Komponen | Keterangan |
| --- | --- |
| Framework | Laravel 11/12 (PHP 8.2+) |
| Database | MySQL / MariaDB (XAMPP) |
| Frontend | Blade, Tailwind CSS (CDN), Alpine.js (CDN) |
| Font | Syne, Outfit, JetBrains Mono |
| Penyimpanan gambar | Laravel Storage, disk `public` |

## Struktur Database

| Tabel | Kolom utama |
| --- | --- |
| `users` | id, name, email, password, role (`admin`/`customer`), timestamps |
| `cars` | id, name, brand, category, price_per_day, hp, top_speed, status (`available`/`rented`), image, timestamps |
| `bookings` | id, user_id, car_id, start_date, end_date, total_price, status, timestamps |
| `testimonials` | id, user_name, comment, rating, timestamps |

Relasi (Foreign Key):
- `bookings.user_id` mengacu ke `users.id`
- `bookings.car_id` mengacu ke `cars.id`

Kategori kendaraan: `Supercar`, `Luxury Sedan`, `Motorsport`, `SUV`.

## Cara Menjalankan

### Prasyarat
- PHP 8.2 atau lebih baru
- Composer
- XAMPP (Apache dan MySQL menyala), atau MySQL/MariaDB lain

### Langkah instalasi

1. Clone repository dan masuk ke foldernya:

```
git clone https://github.com/USERNAME/NAMA-REPOSITORY.git
cd NAMA-REPOSITORY
```

2. Pasang dependensi:

```
composer install
```

3. Salin file environment dan buat application key:

```
copy .env.example .env
php artisan key:generate
```

Di Linux atau macOS, gunakan `cp .env.example .env`.

4. Buat database kosong bernama `luxury_rent_car` lewat phpMyAdmin (collation `utf8mb4_unicode_ci`).

5. Atur koneksi database di file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=luxury_rent_car
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
```

6. Buat tabel dan data awal:

```
php artisan migrate --seed
```

7. Buat symbolic link agar gambar yang diupload dapat diakses browser (lokasi file: `storage/app/public/cars`, diakses lewat `public/storage/cars`):

```
php artisan storage:link
```

8. Jalankan server:

```
php artisan serve
```

Buka `http://127.0.0.1:8000`.

> Tailwind CSS dan Alpine.js dimuat lewat CDN, sehingga komputer harus terhubung ke internet.

## Akun Demo

Akun dibuat oleh seeder di `database/seeders/DatabaseSeeder.php`.

| Role | Email | Password |
| --- | --- | --- |
| Admin | `admin@prestige.test` | `admin12345` |
| Customer | `customer@prestige.test` | `customer12345` |

Ganti kredensial ini sebelum proyek dipakai di luar keperluan demo.

## Halaman Admin

Halaman admin tidak ditampilkan di navigasi publik. Admin masuk lewat halaman `/login` yang sama, lalu diarahkan ke dashboard.

| URL | Fungsi |
| --- | --- |
| `/admin/dashboard` | Dashboard statistik |
| `/admin/cars` | Daftar kendaraan dan CRUD |
| `/admin/bookings` | Manajemen booking |

Semua rute `/admin/*` dilindungi middleware `auth` dan `admin`. Pengguna yang bukan admin akan menerima respons 404, sehingga keberadaan halaman admin tidak terlihat.

## Penyimpanan Gambar

- Gambar diupload lewat form admin, divalidasi sebagai gambar (jpeg, png, jpg, webp) maksimal 2 MB.
- File disimpan di `storage/app/public/cars` dengan nama acak, dan path-nya disimpan di kolom `cars.image`.
- Saat gambar diganti atau kendaraan dihapus, file lama ikut dihapus dari penyimpanan lokal.

## Struktur Folder Penting

```
app/
  Http/
    Controllers/
      Admin/            AdminController, CarController, BookingController
      AuthController.php
      CatalogController.php
      BookingController.php
      TestimonialController.php
    Middleware/AdminMiddleware.php
  Models/               User, Car, Booking, Testimonial
bootstrap/app.php       alias middleware admin
database/
  migrations/
  seeders/DatabaseSeeder.php
resources/views/
  layouts/              app, admin
  partials/             head, flash, car-card, testimonial-card
  auth/  fleet/  bookings/  testimonials/  admin/
routes/web.php
```

## Rute Utama

| Method | URL | Keterangan |
| --- | --- | --- |
| GET | `/` | Beranda |
| GET | `/fleet` | Katalog |
| GET | `/fleet/{car}` | Detail kendaraan |
| POST | `/fleet/{car}/book` | Buat booking (login) |
| GET | `/my-bookings` | Riwayat booking (login) |
| PATCH | `/my-bookings/{booking}/cancel` | Batalkan booking (login) |
| GET/POST | `/testimonials` | Lihat dan kirim testimoni |
| GET/POST | `/login`, `/register` | Autentikasi |
| POST | `/logout` | Logout |
| GET | `/admin/dashboard` | Dashboard admin |
| RESOURCE | `/admin/cars` | CRUD kendaraan |
| GET | `/admin/bookings` | Daftar booking |
| PATCH | `/admin/bookings/{id}` | Ubah status booking |

## Aturan Booking

- Total harga dihitung dari jumlah hari (tanggal mulai sampai tanggal selesai, inklusif) dikali harga per hari.
- Booking ditolak jika kendaraan berstatus `rented` atau tanggalnya bentrok dengan booking `pending`/`approved`.
- Saat admin menyetujui booking (`approved`), status kendaraan menjadi `rented`. Saat `completed` atau `cancelled`, status kembali `available`.

## Pemecahan Masalah

| Masalah | Solusi |
| --- | --- |
| Gambar tidak tampil setelah upload | Jalankan `php artisan storage:link`; di Windows, jalankan terminal sebagai administrator jika gagal |
| Perubahan `.env` tidak terbaca | Jalankan `php artisan config:clear` |
| Error `Table 'users' already exists` | Pastikan hanya ada satu migration yang membuat tabel `users`, lalu jalankan `php artisan migrate:fresh --seed` |
| Tampilan berantakan atau modal tidak terbuka | Periksa koneksi internet (Tailwind dan Alpine dimuat lewat CDN) |

## Lisensi

Proyek ini dibuat untuk keperluan akademik.
