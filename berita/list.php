<?php
include '../koneksi.php';

$query = $pdo->query("SELECT * FROM berita ORDER BY id DESC");
$data = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => true,
    "message" => "List Beita",
    "data" => $data
]);
