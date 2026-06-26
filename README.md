Sistem Informasi Akademik (SIAKAD) Sederhana

Aplikasi web Sistem Informasi Akademik sederhana berbasis Laravel untuk Tugas Besar Mata Kuliah Web II (IF53413).

a. Deskripsi Aplikasi

Aplikasi ini mensimulasikan SIAKAD yang digunakan untuk mengelola data Dosen, Mahasiswa, Mata Kuliah, Jadwal Perkuliahan, dan Kartu Rencana Studi (KRS). Terdapat 2 role pengguna:

- Admin: mengelola seluruh data master (Dosen, Mahasiswa, Mata Kuliah, Jadwal)
- Mahasiswa: mengambil/drop mata kuliah (KRS) dan melihat jadwal perkuliahan

Identitas

- Nama : Queenaira Novinada L
- NPM : 5520124058
- Kelas : IF B 2024

b. Fitur & Penjelasan Halaman

Halaman : Login
Role    : Semua
Fungsi  : Autentikasi pengguna ke sistem

Halaman : Dashboard Admin
Role    : Admin
Fungsi  : Ringkasan jumlah data dosen, mahasiswa, mata kuliah, jadwal

Halaman : Data Dosen
Role    : Admin
Fungsi  : CRUD data dosen

Halaman : Data Mahasiswa
Role    : Admin
Fungsi  : CRUD data mahasiswa, termasuk penentuan dosen wali

Halaman : Data Mata Kuliah
Role    : Admin
Fungsi  : CRUD data mata kuliah dan SKS

Halaman : Data Jadwal
Role    : Admin
Fungsi  : CRUD jadwal perkuliahan (relasi dosen & mata kuliah, penentuan hari/jam/kelas)

Halaman : Dashboard Mahasiswa
Role    : Mahasiswa
Fungsi  : Info profil mahasiswa & menu cepat

Halaman : Jadwal Perkuliahan
Role    : Mahasiswa
Fungsi  : Melihat seluruh jadwal kuliah yang tersedia

Halaman : KRS
Role    : Mahasiswa
Fungsi  : Mengambil mata kuliah, melihat daftar KRS, drop mata kuliah

Role & Akun Demo

Role    : Admin
Email   : admin@siakad.com
Password: password

Role    : Mahasiswa
Email   : queen@siakad.com
Password: password

Cara Menjalankan Secara Lokal

git clone [link repo ini]
cd [nama folder project]
composer install
cp .env.example .env
php artisan key:generate
atur koneksi database di .env
php artisan migrate --seed
npm install && npm run build
php artisan serve

Link Hosting

[diisi link deploy, kalau ada — lihat bagian Bonus]

c. Screenshot Aplikasi

Lihat folder [`screenshots/`](./screenshots) untuk dokumentasi visual setiap halaman.
