<?php
function rupiah($angka){
  return number_format($angka,0,',', '.');
}

$id_user = $_SESSION['id'];
$sql = "SELECT * FROM pinjaman WHERE id_user='$id_user' ORDER BY status DESC, id DESC";
$result = mysqli_query($connect, $sql);
 ?>

<h2 class="my-4">List Pinjaman Anda</h2> 
<a href="/koperasi_sp/login/index.php?page=ajukan_pinjaman" class="btn btn-primary mb-2">Ajukan Pinjaman</a>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Jumlah Pinjaman</th>
        <th scope="col">Tenor</th>
        <th scope="col">Bunga</th>
        <th scope="col">Angsuran</th>
        <th scope="col">Tanggal Pinjam</th>
        <th scope="col">Status</th>
        <th scope="col">No Rekening</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) : ?>
      <tr class='<?php if($data['status_pinjam'] == 'disetujui' && $data['status']=='Lunas'):
                          echo "bg-secondary text-white ";
                       elseif($data['status_pinjam'] == 'disetujui' && $data['status']=='Berjalan'):
                          echo "bg-success text-white ";
                       endif ?>'>
        <th scope="row"><?= $data['id'] ?></th>
        <td><?= rupiah($data['jml_pinjam']) ?></td>
        <td><?= $data['tenor'] ?></td>
        <td><?= $data['bunga'] ?></td>
        <td><?= rupiah($data['angsuran']) ?></td>
        <td><?= $data['tgl_pinjam'] ?></td> 
        <td><?= $data['status'] ?></td>
        <td><?= $data['no_rekening'] ?></td>
        <?php $sp = $data['status_pinjam']; ?>
        <td>
          <?php if($sp == 'belum disetujui'): ?>
            <a href="" class="btn btn-info" data-toggle='modal' data-target='#info<?=$data['id'];?>'>Ket</a>
          <a href="" class="btn btn-danger" data-toggle='modal' data-target='#deleteModal<?=$data['id'];?>'><i class="far fa-trash-alt text-white"></i></a>
          <?php endif ?>
        </td>
      </tr>

      <!-- Modal Dialog Confirm Delete Member --> 
      <div class="modal fade" id="deleteModal<?= $data['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Hapus Pengajuan Pinjaman ? </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah anda yakin ingin menghapusnya ? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a href="/koperasi_sp/login/index.php?page=pinjaman&action=delete&id=<?=$data['id'];?>" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Dialog info pinjaman --> 
      <div class="modal fade" id="info<?= $data['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Info Pinjaman Ini</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Keterangan : <?= $data['ket'] ?></p>
              <p>Belum disetujui oleh administrator, hubungi admin agar pengajuan pinjaman anda dapat disetujui</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile ?>
    </tbody>
  </table>
</div>

<?php 
if(isset($_GET['action']) == 'delete'){
  $delete_id = $_GET['id'];
  $sql = "DELETE FROM pinjaman WHERE id='$delete_id'";

  if(mysqli_query($connect, $sql)){
    echo "<script> var timer = setTimeout(function() {window.location='/koperasi_sp/login/index.php?page=pinjaman'}, 0);</script>";
  }
}
 ?>

