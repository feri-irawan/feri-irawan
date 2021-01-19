<?php
session_start();
require("config.php");
if (isset($_COOKIE['ingat'])) {
	$email = $_COOKIE['ingat'];
} elseif (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
}



if ( isset($email) ) {
	//ambil data pengguna yg login
	$query = mysqli_query($conn,
		"SELECT * FROM users WHERE email='$email' ");
	$row = mysqli_fetch_assoc($query);
	$_SESSION['nama_pengelola'] = $row['nama_depan'];
	$_SESSION['id_pengelola'] = $row['id'];

	//khusus tanggal
	$date = date_create($row["tanggal_pendaftaran"]);
	$tanggal = date_format($date, "d-m-Y H:i:s");


	//ambil data pinjaman pengguna berdasarkan nama_pengelola
	$id_pengelola = $row['id'];
	$data = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pengelola='$id_pengelola' ORDER BY id DESC");
} else {
	header("location: login.php?pesan=belum_daftar");
	exit();
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

$nama_bot = "Feri Irawan";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Index</title>
	<?php 
	include("style.php");
	 ?>
</head>
<body style="padding: 20px">

<div class="wrapper center-y">
<h1 class="title-page">Hi, <?=$row['nama_depan']?> Selamat <?=$salam?></h1>

Saya <?=$nama_bot?>,<br>
Berikut adalah daftar pelanggan yang Saya Ingat.
<br>
<!-- Search -->
<div class="input-group">
    <input type="search" name="search" id="search" autocomplete="off" required>
    <label>Cari Data</label>
    <i class="fas fa-search"></i>
</div>
<!-- end search -->
<div class="overflow-x">
<div class="sticky-left">
	<a class="btn mb-5px" href="add.php?add">Tambah Data <i class="fas fa-plus ml-5px"></i></a>
	<a class="btn mb-5px" href="logout.php">Keluar <i class="fas fa-sign-out-alt ml-5px"></i></a>
</div>
<?php
if (isset($_GET['pesan'])) {
	$pesan = $_GET['pesan'];
	$nama = $_GET['nama'];
	$openPesan = '<div class="pesan">';
	$closePesan = '</div>';

 	if ($pesan == 'success') {
 		echo "$openPesan Berhasil Menambahkan Data <b>$nama</b> $closePesan";
 	}
 	if ($pesan == 'edit') {
 		echo "$openPesan Edit data <b>$nama</b> berhasil $closePesan";
 	}
 	if ($pesan == 'delete') {
 		echo "$openPesan Berhasil menghapus data <b>$nama</b> $closePesan";
 	}
 } 
 ?>
<div id="hasil">
<table>
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
			<a href="index.php?delete&id=<?= $id ?>&nama=<?= $nama_pelanggan ?>"><i class="far fa-trash-alt"></i></a>
		</td>
	</tr>
<?php }

$cek = mysqli_num_rows($data);
if ($cek == 0) {
	echo "<tr>
			<td colspan='9'>Tidak ditemukan data</td>
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
</div>
</div>
</div>

<?php 
if (isset($_GET['delete'])) {
	$id 			= $_GET['id'];
	$nama_pelanggan = $_GET['nama'];
	?>
<div class="konfirmasi-hapus">
	<div>
		<div class="text">
			Apakah anda yakin ingin menghapus data <b><?= $nama_pelanggan ?></b>?
		</div>
		<br>
		<span>
			<a href="delete.php?id=<?= $id ?>&nama=<?= $nama_pelanggan ?>"><i class="far fa-trash-alt"></i> Ya</a>
			<a href="index.php"><i class="far fa-trash-alt"></i> Tidak</a>
		</span>
	</div>
</div>
<?php } ?>	
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<i class="full-screen fas fa-expand" onclick="toggleFullscreen()"></i>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
//saat di scroll
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('.backtop i, .full-screen').css({
          'display': 'block',
          'animation': 'opac .5s forwards',
        });
    } else {
        $('.backtop i, .full-screen').css({
          'animation': 'opacOut .5s forwards',
        });
    }
});

// toggle full-screen
const tombol = document.querySelector(".full-screen.fas.fa-expand");
const fa = document.querySelector(".full-screen.fas.fa-expand");

tombol.onclick = function(){
if(fa.className == "full-screen fas fa-expand"){
fa.className = "full-screen fas fa-compress";
}

else if(fa.className == "full-screen fas fa-compress"){
fa.className = "full-screen fas fa-expand";
}
}

//search
var keyword = document.querySelector("#search");
var saranKeyword = document.querySelector("#saran-keyword");

keyword.addEventListener('keyup', function() {

  //buat objek ajax
  var cari = new XMLHttpRequest();

  //cek kesiapan ajax
  cari.onreadystatechange = function() {
  	if( cari.readyState == 4 && cari.status == 200 ) {
  		hasil.innerHTML = cari.responseText;
  	}
  }

  //eksekusi ajax
  cari.open('GET', 'search.php?search=' + keyword.value, true);
  cari.send();
});


//fullscreen
function toggleFullscreen(elem) {
  elem = elem || document.documentElement;

  if (!document.fullscreenElement && !document.mozFullScreenElement &&
    !document.webkitFullscreenElement && !document.msFullscreenElement) {
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
    } else if (elem.msRequestFullscreen) {
      elem.msRequestFullscreen();
    } else if (elem.mozRequestFullScreen) {
      elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
      elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
}

document.querySelector('.full-screen').addEventListener('click', function() {
  toggleFullscreen();
});


var konfirmasiHapus = document.querySelector(".konfirmasi-hapus");

function hapus() {
	if (konfirmasiHapus.style.display == "none") {
		konfirmasiHapus.style.display = "block";
	} else {
		konfirmasiHapus.style.display = "none";
	}
}
</script>
</body>
</html>



