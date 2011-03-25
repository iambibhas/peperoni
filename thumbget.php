<?php
$filename = 'pt-uploads/2sbev.jpg';
header('Content-type: image/jpeg');
list($width, $height) = getimagesize($filename);
$newwidth = 200;
$newheight = 150;
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
imagejpeg($thumb,NULL,90);
?>
