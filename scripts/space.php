<?php
	switch ($_SERVER['HTTP_ORIGIN'] ?? '')
	{
		case "http://utorrent.devonhess.org":
		case "http://devonhess.org:54173":
		case "http://127.0.0.1:54173":
			header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
	}
	
	if (isset($_GET["d"])) {
		$drive = $_GET["d"] . ':';
	} else {
		$drive = '/';
	}

	function ff($bytes, $decimals = 2)
	{
		$size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
		$factor = floor((strlen($bytes) - 1) / 3);
		return [sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) , $size[$factor]];
	}
	
	$obj = new stdClass();
	$obj->free = disk_free_space($drive);
	$obj->freeFormated = ff($obj->free);
	$obj->total = disk_total_space($drive);
	$obj->totalFormated = ff($obj->total);
	$obj->used = $obj->total - $obj->free;
	$obj->usedFormated = ff($obj->used);
	$obj->percent = $obj->used / $obj->total;
	$obj->percentFormated = round($obj->used / $obj->total * 100);
	echo json_encode($obj);
?>
