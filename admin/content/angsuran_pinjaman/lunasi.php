<?php 
function rupiah($angka){
	return number_format($angka,0,'', '');
}

$id = $_GET['id'];
$sqlAP = "SELECT * FROM angsuran_pinjaman WHERE id='$id' AND status_angsuran='on'";
$dataAP = mysqli_fetch_array(mysqli_query($connect, $sqlAP));

$id_pinjam = $dataAP['id_pinjam'];
$sql = "SELECT * FROM pinjaman WHERE id='$id_pinjam'";
$data = mysqli_fetch_array(mysqli_query($connect, $sql));

if (isset($_POST['save'])) {
	$row = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(id) AS num FROM angsuran_pinjaman"));
	$num = $row['num']+1;

  	$id = $_GET['id'];
  	$idNew = $num;
  	$id_user = $_POST['id_user'];
  	$jml_pinjam = $_POST['jml_pinjam'];
  	$tenor = $_POST['tenor'];
  	$angsuran_ke = $_POST['angsuran_ke'];
  	$id_user = $_POST['id_user'];
  	$jml_angsuran = $_POST['jml_angsuran'];
  	$sisa_angsuran = $_POST['sisa_angsuran'];
  	$tgl_angsuran = $_POST['tgl_angsuran'];
  	$tgl_pinjam = $_POST['tgl_pinjam'];
  	$ket = $_POST['ket'];

  	// ANGSURAN LAMA BERUBAH STATUS OFF
  	$s = $angsuran_ke-1;
  	$sqlUpdateAP = "UPDATE angsuran_pinjaman SET status_angsuran='off' WHERE id='$id' AND angsuran_ke='$s'";

  	// PINJAMAN LUNAS JIKA JUMLAH ANGSURAN_KE MENCAPAI TENOR
	if($angsuran_ke >= $tenor){
		$sqlUpdateP = "UPDATE pinjaman SET status='Lunas' WHERE id='$id_pinjam'";
		$sqlInsertAP = "INSERT INTO angsuran_pinjaman(id,id_pinjam,angsuran_ke,jml_angsuran,sisa_angsuran,tgl_angsuran,status_angsuran) VALUES('$idNew', '$id_pinjam', '$angsuran_ke', '$jml_angsuran', '$sisa_angsuran', '$tgl_angsuran', 'off')"; 
		mysqli_query($connect, $sqlUpdateP);
	}else{
		$sqlInsertAP = "INSERT INTO angsuran_pinjaman(id,id_pinjam,angsuran_ke,jml_angsuran,sisa_angsuran,tgl_angsuran,status_angsuran) VALUES('$idNew', '$id_pinjam', '$angsuran_ke', '$jml_angsuran', '$sisa_angsuran', '$tgl_angsuran', 'on')"; 
	}

	if (mysqli_query($connect, $sqlUpdateAP) && mysqli_query($connect, $sqlInsertAP)) {
		echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil disimpan </div>";
      	echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php?page=angsuran_pinjaman'}, 1000)</script>";
	}else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal disimpan</div>";
	}
}

?>
	<h2 class="my-4">Bayar Angsuran Pinjaman</h2>
	 <div class="container">
	  <div class="row">
	    <div class="col-sm-8 mx-auto">
	      <form method="POST" action="" class="mb-3">
	      	<div class="form-row">
	      		<div class="form-group col-md-4">
			        <label for="inputId_user">Id User</label>
			        <input type="text" name="id_user" value="<?= $data['id_user'] ?>" class="form-control" id="inputId_user" readonly>
			    </div>
	      		<div class="form-group col-md-6">
		            <label for="inputJml_pinjam">Jumlah Pinjaman</label>
		            <input type="text" name="jml_pinjam" value="<?= $data['jml_pinjam'] ?>" class="form-control" id="inputJml_pinjam" readonly>
		            <small class="form-text text-muted">Gunakan number tanpa titik</small>
		        </div>
		        <div class="form-group col-md-2">
		            <label for="inputTenor">Tenor</label>
			        <input type="text" name="tenor" value="<?= $data['tenor'] ?>" class="form-control" id="inputTenor" readonly>
		        </div>
	      	</div>
	      	<div class="form-row">
	      		<div class="form-group col-md-2">
		            <label for="inputAngsuran">Angsuran Ke</label>
			        <input type="text" name="angsuran_ke" value="<?= $dataAP['angsuran_ke']+1 ?>" class="form-control" id="inputAngsuran" readonly>
		        </div>
		        <div class="form-group col-md-3">
		            <label for="inputAngsuran">Jml Angsur</label>
			        <input type="text" name="jml_angsuran" value="<?= $sisa = rupiah($data['angsuran']) ?>" class="form-control" id="inputAngsuran" readonly>
		        </div>
		        <div class="form-group col-md-3">
		            <label for="inputAngsuran">Sisa Angsur</label>
			        <input type="text" name="sisa_angsuran" value="<?= $dataAP['sisa_angsuran']-$sisa ?>" class="form-control" id="inputAngsuran" readonly>
		        </div>
		        <div class="form-group col-md-4	">
		            <label for="inputAngsuran">Tgl Angsur</label>
			        <input type="text" name="tgl_angsuran" name="angsuran" class="form-control" id="inputAngsuran" required="required"><small class="form-text text-muted">Contoh penulisan seperti <?= date('Y-m-d') ?></small>
		        </div>
	      	</div>
	      	<div class="form-group">
		        <label for="inputTgl_pinjam">Tanggal Pinjam</label>
			    <input type="text" name="tgl_pinjam" value="<?= $data['tgl_pinjam'] ?>" class="form-control" id="inputTgl_pinjam"readonly>
		    </div>
	        <div class="form-group">
	          <label for="inputKeterangan">Keterangan</label>
	          <textarea class="form-control" name="ket" id="inputKeterangan" required="required" rows="3" readonly><?= $data['ket'] ?></textarea>
	        </div>
	        <input type="submit" class="btn btn-success" name="save" value="Lunasi Sekarang">
	      </form> 
	    </div>
	    <div class="col-sm-3 mx-auto">
	      <div class="alert alert-warning">Tips: Isi data dengan benar agar dapat disimpan</div>
	    </div>
	  </div>
	</div>


