<?php
	$files = json_decode($_GET["f"]);
	for ($i = 0; $i < count($files); $i++)
	{
		if (!is_dir('../' . $files[$i]) && !in_array($files[$i], array(".htaccess", "delete.php", "readme.html", "space.php", "upload.php")))
		{
			unlink('../' . basename(rawurldecode($files[$i])));
		}
	}
	header('Location: ..');
?>