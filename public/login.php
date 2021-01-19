<?php
session_start();
require("config.php");

if (isset($_SESSION['email']) OR isset($_COOKIE['ingat'])) {
	header("location: index.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
    $remember = $_POST['remember'];


	$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' and password='$password'");
	$cek = mysqli_num_rows($query);

	if ($cek > 0) {
		$_SESSION['email'] = $email;
		header("location: index.php");
	} else {
		echo "Email / Password Anda salah";
	}

    //remember
    $row = mysqli_fetch_assoc($query);
    if (isset($remember)) {
        setcookie('ingat', $row['email'], time()+(7*24*60*60));
    }
}


date_default_timezone_set("Asia/Makassar");
$jam = date("H:i");
// atur salam
if ($jam < "12:00") {
    $salam = "Pagi";
} elseif ($jam < "15:00") {
    $salam = "Siang";
} elseif ($jam < "18:00") {
    $salam = "Sore";
} elseif ($jam < "24:00") {
    $salam = "Malam";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <?php 
    include("style.php");
     ?>
</head>
<body style="padding: 20px">
<div class="wrapper center-y">
<h2 class="title-page">Hai, Selamat <?=$salam?> dan Selamat Datang di F. I. Kasir</h2>
<form class="center-y" action="" method="post">
<div class="pesan">
<?php
if (isset($_GET['pesan'])) {
	$pesan = $_GET['pesan'];

 	if ($pesan == 'logout') {
 		echo "Anda berhasil logout";
 	}
 	if ($pesan == 'belum_daftar') {
 		echo "Anda belum login, silahkan login untuk melanjutkan";
 	}
 } 
 ?>
</div>
<div class="input-group">
    <input type="email" name="email" autocomplete="off" required>
    <label>Email</label>
</div>
<div class="input-group">
    <input type="password" name="password" autocomplete="off" required>    
    <label>Password</label>
</div>
<label class="checkbox-container">
  <span>Ingat Saya!</span>
  <input type="checkbox" name="remember">
  <span class="checkmark"></span>
</label>
<button type="submit" name="submit">Masuk</button>
<br>
<center>
Belum punya akun? <a class="btn" href="daftar.php">Daftar</a>
</center>
</form>


<style>
body::after {
    margin-top: 100%;
}
</style>
</body>
</html>