# CI Basic CMS

### Ini adalah repository belajar membuat CMS menggunakan Codeigniter 3.

Please don't take it seriously, ini cuma repository untuk belajar. Harapannya kalau sudah selesai bisa dikembangkan, dan diupdate menggunakan Codeigniter 4.

Sementara masih dalam proses development.

## Development Process

### 1. Initializing Project

- [x] Membuat folder dari hasil ekstrak Codeigniter 3.
- [x] Mengatur struktur folder. (folder download, uploads, templates, assets, dan dev).
- [x] Membuat configuration.php
- [x] Memindahkan views ke templates, dan konfigurasi di index.php
- [x] Membuat Default Controller di folder Core, dan Backend & Frontend Controller yang menginduk ke Default Controller.
- [x] Konfigurasi config.php untuk loading default controller-nya.

### 2. Membuat Default Model

- [x] Membuat protected class
- [x] Membuat public function insert dengan batch, dan tidak lupa menggunakan prefix tabel_name yg sudah disetting
- [x] Membuat public function get, delete, update, count, dan mencoba mengimplementasikannya.

### 3. Konfigurasi dasar & Templating

- [x] Menambahkan konfigurasi data situs di SConfig
- [x] Membuat library untuk Site view, jadi semua view akan dipanggil via libraries/Sites.php. Bisa untuk memanggil di sisi backend (admin), frontend (user), dan template yg digunakan.
- [x] Testing membuat template backend dan frontend. https://github.com/coderaulia/ci-cms/commit/0391db1f5b8f72ebc7c49a63aacfbafa0f1da2c9
- [x] Membuat folder admin, dan base helper untuk templating. Juga testing untuk mem-bypass data dari Dashboard Admin Controller ke site->view induk. https://github.com/coderaulia/ci-cms/commit/bedb37e04dad3a471a2322af31e986b351446a55

### 4. Prepare Template Admin Dashboard

- [x] Mengimport semua file template starter bootstrap admin page.
- [x] Melakukan pemecahan atau templating di starter template dengan file header, footer, dan function apa nanti yg dipanggil (ex: artikel, laman, etc).
- [x] Membuat Menu Admin dan fitur apa saja yg akan dibuat. Dan mengatur class active di tiap laman yang dibuka (ex: artikel, maka menu aktif ada di artikel).
- [x] Membuat dynamic title function di template helper.

### 5. Membuat Login Admin

- [x] Membuat laman login dari template yg sudah tersedia. (biar cepet).
- [x] Membuat rules di User_model yg sebelumnya sudah dibuat (untuk login).
- [x] Membuat function untuk enkripsi password.
- [x] Routing URL di laman admin supaya tidak terlalu panjang.
- [x] Membuat Login Function beserta form validation, menyeting session, dan cookies jika "remember me" dicentang.
- [x] Membuat restriksi halaman admin.
