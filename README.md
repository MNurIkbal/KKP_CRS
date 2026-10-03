# PRODUCT REQUIREMENTS DOCUMENT (PRD)
# Aplikasi CRS – Laporan Layanan Pengaduan Tindak Kekerasan terhadap Perempuan di Lingkungan Kampus

| Informasi | Keterangan |
|---|---|
| Nama Produk | Campus Reporting System (CRS) |
| Jenis Produk | Aplikasi web layanan pengaduan dan pengelolaan kasus |
| Domain | Penanganan pengaduan kekerasan terhadap perempuan di lingkungan kampus |
| Framework | Laravel 11 |
| Bahasa Pemrograman | PHP 8.2 |
| Database | MySQL (sesuai keterangan pemilik proyek; konfigurasi aktual perlu diverifikasi) |
| Repository | https://github.com/MNurIkbal/KKP_CRS |
| Status Dokumen | Draft PRD berdasarkan pemeriksaan repository dan kebutuhan yang tercatat |
| Versi Dokumen | 1.0 |
| Tanggal | 3 Oktober 2026 |

---

## 1. Ringkasan Produk

Campus Reporting System (CRS) merupakan aplikasi berbasis web yang dirancang untuk membantu perguruan tinggi menerima, mencatat, mengelola, memantau, dan melaporkan pengaduan tindak kekerasan terhadap perempuan di lingkungan kampus.

Aplikasi menyediakan sarana bagi pelapor untuk menyampaikan pengaduan dan bagi petugas kampus untuk melakukan tindak lanjut secara terstruktur. Pengelolaan laporan dilakukan dengan memperhatikan kerahasiaan identitas, keamanan informasi, pembatasan hak akses, serta pencatatan aktivitas penanganan.

CRS dirancang untuk mendukung pengelolaan multi-kampus. Admin kampus hanya dapat mengakses laporan yang menjadi kewenangan kampusnya, sedangkan superadmin memiliki akses lintas kampus dan kewenangan mengelola akun admin.

## 2. Latar Belakang dan Permasalahan

Penanganan pengaduan kekerasan di lingkungan kampus membutuhkan proses yang terdokumentasi, terukur, dan menjaga privasi pihak yang terlibat. Pengelolaan yang tersebar melalui dokumen atau komunikasi terpisah dapat menyulitkan pencarian data, pemantauan perkembangan, pengendalian tenggat waktu, dan penyusunan laporan.

CRS ditujukan untuk menjawab kebutuhan tersebut melalui satu sistem terpusat yang memiliki:
- Kanal pencatatan pengaduan.
- Master data jenis kekerasan dan dokumen identitas.
- Pengelolaan laporan berdasarkan kampus.
- Pencatatan log dan riwayat penanganan.
- Pemantauan progres dan tenggat waktu.
- Penyusunan serta pengunduhan laporan.

## 3. Tujuan Produk

1. Menyediakan sarana pengaduan yang mudah diakses.
2. Mendukung pencatatan laporan secara terstruktur.
3. Menjaga kerahasiaan identitas pelapor, korban, dan informasi kasus.
4. Memudahkan admin kampus memantau dan menindaklanjuti laporan.
5. Memungkinkan superadmin memantau laporan lintas kampus.
6. Menyediakan riwayat perubahan dan aktivitas penanganan.
7. Mempermudah pembuatan laporan untuk kebutuhan administrasi dan evaluasi.

## 4. Ruang Lingkup

### 4.1 Ruang Lingkup Utama

- Autentikasi dan pengelolaan sesi admin.
- Pengelolaan akun dan peran pengguna.
- Pengelolaan data kampus.
- Pengelolaan master jenis kekerasan.
- Pengelolaan master dokumen identitas.
- Pengiriman dan pencatatan pengaduan.
- Pengelolaan detail laporan.
- Pengelolaan progres tindak lanjut.
- Penentuan deadline tindak lanjut.
- Log aktivitas dan riwayat laporan.
- Pencarian, penyaringan, dan pemantauan laporan.
- Ekspor atau unduh laporan.

### 4.2 Di Luar Ruang Lingkup (untuk versi awal)

Hal berikut belum dapat dipastikan dari repository dan tidak dianggap sebagai fitur yang sudah tersedia:
- Integrasi langsung dengan kepolisian, rumah sakit, atau lembaga eksternal.
- Konsultasi psikologis daring.
- Aplikasi mobile native sebagai kanal utama.
- Pelacakan lokasi pelapor.
- Integrasi tanda tangan elektronik.
- Notifikasi SMS/WhatsApp otomatis.

