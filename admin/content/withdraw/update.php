<?php 
if (isset($_POST['save'])) {
	$id           = $_GET['id'];
	$id_user	  = $_POST['id_user'];
	$jml_withdraw   = $_POST['jml_withdraw'];
	$tgl_withdraw   = $_POST['tgl_withdraw'];
	$ket          = $_POST['keterangan'];

	$sqlUpdate = "UPDATE withdraw SET id_user='$id_user', jml_withdraw='$jml_withdraw', tgl_withdraw='$tgl_withdraw', ket='$ket' WHERE id='$id'";  
	if (mysqli_query($connect, $sqlUpdate)) {
		echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil diubah</div>";
		echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php?page=withdraw'}, 1000)</script>";
	}else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal disimpan</div>";
	}
}
	$id = $_GET['id'];
	$sql = "SELECT * FROM withdraw WHERE id='$id'";
	$result = mysqli_query($connect, $sql);
	$data = mysqli_fetch_array($result);
?>
	<h2 class="my-4">Ubah Histori Withdraw</h2>
	 <div class="container">
	  <div class="row">
	    <div class="col-sm-8 mx-auto">
	      <form method="POST" action="" class="mb-3">
	      	<div class="form-row">
	      		<div class="form-group col-md-12">
		          <label for="inputId">ID</label>
		          <input value="<?= $data['id']; ?>" type="text" class="form-control" id="inputId" required="required" readonly>
		        </div>
	      	</div>
	      	<div class="form-row">
		        <div class="form-group col-md-5">
			        <label for="inputId">Id User</label>
			        <?php if (isset($_GET['idUser'])): ?>
					<input type="text" name="id_user" class="form-control" id="inputId" required="required" readonly value="<?= $_GET['idUser']?>">
					<?php else: ?>
					<input type="text" name="id_user" class="form-control" id="inputId" required="required" readonly value="<?= $data['id_user']; ?>">
					<?php endif ?>
			    </div>
			    <div class="form-group col-md-5">
			        <label for="inputNama">Nama</label>
			        <?php if (isset($_GET['nama'])): ?>
					<input type="text" name="nama" class="form-control" id="inputNama" required="required" readonly value="<?= $_GET['nama']?>">
					<?php endif ?>
			    </div>
			    <div class="form-group col-md-2">
			        <a href="/koperasi_sp/login/index.php?page=withdraw&pages=cariUsers&operasi=update&id=<?= $data['id']; ?>" class="btn btn-primary" style="margin-top: 30px">Cari user</a>
			    </div>
	      	</div>
	        <div class="form-row">
	          <div class="form-group col-md-6">
	            <label for="inputJml_withdraw">Jumlah Withdraw</label>
	            <input value="<?= $data['jml_withdraw']; ?>" type="text" name="jml_withdraw" class="form-control" id="inputJml_withdraw" required="required">
	            <small class="form-text text-muted">Gunakan number tanpa titik</small>
	          </div>
	          <div class="form-group col-md-6">
	              <label for="inputTgl_withdraw">Tanggal Withdraw</label>
		          <input value="<?= $data['tgl_withdraw']; ?>" type="text" name="tgl_withdraw" class="form-control" id="inputTgl_withdraw" required="required">
		          <small class="form-text text-muted">Contoh penulisan seperti <?= date('Y-m-d') ?></small>
	          </div>
	        </div>
	        <div class="form-group">
	          <label for="inputKeterangan">Keterangan</label>
	          <textarea class="form-control" name="keterangan" id="inputKeterangan" required="required" rows="3"><?= $data['ket']; ?></textarea>
	        </div>
	        <input type="submit" class="btn btn-primary" name="save" value="Simpan">
	      </form> 
	    </div>
	    <div class="col-sm-3 mx-auto">
	      <div class="alert alert-warning">Tips: Isi data dengan benar agar dapat disimpan</div>
	    </div>
	  </div>
	</div>


