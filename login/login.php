<?php 
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' ";
    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) > 0){
      $data = mysqli_fetch_array($result);
      $_SESSION['id']       = $data['id'];
      $_SESSION['nama']     = $data['nama'];
      $_SESSION['no_hp']    = $data['no_hp'];
      $_SESSION['nik']      = $data['nik'];
      $_SESSION['email']    = $data['email'];
      $_SESSION['alamat']   = $data['alamat'];
      $_SESSION['jk']       = $data['jkelamin'];
      $_SESSION['tgl_lahir']= $data['tgl_lahir'];
      $_SESSION['pekerjaan']= $data['pekerjaan'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['password'] = $data['password'];
      $_SESSION['role']     = $data['role'];

      echo "<script> var timer = setTimeout(function() {window.location='index.php'}, 0);</script>";

      $id = $_SESSION['id'];
      mysqli_query($connect, "UPDATE users SET logged_at =  CURRENT_TIMESTAMP WHERE id='$id'");
    }else{
      $_SESSION['warning'] = "<br><div class=\"alert alert-danger\" role=\"alert\">Username atau Password Salah</div>";
    }
  }
 ?>

<body>
  <div class="container" style="margin-top: 100px;">
    <div class="row">
      <div class="col-sm-6 mx-auto">
        <div class="card">
          <div class="card-header text-center">Form Login</div>
          <div class="card-body">
            <!-- form login -->
            <form action="" class="form-signin" method="POST">
              <div class="form-group">
                <label for="inputUsername">Username</label>
                <input type="username" class="form-control" id="inputUsername" name="username" required="required" autofocus="autofocus" placeholder="Masukan username">
              </div>
              <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password" required="required" placeholder="Masukan password">
              </div>
              <button class="btn btn-primary" type="submit" name="login">Masuk</button><br>
              <?php 
              if(isset($_SESSION['warning'])){
                echo $_SESSION['warning'];
                unset($_SESSION['warning']);
              }
              ?>
              <small class="text-muted">Lupa password ? Hubungi administrator <a href="/koperasi_sp/index.php?page=contact" class="">disini</a></small>
            </form>
          </div>
          <div class="card-footer text-muted text-center">
            Belum punya akun ? <a href="/koperasi_sp/index.php?page=register" class="btn btn-secondary">Daftar</a>
            <a href="/koperasi_sp" class="btn btn-info">Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>  
</body>
