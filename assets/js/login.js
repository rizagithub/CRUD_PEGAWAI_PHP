function login() {
    var email = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value.trim();

    // Validasi email dan password
    if (email === 'riza@gmail.com' && password === '12345') {
        // Redirect ke halaman dashboard.php jika login berhasil
        window.location.href = 'dashboard.php';
    } else {
        // Login gagal, tampilkan pesan error
        alert('Email atau password salah.');
    }
}