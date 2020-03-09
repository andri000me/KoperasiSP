<?php
function rupiah($angka){
  return number_format($angka,0,',', '.');
}
$sql = "SELECT * FROM withdraw ORDER BY id DESC";
$result = mysqli_query($connect, $sql);
 ?>
 
<h2 class="my-4">List Histori Withdraw</h2> 
<a href="/koperasi_sp/login/index.php?page=withdraw&pages=insert" class="btn btn-primary mb-2">Tambah</a>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Id User</th>
        <th scope="col">Nama User</th>
        <th scope="col">Jumlah Withdraw</th>
        <th scope="col">Tanggal Withdraw</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) : ?>
      <?php $idUser = $data['id_user'];
            $dataUser = mysqli_fetch_array(mysqli_query($connect, "SELECT nama FROM users WHERE id='$idUser'")); ?>
      <tr>
        <th scope="row"><?= $data['id'] ?></th>
        <td><?= $data['id_user'] ?></td>
        <td><?= $dataUser['nama'] ?></td>
        <td><?= rupiah($data['jml_withdraw']) ?></td>
        <td><?= $data['tgl_withdraw'] ?></td>
        <td><?= $data['ket'] ?></td>
        <td>
          <a href="/koperasi_sp/login/index.php?page=withdraw&pages=update&id=<?=$data['id'];?>&nama=<?=$dataUser['nama'] ?>" class="btn btn-success m-1" title="Edit"><i class="fas fa-edit"></i></a>
          <a href="" class="btn btn-danger m-1" data-toggle='modal' data-target='#deleteModal<?=$data['id'];?>' title="Hapus"><i class="far fa-trash-alt text-white"></i></a>
        </td>
      </tr>
      <!-- Modal Dialog Confirm Delete Member --> 
      <div class="modal fade" id="deleteModal<?= $data['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Withdraw ? </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah anda yakin ingin menghapusnya ? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a href="/koperasi_sp/login/index.php?page=withdraw&pages=delete&id=<?=$data['id'];?>" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile ?>
    </tbody>
  </table>
</div>
<?php mysqli_close($connect) ?>


