<?php
$id_user = $_SESSION['id'];
$sql = "SELECT id FROM pinjaman WHERE id_user='$id_user'";
$r = mysqli_query($connect, $sql);
 ?>

<h2 class="my-4">Angsuran Pinjaman</h2> 
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Id Pinjaman</th>
        <th scope="col">Angsuran Ke</th>
        <th scope="col">Jumlah Angsuran</th>
        <th scope="col">Sisa Angsuran</th>
        <th scope="col">Tanggal Angsuran</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($data = mysqli_fetch_array($r)) :
            $id_pinjam = $data['id'];
            $sqlAP = "SELECT * FROM angsuran_pinjaman WHERE id_pinjam='$id_pinjam'";
            $result = mysqli_query($connect, $sqlAP);

            while($dataAP = mysqli_fetch_array($result)) : ?>
      <tr class="<?= $dataAP['status_angsuran'] =='on' ? 'bg-success text-white':'' ?>">
        <th scope="row"><?= $dataAP['id'] ?></th>
        <td><?= $dataAP['id_pinjam'] ?></td>
        <td><?= $dataAP['angsuran_ke'] ?></td>
        <td><?= $dataAP['jml_angsuran'] ?></td>
        <td><?= $dataAP['sisa_angsuran'] ?></td>
        <td><?= $dataAP['tgl_angsuran'] ?></td>
        <td><?= $dataAP['status_angsuran'] ?></td>
      </tr>
      <?php endwhile ?>
      <?php endwhile ?>
    </tbody>
  </table>
</div>



