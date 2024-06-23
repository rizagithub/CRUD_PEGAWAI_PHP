<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employe</title>
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
                <h3 class="form-title">Tambah Data Pegawai</h3>
                <form action="add.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Pegawai</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                            <option value="0">Perempuan</option>
                            <option value="1">Laki-Laki</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select id="jabatan" name="jabatan" class="form-control" required>
                            <?php
                            // Include koneksi ke database
                            include_once 'koneksi.php';

                            // Query untuk mengambil data jabatan
                            $query = "SELECT id, nama_jabatan FROM jabatan";
                            $result = mysqli_query($koneksi, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id']}'>{$row['nama_jabatan']}</option>";
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
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="tel" id="no_telepon" name="no_telepon" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status_aktif" value="1" checked>
                            <label class="form-check-label" for="status_aktif">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status_nonaktif" value="0">
                            <label class="form-check-label" for="status_nonaktif">Non-Aktif</label>
                        </div>
                    </div>
                    <button type="submit" name="tambah" value="tambah" class="btn btn-primary btn-submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
                echo "<script>alert('Data pegawai berhasil ditambahkan.'); window.location.href = 'employe.php';</script>";
                exit; // Pastikan untuk menggunakan exit setelah header redirect
            } else {
                echo "Error: " . $q . "<br>" . mysqli_error($koneksi);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
