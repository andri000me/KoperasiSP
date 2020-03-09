 <?php 
$role = $_SESSION['role'];
$user = $_SESSION['username'];
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background: #A35E26;">
	<button class="btn mr-3" id="menu-toggle" style='background: #7A471D'><i class="fas fa-align-left text-white"></i></button>
	<a href="#" class="navbar-brand">Koperasi Simpan Pinjam - <b><?= strtoupper($role) ?></b></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon text-white"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle active" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user color-white m-1"></i> <?= $user ?></a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a href="logout.php" class="dropdown-item">Keluar</a>
				</div>
			</li>
		</ul>
	</div>
</nav>