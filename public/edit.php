<?php 
session_start();
require("config.php");

$id = $_GET['id'];
$nama = $_GET['nama'];

if (isset($_COOKIE['ingat'])) {
	$email = $_COOKIE['ingat'];
} elseif (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
}

if (!isset($email)) {
	header("location: login.php");
}

//tampilkan data di form
$ambil = mysqli_query($conn,
	"SELECT * FROM pelanggan WHERE id='$id'");
$tampil = mysqli_fetch_assoc($ambil);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Data: <?=$tampil['nama_pelanggan']?></title>
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php 
	include("style.php");
	 ?>


</head>
<body style="padding: 20px">
<div class="wrapper center-y">

<?php
if (isset($_POST['submit'])) {

	$nama_pelanggan 	= addslashes($_POST['nama_pelanggan']);
	$nama_barang    	= addslashes($_POST['nama_barang']);
	$harga_barang   	= $_POST['harga_barang'];
	$ongkos_ongkir  	= $_POST['ongkos_ongkir'];
	$alamat         	= addslashes($_POST['alamat']);
	$jenis_pembayaran 	= $_POST['jenis_pembayaran'];
	$jenis_ekspedisi 	= addslashes($_POST['jenis_ekspedisi']);
	$nomor_resi 		= $_POST['nomor_resi'];
	$tanggal_pengiriman = $_POST['tanggal_pengiriman'];
	$tanggal_penerimaan = $_POST['tanggal_penerimaan'];
	$keuntungan 		= $_POST['keuntungan'];

	if ($jenis_pembayaran == "COD") {
		$jenis_pembayaran = "COD";
	} elseif ($jenis_pembayaran == "Transfer") {
		$jenis_pembayaran = "Transfer";
	}

	$rand = rand();
	$ekstensiFile = array('png','jpg','jpeg','gif');
	$namaFile     = $_FILES['foto_pelanggan']['name'];
	$ukuranFile   = $_FILES['foto_pelanggan']['size'];
	$ext 		  = pathinfo($namaFile, PATHINFO_EXTENSION);

	if (!in_array($ext, $ekstensiFile)) { ?>


		<h1 class="title-page">Error</h1>
		<p class="title-page">Maaf file yang anda pilih tidak sesuai format yang diizinkan <code>.png .jpg .jpeg .gif</code> silahkan ganti file!
		<a href="#" onclick="history.back()"><i class="fas fa-chevron-left"></i> Kembali</a>
		</p>

	<?php } else {
		if ($ukuranFile < 2000000) {
			
			if (!$foto_pelanggan = $rand.'_'.$namaFile) {
				$foto_pelanggan = "no-image.jpg";
			} else {
				$foto_pelanggan = $rand.'_'.$namaFile;
			}
			

			move_uploaded_file($_FILES['foto_pelanggan']['tmp_name'], 'images/pelanggan/'.$rand.'_'.$namaFile);
			$query = mysqli_query($conn, "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', foto_pelanggan='$foto_pelanggan',nama_barang='$nama_barang', harga_barang='$harga_barang', ongkos_ongkir='$ongkos_ongkir', alamat='$alamat', jenis_pembayaran='$jenis_pembayaran', jenis_ekspedisi='$jenis_ekspedisi', nomor_resi='$nomor_resi', tanggal_pengiriman='$tanggal_pengiriman', tanggal_penerimaan='$tanggal_penerimaan', keuntungan='$keuntungan' WHERE id='$id'");

			header("location: index.php?pesan=edit&nama=$tampil[nama_pelanggan]");
		} else { ?>
			
		<h1 class="title-page">Error</h1>
		<p class="title-page">Maaf ukuran file yang Anda pilih melampaui batas yang diizinkan, yaitu <code>kurang dari 2 MB</code> silahkan ganti file!
		<a href="#" onclick="history.back()"><i class="fas fa-chevron-left"></i> Kembali</a>
		</p>

		<?php }
	}
//end if (isset($_POST['submit]));
}
?>

