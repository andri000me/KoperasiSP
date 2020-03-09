<?php 
function rupiah($angka){
	return number_format($angka,0,'', '');
}
if (isset($_POST['save'])) {

	$row = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(id) AS num FROM pinjaman"));
	$num =  "PJM-" . sprintf("%05s", (substr($row['num'], 4, 5)+1));
	$row2 = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(id) AS num FROM angsuran_pinjaman"));
	$num2 = $row2['num']+1;

  	$id 		  = $num;  	
	$id_user	  = $_POST['id_user'];
	$jml_pinjam   = $_POST['jml_pinjam'];
	$tenor   	  = $_POST['tenor'];
	$bunga   	  = $_POST['bunga'];
	$tgl_pinjam   = $_POST['tgl_pinjam'];
	$ket          = $_POST['keterangan'];
	$cicilan      = $jml_pinjam/$tenor;
	$hasilBunga   = ($jml_pinjam*($bunga/100))/$tenor;
	$perBulan     = rupiah($cicilan+$hasilBunga);
	$jml_angsuran = rupiah($perBulan*$tenor);

	$sqlInsert = "INSERT INTO pinjaman(id,id_user,jml_pinjam,tenor,bunga,angsuran,tgl_pinjam,status,status_pinjam,ket) VALUES('$id', '$id_user', '$jml_pinjam', '$tenor', '$bunga', '$perBulan', '$tgl_pinjam', 'Berjalan', 'disetujui', '$ket')";
	$sqlInsertAP = "INSERT INTO angsuran_pinjaman(id,id_pinjam,angsuran_ke,jml_angsuran,sisa_angsuran,tgl_angsuran,status_angsuran) VALUES('$num2','$id','0','0','$jml_angsuran','000-00-00','on')";

	if (mysqli_query($connect, $sqlInsert) && mysqli_query($connect, $sqlInsertAP)) {
		echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil disimpan</div>";
      	echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php?page=pinjaman'}, 500)</script>";
	}else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal disimpan</div>";
		
	}
}
?>
	<h2 class="my-4">Tambah Pinjaman</h2>
	 <div class="container">
	  <div class="row">
	    <div class="col-sm-8 mx-auto">
	      <form method="POST" action="" class="mb-3">
	      	<div class="form-row">
			    <div class="form-group col-md-5">
			        <label for="inputId">Id User</label>
			        <?php if (isset($_GET['id'])): ?>
					<input type="text" name="id_user" class="form-control" id="inputId" required="required" readonly value="<?= $_GET['id']?>">
					<?php else: ?>
					<input type="text" name="id_user" class="form-control" id="inputId" required="required" readonly>
					<?php endif ?>
			    </div>
			    <div class="form-group col-md-5">
			        <label for="inputNama">Nama</label>
			        <?php if (isset($_GET['nama'])): ?>
					<input type="text" name="nama" class="form-control" id="inputNama" required="required" readonly value="<?= $_GET['nama']?>">
					<?php else: ?>
					<input type="text" name="nama" class="form-control" id="inputNama" required="required" readonly>
					<?php endif ?>
			    </div>
			    <div class="form-group col-md-2">
			        <a href="/koperasi_sp/login/index.php?page=pinjaman&pages=cariUsers&operasi=insert" class="btn btn-primary" style="margin-top: 30px">Cari user</a>
			    </div>
	      	</div>
	      	<div class="form-row">
	      		<div class="form-group col-md-6">
		            <label for="inputTenor">Tenor</label>
			        <input type="text" name="tenor" class="form-control" id="inputTenor" required="required">
			        <small class="text-muted">Berapa kali bayar angsuran</small>
		        </div>
			    <div class="form-group col-md-6">
			        <label for="inputBunga">Bunga</label>
				    <input type="text" name="bunga" class="form-control" id="inputBunga" required="required">
				    <small class="text-muted">Berapa %</small>
			    </div>
	      	</div>
	      	<div class="form-row">
			    <div class="form-group col-md-6">
		            <label for="inputJml_pinjam">Jumlah Pinjaman</label>
		            <input type="text" name="jml_pinjam" class="form-control" id="inputJml_pinjam" required="required">
		            <small class="form-text text-muted">Gunakan number tanpa titik</small>
		        </div>
		        <div class="form-group col-md-6">
			        <label for="inputTgl_pinjam">Tanggal Pinjam</label>
				    <input type="text" name="tgl_pinjam" class="form-control" id="inputTgl_pinjam" required="required">
			        <small class="form-text text-muted">Contoh penulisan seperti <?= date('Y-m-d') ?></small>
			    </div>
	      	</div>
	        <div class="form-group">
	          <label for="inputKeterangan">Keterangan</label>
	          <textarea class="form-control" name="keterangan" id="inputKeterangan" required="required" rows="3"></textarea>
	        </div>
	        <input type="submit" class="btn btn-primary" name="save" value="Simpan">
	      </form> 
	    </div>
	    <div class="col-sm-3 mx-auto">
	      <div class="alert alert-warning">Tips: Isi data dengan benar agar dapat disimpan</div>
	    </div>
	  </div>
	</div>