Fitur di luar ruang lingkup dapat dipertimbangkan pada pengembangan berikutnya.

## 5. Pengguna dan Hak Akses

### 5.1 Pelapor

Pengguna yang menyampaikan pengaduan. Pelapor dapat berupa korban atau pihak yang melaporkan kejadian atas sepengetahuan dan kewenangannya.

Kebutuhan:
- Mengakses halaman pengaduan.
- Mengisi informasi kejadian sesuai formulir.
- Memilih kategori atau jenis kekerasan.
- Mengirim laporan.
- Melampirkan dokumen pendukung bila tersedia.
- Mendapatkan informasi bahwa laporan berhasil diterima.

Catatan: mekanisme pelacakan status oleh pelapor belum terkonfirmasi dalam repository dan perlu diputuskan sebagai kebutuhan produk.

### 5.2 Admin Kampus

Petugas yang bertanggung jawab mengelola laporan pada kampus tertentu.

Kebutuhan:
- Login ke sistem.
- Identitas kampus ditentukan melalui akun yang diberikan.
- Melihat daftar laporan milik kampusnya.
- Melihat detail laporan sesuai kewenangan.
- Memperbarui progres penanganan.
- Menambahkan catatan tindak lanjut.
- Menentukan tanggal deadline pekerjaan.
- Melihat riwayat laporan.
- Mengunduh laporan sesuai kewenangan.

Batasan: admin kampus tidak boleh melihat laporan kampus lain atau mengelola akun superadmin.

### 5.3 Superadmin

Pengelola sistem dengan kewenangan lintas kampus.

Kebutuhan:
- Login ke sistem.
- Melihat ringkasan laporan lintas kampus.
- Melihat laporan berdasarkan kampus.
- Mengelola data kampus.
- Menambah, mengubah, menghapus, dan menonaktifkan akun admin.
- Mengelola master data.
- Memantau progres penanganan.
- Mengakses laporan agregat dan mengunduh laporan sesuai kebijakan.

### 5.4 Matriks Hak Akses

| Fitur | Pelapor | Admin Kampus | Superadmin |
|---|---:|---:|---:|
| Mengirim pengaduan | Ya | Tidak | Tidak |
| Login dashboard | Belum ditetapkan | Ya | Ya |
| Melihat laporan | Laporan sendiri jika fitur pelacakan disediakan | Kampus sendiri | Seluruh kampus |
| Memperbarui progres | Tidak | Ya | Ya, sesuai kebijakan |
| Mengatur deadline | Tidak | Ya | Ya |
| Melihat log laporan | Tidak | Kampus sendiri | Seluruh kampus |
| Mengelola master kekerasan | Tidak | Sesuai kebijakan | Ya |
| Mengelola dokumen identitas | Tidak | Sesuai kebijakan | Ya |
| Mengelola master kampus | Tidak | Tidak | Ya |
| Mengelola akun admin | Tidak | Tidak | Ya |
| Mengunduh laporan | Belum ditetapkan | Kampus sendiri | Lintas kampus |

## 6. Alur Bisnis Utama

### 6.1 Alur Pengaduan

1. Pelapor membuka halaman pengaduan.
2. Sistem menampilkan formulir pengaduan.
3. Pelapor mengisi informasi yang diminta.
4. Pelapor memilih jenis kekerasan dari master data.
5. Pelapor dapat melampirkan dokumen identitas atau dokumen pendukung; lampiran identitas tidak wajib.
6. Sistem memvalidasi input.
7. Sistem menyimpan laporan dan menghasilkan nomor referensi unik.
8. Sistem memberikan konfirmasi bahwa laporan berhasil diterima.
9. Laporan tersedia bagi admin kampus yang berwenang.

### 6.2 Alur Penanganan Laporan

1. Admin kampus login.
2. Sistem mengidentifikasi kampus yang terhubung dengan akun admin.
3. Admin melihat daftar laporan kampusnya.
4. Admin membuka detail laporan.
5. Admin melakukan pemeriksaan awal dan mencatat progres.
6. Admin dapat menetapkan deadline tindak lanjut.
7. Sistem menyimpan perubahan dan mencatatnya pada log laporan.
8. Admin memperbarui progres sampai laporan selesai sesuai prosedur kampus.
9. Laporan dan riwayat penanganannya dapat diakses sesuai hak akses.

### 6.3 Alur Superadmin

