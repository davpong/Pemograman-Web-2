<?php
// koneksi.php — Simpan di folder yang sama dengan form.php & simpan.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // default XAMPP
define('DB_PASS', '');           // default XAMPP (kosong)
define('DB_NAME', 'buku_tamu_db');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['status' => 'error', 'message' => 'Koneksi database gagal: ' . $conn->connect_error]));
}
