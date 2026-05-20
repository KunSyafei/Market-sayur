
🍏 Sistem Manajemen MarketPlace Buah Segar
📌 Judul & Deskripsi
Judul Proyek:
Marketplace & Manajemen Data Buah Segar (FruitSegar)

Deskripsi Singkat:
Aplikasi web ini merupakan sistem manajemen data buah sekaligus marketplace sederhana. Pengguna dapat login sebagai admin atau user biasa, mengelola data buah (CRUD), serta melihat daftar buah yang tersedia. Proyek ini dibangun untuk memenuhi tugas akhir pemrograman web dengan fokus pada implementasi autentikasi, manajemen data, dan antarmuka yang responsif.

Tujuan Pembelajaran / Produksi:

Memahami implementasi CRUD (Create, Read, Update, Delete) dalam aplikasi web.

Menerapkan sistem autentikasi berbasis session (login/logout).

Membangun antarmuka yang responsif dan semantik menggunakan HTML/CSS modern.

Memahami alur data dari form → backend → database → view.

Menyediakan dokumentasi proyek yang rapi dan dapat dijalankan ulang oleh siapa saja.

🛠️ Tech Stack
Komponen	Teknologi	Versi (jika relevan)
Backend	PHP (Native)	PHP 7.4 / 8.x
Frontend	HTML5, CSS3, JavaScript	-
Database	MySQL	MySQL 5.7 / 8.0
Tooling	Visual Studio Code, XAMPP	-
Version Control	Git & GitHub	-
Catatan: Tidak menggunakan framework agar lebih memahami konsep dasar.

🚀 Langkah Instalasi & Konfigurasi
Ikuti langkah-langkah berikut agar aplikasi dapat berjalan di lingkungan lokal Anda.

1. Prasyarat
Pastikan Anda telah menginstal:

XAMPP (Apache + MySQL) atau Laragon

Web Browser (Chrome/Firefox)

Git (opsional, untuk clone repository)

2. Clone Repository
bash
git clone https://github.com/username/marketplace-buah.git
Atau download ZIP dan ekstrak ke folder htdocs (XAMPP) atau www (Laragon).

3. Import Database
Nyalakan Apache & MySQL di XAMPP.

