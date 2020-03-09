<?php 
// UPDATE PROFILE
if(isset($_POST['save'])){
  $id = $_POST['id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $nama = $_POST['nama'];
  $no_hp = $_POST['no_hp'];
  $nik = $_POST['nik'];
  $email = $_POST['email'];
  $alamat = $_POST['alamat'];
  $jk = isset($_POST['radio']) ? $_POST['radio'] : '';
  $tgl_lahir = $_POST['tgl_lahir'];
  $pekerjaan = $_POST['pekerjaan'];

  $sql = "UPDATE users SET nama='$nama', no_hp='$no_hp', nik='$nik', email='$email', alamat='$alamat', jkelamin='$jk', tgl_lahir='$tgl_lahir', pekerjaan='$pekerjaan', username='$username', password='$password', updated_at = CURRENT_TIMESTAMP WHERE id='$id'";

  if(mysqli_query($connect, $sql)){
    if($username != $_SESSION['username'] || $password != $_SESSION['password']){
      echo "<div class=\"alert alert-success\" role=\"alert\">Anda akan logout ketika mengganti username dan password</div>";
      echo "<script>var timer = setTimeout(function() {window.location= 'index.php'}, 3000)</script>";
      session_destroy();
    }else{
      echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil Disimpan</div>";
    }
    
  }else{
    echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal Disimpan, mohon isi data dengan benar</div>";
  }
}
$jenisKelamin = array('P', 'L');
 ?>

<h2 class="my-4">Profile Admin</h2> 
<div class="container">
  <div class="row">
    <div class="col-sm-8 mx-auto">
      <form method="POST" action="" class="mb-3">
        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="inputId">ID</label>
            <input type="text" name="id" class="form-control" id="inputId" required="required" value="<?= $_SESSION['id'];?>" readonly>
          </div>
          <div class="form-group col-md-5">
            <label for="inputUsername">Username</label>
            <input type="text" name="username" class="form-control" id="inputUsername" required="required" value="<?= $_SESSION['username']; ?>">
          </div>
          <div class="form-group col-md-5">
            <label for="inputPassword">Password</label>
            <input type="text" name="password" class="form-control" id="inputPassword" required="required" value="<?= $_SESSION['password']; ?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputNama">Nama</label>
            <input type="text" name="nama" class="form-control" id="inputNama" required="required" value="<?= $_SESSION['nama']; ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="inputNo_hp">No Handphone</label>
            <input type="text" name="no_hp" class="form-control" id="inputNo_hp" required="required" value="<?= $_SESSION['no_hp']; ?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputNik">NIK</label>
            <input type="text" name="nik" class="form-control" id="inputNik" required="required" value="<?= $_SESSION['nik']; ?>">
          </div>
          <div class="form-group col-md-8">
            <label for="inputEmail">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail" required="required" value="<?= $_SESSION['email']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Alamat</label>
          <textarea class="form-control" name="alamat" id="inputAddress" required="required" rows="3"><?= $_SESSION['alamat']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="inputJKelamin">Jenis Kelamin</label><br>
          <?php foreach ($jenisKelamin as $key): ?>
            <?php $check = $_SESSION['jk'] == $key ? 'checked="checked"' : '';?>
            <?php $idc = $_SESSION['jk']  == $key ? 'radioL' : 'radioP';?>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="<?= $idc?>" required="required" name="radio" class="custom-control-input" value="<?= $key ?>" <?= $check ?>>
              <label class="custom-control-label" for="<?= $idc?>"><?= $key == 'P' ? 'Perempuan' : 'Laki-laki' ?></label>
            </div>
          <?php endforeach ?>
        </div>
        <div class="form-group">
          <label for="inputTgl_lahir">Tanggal Lahir</label>
          <input type="text" name="tgl_lahir" class="form-control" id="inputTgl_lahir" required="required" value="<?= $_SESSION['tgl_lahir']; ?>">
        </div>
        <div class="form-group">
          <label for="inputPekerjaan">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" id="inputPekerjaan" required="required" value="<?= $_SESSION['pekerjaan']; ?>">
        </div>
        <input type="submit" class="btn btn-primary" name="save" value="Simpan">
      </form>
    </div>
    <div class="col-sm-3 mx-auto">
      <div class="alert alert-warning">Tips: Mengganti Username atau Password akan membuatmu logout dari akunmu</div>
    </div>
  </div>
</div>
<?php mysqli_close($connect) ?>
