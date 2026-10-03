-- Database Schema untuk Campus Reporting System (CRS)
-- Disesuaikan dengan Source Code dan Model Laravel yang ada

SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------
-- Table `universitas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `universitas`;
CREATE TABLE `universitas` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Table `kekerasan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kekerasan`;
CREATE TABLE `kekerasan` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tipe_kekerasan` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Table `dokumen_identitas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dokumen_identitas`;
CREATE TABLE `dokumen_identitas` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `jenis_identitas` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `email_verified_at` TIMESTAMP NULL,
  `password` VARCHAR(255) NOT NULL,
  `universitas_id` BIGINT UNSIGNED NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`universitas_id`) REFERENCES `universitas`(`id`) ON DELETE SET NULL
);

-- -----------------------------------------------------
-- Table `laporan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laporan`;
CREATE TABLE `laporan` (
  `id` VARCHAR(50) PRIMARY KEY,
  `kode_laporan` VARCHAR(50) UNIQUE NOT NULL,
  `nama` TEXT, -- Encrypted di aplikasi
  `no_identitas` TEXT, -- Encrypted di aplikasi
  `jenis_kelamin` TEXT, -- Encrypted di aplikasi
  `universitas` BIGINT UNSIGNED NULL,
  `email` TEXT, -- Encrypted di aplikasi
  `no_hp` TEXT, -- Encrypted di aplikasi
  `jenis_identitas` BIGINT UNSIGNED NULL,
  `tanggal_kejadian` TEXT, -- Encrypted di aplikasi
  `kronologi_kejadian` TEXT, -- Encrypted di aplikasi
  `lokasi_kejadian` TEXT, -- Encrypted di aplikasi
  `jenis_kekerasan` BIGINT UNSIGNED NULL,
  `tgl_batas_proses` DATE NULL,
  `status_laporan` TEXT, -- Encrypted di aplikasi
  `deskripsi_laporan` TEXT, -- Encrypted di aplikasi
  `kategori` TEXT, -- Encrypted di aplikasi
  `instansi_bekerja` TEXT NULL, -- Encrypted di aplikasi
  `mitra` VARCHAR(50) NULL,
  `upload_identitas` TEXT NULL, -- Encrypted di aplikasi
  `upload_bukti` TEXT NULL, -- Encrypted di aplikasi
  `pelapor` TEXT, -- Encrypted di aplikasi
  `merge_laporan_id` BIGINT UNSIGNED NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL,
  FOREIGN KEY (`universitas`) REFERENCES `universitas`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`jenis_identitas`) REFERENCES `dokumen_identitas`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`jenis_kekerasan`) REFERENCES `kekerasan`(`id`) ON DELETE SET NULL
);

-- -----------------------------------------------------
-- Table `laporan_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laporan_log`;
CREATE TABLE `laporan_log` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `kode_laporan` VARCHAR(50) NOT NULL,
  `tanggal_diubah` DATETIME NOT NULL,
  `status_laporan` TEXT NOT NULL, -- Encrypted di aplikasi
  `deskripsi_laporan` TEXT NOT NULL, -- Encrypted di aplikasi
  `tgl_batas_proses` DATE NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`kode_laporan`) REFERENCES `laporan`(`kode_laporan`) ON DELETE CASCADE
);

SET FOREIGN_KEY_CHECKS = 1;

-- -----------------------------------------------------
-- SAMPLE DATA
-- -----------------------------------------------------

-- Insert Universitas
INSERT INTO `universitas` (`nama`) VALUES 
('Universitas Nusantara'),
('Institut Teknologi Maju');

-- Insert Kekerasan
INSERT INTO `kekerasan` (`tipe_kekerasan`) VALUES 
('Kekerasan Fisik'),
('Kekerasan Seksual'),
('Kekerasan Psikis'),
('Kekerasan Verbal');

-- Insert Dokumen Identitas
INSERT INTO `dokumen_identitas` (`jenis_identitas`) VALUES 
('KTM (Kartu Tanda Mahasiswa)'),
('KTP (Kartu Tanda Penduduk)'),
('SIM (Surat Izin Mengemudi)');

-- Insert Users (Password: bcrypt hash of "password", sesuaikan dengan aplikasi Anda)
INSERT INTO `users` (`name`, `email`, `password`, `universitas_id`) VALUES 
('Superadmin', 'superadmin@crs.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL),
('Admin Univ Nusantara', 'admin.nusantara@crs.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

-- Note: Data pada tabel 'laporan' dan 'laporan_log' seharusnya dienkripsi (AES-256) menggunakan
-- fungsi Crypt::encryptString() dari Laravel. Data sample di bawah ini HANYA ilustrasi 
-- dan akan gagal didekripsi oleh aplikasi Laravel karena bukan format enkripsi Laravel yang valid.
-- Disarankan untuk membuat laporan melalui form aplikasi langsung agar data terenkripsi dengan benar.
