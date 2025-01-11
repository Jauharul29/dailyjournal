<?php 
function upload_foto($file) {
    // Inisialisasi variabel hasil dan status
    $uploadOk = 1;
    $hasil = array();
    $message = '';

    // Properti file yang diunggah
    $fileName = $file['name'];
    $tmpLocation = $file['tmp_name'];
    $fileSize = $file['size'];

    // Ekstensi file
    $fileExt = explode('.', $fileName);
    $fileExt = strtolower(end($fileExt));

    // Ekstensi file yang diperbolehkan
    $allowed = array('jpg', 'jpeg', 'png', 'gif');  

    // Validasi ukuran file (maksimal 5 MB)
    if ($fileSize > 5000000) { // 5MB
        $message .= "Maaf, ukuran file terlalu besar. Maksimal 5MB. ";
        $uploadOk = 0;
    }

    // Validasi ekstensi file
    if (!in_array($fileExt, $allowed)) {
        $message .= "Maaf, hanya file dengan format JPG, JPEG, PNG, dan GIF yang diperbolehkan. ";
        $uploadOk = 0; 
    }

    // Jika validasi gagal
    if ($uploadOk == 0) {
        $message .= "Maaf, file Anda gagal diunggah. ";
        $hasil['status'] = false; 
    } else {
        // Buat nama file baru untuk mencegah duplikasi
        $newName = date("YmdHis") . '.' . $fileExt;
        $uploadDestination = "img/" . $newName; 

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($tmpLocation, $uploadDestination)) {
            $message .= "File berhasil diunggah: " . $newName;
            $hasil['status'] = true; 
            $hasil['file_name'] = $newName; // Nama file yang berhasil diunggah
        } else {
            $message .= "Maaf, terjadi kesalahan saat mengunggah file. ";
            $hasil['status'] = false; 
        }
    }

    // Mengembalikan hasil
    $hasil['message'] = $message; 
    return $hasil;
}
?>
