# MONET - Money on Internet

MONET (Money on Internet) adalah aplikasi web manajemen keuangan organisasi modern berbasis Laravel 12. Sistem ini dirancang untuk mempermudah pencatatan kas, penagihan iuran anggota, pengajuan dana bantuan, verifikasi pembayaran, serta penyusunan laporan keuangan secara transparan dan akuntabel.

---

## 🌟 Fitur Utama

### 1. Sistem Multi-Role (Otorisasi Pengguna)
Aplikasi membedakan hak akses dan fungsionalitas berdasarkan 3 peran utama:
*   **Bendahara:** Memegang kendali penuh atas manajemen kas masuk/keluar, pengelolaan kategori transaksi, pembuatan tagihan iuran bulanan, verifikasi pembayaran anggota, persetujuan/penolakan pengajuan dana, serta ekspor laporan.
*   **Pengurus:** Memiliki akses monitoring status pembayaran kas anggota, melakukan pengajuan dana organisasi, dan memantau riwayat transaksi keuangan.
*   **Anggota:** Mengakses dashboard pribadi, melihat tagihan yang belum dibayar, melakukan pembayaran kas dengan mengunggah bukti transfer, dan mengajukan dana bantuan.

### 2. Otomatisasi Tagihan & Notifikasi Email
*   **Generate Tagihan:** Bendahara dapat membuat tagihan iuran kas bulanan secara masal untuk semua anggota aktif (Pengurus & Bendahara).
*   **Notifikasi Tagihan:** Sistem mengirimkan email notifikasi tagihan baru secara otomatis saat tagihan berhasil dibuat.
*   **Email Transaksional:** Pengiriman email konfirmasi saat pembayaran berhasil diverifikasi (`Lunas`) atau ditolak (`Ditolak`).

### 3. Manajemen Status Pembayaran & Pengingat Massal
*   **Status Terintegrasi:** Siklus status pembayaran terdiri dari: *Belum Bayar*, *Menunggu Verifikasi*, *Lunas*, dan *Ditolak*.
*   **Upload Bukti Pembayaran:** Anggota dapat mengunggah bukti pembayaran langsung dari dashboard.
*   **Pengingat Massal (Mass Reminder):** Bendahara dapat mengirimkan email pengingat (reminder) secara massal ke seluruh anggota yang menunggak secara langsung (*synchronous*), dilengkapi dengan proteksi spam (maksimal 1 kali pengingat per 24 jam per anggota) dan pengaman waktu eksekusi (`set_time_limit`).

### 4. Approval System Pengajuan Dana
*   Proses pengajuan bantuan/dana dengan melampirkan keterangan nominal, bank tujuan, nomor rekening, dan dokumen pendukung.
*   Bendahara dapat meninjau, menyetujui, atau menolak pengajuan dana dengan menyertakan catatan persetujuan atau alasan penolakan.
*   Sistem dilengkapi dengan **Timeline Status** dinamis yang memperlihatkan riwayat proses pengajuan dari pembuatan hingga keputusan akhir.

### 5. Pencatatan Transaksi & Laporan Keuangan
*   **Kas Masuk & Kas Keluar:** Pencatatan arus keuangan yang dikelompokkan berdasarkan kategori transaksi.
*   **Laporan Keuangan Interaktif:** Visualisasi data pengeluaran dan pemasukan bulanan menggunakan grafik interaktif.
*   **Ekspor Data:** Fitur cetak laporan keuangan dan pengajuan dana ke format **PDF** dan **Excel**.

### 6. Integrasi Midtrans Payment Gateway
*   Mendukung pemrosesan pembayaran otomatis melalui callback webhook Midtrans untuk integrasi pembayaran online yang aman.

---

## 🛠️ Spesifikasi Teknologi

*   **Framework Utama:** Laravel 12 (PHP >= 8.2)
*   **Database:** PostgreSQL (Hosting Supabase RDS)
*   **Styling & UI:** TailwindCSS, Vanilla CSS, Material Symbols Outlined
*   **Media & Attachment Storage:** AWS S3 (Supabase Storage Cloud Bucket)
*   **Email Service:** SMTP (Gmail)

