<?php
	$tmp = $_FILES['upload']['tmp_name'];
	$name = $_FILES['upload']['name'];
	for ($i = 0; $i < count($tmp); $i++)
	{
		if (file_exists($tmp[$i]) && !file_exists('../' . $name[$i]) && !in_array($name[$i], array(".htaccess", "index.php", "scripts", "readme.html")))
		{
			move_uploaded_file($tmp[$i], '../' . $name[$i]);
		}
		header('Location: ..');
	}
?>