1. Superadmin login.
2. Sistem menampilkan ringkasan lintas kampus.
3. Superadmin memilih kampus untuk melihat laporan tertentu.
4. Superadmin mengelola akun admin dan data kampus.
5. Superadmin memantau progres dan mengunduh laporan.

## 7. Kebutuhan Fungsional

Prioritas: **Must** = wajib untuk rilis awal; **Should** = penting; **Could** = pengembangan lanjutan.

| ID | Modul | Kebutuhan | Prioritas |
|---|---|---|---|
| FR-001 | Autentikasi | Admin dan superadmin dapat login menggunakan kredensial yang valid. | Must |
| FR-002 | Autentikasi | Sistem menyediakan logout dan pengelolaan sesi. | Must |
| FR-003 | Hak Akses | Sistem membedakan peran superadmin dan admin kampus. | Must |
| FR-004 | Hak Akses | Admin kampus hanya dapat mengakses data kampus yang ditetapkan pada akunnya. | Must |
| FR-005 | Hak Akses | Superadmin dapat mengakses data lintas kampus. | Must |
| FR-006 | Pengaduan | Pelapor dapat mengirim laporan melalui formulir. | Must |
| FR-007 | Pengaduan | Sistem memvalidasi data wajib sebelum laporan disimpan. | Must |
| FR-008 | Pengaduan | Lampiran dokumen identitas bersifat opsional. | Must |
| FR-009 | Pengaduan | Sistem menghasilkan nomor referensi laporan yang unik. | Must |
| FR-010 | Master Data | Admin berwenang dapat mengelola master jenis kekerasan. | Must |
| FR-011 | Master Data | Sistem menyediakan master jenis dokumen identitas. | Must |
| FR-012 | Master Kampus | Superadmin dapat menambah, mengubah, dan mengelola data kampus. | Must |
| FR-013 | Transaksi | Admin dapat melihat daftar laporan sesuai cakupan kampus. | Must |
| FR-014 | Transaksi | Admin dapat melihat detail laporan sesuai hak akses. | Must |
| FR-015 | Progres | Admin dapat menambahkan dan memperbarui progres penanganan. | Must |
| FR-016 | Progres | Admin dapat menentukan tanggal deadline melalui pemilih tanggal. | Must |
| FR-017 | Log | Sistem menyimpan riwayat perubahan dan aktivitas penting pada laporan. | Must |
| FR-018 | Keamanan | Data sensitif laporan dan log dienkripsi menggunakan AES-256 sesuai rancangan proyek. | Must |
| FR-019 | Akun | Superadmin dapat menambah, mengubah, menghapus, dan menonaktifkan akun admin. | Must |
| FR-020 | Pelaporan | Pengguna berwenang dapat mengunduh laporan. | Should |
| FR-021 | Dashboard | Dashboard menampilkan ringkasan laporan berdasarkan hak akses. | Should |
| FR-022 | Pencarian | Admin dapat mencari dan memfilter laporan. | Should |
| FR-023 | Pelapor | Pelapor dapat memeriksa status laporan menggunakan mekanisme aman. | Could |
| FR-024 | Notifikasi | Sistem dapat memberikan notifikasi perubahan status atau deadline. | Could |

### 7.1 Ketentuan Data Pengaduan

Rancangan field berikut merupakan usulan kebutuhan dan harus disesuaikan dengan formulir serta struktur database aktual:
- Nomor referensi laporan.
- Kampus tujuan.
- Waktu kejadian atau rentang waktu kejadian.
- Lokasi kejadian.
- Jenis kekerasan.
- Kronologi atau uraian kejadian.
- Informasi korban dan pelapor sesuai kebutuhan minimum.
- Informasi terlapor jika diketahui dan relevan.
- Kontak aman yang dapat digunakan untuk komunikasi.
- Dokumen pendukung opsional.
- Status laporan.
- Waktu pengiriman laporan.

Pengumpulan data harus menerapkan prinsip minimalisasi data. Jangan mewajibkan informasi yang tidak diperlukan untuk penerimaan dan tindak lanjut laporan.

### 7.2 Status Laporan yang Diusulkan

Status berikut adalah rancangan awal, bukan klaim bahwa seluruh status telah tersedia di kode:
- Diterima.
- Dalam Pemeriksaan.
- Dalam Penanganan.
- Menunggu Informasi/Tindak Lanjut.
- Selesai.
- Ditutup sesuai prosedur.

Perubahan status harus memiliki waktu perubahan dan identitas petugas yang melakukan perubahan. Status tidak boleh digunakan untuk menyimpulkan kebenaran atau ketidakbenaran pengaduan.

