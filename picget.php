<?php
/*
 *      picget.php
 *
 *      Copyright 2011 Bibhas Ch Debnath <bibhas@localhost>
 */

include 'functions.php';
if(isset($_GET['slug']) && !empty($_GET['slug'])){
	$slug=$_GET['slug'];

	$path=get_path_from_slug($slug);

	if(!file_exists($path)){
		header("Content-type: image/png");
		$im = @imagecreate(400, 300)
			or die("Cannot Initialize new GD image stream");
		$background_color = imagecolorallocate($im, 239, 239, 239);
		$text_color = imagecolorallocate($im, 0, 0, 0);
		imagestring($im, 10, 90, 130,  "Image file doesn't Exist", $text_color);
		imagepng($im);
		imagedestroy($im);
	}else{
		$size=getimagesize($path);
		$image_mime=$size['mime'];
		switch($image_mime){
			case 'image/jpeg':
				$im = imagecreatefromjpeg($path);
				header('Content-type: image/jpeg');
				imagejpeg($im, NULL, 100);
			break;
			case 'image/gif':
				$im = imagecreatefromgif($path);
				header('Content-type: image/gif');
				imagegif($im);
			break;
			case 'image/png':
				$im = imagecreatefrompng($path);
				header('Content-type: image/png');
				imagepng($im, NULL, 0);
			break;
			default:
				header("Content-type: image/png");
				$im = @imagecreate(300, 300)
					or die("Cannot Initialize new GD image stream");
				$background_color = imagecolorallocate($im, 255, 255, 255);
				$text_color = imagecolorallocate($im, 0, 0, 0);
				imagestring($im, 10, 50, 50,  "Image file doesn't Exist", $text_color);
				imagepng($im);
				imagedestroy($im);
			break;
		}
		// Free up memory
		imagedestroy($im);
	}
}else{
}

?>
