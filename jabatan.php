<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Jabatan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        <div class="container">
            <div class="d-flex justify-content-start mb-3">
                <a href="addJabatan.php" class="btn btn-success">
                    <i class="bi bi-plus-circle-fill me-2"></i>Add Jabatan
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Jabatan</th>
                            <th>Nama Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include koneksi ke database
                        include_once 'koneksi.php';

                        // Query untuk mengambil data dari tabel jabatan
                        $query = "SELECT * FROM jabatan";
                        $result = mysqli_query($koneksi, $query);

                        if (mysqli_num_rows($result) > 0) {
                            $no = 1; // Inisialisasi nomor
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$no}</td>";
                                echo "<td>{$row['id']}</td>";
                                echo "<td>{$row['nama_jabatan']}</td>";
                                echo "<td>";
                                echo "<a href='editJabatan.php?id={$row['id']}' class='btn btn-warning btn-sm bi bi-pencil-fill'></a>";
                                echo "<a href='deleteJabatan.php?id={$row['id']}' class='btn btn-danger btn-sm bi bi-trash-fill ms-1' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\")'></a>";
                                echo "</td>";
                                echo "</tr>";

                                $no++; // Increment nomor
                            }
                        } else {
                            echo "<tr><td colspan='4'>Tidak ada data jabatan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
