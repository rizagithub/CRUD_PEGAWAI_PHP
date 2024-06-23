<?php
// editJabatan.php
include_once 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM jabatan WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $jabatan = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama_jabatan = $_POST['nama_jabatan'];

    $query = "UPDATE jabatan SET nama_jabatan = '$nama_jabatan' WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Jabatan updated successfully.'); window.location.href = 'jabatan.php';</script>";
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jabatan - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <!-- Content -->
    <div class="content">
        <div class="container">
            <h1 class="my-4">Edit Jabatan</h1>
            <div class="row">
                <div class="col-md-6">
                    <?php if (isset($jabatan)): ?>
                        <form action="editJabatan.php" method="POST">
                            <input type="hidden" name="id" value="<?= $jabatan['id'] ?>">
                            <div class="mb-3">
                                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="<?= $jabatan['nama_jabatan'] ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    <?php else: ?>
                        <p>Jabatan not found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
