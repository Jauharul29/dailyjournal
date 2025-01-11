<?php
// Pastikan sesi sudah dimulai
if (!isset($_SESSION)) {
    session_start();
}

// Redirect ke halaman login jika pengguna belum login
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}
?>
<div id="profile" class="section">
    <h2 class="text-center mb-4">Profile</h2>
    <div class="text-center mb-4">
        <img src="image/xiaoyan.jpeg" alt="Profile Photo" class="profile-photo rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
    </div>
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <table class="table table-borderless text-center">
                <tr>
                    <td><strong>Nama:</strong></td>
                    <td>Muhammad Jauharul Ilmi</td>
                </tr>
                <tr>
                    <td><strong>NIM:</strong></td>
                    <td>A11.2023.15490</td>
                </tr>
                <tr>
                    <td><strong>Program Studi:</strong></td>
                    <td>Teknik Informatika</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>1112315490@gmail.com</td>
                </tr>
                <tr>
                    <td><strong>Telepon:</strong></td>
                    <td>+6281338337020</td>
                </tr>
                <tr>
                    <td><strong>Alamat:</strong></td>
                    <td>Jl. Setinggil No. 76, Demak</td>
                </tr>
            </table>
        </div>
    </div>
</div>
