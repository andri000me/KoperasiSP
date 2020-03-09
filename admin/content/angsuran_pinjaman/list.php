<?php
function rupiah($angka){
  return number_format($angka,0,',', '.');
}
$status_bayar = 'on';
if((isset($_GET['sb']))){ $status_bayar = $_GET['sb']; }

$sql = "SELECT * FROM angsuran_pinjaman WHERE status_angsuran='$status_bayar' ORDER BY id DESC";
$result = mysqli_query($connect, $sql);
 ?>

<?php if(isset($_GET['sb'])): ?>
  <?php if($_GET['sb'] == 'on'): ?>
    <h2 class="my-4">Pembayaran Angsuran Terakhir</h2> 
  <?php elseif($_GET['sb'] == 'off'): ?>
    <h2 class="my-4">Histori Angsuran Pinjaman</h2> 
  <?php endif ?>
<?php else: ?>
  <h2 class="my-4">Pembayaran Angsuran Terakhir</h2> 
<?php endif ?>

<?php if(isset($_GET['sb'])): ?>
  <?php if($_GET['sb'] == 'on'): ?>
    <a href="/koperasi_sp/login/index.php?page=angsuran_pinjaman&sb=off" class="btn btn-secondary mb-2">Histori Angsuran Pinjaman</a>
  <?php elseif($_GET['sb'] == 'off'): ?>
    <a href="/koperasi_sp/login/index.php?page=angsuran_pinjaman" class="btn btn-secondary mb-2">Angsuran Pinjaman Aktif</a>
  <?php endif ?>
<?php else: ?>
  <a href="/koperasi_sp/login/index.php?page=angsuran_pinjaman&sb=off" class="btn btn-secondary mb-2">Histori Angsuran Pinjaman</a>
<?php endif ?>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Id Pinjaman</th>
        <th scope="col">Id Peminjam</th>
        <th scope="col">Nama Peminjam</th>
        <th scope="col">Angsuran Ke</th>
        <th scope="col">Jumlah Angsuran</th>
        <th scope="col">Sisa Angsuran</th>
        <th scope="col">Tanggal Angsuran</th>
        <?php if($status_bayar == 'on'): ?>
            <th scope="col">Action</th>
          <?php endif ?>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) : ?>
      <?php $id = $data['id']; 
            $id_pinjam = $data['id_pinjam'];
            $sqlPinjaman = "SELECT * FROM pinjaman WHERE id='$id_pinjam'";
            $resultPinjaman = mysqli_fetch_array(mysqli_query($connect, $sqlPinjaman));
            $id_user = $resultPinjaman['id_user'];
            $sqlUsers = "SELECT * FROM users WHERE id='$id_user'";
            $resultUsers = mysqli_fetch_array(mysqli_query($connect, $sqlUsers));
            ?>
      
      <tr>
        <th scope="row"><?= $id ?></th>
        <td><?= $id_pinjam ?></td>
        <td><?= $resultUsers['id'] ?></td>
        <td><?= $resultUsers['nama'] ?></td>
        <td><?= $data['angsuran_ke'] ?></td>
        <td><?= rupiah($data['jml_angsuran']) ?></td>
        <td><?= rupiah($data['sisa_angsuran']) ?></td>
        <td><?= $data['tgl_angsuran'] ?></td>
        <td>
          <?php if($status_bayar == 'on'): ?>
            <a href="/koperasi_sp/login/index.php?page=angsuran_pinjaman&pages=lunasi&id=<?=$data['id'];?>" class="btn btn-success m-1" title="Lunasi"><i class="fas fa-money-bill-wave"></i> Lunasi</a>
            <?php if($data['angsuran_ke'] != '0'): ?>
              <a href="" class="btn btn-danger m-1" data-toggle='modal' data-target='#deleteModal<?=$data['id'];?>' title="Hapus"><i class="far fa-trash-alt text-white"></i></a>
            <?php endif ?>
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
              <a href="/koperasi_sp/login/index.php?page=angsuran_pinjaman&pages=delete&id=<?=$data['id'];?>" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile ?>
    </tbody>
  </table>
</div>
<?php mysqli_close($connect); ?>


