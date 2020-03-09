<?php 
function rupiah($angka){
	return number_format($angka,0,',', '.');
}

$sql = "SELECT COUNT(*) AS jml_member FROM users WHERE role='member'";
$sql2 = "SELECT COUNT(*) AS jml_p FROM pre_users WHERE role='member'";
$result = mysqli_query($connect, $sql);
$result2 = mysqli_query($connect, $sql2);

if(mysqli_num_rows($result) > 0 &&  mysqli_num_rows($result2) > 0){
	$data = mysqli_fetch_array($result);
	$data2 = mysqli_fetch_array($result2);
	$jumlahMember = $data["jml_member"];
	$jumlahp = $data2["jml_p"];
}else{
	$jumlahMember = "Null";
	$jumlahp = "Null";
}
$sqljmlTotal = "SELECT SUM(jml_simpan) AS jml_simpan FROM simpanan ";
$row1 = mysqli_fetch_array(mysqli_query($connect, $sqljmlTotal));
$row2 = mysqli_fetch_array(mysqli_query($connect, $sqljmlTotal."WHERE jenis_simpan='Simpanan Pokok'"));
$row3 = mysqli_fetch_array(mysqli_query($connect, $sqljmlTotal."WHERE jenis_simpan='Simpanan Wajib'"));
$row4 = mysqli_fetch_array(mysqli_query($connect, $sqljmlTotal."WHERE jenis_simpan='Simpanan Sukarela'"));
$row5 = mysqli_fetch_array(mysqli_query($connect, $sqljmlTotal."WHERE jenis_simpan='Sisa Usaha'"));
$row6 = mysqli_fetch_array(mysqli_query($connect, $sqljmlTotal."WHERE jenis_simpan='Pinjaman Modal'"));
$row7 = mysqli_fetch_array(mysqli_query($connect, $sqljmlTotal."WHERE jenis_simpan='Donasi'"));

//$cRow1 = isset($row1['jml_simpan']) ? rupiah($row1['jml_simpan']):"Null";
$cRow1 = rupiah($row1['jml_simpan']);
$cRow2 = rupiah($row2['jml_simpan']);
$cRow3 = rupiah($row3['jml_simpan']);
$cRow4 = rupiah($row4['jml_simpan']);
$cRow5 = rupiah($row5['jml_simpan']);
$cRow6 = rupiah($row6['jml_simpan']);
$cRow7 = rupiah($row7['jml_simpan']);

$sqljmlWithdraw = "SELECT SUM(jml_withdraw) AS jml_withdraw FROM withdraw";
$row8 = mysqli_fetch_array(mysqli_query($connect, $sqljmlWithdraw));
$cRow8 = rupiah($row8['jml_withdraw']);

$sqljmlPinjaman = "SELECT SUM(sisa_angsuran) AS jml_pinjaman FROM angsuran_pinjaman WHERE status_angsuran='on'";
$row9 = mysqli_fetch_array(mysqli_query($connect, $sqljmlPinjaman));

$jmlHitung = $row1['jml_simpan']-$row8['jml_withdraw']-$row9['jml_pinjaman'];

if($jmlHitung <= 0){
	$jmlHutang = rupiah($jmlHitung);
}else{
	$jmlHutang = 0;
}

?>

