<body>
	<?php require 'navigation.php'; ?>
	<?php 
	$content = (isset($_GET["page"])) ? $_GET["page"] : "";
	switch ($content) {
		case 'about':
			require 'content/about.php';
			break;
		case 'contact':
			require 'content/contact.php';
			break;
		case 'register':
			require 'content/register.php';
			break;
		default:
			require 'content/homepage.php';
			break;
	}
	 ?>
	<div class="box"></div>
	<?php require 'footer.php'; ?>
</body>