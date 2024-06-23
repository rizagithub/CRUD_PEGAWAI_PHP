<?php
include_once 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Melindungi dari SQL Injection
    $id = mysqli_real_escape_string($koneksi, $id);

    // Query untuk menghapus data user berdasarkan id
    $query = "DELETE FROM user WHERE id = $id";

    if (mysqli_query($koneksi, $query)) {
        header('Location: user.php'); // Redirect ke halaman user.php setelah berhasil menghapus data
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID user tidak ditemukan.";
}
?>
