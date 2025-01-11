<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "uploads/$foto");

    $sql = "INSERT INTO user (nama, username, password, email, foto) VALUES ('$nama', '$username', '$password', '$email', '$foto')";
    $conn->query($sql);

    header('Location: admin.php?page=user');
}
?>

<h1>Tambah User</h1>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="file" name="foto" required>
    <button type="submit">Simpan</button>
</form>
