<?php 
if(isset($_POST['save'])){
  $id = $_GET['id'];
  $nama = $_POST['nama'];
  $no_hp = $_POST['no_hp'];
  $nik = $_POST['nik'];
  $email = $_POST['email'];
  $alamat = $_POST['alamat'];
  $jk = isset($_POST['radio']) ? $_POST['radio'] : '';
  $tgl_lahir = $_POST['tgl_lahir'];
  $pekerjaan = $_POST['pekerjaan'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  $sql = "UPDATE users SET nama='$nama', no_hp='$no_hp', nik='$nik', email='$email', alamat='$alamat', jkelamin='$jk', tgl_lahir='$tgl_lahir', pekerjaan='$pekerjaan', username='$username', password='$password', role='$role', updated_at = CURRENT_TIMESTAMP WHERE id='$id'";

  if(mysqli_query($connect, $sql)){
    if($username == $_SESSION['username'] || $password == $_SESSION['password']){
      echo "<div class=\"alert alert-success\" role=\"alert\">Anda akan logout ketika mengganti username dan password</div>";
      echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php'}, 500)</script>";
      session_destroy();
    }else{
      echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil Disimpan</div>";
      echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php?page=users'}, 500)</script>";
    }
    
  }else{
    echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal Disimpan, mohon isi data dengan benar</div>";
  }
}
$id = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM users WHERE id='$id'");
$users = mysqli_fetch_array($result);
$jenisKelamin = array('P', 'L');
$jenisRole = array('admin', 'member');
 ?>
<h2 class="my-4">Ubah Data Member</h2>
 <div class="container mb-3">
  <div class="row">
    <div class="col-sm-8 mx-auto">
      <form method="POST" action="" class="mb-3">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputUsername">Username</label>
            <input type="text" name="username" class="form-control" id="inputUsername" required="required" value="<?= $users['username']?>">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword">Password</label>
            <input type="text" name="password" class="form-control" id="inputPassword" required="required" value="<?= $users['password']?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputNama">Nama</label>
            <input type="text" name="nama" class="form-control" id="inputNama" required="required" value="<?= $users['nama']?>">
          </div>
          <div class="form-group col-md-6">
            <label for="inputNo_hp">No Handphone</label>
            <input type="text" name="no_hp" class="form-control" id="inputNo_hp" required="required" value="<?= $users['no_hp']?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputNik">NIK</label>
            <input type="text" name="nik" class="form-control" id="inputNik" required="required" value="<?= $users['nik']?>">
          </div>
          <div class="form-group col-md-8">
            <label for="inputEmail">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail" required="required" value="<?= $users['email']?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Alamat</label>
          <textarea class="form-control" name="alamat" id="inputAddress" required="required" rows="3"><?= $users['alamat']?></textarea>
        </div>
        <div class="form-group">
          <label for="inputJKelamin">Jenis Kelamin</label><br>
          <?php foreach ($jenisKelamin as $key): ?>
            <?php $check = $users['jkelamin'] == $key ? 'checked="checked"' : '';?>
            <?php $idc = $users['jkelamin'] == $key ? 'radioL' : 'radioP';?>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="<?= $idc?>" required="required" name="radio" class="custom-control-input" value="<?= $key ?>" <?= $check ?>>
              <label class="custom-control-label" for="<?= $idc?>"><?= $key == 'P' ? 'Perempuan':'Laki-laki' ?></label>
            </div>
          <?php endforeach ?>
        </div>
        <div class="form-row">
        	<div class="form-group col-md-6">
	          <label for="inputTgl_lahir">Tanggal Lahir</label>
	          <input type="text" name="tgl_lahir" class="form-control" id="inputTgl_lahir" required="required" value="<?= $users['tgl_lahir']?>">
	          <small class="form-text text-muted">Contoh penulisan seperti <?= date('Y-m-d') ?></small>
	        </div>
	        <div class="form-group col-md-6">
	        	<label for="inputRole">Role</label>
	        	<select class="custom-select" required="required" name="role">
              <option>Pilih Hak Akses</option>
              <?php foreach($jenisRole as $key) : ?>
              <?php $check = $users['role'] == $key ? 'selected' : ''?>
    				  <option value="<?=$key?>" <?=$check?> ><?=$key == 'admin' ? 'Admin':'Member'?></option>
              <?php endforeach ?>
  				</select>
	        </div>
        </div>
        
        <div class="form-group">
          <label for="inputPekerjaan">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" id="inputPekerjaan" required="required" value="<?= $users['pekerjaan']?>">
        </div>
        <input type="submit" class="btn btn-primary" name="save" value="Simpan">
      </form>
    </div>
    <div class="col-sm-3 mx-auto">
      <div class="alert alert-warning">Tips: Isi data dengan benar agar dapat disimpan</div>
    </div>
  </div>
</div>