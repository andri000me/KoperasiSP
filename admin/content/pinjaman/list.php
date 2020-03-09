<?php
function rupiah($angka){
  return number_format($angka,0,',', '.');
}

$spinjam = 'disetujui';

if((isset($_GET['sp']))){ $spinjam = $_GET['sp']; }

$sql = "SELECT * FROM pinjaman WHERE status_pinjam='$spinjam' ORDER BY status DESC, ID DESC";
$result = mysqli_query($connect, $sql);
?>


<?php if (isset($_GET['sp'])) : ?>
  <?php if($_GET['sp'] == 'disetujui'): ?>
    <h2 class="my-4">List Pinjaman</h2> 
  <?php else: ?>
    <h2 class="my-4">Pengajuan Pinjaman</h2> 
  <?php endif ?>
<?php else : ?>
   <h2 class="my-4">List Pinjaman</h2> 
<?php endif ?>

<a href="/koperasi_sp/login/index.php?page=pinjaman&pages=insert" class="btn btn-primary mb-2">Tambah</a>

<?php if (isset($_GET['sp'])) : ?>
  <?php if($_GET['sp'] == 'disetujui'): ?>
    <a href="/koperasi_sp/login/index.php?page=pinjaman&sp=belum disetujui" class="btn btn-warning mb-2">Pengajuan Pinjaman</a>
  <?php else: ?>
    <a href="/koperasi_sp/login/index.php?page=pinjaman&sp=disetujui" class="btn btn-secondary mb-2">List Pinjaman</a>
  <?php endif ?>
<?php else : ?>
   <a href="/koperasi_sp/login/index.php?page=pinjaman&sp=belum disetujui" class="btn btn-warning mb-2">Pengajuan Pinjaman</a>
<?php endif ?>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Id User</th>
        <th scope="col">Nama User</th>
        <th scope="col">Jumlah Pinjam</th>
        <th scope="col">Tenor</th>
        <th scope="col">Bunga</th>
        <th scope="col">Angsuran</th>
        <th scope="col">Tanggal Pinjam</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) : ?>
      <?php $id = $data['id'];
            $idUser = $data['id_user'];
            $dataUser = mysqli_fetch_array(mysqli_query($connect, "SELECT nama FROM users WHERE id='$idUser'")); ?>
      <tr>
        <th scope="row"><?= $id ?></th>
        <td><?= $idUser ?></td>
        <td><?= $dataUser['nama'] ?></td>
        <td><?= rupiah($data['jml_pinjam']) ?></td>
        <td><?= $data['tenor'].'X' ?></td>
        <td><?= $data['bunga'].'%' ?></td>
        <td><?= rupiah($data['angsuran']) ?></td>
        <td><?= $data['tgl_pinjam'] ?></td>
        <td><?= $data['status']?></td>
        <td>
          <a href="" class="btn btn-info m-1" data-toggle='modal' data-target='#info<?=$data['id'];?>' title="Info">Ket</a>
          <?php if($spinjam == 'belum disetujui'): ?>
            <a href="/koperasi_sp/login/index.php?page=pinjaman&pages=accept_pinjaman&id=<?=$data['id'];?>" class="btn btn-success m-1" title="Setujui">Setujui</a>
          <?php endif ?>
          <?php if($data['status'] == 'Berjalan'): ?>
            <a href="" class="btn btn-danger m-1" data-toggle='modal' data-target='#deleteModal<?=$data['id'];?>' title="Hapus"><i class="far fa-trash-alt text-white"></i></a>
          <?php endif ?>
        </td>
      </tr>
    
      <!-- Modal Dialog Confirm Delete Member --> 
      <div class="modal fade" id="deleteModal<?= $data['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Pinjaman ? </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah anda yakin ingin menghapusnya ? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a href="/koperasi_sp/login/index.php?page=pinjaman&pages=delete&id=<?=$data['id'];?>" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Dialog Info Pinjaman --> 
      <div class="modal fade" id="info<?= $data['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Info Pinjaman</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Keterangan : <?= $data['ket']; ?></p>
              <p>Nomor Rekening : <?= $data['no_rekening']; ?></p>
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
<?php mysqli_close($connect); ?>


