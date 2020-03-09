<?php
function rupiah($angka){
  return number_format($angka,0,',', '.');
}
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($connect, $sql);
 ?>
 
<h2 class="my-4">Pilih User</h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nama User</th>
        <th scope="col">NIK</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) : ?>
      <?php $id = $data['id']; $nama = $data['nama']?>
      <tr>
        <th scope="row"><?= $id ?></th>
        <td><?= $nama ?></td>
        <td><?= $data['nik'] ?></td>
        <td>
          <?php if($_GET['operasi'] == "insert"): ?>
          <a href="/koperasi_sp/login/index.php?page=pinjaman&pages=insert&id=<?=$id?>&nama=<?= $nama?>" class="btn btn-success m-1" title="Pilih">Pilih</a>
          <?php else: ?>
            <a href="/koperasi_sp/login/index.php?page=pinjaman &pages=update&id=<?=$_GET['id']?>&idUser=<?=$id?>&nama=<?= $nama?>" class="btn btn-success m-1" title="Pilih">Pilih</a>
          <?php endif ?>
        </td>
      </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>
<?php mysqli_close($connect) ?>


