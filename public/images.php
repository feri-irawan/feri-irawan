<?php 
session_start();
require 'config.php';

//cek
if (isset($_COOKIE['ingat'])) {
	$email = $_COOKIE['ingat'];
} elseif (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
}
	$id    = $_GET['id'];

//out
if (!isset($email)) {
	header("location: login.php?pesan=belum_daftar");
}

//jika ada
if (isset($id)) {
	$query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$id'");
	$r     = mysqli_fetch_assoc($query);
	$foto_pelanggan    = "images/pelanggan/" . $r['foto_pelanggan'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Foto Pelanggan: <?=$r['nama_pelanggan']?></title>
	<?php 
	include("style.php");
	 ?>
</head>
<body>
<div class="zoomIMG">
	<a class="btn" href="index.php"><i class="fas fa-chevron-left mr-5px"></i>Kembali</a>
	<div class="img-wrapper">
		<img src="<?=$foto_pelanggan?>">
	</div>
</div>

<style>
body::after {
	display: none;
}

.btn {
	z-index: 999;
	height: max-content;
	margin-top: 30px;
	box-shadow: 0 0 0 5px #fff;
}

img {
	animation: opac .5s forwards;
}
</style>

</body>
</html>