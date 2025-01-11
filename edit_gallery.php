<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$gallery = $koneksi->query("SELECT * FROM gallery WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $gambar_lama = $gallery['gambar'];

    // Check apakah ada file gambar yang diupload
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $upload_dir = 'uploads/';

        // Hapus file lama
        if (file_exists($upload_dir . $gambar_lama)) {
            unlink($upload_dir . $gambar_lama);
        }

        // Upload file baru
        move_uploaded_file($tmp_name, $upload_dir . $gambar);
    } else {
        $gambar = $gambar_lama; // Jika tidak ada file baru, gunakan file lama
    }

    // Update data
    $koneksi->query("UPDATE gallery SET judul = '$judul', deskripsi = '$deskripsi', gambar = '$gambar' WHERE id = $id");
    header('Location: gallery.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Edit Gallery</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" id="judul" value="<?= $gallery['judul'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required><?= $gallery['deskripsi'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" name="gambar" id="gambar">
            <p class="mt-2">Gambar saat ini:</p>
            <img src="uploads/<?= $gallery['gambar'] ?>" width="100" alt="Gallery">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="gallery.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
