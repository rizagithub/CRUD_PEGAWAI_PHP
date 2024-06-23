<?php
// Include file koneksi database
include_once 'koneksi.php';

// Pastikan parameter id terdefinisi dan merupakan bilangan bulat
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Escape parameter id untuk mencegah SQL Injection
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query untuk menghapus data berdasarkan id
    $query = "DELETE FROM employe WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak valid atau tidak ditemukan.";
}

// Redirect kembali ke halaman employe.php setelah menghapus data
header('Location: employe.php');
exit;
?>
