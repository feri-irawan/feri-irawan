<?php
require "config.php";

$id = $_GET["id"];

$ambil = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$id' ");
$tampil = mysqli_fetch_assoc($ambil);

if (isset($_POST["submit"])) {
    $rand = rand();
    $ekstensi = array("png", "jpg", "jpeg", "gif");
    $filename = $_FILES["fotoPelanggan"]["name"];
    $ukuran = $_FILES["fotoPelanggan"]["size"];
    $ext      = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext,$ekstensi)) {
        echo "File yang anda pilih tidak sesuai ekstensi yang diizinkan";
    } else {
        if($ukuran < 1000000) {
            $xx = $rand.'_'.$filename;
            move_uploaded_file($_FILES["fotoPelanggan"]["tmp_name"], "images/pelanggan/".$rand.'_'.$filename);

            // update kolom foto_pelanggan
            mysqli_query($conn, "UPDATE user SET foto_pelanggan='$xx' WHERE id='$id' ");

            echo "Berhasil upload foto";
        } else {
            echo "Ukuran melampaui batas 2 MB";
        }
    }
    
} 

?>

<form action="" method="post" anctyple="multipart/form-data">
    <div class="input-group">
        <input type="file" name="fotoPelanggan">
        <label>Foto Pelanggan</label>
    </div>
    <button type="submit" name="submit">Kirim</button>
</form>

