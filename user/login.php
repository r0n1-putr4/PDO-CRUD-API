<?php

include "../koneksi.php";



if (isset($_POST['email']) && isset($_POST['password'])) {
    echo json_encode([
        "success" => "error",
        "message" => "Email dan password wajib diisi"
    ]);
    exit;
}


$email = $_POST["email"];
$password = $_POST["password"];

// Cek user berdasarkan email
$sql = "SELECT * FROM users WHERE email = ?  and passwrod = ? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email,$password]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika email dan password tidak ditemukan
if (!$user) {
    echo json_encode([
        "success" => false,
        "message" => "Email atau Password anda salah!, Silahkan di coba kembali"
    ]);
    exit;
}
// Login berhasil
echo json_encode([
    "success" => true,
    "message" => "Login berhasil",
    "data" => [
        "id" => $user["id"],
        "nama" => $user["nama"],
        "email" => $user["email"]
    ]
]);