## 8. Kebutuhan Nonfungsional

### 8.1 Keamanan dan Kerahasiaan

- Semua akses dashboard wajib melalui autentikasi.
- Terapkan otorisasi pada backend untuk setiap permintaan data, bukan hanya menyembunyikan menu di frontend.
- Terapkan isolasi data berdasarkan kampus pada query dan endpoint.
- Data sensitif dienkripsi saat disimpan sesuai rancangan yang disetujui.
- Gunakan pengelolaan kunci enkripsi yang terpisah dari source code dan database.
- Gunakan HTTPS pada lingkungan produksi.
- Terapkan perlindungan CSRF, validasi input, pembatasan percobaan login, dan pengamanan unggahan file.
- Batasi akses unduh dokumen dan jangan menggunakan URL publik yang mudah ditebak.
- Jangan mencatat isi kronologi, identitas, atau informasi sensitif secara berlebihan ke application log.
- Terapkan backup terenkripsi dan uji pemulihan data.
- Sediakan kebijakan retensi dan penghapusan data.

### 8.2 Enkripsi AES-256

Catatan proyek menyebutkan enkripsi AES256 untuk transaksi laporan dan log laporan. Implementasi perlu menetapkan:
- Algoritma dan mode autentikasi yang aman, misalnya AES-256-GCM.
- Nonce/IV unik untuk setiap operasi enkripsi.
- Penyimpanan authentication tag.
- Pengelolaan dan rotasi kunci.
- Versioning format ciphertext agar perubahan implementasi dapat dikelola.
- Uji bahwa data dapat didekripsi oleh role dan proses yang memang berwenang.

Jangan menganggap penggunaan nama algoritma AES-256 saja sudah cukup untuk menjamin keamanan.

### 8.3 Kinerja

- Halaman daftar menggunakan pagination.
- Pencarian dan filter dilakukan melalui query terindeks.
- File unggahan dibatasi ukuran dan tipe yang diizinkan.
- Proses ekspor berukuran besar dapat dijalankan melalui queue.
- Target kinerja numerik ditetapkan setelah uji beban dan kesepakatan pemilik sistem.

### 8.4 Kemudahan Penggunaan dan Aksesibilitas

- Antarmuka responsif untuk desktop dan perangkat seluler.
- Formulir menggunakan label dan pesan validasi yang jelas.
- Alur pengaduan dibuat sederhana dan tidak meminta data berlebihan.
- Hindari bahasa yang menyalahkan korban.
- Sediakan informasi mengenai kerahasiaan dan batasan layanan sebelum formulir dikirim.

### 8.5 Keandalan dan Audit

- Setiap laporan memiliki identitas unik.
- Perubahan progres dan status tercatat.
- Operasi penting menggunakan transaksi database jika melibatkan beberapa tabel.
- Backup dan pemulihan diuji secara berkala.

## 9. Data dan Entitas Utama

Entitas konseptual berikut merupakan rancangan awal. Nama tabel dan relasi aktual perlu diverifikasi terhadap migration serta model pada repository.

| Entitas | Deskripsi |
|---|---|
| Users | Akun admin dan superadmin |
| Campuses | Data perguruan tinggi/kampus |
| ViolenceTypes | Master jenis kekerasan |
| IdentityDocumentTypes | Master jenis dokumen identitas |
| Reports | Data utama pengaduan |
| ReportAttachments | Berkas pendukung laporan |
| ReportProgress | Catatan progres dan deadline |
| ReportLogs | Riwayat aktivitas/perubahan laporan |

Relasi konseptual:
- Satu kampus dapat memiliki banyak akun admin.
- Satu kampus dapat memiliki banyak laporan.
- Satu laporan dapat memiliki banyak lampiran.
- Satu laporan dapat memiliki banyak catatan progres.
- Satu laporan dapat memiliki banyak log aktivitas.
- Jenis kekerasan dapat direferensikan oleh banyak laporan.

## 10. Kebutuhan Antarmuka

### 10.1 Area Publik/Pelapor
- Halaman informasi layanan.
- Halaman formulir pengaduan.
- Halaman konfirmasi pengiriman.
- Informasi privasi, kerahasiaan, dan petunjuk kondisi darurat.

### 10.2 Area Admin Kampus
- Halaman login.
- Dashboard kampus.
- Daftar laporan.
- Detail laporan.
- Form tambah/edit progres.
- Pemilihan deadline melalui kalender.
- Riwayat/log laporan.
- Unduh laporan.

