<?php
$path = 'pt-uploads/dog-win.gif';
if(file_exists($path)){
	$size = getimagesize($path);
	list($width, $height) = $size;
	$mime=$size['mime'];
	//echo $mime;
	$newwidth = 200;
	$newheight = 150;
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	switch($mime){
		case 'image/jpeg':
			header('Content-type: image/jpeg');
			$source = imagecreatefromjpeg($path);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagejpeg($thumb,NULL,90);
		break;
		case 'image/png':
			header('Content-type: image/png');
			$source = imagecreatefrompng($path);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagepng($thumb);
		break;
		case 'image/gif':
			header('Content-type: image/gif');
			$source = imagecreatefromgif($path);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagegif($thumb);
		break;
		default:
			header("Content-type: image/png");
			$im = @imagecreate(200, 150)
				or die("Cannot Initialize new GD image stream");
			$background_color = imagecolorallocate($im, 239, 239, 239);
			$text_color = imagecolorallocate($im, 0, 0, 0);
			imagestring($im, 10, 60, 60,  "Invalid Format!", $text_color);
			imagepng($im);
			imagedestroy($im);
		break;
	}
}else{
	header("Content-type: image/png");
	$im = @imagecreate(200, 150)
		or die("Cannot Initialize new GD image stream");
	$background_color = imagecolorallocate($im, 239, 239, 239);
	$text_color = imagecolorallocate($im, 0, 0, 0);
	imagestring($im, 10, 60, 60,  "No Image!", $text_color);
	imagepng($im);
	imagedestroy($im);
}
?>
