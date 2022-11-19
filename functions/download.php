<?php
  include_once("helper.php");
  include_once("connection.php");

	if(ISSET($_REQUEST['image'])){
		// $exp=explode("/", $_REQUEST['image']);
		// $image=$exp[1];
    $image = $_REQUEST['image'];
		
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=".basename($image));
		header("Content-Type: application/octet-stream;");
		header("Content-Transfer-Encoding: binary");
		// readfile("uploads/".$image);
    readfile("../Assets/evidence/" . $image);
	}
?>