<?php
include_once 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM employe WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['nama'];
        $jenis_kelamin = $row['jenis_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan';
        $nip = $row['nip'];
        $jabatan_id = $row['jabatan_id'];
        $image_path = $row['image'];
        $no_telepon = $row['no_telepon'];
        $alamat = $row['alamat'];
        $status = $row['status'] == 1 ? 'Aktif' : 'Tidak Aktif';

        // Query untuk mendapatkan nama jabatan berdasarkan jabatan_id
        $query_jabatan = "SELECT nama_jabatan FROM jabatan WHERE id = $jabatan_id";
        $result_jabatan = mysqli_query($koneksi, $query_jabatan);
        $jabatan = mysqli_fetch_assoc($result_jabatan)['nama_jabatan'];
    } else {
        $error_message = "Pegawai tidak ditemukan.";
    }
} else {
    $error_message = "ID Pegawai tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5 col-8">
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error_message ?>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-header text-center">
                    <h2>Employe's Card of AE Company</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <img src="<?= $image_path ?>" alt="Employee Image" class="img-detail" style="width: 50%; height: auto;">
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Nama</th>
                                        <td><?= $nama ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jenis Kelamin</th>
                                        <td><?= $jenis_kelamin ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">NIP</th>
                                        <td><?= $nip ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jabatan</th>
                                        <td><?= $jabatan ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No Telepon</th>
                                        <td><?= $no_telepon ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Alamat</th>
                                        <td><?= $alamat ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status</th>
                                        <td><?= $status ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
