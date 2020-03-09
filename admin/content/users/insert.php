<?php 
if(isset($_POST['save'])){
	$sqlNum = "SELECT MAX(id) AS num FROM users";
  $sqlNumPre = "SELECT MAX(id) AS num FROM pre_users";
  $result = mysqli_fetch_array(mysqli_query($connect, $sqlNum));
  $resultPre = mysqli_fetch_array(mysqli_query($connect, $sqlNumPre));

  $banding = $result['num'] > $resultPre['num'] ? $result['num'] : $resultPre['num'];

  $id = $banding+1;
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $nama = $_POST['nama'];
  $no_hp = $_POST['no_hp'];
  $nik = $_POST['nik'];
  $email = $_POST['email'];
  $alamat = $_POST['alamat'];
  $jk = isset($_POST['radio']) ? $_POST['radio'] : '';
  $tgl_lahir = $_POST['tgl_lahir'];
  $pekerjaan = $_POST['pekerjaan'];

  $sql = "INSERT INTO users (id, nama, no_hp, nik, email, alamat, jkelamin, tgl_lahir, pekerjaan, username, password, role, logged_at, created_at, updated_at) VALUES('$id', '$nama', '$no_hp', '$nik', '$email', '$alamat', '$jk', '$tgl_lahir', '$pekerjaan', '$username', '$password', '$role', '0000-00-00 00:00:00.000000', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000')"; 
  
  if(mysqli_query($connect, $sql)){
  	echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil disimpan</div>";
    echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php?page=users'}, 500)</script>";
  }else{
  	echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal Disimpan, mohon isi data dengan benar</div>";
  }
}

$jenisKelamin = array('P', 'L');

 ?>
 <h2 class="my-4">Tambah Member</h2>
 <div class="container">
  <div class="row">
    <div class="col-sm-8 mx-auto">
      <form method="POST" action=""  class="mb-3">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputUsername">Username</label>
            <input type="text" name="username" class="form-control" id="inputUsername" required="required">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword">Password</label>
            <input type="text" name="password" class="form-control" id="inputPassword" required="required">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputNama">Nama</label>
            <input type="text" name="nama" class="form-control" id="inputNama" required="required">
          </div>
          <div class="form-group col-md-6">
            <label for="inputNo_hp">No Handphone</label>
            <input type="text" name="no_hp" class="form-control" id="inputNo_hp" required="required">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputNik">NIK</label>
            <input type="text" name="nik" class="form-control" id="inputNik" required="required">
          </div>
          <div class="form-group col-md-8">
            <label for="inputEmail">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail" required="required">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Alamat</label>
          <textarea class="form-control" name="alamat" id="inputAddress" required="required" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="inputJKelamin">Jenis Kelamin</label><br>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="radioL" required="required" name="radio" class="custom-control-input" value="L">
              <label class="custom-control-label" for="radioL">Laki-laki</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="radioP" required="required" name="radio" class="custom-control-input" value="P">
              <label class="custom-control-label" for="radioP">Perempuan</label>
            </div>
        </div>
        <div class="form-row">
        	<div class="form-group col-md-6">
	          <label for="inputTgl_lahir">Tanggal Lahir</label>
	          <input type="text" name="tgl_lahir" class="form-control" id="inputTgl_lahir" required="required">
	          <small class="form-text text-muted">Contoh penulisan seperti <?= date('Y-m-d') ?></small>
	        </div>
	        <div class="form-group col-md-6">
	        	<label for="inputRole">Role</label>
	        	<select class="custom-select" required="required" name="role">
				  <option selected>Pilih Hak Akses</option>
				  <option value="admin">Admin</option>
				  <option value="member">Member</option>
				</select>
	        </div>
        </div>
        
        <div class="form-group">
          <label for="inputPekerjaan">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" id="inputPekerjaan" required="required">
        </div>
        <input type="submit" class="btn btn-primary" name="save" value="Simpan">
      </form>
    </div>
    <div class="col-sm-3 mx-auto">
      <div class="alert alert-warning">Tips: Isi data dengan benar agar dapat disimpan, data yang sama seperti (nik, no_hp, email, username) dengan user lain tidak akan disimpan</div>
    </div>
  </div>
</div>