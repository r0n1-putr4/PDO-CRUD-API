<?php
include '../koneksi.php';

try {
    if (isset($_POST['id'])) {

        $id = $_POST['id'];

        $query = $pdo->prepare("DELETE FROM berita WHERE id = ?");
        $query->execute([$id]);

        echo json_encode([
            "success" => true,
            "message" => "Berita berhasil delete"
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
    exit;
}