---

## 📂 Struktur Database Utama

Aplikasi menggunakan skema relasional dengan tabel-tabel utama berikut:
*   `users`: Menyimpan data pengguna beserta role (`bendahara`, `pengurus`, `anggota`) dan avatar.
*   `tagihan_kas`: Tabel master periode iuran kas bulanan.
*   `pembayaran_kas`: Menyimpan status transaksi pembayaran iuran kas masing-masing anggota.
*   `pembayaran_kas_reminders`: Log pengiriman email pengingat untuk membatasi pengiriman berulang dalam 24 jam.
*   `pengajuan_dana`: Menyimpan data permohonan dana beserta status (`Pending`, `Disetujui`, `Ditolak`).
*   `pengajuan_dana_histories`: Pencatatan log persetujuan/penolakan pengajuan dana.
*   `kas_masuk` & `kas_keluar`: Arus kas transaksi keuangan organisasi.
*   `kategori_transaksi`: Kategori pembagian kas masuk dan keluar.

---

## 🚀 Panduan Instalasi Lokal

### 1. Prasyarat (Prerequisites)
Pastikan komputer Anda sudah terinstal:
*   PHP >= 8.2 (aktifkan ekstensi `pdo_pgsql`, `openssl`, `mbstring`, dll)
*   Composer (Dependency Manager PHP)
*   Node.js & NPM
*   PostgreSQL Server (atau menggunakan cloud database Supabase)

### 2. Kloning & Persiapan Repositori
Kloning proyek ke direktori lokal Anda (misal `C:\xampp\htdocs\monet`):
```bash
git clone <url-repository> monet
cd monet
```

### 3. Instalasi Dependensi
Jalankan perintah berikut untuk menginstal package library PHP dan NPM:
```bash
composer install
npm install
```

### 4. Konfigurasi Environment File
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` baru tersebut, lalu sesuaikan konfigurasi database, SMTP email, AWS S3 storage, dan Client ID Google:
```env
# Database
DB_CONNECTION=pgsql
DB_HOST=aws-1-ap-northeast-1.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.xxxxxxx
DB_PASSWORD=xxxxxxx

# Mailer (SMTP Gmail)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=yourmonet.idn@gmail.com
MAIL_PASSWORD=xxxxxxx
MAIL_ENCRYPTION=smtps

# Storage AWS S3
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=xxxxxxx
AWS_SECRET_ACCESS_KEY=xxxxxxx
AWS_DEFAULT_REGION=ap-northeast-1
AWS_BUCKET=avatars
AWS_ENDPOINT=https://xxxxxxx.supabase.co/storage/v1/s3
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Migrasi & Seeder Database
Jalankan migrasi tabel beserta data uji awal (seperti akun default):
```bash
php artisan migrate --seed
```

### 7. Menjalankan Aplikasi secara Lokal
Jalankan server lokal Laravel:
```bash
php artisan serve
```
Dan jalankan kompilasi aset frontend menggunakan Vite:
```bash
npm run dev
```
Aplikasi kini dapat diakses melalui browser di alamat: `http://localhost:8000`.

---

## ⚙️ Detail Konfigurasi Pengingat Massal (Queue vs Sync)
Fitur **Pengingat Massal** telah disesuaikan agar berjalan secara **Synchronous**. 
*   **Kenapa?** Pada server VPS kecil atau shared hosting, service daemon queue (`php artisan queue:work`) seringkali mati secara tiba-tiba tanpa pemantau proses.
*   **Bagaimana cara kerjanya?** Tombol pengingat massal akan langsung mengeksekusi loop pengiriman SMTP email secara real-time. Sistem telah disematkan `@set_time_limit(0)` agar proses eksekusi PHP tidak terputus (timeout) meskipun mengirimkan puluhan email sekaligus.
*   **Konfigurasi .env:** Nilai `QUEUE_CONNECTION` di `.env` bisa tetap menggunakan `database` atau diubah ke `sync` tanpa memengaruhi fitur pengingat massal.
