<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <?php 
    include("style.php");
     ?>
</head>
<body style="padding: 20px">
<div class="wrapper center-y">
<h1 class="title-page">Daftar</h1>
Sudah punya akun?
<a class="btn" href="login.php">Masuk</a>
<br>
<br>
<?php
require("config.php");

if ( isset($_POST["submit"]) ) {
    //buat variable
    $namaDepan = $_POST["namaDepan"];
    $namaBelakang = $_POST["namaBelakang"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    date_default_timezone_set("Asia/Makassar");
    $tangggal = date("Y-m-d H:i:s");

    $query = mysqli_query($conn,
             "SELECT * FROM users WHERE email='$email' ");

    $cek = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);

    if ($cek > 0) {
        echo "Maaf email tersebut telah di gunakan orang lain";
    } else {
        $query = mysqli_query($conn,
            "INSERT INTO users 
            (nama_depan, nama_belakang, email, password, level, tanggal_pendaftaran) 
             VALUES 
            ('$namaDepan', '$namaBelakang', '$email', '$password', 'Member', '$tangggal')");

        echo "
        Wow! Anda berhasil mendaftar!
        <a href='login.php'>Go to Index</a>
        ";
    }
}

?>



<form class="center-y" action="" method="post">
<div class="input-group">
    <input type="text" name="namaDepan" autocomplete="off" required>
    <label>Nama Dapan</label>
</div>
<div class="input-group">
    <input type="text" name="namaBelakang" autocomplete="off" required>
    <label>Nama Belakang</label>
</div>
<div class="input-group">
    <input type="email" name="email" autocomplete="off" required>
    <label>Email</label>
</div>
<div class="input-group">
    <input type="password" name="password" autocomplete="off" required>    
    <label>Password</label>
</div>

<button type="submit" name="submit">Daftar</button>

</form>
</div>

</body>
</html>