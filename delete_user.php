<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$user = $koneksi->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();
$foto = $user['foto'];

if (file_exists('uploads/' . $foto)) {
    unlink('uploads/' . $foto);
}

$koneksi->query("DELETE FROM users WHERE id = $id");
header('Location: user.php');
?>
