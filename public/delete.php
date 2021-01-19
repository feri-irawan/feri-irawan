<?php 
require 'config.php';

$id = $_GET['id'];
$nama = $_GET['nama'];

if (isset($id)) {
	
$query = mysqli_query($conn,"DELETE FROM pelanggan WHERE id='$id'");
} else {
	header("location: login.php?pesan=belum_daftar");
}

header("location: index.php?pesan=delete&nama=$nama");
?>