<h1 class="title-page">Edit Data: <span class="capitalize"><?=$tampil['nama_pelanggan']?></span></h1>
<a class="btn" href="index.php"><i class="fas fa-chevron-left mr-5px"></i>Kembali</a>
<br>
<br>
<div class="title-page">
 <b>Catatan:</b>
 Kami hanya menerima file gambar dengan format <code>.png</code> <code>.jpg</code> <code>.jpeg</code> <code>.gif</code> dengan ukuran tidak melebihi <code>2 MB</code>
 </div>
<br>
<br>
<form class="center-y" action="" method="post" anctype="multipart/form-data">
 	<div class="input-group">
		<input type="text" name="nama_pelanggan" value="<?=$tampil['nama_pelanggan']?>" autocomplete="off" required>
 		<label>Nama Pelanggan</label>
	 </div>
	 <div class="input-group">
	 	<input class="normal-text" type="file" name="foto_pelanggan">
	 	<label>Foto Pelanggan</label>
	 </div>
 	<div class="input-group">
 		<input type="text" name="nama_barang" value="<?=$tampil['nama_barang']?>" autocomplete="off" required>
 		<label>Barang</label>
 	</div>
 	<div class="input-group">
 		<input type="number" name="harga_barang" value="<?=$tampil['harga_barang']?>" autocomplete="off" required>
 		<label>Harga Barang</label>
 	</div>
 	<div class="input-group">
 		<textarea name="alamat" autocomplete="off" required><?=$tampil['alamat']?></textarea>
 		<label>Alamat Pelanggan</label>
 	</div>

<?php
 $jenis_pembayaran = $tampil['jenis_pembayaran'];
 if ($jenis_pembayaran == "COD") { ?>
	<div class="pembayaran">
	 	<label class="checkbox-container">
		  <span>COD</span>
		  <input type="checkbox" name="jenis_pembayaran" value="COD" checked>
		  <span class="checkmark"></span>
		</label>
		<label class="checkbox-container ml-10px">
		  <span>Transfer</span>
		  <input type="checkbox" name="jenis_pembayaran" value="Transfer">
		  <span class="checkmark"></span>
		</label>
 	</div>

<?php } elseif ($jenis_pembayaran == "Transfer") { ?>
	<div class="pembayaran">
	 	<label class="checkbox-container">
		  <span>COD</span>
		  <input type="checkbox" name="jenis_pembayaran" value="COD">
		  <span class="checkmark"></span>
		</label>
		<label class="checkbox-container ml-10px">
		  <span>Transfer</span>
		  <input type="checkbox" name="jenis_pembayaran" value="Transfer" checked>
		  <span class="checkmark"></span>
		</label>
 	</div>
 <?php } ?>

	<div class="input-group">
 		<input type="text" name="jenis_ekspedisi" autocomplete="off" value="<?=$tampil['jenis_ekspedisi']?>" required>
 		<label>Jenis Ekspedisi</label>
 	</div>

 	<div class="input-group">
 		<input class="uppercase" type="text" name="nomor_resi" autocomplete="off" value="<?=$tampil['nomor_resi']?>" required>
 		<label>Nomor Resi</label>
 	</div>

 	<div class="input-group">
 		<input type="date" name="tanggal_pengiriman" value="<?=$tampil['tanggal_pengiriman']?>" autocomplete="off" required>
 		<label>Tanggal Pengiriman</label>
 	</div>
 	<div class="input-group">
 		<input type="date" name="tanggal_penerimaan" value="<?=$tampil['tanggal_penerimaan']?>" autocomplete="off" required>
 		<label>Tanggal Penerimaan</label>
 	</div>
 	<div class="input-group">
 		<input type="number" name="ongkos_ongkir" value="<?=$tampil['ongkos_ongkir']?>" autocomplete="off" required>
 		<label>Ongkos Ongkir</label>
 	</div>
 	<div class="input-group">
 		<input type="number" name="keuntungan" value="<?=$tampil['keuntungan']?>" autocomplete="off" required>
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