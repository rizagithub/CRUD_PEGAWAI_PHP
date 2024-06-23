<?php
// Include koneksi ke database
include_once 'koneksi.php';

// Mengambil data nama jabatan dari form
$nama_jabatan = $_POST['nama_jabatan'];

// Query untuk menyimpan data jabatan ke dalam database
$query = "INSERT INTO jabatan (nama_jabatan) VALUES ('$nama_jabatan')";

if (mysqli_query($koneksi, $query)) {
    // Jika berhasil disimpan, redirect ke halaman manage jabatan
    header("Location: jabatan.php");
    exit;
} else {
    // Jika terjadi error, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Menutup koneksi database
mysqli_close($koneksi);
?>
