# CI Basic CMS

### Ini adalah repository belajar membuat CMS menggunakan Codeigniter 3.

Please don't take it seriously, ini cuma repository untuk belajar. Harapannya kalau sudah selesai bisa dikembangkan, dan diupdate menggunakan Codeigniter 4.

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
