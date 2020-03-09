<?php 
function rupiah($angka){
	return number_format($angka,0,'', '');
}

$id = $_GET['id'];
$sql = "SELECT * FROM pinjaman WHERE id='$id'";
$dataPinjaman = mysqli_fetch_array(mysqli_query($connect, $sql));

if(isset($_POST['save'])){
	$row2 = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(id) AS num FROM angsuran_pinjaman"));
	$num2 = $row2['num']+1;

	$jml_pinjam   = $_POST['jml_pinjam'];
	$tenor        = $_POST['tenor'];
	$bunga   	  = $_POST['bunga'];
	$tgl_pinjam   = $_POST['tgl_pinjam'];

	$cicilan      = $jml_pinjam/$tenor;
	$hasilBunga   = ($jml_pinjam*($bunga/100))/$tenor;
	$perBulan     = rupiah($cicilan+$hasilBunga);
	$jml_angsuran = rupiah($perBulan*$tenor);

	$sqlPinjam = "UPDATE pinjaman SET bunga='$bunga', tgl_pinjam='$tgl_pinjam', angsuran='$perBulan', status_pinjam='disetujui' WHERE id='$id'";
	$sqlAP = "INSERT INTO angsuran_pinjaman(id,id_pinjam,angsuran_ke,jml_angsuran,sisa_angsuran,tgl_angsuran,status_angsuran) VALUES('$num2','$id','0','0','$jml_angsuran','000-00-00','on')";

	if(mysqli_query($connect, $sqlPinjam) && mysqli_query($connect, $sqlAP)){
		echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil disetujui</div>";
      	echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php?page=pinjaman'}, 500)</script>";
	}else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal disetujui</div>";
	}

}

 ?>

 <h2 class="my-4">Ajukan Pinjaman</h2>
	 <div class="container">
	  <div class="row">
	    <div class="col-sm-8 mx-auto">
	      <form method="POST" action="" class="mb-3">
	      	<div class="form-row">
	      		<div class="form-group col-md-3">
		            <label for="inputId_pinjaman">Id Pinjaman</label>
		            <input type="text" name="id_pinjaman" value="<?= $dataPinjaman['id'] ?>" class="form-control" id="inputId_pinjaman" required="required" readonly>
		        </div>
	      		<div class="form-group col-md-3">
		            <label for="inputId_user">Id User</label>
		            <input type="text" name="id_user" value="<?= $dataPinjaman['id_user'] ?>" class="form-control" id="inputId_user" required="required" readonly>
		        </div>
			    <div class="form-group col-md-6">
		            <label for="inputJml_pinjam">Jumlah Pinjaman</label>
		            <input type="text" name="jml_pinjam" value="<?= $dataPinjaman['jml_pinjam'] ?>" class="form-control" id="inputJml_pinjam" required="required" readonly>
		            <small class="form-text text-muted">Gunakan number tanpa titik</small>
		        </div>
		        
	      	</div>
	      	<div class="form-row">
	      		<div class="form-group col-md-2">
		            <label for="inputTenor">Tenor</label>
			       	<input type="text" name="tenor" value="<?= $dataPinjaman['tenor'] ?>" class="form-control" id="inputTenor" required="required" readonly>
	          	</div>
	          	<div class="form-group col-md-2">
		            <label for="inputBunga">Bunga</label>
			       	<input type="text" name="bunga" class="form-control" id="inputBunga" required="required">
	          	</div>
		        <div class="form-group col-md-8">
			        <label for="inputTgl_pinjam">Tanggal Pinjam</label>
				    <input type="text" name="tgl_pinjam" class="form-control" id="inputTgl_pinjam" required="required">
			        <small class="form-text text-muted">Contoh penulisan seperti <?= date('Y-m-d') ?></small>
			    </div>
	      	</div>
	        <div class="form-group">
	          <label for="inputKeterangan">Keterangan</label>
	          <textarea class="form-control" name="keterangan" id="inputKeterangan" required="required" rows="3" readonly><?= $dataPinjaman['ket'] ?></textarea>
	        </div>
	        <input type="submit" class="btn btn-primary" name="save" value="Setujui Pinjaman">
	      </form> 
	    </div>
	    <div class="col-sm-3 mx-auto">
	      <div class="alert alert-warning">Tips: Isi data dengan benar agar dapat disimpan</div>
	      <div class="alert alert-danger">Setujui pinjaman jika user sudah menerima/akan menerima dana pinjaman</div>
	    </div>
	  </div>
	</div>