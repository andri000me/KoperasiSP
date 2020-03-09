<?php 
$role = 'member';
$user = 'users';

if((isset($_GET['role']))){ $role = $_GET['role']; }
if((isset($_GET['users']))){ $user = $_GET['users']; }

$sql = "SELECT * FROM $user WHERE role='$role' ORDER BY id DESC";
$result = mysqli_query($connect, $sql);
 ?>

<?php if (isset($_GET['role'])) : ?>
  <?php if($_GET['role'] == 'member'): ?>
    <h2 class="my-4">List Data Member</h2> 
  <?php else: ?>
    <h2 class="my-4">List Data Admin</h2> 
  <?php endif ?>
<?php else : ?>
   <h2 class="my-4">List Data Member</h2> 
<?php endif ?>

<a href="/koperasi_sp/login/index.php?page=users&pages=insert" class="btn btn-primary mb-2"> Tambah</a>

<?php if (isset($_GET['role'])) : ?>
  <?php if($_GET['role'] == 'member'): ?>
    <a href="/koperasi_sp/login/index.php?page=users&role=admin" class="btn btn-secondary mb-2"> List Admin</a>
  <?php else: ?>
    <a href="/koperasi_sp/login/index.php?page=users&role=member" class="btn btn-secondary mb-2"> List Member</a>
  <?php endif ?>
<?php else : ?>
   <a href="/koperasi_sp/login/index.php?page=users&role=admin" class="btn btn-secondary mb-2"> List Admin</a>
<?php endif ?>

<?php if(isset($_GET['users'])): ?>
  <?php if($_GET['users'] == 'users'): ?>
    <a href="/koperasi_sp/login/index.php?page=users&role=member&users=pre_users" class="btn btn-warning mb-2"> Pendaftaran User Butuh Persetujuan</a>
  <?php endif ?>
<?php else: ?>
  <a href="/koperasi_sp/login/index.php?page=users&role=member&users=pre_users" class="btn btn-warning mb-2"> Pendaftaran User Butuh Persetujuan</a>
<?php endif ?>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nama</th>
        <th scope="col">NIK</th>
        <th scope="col">Tgl Lahir</th>
        <th scope="col">JK</th>
        <th scope="col">No Hp</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) : ?>
      <tr>
        <th scope="row"><?= $data['id'] ?></th>
        <td><?= $data['nama'] ?></td>
        <td><?= $data['nik'] ?></td>
        <td><?= $data['tgl_lahir'] ?></td>
        <td><?= $data['jkelamin'] ?></td>
        <td><?= $data['no_hp'] ?></td>
        <td><?= $data['email'] ?></td>
        <td>
          <a href="" class="btn btn-info mb-1" data-toggle="modal" data-target="#infoModal<?=$data['id'];?>" title="Info User"><i class="fas fa-info-circle text-white"></i></a>
          <?php if(isset($_GET['users'])): ?>
            <?php if($_GET['users'] == 'pre_users'): ?>
              <a href="" class="btn btn-success mb-1" data-toggle="modal" data-target="#setujuiModal<?=$data['id'];?>" title="Setujui">Setujui</a>
              <a href="" class="btn btn-danger mb-1" data-toggle='modal' data-target='#deleteModal<?=$data['id'];?>' title="Hapus"><i class="far fa-trash-alt text-white"></i></a>
            <?php endif ?>
          <?php else: ?>
            <a href="/koperasi_sp/login/index.php?page=users&pages=update&id=<?=$data['id'];?>" class="btn btn-success mb-1"title="Edit"><i class="fas fa-user-edit text-white"></i></a>
            <a href="" class="btn btn-danger mb-1" data-toggle='modal' data-target='#deleteModal<?=$data['id'];?>' title="Hapus"><i class="far fa-trash-alt text-white" ></i></a>
          <?php endif ?>
          
        </td>
      </tr>

      <?php 
      $id=$data['id']; 
      $sqlInfo = mysqli_query($connect, "SELECT * FROM $user WHERE role='$role' AND id='$id'");
      while ($row = mysqli_fetch_array($sqlInfo)) : ?>
            
      <!-- Modal Dialog Info Member -->
      <div class="modal fade" id="infoModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?= $id.' - '.$data['nama']; ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-sm-4 mx-auto text-right">
                    <label for="pekerjaan">Pekerjaan : </label><br>      
                  </div>
                  <div class="col-sm-8 mx-auto text-left">
                    <label for="pekerjaanM"><?= $row['pekerjaan'] ?></label><br>      
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 mx-auto text-right">
                    <label for="alamat">Alamat : </label><br>   
                  </div>
                  <div class="col-sm-8 mx-auto text-left">
                    <label for="alamatM"><?= $row['alamat'] ?></label><br>      
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 mx-auto text-right">
                    <label for="created_at">Dibuat pada : </label><br>   
                  </div>
                  <div class="col-sm-8 mx-auto text-left">
                    <label for="created_atM"><?= $row['created_at'] ?></label><br>      
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 mx-auto text-right">
                    <label for="update_at">Diubah pada : </label>
                  </div>
                  <div class="col-sm-8 mx-auto text-left">
                    <label for="update_atM"><?= $row['updated_at'] ?></label><br>      
                  </div>
                </div>
              </div>
              <hr>
              
              <?php 
              $sqlUserLogin = mysqli_query($connect, "SELECT * FROM $user WHERE role='$role' AND id='$id'");
              while ($row2 = mysqli_fetch_array($sqlUserLogin)) : ?>
                <div class="alert alert-warning" role="alert">Menampilkan user login <?= $role ?></div>
                <div class="container">
                  <div class="row">
                    <div class="col-sm-4 mx-auto text-right">
                      <label for="username">Username :</label>
                    </div>
                    <div class="col-sm-8 mx-auto text-left">
                      <label for="usernameM"><?= $row2['username']; ?></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 mx-auto text-right">
                      <label for="password">Password :</label>
                    </div>
                    <div class="col-sm-8 mx-auto text-left">
                      <label for="passwordM"><?= $row2['password']; ?></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 mx-auto text-right">
                      <label for="role">Hak Akses :</label>
                    </div>
                    <div class="col-sm-8 mx-auto text-left">
                      <label for="roleM"><?= $row2['role']; ?></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 mx-auto text-right">
                      <label for="logged_at">Masuk Pada :</label>
                    </div>
                    <div class="col-sm-8 mx-auto text-left">
                      <label for="logged_atM"><?= $row2['logged_at']; ?></label>
                    </div>
                  </div>
                </div>
              </div>
              <?php endwhile ?>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    
      <!-- Modal Dialog Confirm Delete Member --> 
      <div class="modal fade" id="deleteModal<?= $id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete User ? </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah anda yakin ingin menghapus <?= $role.' "'.$data['nama']?>" ? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a href="/koperasi_sp/login/index.php?page=users&pages=delete&id=<?=$data['id'];?>&users=<?=$user?>" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Dialog Confirm Setujui Pre Users Member --> 
      <div class="modal fade" id="setujuiModal<?= $id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Setujui User ? </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah anda yakin ingin meyutujui <?= $role.' "'.$data['nama']?>"" untuk menjadi anggota koperasi ? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a href="/koperasi_sp/login/index.php?page=users&pages=accept_user&id=<?=$data['id'];?>&users=<?=$user?>" class="btn btn-success">Setujui</a>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile ?>
      <?php endwhile ?>
    </tbody>
  </table>
</div>
<?php mysqli_close($connect); ?>
