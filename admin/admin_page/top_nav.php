<?php 
$role = $_SESSION['role'];
$user = $_SESSION['username'];
?>

<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
	<button class="btn mr-3" id="menu-toggle" style='background: #0050A6'><i class="fas fa-align-left text-white"></i></button>
	<a href="#" class="navbar-brand">Koperasi Simpan Pinjam - <b><?= strtoupper($role) ?></b></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
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