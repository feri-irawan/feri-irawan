<?php 

session_start();
require 'config.php';

if (isset($_COOKIE['ingat'])) {
	$email = $_COOKIE['ingat'];
} elseif (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
}

if (!isset($email)) {
	header("location: login.php?pesan=belum_daftar");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Hasil Pencarian: <?=$keyword?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php 
	include("style.php");
	 ?>
</head>
<body>

</body>
</html>

<table id="table">
	<tr>
		<th>No</th>
		<th>Nama Pelanggan</th>
		<th>Foto</th>
		<th>Barang</th>
		<th>Harga</th>
		<th>Ongkos Ongkir</th>
		<th>Alamat Pelanggan</th>
		<th>Jenis Pembayaran</th>
		<th>Ekspedisi</th>
		<th>No Resi</th>
		<th>Tanggal Pengiriman</th>
		<th>Tanggal Penerimaan</th>
		<th>Keuntungan</th>
		<th>Aksi</th>
	</tr>
<?php 
$no = 0;
$total_keuntungan   = 0;
$total_harga_barang = 0;
$total_ongkir       = 0;
$total_pembayaran   = 0;


	$keyword = $_GET['search'];

	$data = mysqli_query($conn,
		"SELECT * FROM pelanggan
			WHERE
		nama_pelanggan LIKE '%$keyword%' OR
		nama_barang LIKE '%$keyword%' OR
		harga_barang LIKE '%$keyword%' OR
		ongkos_ongkir LIKE '%$keyword%' OR
		jenis_pembayaran LIKE '%$keyword%' OR
		alamat LIKE '%$keyword%' OR
		jenis_ekspedisi LIKE '%$keyword%' OR
		nomor_resi LIKE '%$keyword%' OR
		tanggal_penerimaan LIKE '%$keyword%' OR
		tanggal_penerimaan LIKE '%$keyword%' OR
		keuntungan LIKE '%$keyword%'
		ORDER BY id DESC
		");

while ($r = mysqli_fetch_array($data)) {
	$no++;
	$id 			   = $r['id'];
	$nama_pelanggan    = $r['nama_pelanggan'];
	$foto_pelanggan    = "images/pelanggan/" . $r['foto_pelanggan'];
	$nama_barang	   = $r['nama_barang'];
	$harga_barang      = number_format($r['harga_barang'], 0, ',', '.');
	$ongkos_ongkir     = number_format($r['ongkos_ongkir'], 0, ',', '.');
	$alamat 	       = $r['alamat'];
	$jenis_pembayaran  = $r['jenis_pembayaran'];
	$jenis_ekspedisi   = $r['jenis_ekspedisi'];
	$nomor_resi        = $r['nomor_resi'];


	$date1 = date_create($r['tanggal_pengiriman']);
	$date2 = date_create($r['tanggal_penerimaan']);

	if ($r['tanggal_penerimaan'] == "Belum diterima") {
		$tanggal_penerimaan = $r['tanggal_penerimaan'];
	} else {
		$tanggal_penerimaan =  date_format($date2, "d-m-Y") . " <span class='bg-green'>Diterima</span>";
	}
	
	$tanggal_pengiriman =  date_format($date1, "d-m-Y");
	$keuntungan         = number_format($r['keuntungan'], 0, ',', '.');

	//total
	$total_harga_barang += $r['harga_barang'];
	$total_ongkir       += $r['ongkos_ongkir'];
	$total_keuntungan   += $r['keuntungan'];
	$total_pembayaran    = $r['harga_barang'] + $r['ongkos_ongkir'];
?>
	<tr id="option">
		<td class="center"><?= $no ?>.</td>
		<td class="tidak-lengkap">
			<?= $nama_pelanggan ?>
			<div class="clip-shadow">
				<div class="lengkap center">
					Total Pembayaran<br>
				Rp. <?=number_format($total_pembayaran, 0, ',', '.'); ?>
				</div>
			</div>	
		</td>
		<td class="p-5px tidak-lengkap">
			<a href="images.php?id=<?=$id?>">
			<div class="foto-pelanggan">
				<img src="<?=$foto_pelanggan?>">
				<div class="clip-shadow clip-img">
					<div class="lengkap center">
						<img src="<?=$foto_pelanggan?>">
					</div>
				</div>	
			</div>
			</a>
		</td>
		<td class="tidak-lengkap">
			<span class="ellipsis"><?= $nama_barang ?></span>
			<div class="clip-shadow">
				<div class="lengkap">
					<?= $nama_barang ?>
				</div>
			</div>
		</td>
		<td class="center"><?= $harga_barang ?></td>
		<td class="center"><?= $ongkos_ongkir ?></td>
		<td class="tidak-lengkap">
			<span class="ellipsis"><?= $alamat ?></span>
			<div class="clip-shadow">
				<div class="lengkap">
					<?= $alamat ?>
				</div>
			</div>
		</td>
		<td class="center"><?= $jenis_pembayaran ?></td>
		<td class="center"><?= $jenis_ekspedisi ?></td>
		<td class="center uppercase"><?= $nomor_resi ?></td>
		<td class="center"><?= $tanggal_pengiriman ?></td>
		<td class="center"><?= $tanggal_penerimaan ?></td>
		<td class="center"><?= $keuntungan ?></td>
		<td class="btn-sticky">
			<a href="edit.php?id=<?= $id ?>&nama=<?= $nama_pelanggan ?>"><i class="far fa-edit"></i></a> |
			<a href="delete.php?id=<?= $id ?>&nama=<?= $nama_pelanggan ?>"><i class="far fa-trash-alt"></i></a>

		</td>
	</tr>
<?php }

$cek = mysqli_num_rows($data);
if ($cek == 0) {
	echo "<tr>
			<td colspan='13'>
			<span class='data-kosong'>Tidak ditemukan data: <b>$keyword</b></span>
			</td>
		  </tr>";
}

 ?>
 <tr>
 	<th colspan="4">Total keseluruhan</th>
 	<th><?=number_format($total_harga_barang, 0, ',', '.'); ?></th>
 	<th><?=number_format($total_ongkir, 0, ',', '.'); ?></th>
 	<th colspan="6"></th>
 	<th><?=number_format($total_keuntungan, 0, ',', '.'); ?></th>
 	<th></th>
 </tr>
</table>


<style type="text/css">
body::after {
	display: none;
}
.data-kosong {
 position: sticky;
 left: 10px;
}
</style>
