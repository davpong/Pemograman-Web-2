<?php
// simpan.php — Menerima POST dari form buku tamu

header('Content-Type: application/json');
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method tidak diizinkan.']);
    exit;
}

// ── Ambil & sanitasi input ──────────────────────────────────────────
$nama       = trim($_POST['nama']       ?? '');
$email      = trim($_POST['email']      ?? '');
$no_telepon = trim($_POST['no_telepon'] ?? '');
$instansi   = trim($_POST['instansi']   ?? '');
$keperluan  = trim($_POST['keperluan']  ?? '');
$pesan      = trim($_POST['pesan']      ?? '');
$penilaian  = (int)($_POST['penilaian'] ?? 5);
$tanggal    = trim($_POST['tanggal']    ?? '');
$jam_masuk  = trim($_POST['jam_masuk']  ?? '');

// ── Validasi ────────────────────────────────────────────────────────
$errors = [];

if ($nama === '')                             $errors[] = 'Nama wajib diisi.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Format email tidak valid.';
if ($no_telepon === '')                       $errors[] = 'No. Telepon wajib diisi.';
if ($keperluan === '')                        $errors[] = 'Keperluan wajib dipilih.';
if ($penilaian < 1 || $penilaian > 5)        $errors[] = 'Penilaian harus antara 1–5.';
if ($tanggal === '')                          $errors[] = 'Tanggal wajib diisi.';
if ($jam_masuk === '')                        $errors[] = 'Jam masuk wajib diisi.';

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
    exit;
}

// ── Simpan ke database ──────────────────────────────────────────────
$stmt = $conn->prepare(
    "INSERT INTO tamu
       (nama, email, no_telepon, instansi, keperluan, pesan, penilaian, tanggal, jam_masuk)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
);

$stmt->bind_param(
    'ssssssiis',
    $nama, $email, $no_telepon, $instansi,
    $keperluan, $pesan, $penilaian, $tanggal, $jam_masuk
);

if ($stmt->execute()) {
    echo json_encode([
        'status'  => 'success',
        'message' => 'Data berhasil disimpan! Terima kasih telah berkunjung.',
        'id'      => $stmt->insert_id,
    ]);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
