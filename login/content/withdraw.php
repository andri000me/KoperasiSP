<?php
function rupiah($angka){
  return number_format($angka,0,',', '.');
}

$id_user = $_SESSION['id'];
$sql = "SELECT * FROM withdraw ORDER BY id DESC";
$result = mysqli_query($connect, $sql);
 ?>

<h2 class="my-4">List Histori Withdraw Koperasi</h2> 
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
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) :
      $id_user = $data['id_user'];
      $data2 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM users WHERE id='$id_user'"));
      ?>
      <tr>
        <th scope="row"><?= $data['id'] ?></th>
        <td><?= $id_user ?></td>
        <td><?= $data2['nama'] ?></td>
        <td><?= rupiah($data['jml_withdraw']) ?></td>
        <td><?= $data['tgl_withdraw'] ?></td>
        <td><?= $data['ket'] ?></td>
      </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>