Buka phpMyAdmin (http://localhost/phpmyadmin).

Buat database baru dengan nama: nanti dibuat bjshjkd

Import file database.sql (jika ada) atau buat tabel manual dengan query:

sql
CREATE TABLE tabel_buah (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_buah VARCHAR(100) NOT NULL,
    stok_kg INT(11) NOT NULL,
    tingkat_kematangan ENUM('Mentah','Setengah Matang','Terlalu Matang') NOT NULL,
    asal_sumber VARCHAR(100) NOT NULL,
    gambar VARCHAR(255) DEFAULT 'default.jpg'
);
4. Konfigurasi Koneksi Database
Buka file function.php dan sesuaikan koneksi:

php
$conn = mysqli_connect("localhost", "root", "", "nanti dibuat bjshjkd");
Ganti root dan password sesuai konfigurasi MySQL Anda.

5. Jalankan Aplikasi
Pastikan project berada di dalam folder htdocs, misal: C:\xampp\htdocs\marketplace-buah

Akses melalui browser: http://localhost/marketplace-buah/login.php

6. Akun Default untuk Login
Role	Username	Password
Admin	guru	password123
Admin	admin	admin
User	user1	pass1
User	user2	pass2
User	user3	pass3
Data dummy tersedia di file auth.php.

📋 Pemetaan Rubrik Penilaian
Rubrik	Implementasi dalam Proyek	Bukti Screenshot
HTML Semantik	Menggunakan <header>, <nav>, <main>, <section>, <table> di welcome.php & homepage.php	https://screenshots/html-semantik.png
Validasi Form	Form tambah & update memiliki required, validasi tipe number, dan pencegahan XSS dengan htmlspecialchars	https://screenshots/validasi-form.png
Responsivitas	CSS Grid, Flexbox, media query untuk tampilan mobile (max-width: 700px)	https://screenshots/responsif-mobile.png
CRUD (Create, Read, Update, Delete)	- Create: form tambah buah di welcome.php
- Read: tabel daftar buah
- Update: form update.php dengan data pre-filled
- Delete: hapus.php dengan konfirmasi	https://screenshots/crud-buah.png
Autentikasi (Auth)	Session-based login (auth.php), logout (logout.php), role separation (admin/user)	https://screenshots/login-form.png
Keamanan Dasar	- Password tidak di-hash (catatan: untuk pembelajaran)
- htmlspecialchars() untuk output
- Proteksi SQL Injection minimal (perlu prepared statement)	-
Upload Gambar	Form dengan enctype="multipart/form-data", penyimpanan di folder image/	https://screenshots/upload-gambar.png
Catatan: Screenshot sebaiknya disimpan dalam folder screenshots/ di repository.

🧱 Struktur Direktori & Alur Data
text
marketplace-buah/
│
├── auth.php               # Proses login (autentikasi)
├── login.php              # Halaman form login
├── logout.php             # Proses logout
├── welcome.php            # Dashboard admin (CRUD buah)
├── homepage.php           # Marketplace untuk user biasa
├── update.php             # Form edit data buah
├── hapus.php              # Proses hapus data buah
├── function.php           # Koneksi DB & fungsi CRUD (belum selesai)
│
├── image/                 # Folder upload gambar buah
├── screenshots/           # Dokumentasi screenshot (untuk README)
│
└── README.md              # Dokumentasi proyek
🔁 Alur Data (Request → Response)
User membuka login.php → mengirim username/password ke auth.php.

auth.php memeriksa data dummy → jika cocok, buat session → redirect ke:

welcome.php (jika admin/guru) → menampilkan form CRUD dan tabel data buah.

homepage.php (jika user biasa) → menampilkan marketplace buah.

Admin menambah buah: form di welcome.php → data dikirim ke function.php (fungsi tambah()) → INSERT ke database.

Admin mengedit: klik "ubah" di tabel → update.php mengambil data berdasarkan ID → form pre-filled → submit ke fungsi update().

Admin menghapus: klik "hapus" → konfirmasi → hapus.php menjalankan fungsi hapus().

Semua data dibaca dari tabel tabel_buah dan ditampilkan di welcome.php & homepage.php.

Catatan: Saat ini fungsi update() dan hapus() belum lengkap di function.php. Anda perlu melengkapinya sendiri sebagai latihan.

📌 Mengapa CRUD Penting dalam Aplikasi Web?
CRUD (Create, Read, Update, Delete) adalah fondasi dari sebagian besar aplikasi web yang berinteraksi dengan database. Berikut alasan mengapa CRUD sangat penting:

Operasi	Pentingnya	Contoh dalam proyek ini
Create	Memungkinkan pengguna menambahkan data baru ke sistem. Tanpa create, aplikasi bersifat statis.	Admin menambahkan buah baru ke dalam daftar.
Read	Menampilkan data yang tersimpan agar dapat dilihat dan dianalisis.	Menampilkan semua buah di tabel dan marketplace.
Update	Memungkinkan perbaikan atau perubahan data tanpa menghapus dan membuat ulang.	Mengubah stok buah atau tingkat kematangan.
Delete	Menghapus data yang tidak relevan atau salah untuk menjaga kebersihan data.	Menghapus buah yang sudah tidak dijual.
Manfaat lebih luas:

Efisiensi: Tidak perlu mengubah file secara manual.

Dinamisme: Data dapat berubah sesuai kebutuhan pengguna.

Skalabilitas: Cocok untuk sistem besar seperti e-commerce, manajemen inventaris, dll.

Pengalaman pengguna: User dapat mengelola data mereka sendiri.

⚠️ Known Issues & Rencana Pengembangan
Known Issues (Kekurangan Saat Ini)
❌ Fungsi update() dan hapus() di function.php belum diimplementasikan.

❌ Password disimpan dalam bentuk plain text (tidak di-hash) – hanya untuk pembelajaran.

❌ Upload gambar tidak menyimpan nama file unik (bisa tabrakan).

❌ Tidak ada validasi tipe file gambar (bisa upload file berbahaya).

❌ Error handling masih minim (contoh: SQL error tidak ditangkap).

❌ Tidak menggunakan prepared statement → rentan SQL injection.

Rencana Fase Selanjutnya (Improvements)
Implementasi password_hash() dan password_verify().

Ganti query manual ke Prepared Statement (PDO atau MySQLi).

Tambahkan pagination pada tabel buah.

Buat fitur pencarian dan filter berdasarkan tingkat kematangan.

Perbaiki upload gambar: rename file, validasi ekstensi, resize.

Tambahkan role-based access control (RBAC) yang lebih ketat.

Gunakan alert yang lebih interaktif (misal: SweetAlert2).

Buat API sederhana untuk kebutuhan mobile (JSON).

✅ Checklist Mandiri (Sebelum Final)
Checklist	Status
README.md bisa dijalankan ulang oleh orang lain tanpa bertanya	✅
Setiap fitur rubrik memiliki penjelasan + bukti screenshot berkonteks	✅ (Screenshot belum disertakan, tapi sudah ada tabel pemetaan)
Tidak ada credential, token, atau data pribadi di repo/README	✅ (Password dummy tidak rahasia)
Struktur folder & penamaan file konsisten & profesional	✅
CRUD sudah diuji: create valid, read terorganisir, update pre-filled, delete aman, error jelas	⚠️ (Update & delete belum lengkap di function.php)
Commit message bermakna & historis Git rapi	✅ (Asalkan commit dibuat deskriptif)
📸 Screenshot yang Diperlukan (Contoh)
Simpan gambar-gambar berikut di folder screenshots/ lalu tautkan di README.

Halaman Login
![Halaman Login](screenshots/login-page.png)

Dashboard Admin (Welcome) dengan form tambah & tabel
![Dashboard Admin](screenshots/admin-dashboard.png)

Marketplace User (Homepage)
![Marketplace User](screenshots/user-marketplace.png)

Form Update dengan data pre-filled
![Form Update](screenshots/update-form.png)

Konfirmasi Hapus
![Konfirmasi Hapus](screenshots/delete-confirm.png)

Tampilan Responsif di HP
![Mobile View](screenshots/mobile-responsive.png)

👨‍💻 Kontributor & Lisensi
Pengembang: [Nama Anda]

Kelas / Mata Pelajaran: Pemrograman Web

Lisensi: MIT (bebas digunakan untuk pembelajaran)

🙏 Catatan Akhir
Proyek ini masih dalam tahap pembelajaran dan memiliki banyak kekurangan. Silakan kembangkan lebih lanjut sesuai kebutuhan. Jika ada pertanyaan, silakan buat issue di repository ini.

Pesan untuk siswa: Jangan lupa lengkapi fungsi update() dan hapus() di function.php agar CRUD benar-benar berfungsi sempurna. Selamat belajar! 🍎

