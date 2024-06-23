<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
            width: 250px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar {
            margin-left: 250px;
        }
    </style>
</head>
<body>
    <?php
    // Sertakan file koneksi
    include 'koneksi.php';

    // Ambil data user dan employe
    $user_query = "SELECT COUNT(*) AS user_count FROM user";
    $employe_query = "SELECT COUNT(*) AS employe_count FROM employe";

    $user_result = mysqli_query($koneksi, $user_query);
    $employe_result = mysqli_query($koneksi, $employe_query);

    $user_count = 0;
    $employe_count = 0;

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_count = mysqli_fetch_assoc($user_result)['user_count'];
    }

    if ($employe_result && mysqli_num_rows($employe_result) > 0) {
        $employe_count = mysqli_fetch_assoc($employe_result)['employe_count'];
    }

    mysqli_close($koneksi);
    ?>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="ms-4 fw-bold">INFLOYE</h4>
        <a href="dashboard.php"><i class="bi bi-house-gear-fill mx-2"></i>Dashboard</a>
        <a href="user.php"><i class="bi bi-people-fill mx-2"></i>Manage Users</a>
        <a href="employe.php"><i class="bi bi-person-badge-fill mx-2"></i>Manage Employees</a>
        <a href="jabatan.php"><i class="bi bi-gear-fill mx-2"></i>Manage Position</a>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><button type="button" class="btn btn-danger"><i class="bi bi-box-arrow-in-right me-2"></i>Logout</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Here you can manage users, employees, and other settings.</p>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header fw-bold">
                        User and Employee Statistics
                    </div>
                    <div class="card-body">
                        <canvas id="userEmployeeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom JS -->
    <script>
        const userCount = <?php echo $user_count; ?>;
        const employeCount = <?php echo $employe_count; ?>;
    </script>
    <script src="assets/js/dashboard.js"></script>
</body>
</html>
