<?php
function rupiah($angka){
  return number_format($angka,0,',', '.');
}
$id_user = $_SESSION['id'];
$status_a = 'on';

if((isset($_GET['status_a']))){ $status_a = $_GET['status_a']; }

$sql = "SELECT id FROM pinjaman WHERE id_user='$id_user'";
$r = mysqli_query($connect, $sql);
 ?>

<?php if(isset($_GET['status_a'])): ?>
  <?php if($_GET['status_a'] == 'on'): ?>
    <h2 class="my-4">Pembayaran Angsuran Terakhir Anda</h2> 
  <?php elseif($_GET['status_a'] == 'off'): ?>
    <h2 class="my-4">Histori Angsuran Pinjaman</h2> 
  <?php endif ?>
<?php else: ?>
  <h2 class="my-4">Pembayaran Angsuran Terakhir Anda</h2> 
<?php endif ?>

<?php if(isset($_GET['status_a'])): ?>
  <?php if($_GET['status_a'] == 'on'): ?>
    <a href="/koperasi_sp/login/index.php?page=angsuran_pinjaman&status_a=off" class="btn btn-secondary mb-2">Histori Angsuran Pinjaman</a>
  <?php elseif($_GET['status_a'] == 'off'): ?>
    <a href="/koperasi_sp/login/index.php?page=angsuran_pinjaman&status_a=on" class="btn btn-secondary mb-2">Pembayaran Angsuran Terakhir</a>
  <?php endif ?>
<?php else: ?>
  <a href="/koperasi_sp/login/index.php?page=angsuran_pinjaman&status_a=off" class="btn btn-secondary mb-2">Histori Angsuran Pinjaman</a>
<?php endif ?>

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
      </tr>
    </thead>
    <tbody>
      <?php while ($data = mysqli_fetch_array($r)) :
            $id_pinjam = $data['id'];
            $sqlAP = "SELECT * FROM angsuran_pinjaman WHERE id_pinjam='$id_pinjam' AND status_angsuran='$status_a'";
            $result = mysqli_query($connect, $sqlAP);

            while($dataAP = mysqli_fetch_array($result)) : ?>
      <tr class="<?= $dataAP['status_angsuran'] =='on' ? 'bg-success text-white':'' ?>">
        <th scope="row"><?= $dataAP['id'] ?></th>
        <td><?= $dataAP['id_pinjam'] ?></td>
        <td><?= $dataAP['angsuran_ke'] ?></td>
        <td><?= rupiah($dataAP['jml_angsuran']) ?></td>
        <td><?= rupiah($dataAP['sisa_angsuran']) ?></td>
        <td><?= $dataAP['tgl_angsuran'] ?></td
      </tr>
      <?php endwhile ?>
      <?php endwhile ?>
    </tbody>
  </table>
</div>



