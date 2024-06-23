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
