<head>
	<title>Halaman Admin</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/simple-sidebar.css">
	<?php if(isset($_SESSION['role'])): ?>
		<?php if($_SESSION['role'] == 'admin'): ?>
			<link rel="stylesheet" type="text/css" href="css/admin.css">
		<?php else: ?>
			<link rel="stylesheet" type="text/css" href="css/member.css">
		<?php endif ?>
	<?php endif ?>
</head>