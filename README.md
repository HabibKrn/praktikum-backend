# Praktikum Back-End Laravel - Pertemuan 3: Routing, Controller, Dependency Injection, dan Middleware

Dokumentasi ini disusun untuk memenuhi laporan dan tugas praktikum Mata Kuliah **Pengembangan Web / Back-End (Pertemuan 3)**. Aplikasi ini merupakan layanan mini *back-end* berbasis **Laravel** yang menerapkan arsitektur web modern seperti *routing*, penanganan *controller*, *dependency injection*, serta proteksi keamanan mengunakan *middleware*.

## 1. Identitas & Informasi Praktikum

* **Mata Kuliah:** Pengembangan Web
* **Materi:** Route, Controller, Dependency Injection (DI), dan Middleware
* **Framework:** Laravel 11.x / PHP >= 8.2
* **Branch Git:** `praktikum/pertemuan-3`

## 2. Fitur & Tujuan Pembelajaran

1. **Routing Dasar & Parameters:**
   * Menerapkan rute dasar (`/`, `/halo`).
   * Menerapkan *route parameter* wajib (`/mahasiswa/{nim}`) dengan *constraint* angka (`whereNumber`).
   * Menerapkan *route parameter* opsional (`/profil/{nama?}`).
2. **Controller Structure:**
   * Memisahkan logika aplikasi dari file rute ke `MahasiswaController` dan `KatalogController`.
3. **Dependency Injection (DI):**
   * Menggunakan kelas layanan `KatalogService` untuk mengelola data katalog mata kuliah yang disuntikkan (*injected*) ke dalam `KatalogController`.
4. **Middleware Request Pipeline:**
   * Membuat *middleware* kustom `CheckRole` yang didaftarkan dengan alias `role.admin` untuk memproteksi akses halaman administrasi.

## 3. Cara Menjalankan Project Secara Lokal

Ikuti langkah-langkah berikut untuk menjalankan *project* ini di komputer Anda:

1. **Clone Repository & Masuk ke Folder Project:**
   ```bash
   git clone <URL_REPOSITORY_GITHUB_ANDA>
   cd praktikum-backend
   ```

2. **Install Dependensi Composer:**
   ```bash
   composer install
   ```

3. **Pengaturan File Environment (`.env`):**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Jalankan Server Lokal Laravel:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui *browser* pada alamat: `http://127.0.0.1:8000`

## 4. Daftar Endpoint API

Berikut adalah daftar seluruh rute (*endpoints*) yang terdaftar dalam aplikasi:

| No | Method | Endpoint / URI | Fungsi / Deskripsi | Proteksi Middleware |
| :---: | :---: | :--- | :--- | :---: |
| 1 | `GET` | `/` | Cek status aktif layanan back-end | Tidak Ada |
| 2 | `GET` | `/halo` | Menampilkan pesan salam dasar | Tidak Ada |
| 3 | `GET` | `/mahasiswa/{nim}` | Menampilkan detail status NIM (wajib angka) | Tidak Ada |
| 4 | `GET` | `/profil/{nama?}` | Menampilkan profil nama (parameter opsional) | Tidak Ada |
| 5 | `GET` | `/katalog` | Menampilkan daftar seluruh mata kuliah | Tidak Ada |
| 6 | `GET` | `/katalog/{kode}` | Menampilkan detail satu mata kuliah berdasarkan kode | Tidak Ada |
| 7 | `GET` | `/admin/katalog` | Menampilkan katalog terproteksi khusus role admin | `role.admin` |

## 5. Skenario Pengujian (Test Case)

Pengujian dilakukan menggunakan *web browser* dengan 5 skenario utama sesuai ketentuan modul:

### **Test Case 1: Parameter Wajib dengan Constraint Angka (Berhasil)**
* **URL:** `http://127.0.0.1:8000/mahasiswa/23010001`
* **Method:** `GET`
* **Hasil yang Diharapkan:** Mengembalikan respons JSON `{"nim":"23010001","status":"aktif"}` dengan status HTTP **200 OK**.

### **Test Case 2: Constraint Parameter Gagal (Non-Angka)**
* **URL:** `http://127.0.0.1:8000/mahasiswa/ABC`
* **Method:** `GET`
* **Hasil yang Diharapkan:** Menampilkan halaman **404 Not Found** karena parameter `ABC` ditolak oleh aturan `whereNumber('nim')`.

### **Test Case 3: Dependency Injection pada Service & Controller**
* **URL:** `http://127.0.0.1:8000/katalog`
* **Method:** `GET`
* **Hasil yang Diharapkan:** Mengembalikan respons JSON daftar mata kuliah dari `KatalogService` dengan status HTTP **200 OK**.

### **Test Case 4: Proteksi Middleware (Akses Ditolak)**
* **URL:** `http://127.0.0.1:8000/admin/katalog`
* **Method:** `GET`
* **Hasil yang Diharapkan:** Menampilkan teks pesan `"Akses ditolak"` dengan status HTTP **403 Forbidden** karena tidak menyertakan query parameter admin.

### **Test Case 5: Proteksi Middleware (Akses Diterima)**
* **URL:** `http://127.0.0.1:8000/admin/katalog?role=admin`
* **Method:** `GET`
* **Hasil yang Diharapkan:** Menampilkan data JSON katalog mata kuliah dengan status HTTP **200 OK** karena query `role=admin` berhasil divalidasi oleh *middleware*.

## 6. Verifikasi Rute Aplikasi

Untuk memverifikasi seluruh rute yang telah dikonfigurasi pada file `routes/web.php`, jalankan perintah berikut pada terminal:

```bash
php artisan route:list
```