<?php
	if (isset($_GET['V']))
	{
		$imagen = imagecreatetruecolor(512, 32);
	}
	else
	{
		$imagen = imagecreatetruecolor(512, 32);
	}
	$r = 0;
	if (isset($_GET['r']))
	{
		$r = $_GET['r'];
	}
	else
	{
		$r = rand(0,255);
	}
	$v = 0;
	if (isset($_GET['v']))
	{
		$v = $_GET['v'];
	}
	else
	{
		$v = rand(0,255);
	}
	$b = 0;
	if (isset($_GET['b']))
	{
		$b = $_GET['b'];
	}
	else
	{
		$b = rand(0,255);
	}
	$size = 1;
	if (isset($_GET['size']))
	{
		$size = round(512 * $_GET['size'] / 100, 0);
	}
	if ($size < 1)
	{
		$size = 1;
	}
	if ($size > 512)
	{
		$size = 512;
	}
	$color = imagecolorallocate($imagen, $r, $v, $b);
	imagefilledrectangle($imagen, 0, 0, $size, 32, $color);
	header('Content-type: image/png');
	imagepng($imagen);
	imagedestroy($imagen);
?>
