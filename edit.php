<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employe</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input[type="text"], 
        .form-group input[type="tel"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="file"] {
            margin-top: 5px;
        }
        .form-group .custom-select {
            width: 100%;
        }
        .form-group .form-check {
            margin-top: 10px;
        }
        .form-group .form-check-label {
            margin-left: 5px;
        }
        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h3 class="form-title">Edit Data Pegawai</h3>
                <?php
                // Include file koneksi database
                include_once 'koneksi.php';

                // Cek apakah parameter id ada
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $id = $_GET['id'];

                    // Query untuk mendapatkan data pegawai berdasarkan id
                    $query = "SELECT * FROM employe WHERE id = $id";
                    $result = mysqli_query($koneksi, $query);

                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
                ?>
                <form action="update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="nama">Nama Pegawai</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                            <option value="0" <?php if ($row['jenis_kelamin'] == 0) echo 'selected'; ?>>Perempuan</option>
                            <option value="1" <?php if ($row['jenis_kelamin'] == 1) echo 'selected'; ?>>Laki-Laki</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-control" value="<?php echo $row['nip']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select id="jabatan" name="jabatan" class="form-control" required>
                            <?php
                            // Query untuk mengambil data jabatan
                            $query_jabatan = "SELECT id, nama_jabatan FROM jabatan";
                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);

                            if (mysqli_num_rows($result_jabatan) > 0) {
                                while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                    $selected = ($row_jabatan['id'] == $row['jabatan_id']) ? 'selected' : '';
                                    echo "<option value='{$row_jabatan['id']}' $selected>{$row_jabatan['nama_jabatan']}</option>";
                                }
                            } else {
                                echo "<option disabled>Tidak ada data jabatan</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Upload Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control-file">
                        <img src="<?php echo $row['image']; ?>" width="100" height="100" alt="Gambar Pegawai">
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="tel" id="no_telepon" name="no_telepon" class="form-control" value="<?php echo $row['no_telepon']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" class="form-control" required><?php echo $row['alamat']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status_aktif" value="1" <?php if ($row['status'] == 1) echo 'checked'; ?>>
                            <label class="form-check-label" for="status_aktif">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status_nonaktif" value="0" <?php if ($row['status'] == 0) echo 'checked'; ?>>
                            <label class="form-check-label" for="status_nonaktif">Non-Aktif</label>
                        </div>
                    </div>
                    <button type="submit" name="edit" value="edit" class="btn btn-primary btn-submit">Simpan Perubahan</button>
                </form>
                <?php
                    } else {
                        echo "Data pegawai tidak ditemukan.";
                    }
                } else {
                    echo "Parameter id tidak valid.";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
