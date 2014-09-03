<?php
	$type = isset($_GET['type']) ? (string)$_GET['type'] : "";
	if(isset($_GET['src'])){
		$src=$_GET['src'];
		if($src==""){
			$src="notfound.jpg";
		}
	}else
		$src="notfound.jpg";
	$new_src=md5($src);
	$source_image = imagecreatefromjpeg($src);
	$source_imagex = imagesx($source_image);
	$source_imagey = imagesy($source_image);
	$h=600;
	$w=600;
	if($type=="Super Nintendo (SNES)"){
		$w=600;
		$h=440;
	}elseif($type=="Sony Playstation 2"){
		$w=357;
		$h=484;
	}
	
	$dest_imagex = $w;
	$dest_imagey = $h;
	$dest_image = imagecreatetruecolor($dest_imagex, $dest_imagey);

	imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, $dest_imagex, 
				$dest_imagey, $source_imagex, $source_imagey);
	
	header("Content-Type: image/jpeg");
	imagejpeg($dest_image,NULL,80);
	imagedestroy($dest_image);
?>