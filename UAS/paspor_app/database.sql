-- =========================================================
-- DATABASE: SISTEM PENGAJUAN PASPOR - KANTOR IMIGRASI CABANG
-- UAS Pemrograman Web II
-- =========================================================

CREATE DATABASE IF NOT EXISTS db_paspor;
USE db_paspor;

-- ---------------------------------------------------------
-- TABEL 1: PENDAFTAR (Menu "Daftar")
-- ---------------------------------------------------------
CREATE TABLE pendaftar (
  no_daftar     INT AUTO_INCREMENT PRIMARY KEY,
  nama_pemohon  VARCHAR(100) NOT NULL,
  tgl_daftar    DATE NOT NULL,
  hari          VARCHAR(20) NOT NULL,   -- hari harus datang (auto)
  tanggal       DATE NOT NULL,          -- tanggal harus datang (auto, sesuai kuota)
  jam           TIME NOT NULL,          -- jam harus datang (auto, sesuai slot)
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- TABEL 2: DAFTAR ULANG (Menu "Daftar Ulang")
-- ---------------------------------------------------------
CREATE TABLE daftar_ulang (
  no_daftar_ulang   INT AUTO_INCREMENT PRIMARY KEY,
  no_daftar         INT NOT NULL,
  nama_pemohon      VARCHAR(100) NOT NULL,
  hari_daftar_ulang VARCHAR(20) NOT NULL,
  tgl_daftar_ulang  DATE NOT NULL,
  hari_datang       VARCHAR(20) NOT NULL,
  tgl_datang        DATE NOT NULL,
  ktp               ENUM('Ada','Tidak') NOT NULL,
  kk                ENUM('Ada','Tidak') NOT NULL,
  ijazah_akte       ENUM('Ada','Tidak') NOT NULL,
  keperluan         VARCHAR(50) NOT NULL,
  keterangan        ENUM('OK','Tidak') NOT NULL,   -- OK jika hari & tanggal datang sesuai jadwal
  no_antrian        INT DEFAULT NULL,               -- otomatis terisi hanya jika keterangan = OK
  FOREIGN KEY (no_daftar) REFERENCES pendaftar(no_daftar) ON DELETE CASCADE
);

-- ---------------------------------------------------------
-- TABEL 3: PENGURUSAN BERKAS (Menu "Pengurusan")
-- ---------------------------------------------------------
CREATE TABLE pengurusan (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  no_antrian      INT NOT NULL,
  no_daftar_ulang INT NOT NULL,
  no_daftar       INT NOT NULL,
  nama_pemohon    VARCHAR(100) NOT NULL,
  berkas          ENUM('Lengkap','Tidak Lengkap') NOT NULL,
  status          ENUM('Diterima','Ditolak') NOT NULL,
  keterangan      VARCHAR(20) NOT NULL,
  pembayaran      INT DEFAULT 0,
  created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (no_daftar_ulang) REFERENCES daftar_ulang(no_daftar_ulang) ON DELETE CASCADE
);

