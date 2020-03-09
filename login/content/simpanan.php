<?php
function rupiah($angka){
  return number_format($angka,0,',', '.');
}

$id_user = $_SESSION['id'];
$sql = "SELECT * FROM simpanan WHERE id_usr='$id_user' ORDER BY id DESC";
$result = mysqli_query($connect, $sql);
 ?>


<h2 class="my-4">List Simpanan Anda</h2>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Jumlah Simpan</th>
        <th scope="col">Jenis Simpanan</th>
        <th scope="col">Tanggal Simpan</th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) : ?>
      <tr>
        <th scope="row"><?= $data['id'] ?></th>
        <td><?= rupiah($data['jml_simpan']) ?></td>
        <td><?= $data['jenis_simpan'] ?></td>
        <td><?= $data['tgl_simpan'] ?></td>
        <td><?= $data['ket'] ?></td>
      </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>