### 10.3 Area Superadmin
- Dashboard lintas kampus.
- Daftar dan detail laporan lintas kampus.
- Manajemen kampus.
- Manajemen akun admin.
- Manajemen master data.
- Monitoring progres.
- Unduh laporan.

## 11. Aturan Bisnis

1. Setiap laporan harus memiliki nomor referensi unik.
2. Admin kampus hanya dapat melihat dan mengelola laporan dalam cakupan kampusnya.
3. Superadmin dapat melihat laporan lintas kampus.
4. Akun admin harus terhubung dengan satu kampus yang ditetapkan.
5. Dokumen identitas pelapor tidak wajib dilampirkan.
6. Perubahan progres harus menyimpan waktu dan pengguna yang melakukan perubahan.
7. Deadline disimpan sebagai tanggal yang dapat dipantau.
8. Data laporan dan log yang sensitif harus dilindungi dengan enkripsi.
9. Unduhan laporan harus mengikuti pembatasan hak akses.
10. Penghapusan akun admin sebaiknya mempertimbangkan jejak audit; penonaktifan dapat digunakan agar riwayat aktivitas tetap utuh.

## 12. Kriteria Penerimaan

| ID | Kriteria |
|---|---|
| AC-001 | Admin dan superadmin dapat login dan logout. |
| AC-002 | Admin Kampus A tidak dapat membaca laporan Kampus B, termasuk melalui manipulasi URL atau request API. |
| AC-003 | Superadmin dapat melihat laporan dari beberapa kampus. |
| AC-004 | Pelapor dapat mengirim laporan tanpa mengunggah dokumen identitas. |
| AC-005 | Sistem menolak input wajib yang tidak valid dan menampilkan pesan yang dapat dipahami. |
| AC-006 | Laporan yang berhasil disimpan memiliki nomor referensi unik. |
| AC-007 | Admin dapat menambahkan progres dan menetapkan deadline. |
| AC-008 | Perubahan progres/status tercatat dalam log dengan aktor dan waktu. |
| AC-009 | Superadmin dapat mengelola akun admin dan data kampus. |
| AC-010 | Pengguna hanya dapat mengunduh laporan sesuai kewenangannya. |
| AC-011 | Data sensitif yang ditentukan dalam desain keamanan tersimpan dalam bentuk terenkripsi dan dapat diakses melalui proses yang berwenang. |
| AC-012 | Unggahan file divalidasi berdasarkan tipe, ukuran, dan otorisasi akses. |

## 13. Teknologi dan Implementasi

Berdasarkan `composer.json` repository:
- PHP `^8.2`.
- Laravel `^11.31`.
- `maatwebsite/excel` untuk kebutuhan ekspor/impor spreadsheet.
- `anhskohbo/no-captcha` dan `mews/captcha` untuk dukungan CAPTCHA.
- `diglactic/laravel-breadcrumbs` untuk navigasi breadcrumb.
- Vite dan konfigurasi frontend tersedia di repository.

Database MySQL disebutkan dalam deskripsi proyek, tetapi konfigurasi koneksi aktual harus diverifikasi melalui environment deployment. File `.env` tidak boleh dimasukkan ke repository.

## 14. Kondisi Implementasi Berdasarkan Repository

Bagian ini memisahkan catatan yang ditemukan dari kebutuhan target. Status berikut berdasarkan `README PROJEK`, bukan hasil pengujian menyeluruh terhadap seluruh halaman dan endpoint.

| Modul/pekerjaan | Status menurut README PROJEK |
|---|---|
| HTML frontend | Sudah dikerjakan |
| Login Admin | Sudah dikerjakan |
| Template Dashboard | Sudah dikerjakan |
| Master kekerasan | Ditandai selesai |
| Master dokumen identitas | Ditandai selesai |
| Transaksi laporan | Tercatat perlu dikerjakan |
| Log laporan | Tercatat perlu dikerjakan |
| Download laporan | Tercatat perlu dikerjakan |
| Master kampus | Tercatat perlu dikerjakan |
| File identitas tidak wajib | Tercatat sebagai perubahan yang diperlukan |
| Deadline progres | Tercatat sebagai perubahan yang diperlukan |
| Hak akses admin kampus | Tercatat sebagai perubahan yang diperlukan |
| Hak akses superadmin | Tercatat sebagai perubahan yang diperlukan |

### 14.1 Batasan Analisis

