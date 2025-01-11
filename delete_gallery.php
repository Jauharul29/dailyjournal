<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];

// Ambil data gambar
$gallery = $koneksi->query("SELECT * FROM gallery WHERE id = $id")->fetch_assoc();
$gambar = $gallery['gambar'];

// Hapus file gambar dari folder uploads
if (file_exists('uploads/' . $gambar)) {
    unlink('uploads/' . $gambar);
}

// Hapus data dari database
$koneksi->query("DELETE FROM gallery WHERE id = $id");
header('Location: gallery.php');
?>
