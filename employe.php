<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
        .table-container {
            margin: 0 auto;
            max-width: 1200px;
        }
        .employee-img {
            max-width: 80px;
            max-height: 80px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="ms-4 fw-bold">INFLOYE</h4>
        <a href="dashboard.php"><i class="bi bi-house-gear-fill mx-2"></i>Dashboard</a>
        <a href="user.php"><i class="bi bi-people-fill mx-2"></i>Manage Users</a>
        <a href="dashboard.php"><i class="bi bi-person-badge-fill mx-2"></i>Manage Employees</a>
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
        <div class="container table-container">
            <div class="d-flex mb-3">
                <div>
                    <!-- <a href="add.php" class="btn btn-success"><i class="bi bi-person-fill-add me-2"></i>Add Data</a> -->
                    <button type="button" class="btn btn-success btn-add-employee" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        <i class="bi bi-person-fill-add me-2"></i>Add Employee
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="employeTable" class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Pegawai</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once 'koneksi.php';
                        
                        $q = "SELECT p.*, j.nama_jabatan FROM employe p JOIN jabatan j ON p.jabatan_id = j.id";
                        $result = mysqli_query($koneksi, $q);
                        
                        if (mysqli_num_rows($result) > 0) {
                            $nomor = 1; // Inisialisasi nomor
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?= $nomor ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['nip'] ?></td>
                                    <td><?= $row['nama_jabatan'] ?></td>
                                    <td>
                                        <?php if (!empty($row['image'])): ?>
                                            <img src="<?= $row['image'] ?>" class="employee-img" alt="Employee Image">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['status'] ? 'Aktif' : 'Tidak Aktif' ?></td>
                                    <td>
                                        <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                        <a href="#" class="btn btn-sm btn-delete btn-danger" data-id="<?= $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"><i class="bi bi-trash3-fill"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $nomor++; // Increment nomor untuk setiap baris data
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data pegawai.</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <a href="print.php" class="btn btn-primary">Print Data</a>
            </div>
        </div>

        <!-- Modal Konfirmasi Penghapusan -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add Data -->
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="add.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="nama">Name</label>
                                <input type="text" id="nama" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="jenis_kelamin">Gender</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                    <option value="0">Female</option>
                                    <option value="1">Male</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nip">NIP</label>
                                <input type="text" id="nip" name="nip" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="jabatan">Position</label>
                                <select id="jabatan" name="jabatan" class="form-control" required>
                                    <?php
                                    include_once 'koneksi.php';
                                    $query = "SELECT id, nama_jabatan FROM jabatan";
                                    $result = mysqli_query($koneksi, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$row['id']}'>{$row['nama_jabatan']}</option>";
                                        }
                                    } else {
                                        echo "<option disabled>No data available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="gambar">Upload Image</label>
                                <input type="file" id="gambar" name="gambar" class="form-control-file">
                            </div>
                            <div class="form-group mb-3">
                                <label for="no_telepon">Phone Number</label>
                                <input type="tel" id="no_telepon" name="no_telepon" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat">Address</label>
                                <textarea id="alamat" name="alamat" rows="3" class="form-control" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Status</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_aktif" value="1" checked>
                                    <label class="form-check-label" for="status_aktif">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_nonaktif" value="0">
                                    <label class="form-check-label" for="status_nonaktif">Inactive</label>
                                </div>
                            </div>
                            <button type="submit" name="tambah" value="tambah" class="btn btn-primary btn-submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        $(document).ready(function() {
            var deleteUrl = '';

            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                deleteUrl = 'delete.php?id=' + id;
                $('#confirmDeleteModal').modal('show');
            });

            $('#confirmDeleteButton').on('click', function() {
                window.location.href = deleteUrl;
            });
        });
        </script>
    </div>

   
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#employeTable').DataTable();
        });
    </script>
</body>
</html>

<?php
if (isset($_POST['tambah'])) {
    include_once 'koneksi.php';
    
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nip = $_POST['nip'];
    $jabatan_id = $_POST['jabatan'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    // Upload gambar
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    if ($_FILES["gambar"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $q = "INSERT INTO employe (nama, jenis_kelamin, nip, jabatan_id, image, no_telepon, alamat, status) 
                  VALUES ('$nama', '$jenis_kelamin', '$nip', '$jabatan_id', '$target_file', '$no_telepon', '$alamat', '$status')";
            $result = mysqli_query($koneksi, $q);
            
            if ($result) {
                echo "<script>alert('Employee data added successfully.'); window.location.href = 'employe.php';</script>";
                exit; // Ensure to use exit after header redirect
            } else {
                echo "Error: " . $q . "<br>" . mysqli_error($koneksi);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
