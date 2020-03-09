 <?php 
 function rupiah($angka){
	return number_format($angka,0,',', '.');
}
$id = $_SESSION['id'];
$sql1 = "SELECT * FROM users WHERE id ='$id'";
$result1 = mysqli_fetch_array(mysqli_query($connect, $sql1));
$sql2 = "SELECT COUNT(*) AS jmlp, id, SUM(jml_pinjam) AS jmlpt FROM pinjaman WHERE id_user ='$id'";

$result2 = mysqli_fetch_array(mysqli_query($connect, $sql2));

$idPinjaman = $result2['id'];
$sql3 = "SELECT SUM(sisa_angsuran) AS jmlsa FROM angsuran_pinjaman WHERE id_pinjam='$idPinjaman' AND status_angsuran='on'";
$result3 = mysqli_fetch_array(mysqli_query($connect, $sql3));
?>

<div class="container mt-3">
	<div class="row">
		<div class="col-md-4">
			<div class="card mb-3 text-white"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);background: #0097e6;border: none">
		      <div class="card-body text-center">
		        <h5 class="card-title">Jumlah Pinjaman Anda</h5>
		        <p class="card-text">Memiliki <?=$result2['jmlp'] ?> pinjaman</p>
		      </div>
		    </div>
		</div>
		<div class="col-md-4">
			<div class="card mb-3 text-white"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);background: #44bd32;border: none">
		      <div class="card-body text-center">
		        <h5 class="card-title">Sisa Pinjaman Anda</h5>
		        <p class="card-text"><?= rupiah($result3['jmlsa']) ?></p>
		      </div>
		    </div>
		</div>
		<div class="col-md-4">
			<div class="card mb-3 text-white"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);background: #40739e;border: none">
		      <div class="card-body text-center">
		        <h5 class="card-title">Total Pinjaman Anda</h5>
		        <p class="card-text"><?= rupiah($result2['jmlpt']) ?></p>
		      </div>
		    </div>
		</div>
	</div>
</div>

<div class="container">
	<h2 class="mt-3">Selamat Datang "<?= $result1['nama'] ?>"</h2>
	<p>Halaman ini adalah informasi mengenai transaksi anda di KSP sejahtera, anda dapat melihat semua simpanan selama anda masih menjadi anggota KSP sejahtera, anda dapat melihat semua withdraw/pengeluaran KSP sejahtera, anda dapat melihat semua pinjaman selama anda masih menjadi anggota koperasi, anda juga dapat melihat angsuran pinjaman yang sudah anda bayarkan, anda juga dapat merubah profil/data diri untuk kelengkapan data anda, selain itu anda dapat mengajukan pinjaman anda sendiri melalui halaman member tunggu setelah admin memverifikasi menyetujui pinjaman anda lalu anda dapat mencairkannya langsung</p>
	<p>Lunasi Pinjaman anda sebelum datang tanggal yang ditentukan melakukan pembayaran pinjaman yaitu 1 bulan saat anda menerima pinjaman dari KSP sejahtera, sanksi berlaku jika anggota telat untuk membayar pinjaman</p>

	<p></p>
</div>
