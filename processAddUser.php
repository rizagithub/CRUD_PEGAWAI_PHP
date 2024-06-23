<?php
// Include koneksi ke database
include_once 'koneksi.php';

// Pastikan data POST telah terkirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password sebelum disimpan ke database (contoh sederhana, sebaiknya gunakan metode yang lebih aman)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data user ke dalam database
    $query = "INSERT INTO user (nama, email, password) VALUES ('$nama', '$email', '$hashed_password')";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Jika penyimpanan berhasil, redirect kembali ke halaman user.php
        header('Location: user.php');
        exit;
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>