- Pemeriksaan awal repository menemukan struktur Laravel dan catatan pengembangan.
- Isi seluruh controller, model, migration, route, view, serta folder Android belum diverifikasi satu per satu dalam analisis ini.
- Karena itu, nama tabel, field, endpoint, validasi, dan perilaku aktual tidak boleh dianggap final sebelum audit kode.
- Status "selesai" pada README perlu dikonfirmasi melalui pengujian aplikasi.

## 15. Risiko dan Mitigasi

| Risiko | Dampak | Mitigasi |
|---|---|---|
| Kebocoran identitas atau kronologi | Membahayakan korban/pelapor | Enkripsi, pembatasan akses, minimisasi data, audit akses |
| Admin melihat data kampus lain | Pelanggaran kerahasiaan | Otorisasi backend dan pengujian isolasi tenant |
| Kredensial masuk repository | Akses tidak sah ke layanan | Rotasi segera, hapus dari source dan riwayat Git, gunakan secret manager |
| File berbahaya diunggah | Kompromi server/data | Validasi MIME, ukuran, ekstensi, pemindaian, penyimpanan privat |
| Log menyimpan data sensitif | Kebocoran melalui log | Redaksi data dan kebijakan logging |
| Deadline tidak terpantau | Keterlambatan penanganan | Dashboard deadline dan notifikasi sebagai pengembangan |
| Penghapusan data tidak tepat | Hilangnya bukti/riwayat | Kebijakan retensi, soft delete, dan audit |

## 16. Prioritas Pengembangan

### Tahap 1 – Fondasi dan Keamanan
- Audit autentikasi dan otorisasi.
- Pastikan pemisahan data per kampus.
- Finalisasi master kampus dan akun admin.
- Tetapkan skema enkripsi dan pengelolaan kunci.

### Tahap 2 – Proses Pengaduan
- Finalisasi formulir pengaduan.
- Implementasikan penyimpanan transaksi laporan.
- Jadikan dokumen identitas opsional.
- Implementasikan nomor referensi dan validasi.

### Tahap 3 – Penanganan dan Audit
- Implementasikan progres penanganan.
- Implementasikan deadline.
- Implementasikan log laporan.
- Uji audit trail dan hak akses.

### Tahap 4 – Pelaporan dan Penyempurnaan
- Implementasikan unduh/ekspor laporan.
- Sempurnakan dashboard dan filter.
- Uji keamanan, performa, dan usability.
- Siapkan dokumentasi operasional dan backup.

## 17. Pertanyaan yang Perlu Diputuskan Pemilik Produk

1. Apakah pelapor dapat mengirim laporan secara anonim?
2. Apakah pelapor dapat memantau status menggunakan nomor referensi dan PIN/token?
3. Informasi apa yang wajib diisi pada formulir dan mana yang opsional?
4. Siapa saja petugas yang boleh membaca identitas dan kronologi lengkap?
5. Apakah satu admin dapat mengelola lebih dari satu kampus?
6. Status dan alur persetujuan apa yang digunakan masing-masing kampus?
7. Berapa lama data laporan dan lampiran disimpan?
8. Format ekspor yang dibutuhkan: PDF, Excel, atau keduanya?
9. Apakah perlu notifikasi email atau kanal lain untuk deadline dan perubahan status?
10. Apakah aplikasi Android pada repository merupakan kanal aktif yang harus disinkronkan dengan sistem web?

## 18. Definisi Selesai (Definition of Done)

Rilis awal dapat dinyatakan siap apabila:
- Semua kebutuhan prioritas Must selesai dan telah diuji.
- Pengujian isolasi data antar-kampus lulus.
- Data sensitif dan lampiran dilindungi sesuai rancangan keamanan.
- Alur pengaduan sampai tindak lanjut dapat dilakukan tanpa proses manual yang tidak terdokumentasi.
- Perubahan progres dan status memiliki audit trail.
- Pengunduhan data menerapkan otorisasi.
- Tidak terdapat kredensial rahasia di repository.
- Dokumentasi instalasi, konfigurasi, backup, dan pemulihan tersedia.

## 19. Referensi

- Repository: https://github.com/MNurIkbal/KKP_CRS
- Catatan pengembangan: `README PROJEK` pada repository.
- Dependensi dan versi runtime: `composer.json` pada repository.

---

**Catatan:** Dokumen ini merupakan PRD awal yang menggabungkan fakta yang terlihat pada repository dengan rancangan kebutuhan produk. Bagian rancangan dan usulan harus dikonfirmasi oleh pemilik proses bisnis sebelum dijadikan spesifikasi final.
