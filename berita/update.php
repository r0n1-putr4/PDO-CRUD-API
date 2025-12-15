<?php
include '../koneksi.php';

// Folder upload
$folder = "../uploads/";
try {
    if (
        isset($_POST['judul']) && isset($_POST['isi_berita']) &&
        isset($_POST['rating']) && isset($_FILES['gambar_berita']) && isset($_POST['id'])
    ) {

        $judul = $_POST['judul'];
        $isi   = $_POST['isi_berita'];
        $rating = $_POST['rating'];
        $id = $_POST['id'];

        // Ambil data file
        $namaFile = $_FILES['gambar_berita']['name'];
        $tmpFile  = $_FILES['gambar_berita']['tmp_name'];

        $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

        $namaBaru = uniqid('berita_') . "." . $ekstensi;
        $pathGambar =$folder . $namaBaru;

        if (move_uploaded_file($tmpFile, $pathGambar)) {
            $query = $pdo->prepare("UPDATE berita SET judul = ?, isi_berita = ?, gambar_berita = ?, rating = ? WHERE id = ?");
            $query->execute([$judul, $isi, "uploads/" . $namaBaru , $rating,$id]);

            echo json_encode([
                "success" => true,
                "message" => "Berita berhasil update",
                "data" => $_POST
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal Disimpan"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
    exit;
}
