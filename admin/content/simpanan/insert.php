<?php 

if (isset($_POST['save'])) {
	$row = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(id) AS num FROM simpanan"));
	$num =  "WDR-" . sprintf("%05s", (substr($row['num'], 4, 5)+1));

  	$id 		  = $num;
	$id_user	  = $_POST['id_user'];
	$jml_simpan   = $_POST['jml_simpan'];
	$jenis_simpan = $_POST['jenis_simpan'];
	$tgl_simpan   = $_POST['tgl_simpan'];
	$ket          = $_POST['keterangan'];

	$sqlUpdate = "INSERT INTO simpanan(id,id_usr,jml_simpan,jenis_simpan,tgl_simpan,ket) VALUES('$id', '$id_user', $jml_simpan, '$jenis_simpan', '$tgl_simpan', '$ket')"; 
	if (mysqli_query($connect, $sqlUpdate)) {
		echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil disimpan</div>";
      	echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php?page=simpanan'}, 1000)</script>";
	}else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal disimpan</div>";
	}
}
	$jenis_simpan = ['Simpanan Pokok', 'Simpanan Wajib', 'Simpanan Sukarela', 'Sisa Usaha', 'Pinjaman Modal', 'Donasi']
?>
	<h2 class="my-4">Tambah Simpanan</h2>
	 <div class="container mb-3">
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
			        <a href="/koperasi_sp/login/index.php?page=simpanan&pages=cariUsers&operasi=insert" class="btn btn-primary" style="margin-top: 30px">Cari user</a>
			    </div>
	      	</div>
	        <div class="form-row">
	          <div class="form-group col-md-6">
	            <label for="inputjml_simpan">Jumlah Simpan</label>
	            <input type="text" name="jml_simpan" class="form-control" id="inputjml_simpan" required="required">
	            <small class="form-text text-muted">Gunakan number tanpa titik</small>
	          </div>
	          <div class="form-group col-md-6">
	            <label for="inputjenis_simpan">Jenis Simpan</label>
		        	<select class="custom-select" required="required" name="jenis_simpan">
					  <option>Pilih Jenis Simpanan</option>
					  <?php foreach($jenis_simpan as $key): ?>
						  <option value="<?= $key?>" ><?= $key ?></option>
					  <?php endforeach ?>
					</select>
	          </div>
	        </div>
	        <div class="form-group">
	          <label for="inputTgl_simpan">Tanggal Simpan</label>
	          <input type="text" name="tgl_simpan" class="form-control" id="inputTgl_simpan" required="required">
	          <small class="form-text text-muted">Contoh penulisan seperti <?= date('Y-m-d') ?></small>
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


