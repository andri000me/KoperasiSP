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
	$id_user	  = $_SESSION['id'];
	$jml_pinjam   = $_POST['jml_pinjam'];
	$tenor   	  = $_POST['tenor'];
	$no_rekening  = $_POST['no_rekening'];
	$ket          = $_POST['keterangan'];

	$sqlInsert = "INSERT INTO pinjaman(id,id_user,jml_pinjam,tenor,bunga,angsuran,tgl_pinjam,no_rekening,status,status_pinjam,ket) VALUES('$id', '$id_user', '$jml_pinjam', '$tenor', '0', '0', '0000-00-00', $no_rekening,'Berjalan', 'belum disetujui', '$ket')";

	if (mysqli_query($connect, $sqlInsert)) {
		echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil disimpan</div>";
      	echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php?page=pinjaman'}, 1000)</script>";
	}else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal disimpan</div>";
		
	}
}
$jenis_tenor = array('3','6','12','16','20');
?>
	<h2 class="my-4">Ajukan Pinjaman</h2>
	 <div class="container">
	  <div class="row">
	    <div class="col-sm-8 mx-auto">
	      <form method="POST" action="">
	      	<div class="form-row">
			    <div class="form-group col-md-6">
		            <label for="inputJml_pinjam">Jumlah Pinjaman</label>
		            <input type="text" name="jml_pinjam" class="form-control" id="inputJml_pinjam" required="required">
		            <small class="form-text text-muted">Gunakan number tanpa titik</small>
		        </div>
		        <div class="form-group col-md-6">
	            <label for="inputJenis_tenor">Tenor</label>
		        	<select class="custom-select" required="required" name="tenor">
					  <option>Pilih</option>
					  <?php foreach($jenis_tenor as $key): ?>
						  <option value="<?= $key?>" ><?= $key ?></option>
					  <?php endforeach ?>
					</select>
	          	</div>
	      	</div>
	      	<div class="form-group">
		        <label for="inputNo_rekening">Nomor Rekening</label>
		        <input type="text" name="no_rekening" class="form-control" id="inputNo_rekening" required="required">
		        <small class="form-text text-muted">Isikan nomer rekening asli agar dana dapat diterima melalui rekening, kosongkan jika ingin diterima dalam bentuk uang</small>
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