<div class="d-flex">
	<div class="container mt-2">
		<div class="row mx-auto">
			<div class="col-sm-4">
				<div class="card mb-3 text-center" style="background: #fff; border: none;border-radius: 20px;height: 180px;max-width: 18rem;width: 400px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);">
					<div class="card-header text-light" style="border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;background: #3498db">Anggota</div>
				  <div class="card-body" style="color: #3498db">
				    <h5 class="card-title">Jumlah semua anggota</h5>
				    <h2 class="card-text"><?= $jumlahMember ?></h2>
				  </div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card border-secondary mb-3 text-center" style="background: #fff; border: none;border-radius: 20px;height: 180px;max-width: 18rem;width: 400px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);">
				  <div class="card-header text-light" style="border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;background: #95a5a6">Pinjaman</div>
				  <div class="card-body" style="color: #95a5a6">
				    <h5 class="card-title">Jumlah semua pinjaman</h5>
				    <h2 class="card-text"><?= rupiah($row9['jml_pinjaman']) ?></h2>
				  </div>
				</div>	
			</div>
			<div class="col-sm-4">
				<div class="card border-danger mb-3 text-center" style="background: #fff; border: none;border-radius: 20px;height: 180px;max-width: 18rem;width: 400px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);">
				  <div class="card-header text-light" style="border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;background: #e67e22">Simpanan</div>
				  <div class="card-body" style="color: #e67e22">
				    <h5 class="card-title">Jumlah semua simpanan</h5>
				    <h2 class="card-text"><?= $cRow1 ?></h2>
				  </div>
				</div>
			</div>
		</div>
		<div class="row mx-auto mt-3">
			<div class="col-sm-4">
				<div class="card border-secondary mb-3 text-center" style="background: #fff; border: none;border-radius: 20px;height: 180px;max-width: 18rem;width: 400px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);">
				  <div class="card-header text-light" style="border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;background: #9b59b6">Anggota</div>
				  <div class="card-body" style="color: #9b59b6">
				    <h5 class="card-title">Butuh persetujuan</h5>
				    <h2 class="card-text"><?= $jumlahp ?></h2>
				  </div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card border-info mb-3 text-center" style="background: #fff; border: none;border-radius: 20px;height: 180px;max-width: 18rem;width: 400px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);">
				  <div class="card-header text-light" style="border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;background: #2ecc71">Withdraw</div>
				  <div class="card-body" style="color: #2ecc71">
				    <h5 class="card-title">Jumlah semua withdraw</h5>
				    <h2 class="card-text"><?= $cRow8 ?></h2>
				  </div>
				</div>	
			</div>
			<div class="col-sm-4">
				<div class="card border-primary mb-3 text-center" style="background: #fff; border: none;border-radius: 20px;height: 180px;max-width: 18rem;width: 400px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);">
				  <div class="card-header text-light" style="border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;background: #e74c3c">Hutang</div>
				  <div class="card-body" style="color: #e74c3c">
				    <h5 class="card-title">Jumlah semua hutang</h5>
				    <h2 class="card-text"><?= $jmlHutang ?></h2>
				  </div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
		  <div class="col-sm-2">
		    <div class="card mb-3" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);border: none;border-left:1px solid #e67e22;border-top-right-radius: 60px;border-bottom-left-radius: 60px">
		      <div class="card-body text-center">
		        <h5 class="card-title">Simpanan pokok</h5>
		        <p class="card-text"><?= $cRow2 ?></p>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-2">
		    <div class="card mb-3"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);border: none;border-left:1px solid #e67e22;border-top-right-radius: 60px;border-bottom-left-radius: 60px">
		      <div class="card-body text-center">
		        <h5 class="card-title">Simpanan wajib</h5>
		        <p class="card-text"><?= $cRow3 ?></p>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-2">
		    <div class="card mb-3"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);border: none;border-left:1px solid #e67e22;border-top-right-radius: 60px;border-bottom-left-radius: 60px">
		      <div class="card-body text-center">
		        <h5 class="card-title ">Simpanan sukarela</h5>
		        <p class="card-text"><?= $cRow4 ?></p>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-2">
		    <div class="card mb-3"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);border: none;border-left:1px solid #e67e22;border-top-right-radius: 60px;border-bottom-left-radius: 60px">
		      <div class="card-body text-center">
		        <h5 class="card-title">Simpanan sisa</h5>
		        <p class="card-text"><?= $cRow5 ?></p>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-2">
		    <div class="card mb-3"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);border: none;border-left:1px solid #e67e22;border-top-right-radius: 60px;border-bottom-left-radius: 60px">
		      <div class="card-body text-center">
		        <h5 class="card-title ">Simpanan modal</h5>
		        <p class="card-text"><?= $cRow6 ?></p>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-2">
		    <div class="card mb-3"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);border: none;border-left:1px solid #e67e22;border-top-right-radius: 60px;border-bottom-left-radius: 60px">
		      <div class="card-body text-center">
		        <h5 class="card-title">Simpanan donasi</h5>
		        <p class="card-text"><?= $cRow7 ?></p>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>
<?php mysqli_close($connect) ?>
<style type="text/css">
	body{
		background: #EBEBEB;
	}
</style>