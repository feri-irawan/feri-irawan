<?php 
session_start();
require("config.php");
$email = $_SESSION['email'];

if (!isset($email) && !isset($_GET['add'])) {
	header("location: login.php?pesan=belum_daftar");
}

if (isset($_POST['submit'])) {
	$nama_pengelola 	= $_SESSION['nama_pengelola'];
	$id_pengelola 		= $_SESSION['id_pengelola'];

	$nama_pelanggan 	= addslashes($_POST['nama_pelanggan']);
	$nama_barang 		= addslashes( $_POST['nama_barang']);
	$harga_barang 		= $_POST['harga_barang'];
	$ongkos_ongkir 		= $_POST['ongkos_ongkir'];
	$alamat 			= addslashes($_POST['alamat']);
	$jenis_pembayaran 	= $_POST['jenis_pembayaran'];
	$jenis_ekspedisi 	= addslashes($_POST['jenis_ekspedisi']);
	$nomor_resi		 	= $_POST['nomor_resi'];
	$tanggal_pengiriman = $_POST['tanggal_pengiriman'];
	$keuntungan 	  	= $_POST['keuntungan'];
	$foto_pelanggan     = "no-image.jpg";

	if ($jenis_pembayaran == "COD") {
		$jenis_pembayaran = "COD";
	} elseif ($jenis_pembayaran == "Transfer") {
		$jenis_pembayaran = "Transfer";
	}

	$query = mysqli_query($conn, "
		INSERT INTO pelanggan
		(nama_pengelola, id_pengelola,
		 nama_pelanggan, foto_pelanggan, nama_barang,
		  harga_barang, ongkos_ongkir, alamat,
		   jenis_pembayaran, jenis_ekspedisi, nomor_resi,
		    tanggal_pengiriman, tanggal_penerimaan,
		     keuntungan)
		VALUES
		('$nama_pengelola', '$id_pengelola',
		 '$nama_pelanggan', '$foto_pelanggan', '$nama_barang',
		  '$harga_barang', '$ongkos_ongkir', '$alamat',
		   '$jenis_pembayaran', '$jenis_ekspedisi', '$nomor_resi',
		   '$tanggal_pengiriman', 'Belum diterima',
		    '$keuntungan')");
	$nama = $_POST['nama_pelanggan'];
	header("location: index.php?pesan=success&nama=$nama");
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Tambah</title>
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php 
	include("style.php");
	 ?>


 </head>
 <body style="padding: 20px">
 <div class="wrapper center-y">
<h1 class="title-page">Tambah Daftar Pelanggan</h1>
 <a class="btn" href="index.php"><i class="fas fa-chevron-left mr-5px"></i>Kembali</a>
 <br>
 <br>

 <form class="center-y" action="" method="post">

 	<div class="input-group">
 		<input type="text" name="nama_pelanggan" autocomplete="off" required autofocus>
 		<label>Nama Pelanggan</label>
 	</div>
 	<div class="input-group">
 		<input type="text" name="nama_barang" autocomplete="off" required>
 		<label>Barang</label>
 	</div>
 	<div class="input-group">
 		<input type="number" name="harga_barang" autocomplete="off" required>
 		<label>Harga Barang</label>
 	</div>
 	<div class="input-group">
 		<textarea name="alamat" autocomplete="off" required></textarea>
 		<label>Alamat Pelanggan</label>
 	</div>

 	<div class="pembayaran">
	 	<label class="checkbox-container">
		  <span>COD</span>
		  <input type="checkbox" name="jenis_pembayaran" value="COD">
		  <span class="checkmark"></span>
		</label>
		<label class="checkbox-container ml-10px">
		  <span>Transfer</span>
		  <input type="checkbox" name="jenis_pembayaran" value="Transfer">
		  <span class="checkmark"></span>
		</label>
 	</div>

	<div class="input-group">
 		<input type="text" name="jenis_ekspedisi" autocomplete="off" required>
 		<label>Jenis Ekspedisi</label>
 	</div>
 	<div class="input-group">
 		<input class="uppercase" type="text" name="nomor_resi" autocomplete="off" required>
 		<label>Nomor Resi</label>
 	</div>

 	<div class="input-group">
 		<input type="date" name="tanggal_pengiriman" autocomplete="off" required>
 		<label>Tanggal Pengiriman</label>
 	</div>
 	<div class="input-group">
 		<input type="number" name="ongkos_ongkir" autocomplete="off" required>
 		<label>Ongkos Ongkir</label>
 	</div>
 	<div class="input-group">
 		<input type="number" name="keuntungan" autocomplete="off" required>
 		<label>Keuntungan</label>
 	</div>

 	<button type="submit" name="submit">Simpan</button>

 </form>
 </div>


 <style>
 .pembayaran {
 	height: 20px;
 }
 .pembayaran label {
 	display: inline-block;
 	margin-top: -10px;
 }
 </style>
 </body>
 </html>