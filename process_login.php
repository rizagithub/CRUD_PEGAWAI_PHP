<?php
session_start();
include_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mendapatkan hash password berdasarkan email
    $query = "SELECT password FROM user WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];

            // Memverifikasi password yang dimasukkan oleh pengguna
            if (password_verify($password, $hashed_password)) { 
                    $_SESSION['email'] = $email; // Set session email jika login berhasil
                    header('Location: dashboard.php'); // Redirect ke halaman dashboard.php
            } else {
                header('Location: login.php?error=password'); // Redirect dengan pesan error password salah
                exit;
            }
        } else {
            header('Location: login.php?error=email'); // Redirect dengan pesan error email tidak ditemukan
            exit;
        }
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header('Location: login.php'); // Redirect jika tidak ada akses POST langsung
    exit;
}
?>
