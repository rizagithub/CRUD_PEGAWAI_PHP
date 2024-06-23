<?php
// Include file koneksi database
include_once 'koneksi.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nip = $_POST['nip'];
    $jabatan_id = $_POST['jabatan'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    // Upload gambar jika ada perubahan
    if ($_FILES["gambar"]["size"] > 0) {
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
                // Hapus gambar lama jika ada
                $query_select_image = "SELECT image FROM employe WHERE id = $id";
                $result_select_image = mysqli_query($koneksi, $query_select_image);
                $row_select_image = mysqli_fetch_assoc($result_select_image);
                $old_image_path = $row_select_image['image'];

                if (!empty($old_image_path) && file_exists($old_image_path)) {
                    unlink($old_image_path); // Hapus file gambar lama dari server
                }

                // Update data dengan gambar baru
                $query_update = "UPDATE employe SET 
                                nama = '$nama', 
                                jenis_kelamin = '$jenis_kelamin', 
                                nip = '$nip', 
                                jabatan_id = '$jabatan_id', 
                                image = '$target_file', 
                                no_telepon = '$no_telepon', 
                                alamat = '$alamat', 
                                status = '$status' 
                                WHERE id = $id";

                $result_update = mysqli_query($koneksi, $query_update);

                if ($result_update) {
                    echo "<script>alert('Data pegawai berhasil diperbarui.'); window.location.href = 'employe.php';</script>";
                    exit; // Pastikan untuk menggunakan exit setelah header redirect
                } else {
                    echo "Error: " . $query_update . "<br>" . mysqli_error($koneksi);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Update data tanpa mengubah gambar
        $query_update = "UPDATE employe SET 
                        nama = '$nama', 
                        jenis_kelamin = '$jenis_kelamin', 
                        nip = '$nip', 
                        jabatan_id = '$jabatan_id', 
                        no_telepon = '$no_telepon', 
                        alamat = '$alamat', 
                        status = '$status' 
                        WHERE id = $id";

        $result_update = mysqli_query($koneksi, $query_update);

        if ($result_update) {
            echo "<script>alert('Data pegawai berhasil diperbarui.'); window.location.href = 'employe.php';</script>";
            exit; // Pastikan untuk menggunakan exit setelah header redirect
        } else {
            echo "Error: " . $query_update . "<br>" . mysqli_error($koneksi);
        }
    }
} else {
    echo "Form submission error.";
}
?>
