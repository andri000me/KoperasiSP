<?php session_start(); require '../koneksi.php'; ?>

<!DOCTYPE html>
<html>
<?php 
	require 'header.php'; 
	//jika session (user) tidak ada = masuk ke login.pnp
	if(!isset($_SESSION['username'])){
		require 'login.php';
		exit();
	}
 ?>
<body>
	<div class="d-flex" id="wrapper">
		<?php 
		if($_SESSION['role'] == 'admin'){
			require '../admin/admin_page/side_nav.php';
		}else{
			require 'member_page/side_nav.php';
		}
		?>
		
		<!-- page content -->
		<div id="page-content-wrapper">
			<?php 
				if($_SESSION['role'] == 'admin'){
					require '../admin/admin_page/top_nav.php';
				}else{
					require 'member_page/top_nav.php';
				}
				 ?>
			<div class="container-fluid pt-3">
				<?php require 'body.php'; ?>
			</div>
		</div>
	</div>

	<?php require 'footer.php'; ?>
</body>
</html>
