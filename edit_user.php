<?php
include 'koneksi.php';
$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<form method="POST" enctype="multipart/form-data">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" value="<?= $user['nama']; ?>" required><br>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?= $user['username']; ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= $user['email']; ?>" required><br>

    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto"><br>
    <img src="uploads/<?= $user['foto']; ?>" alt="Foto Profil" width="50"><br>

    <button type="submit" name="update">Simpan Perubahan</button>
</form>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $foto = $_FILES['foto']['name'];

    if ($foto) {
        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto);
        $sql = "UPDATE user SET nama = '$nama', username = '$username', email = '$email', foto = '$foto' WHERE id = $id";
    } else {
        $sql = "UPDATE user SET nama = '$nama', username = '$username', email = '$email' WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate!";
        header("Location: admin.php?page=user_manage");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
