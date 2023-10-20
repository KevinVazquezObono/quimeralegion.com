<?php
$alto = 512;
$ancho = 512;
$radio = 256;
$imagen = imagecreatetruecolor(512, 512);
$angulo = 2;
$colorFondo = imagecolorallocatealpha($imagen, 255, 255, 255, 127);
$colorBorde = imagecolorallocatealpha($imagen, 0, 0, 0, 0);
$colorSector = imagecolorallocatealpha($imagen, rand(200,255), rand(30,80), 0, 0);
$colorCirculo = imagecolorallocatealpha($imagen, rand(0,32), rand(0,32), rand(0,32), 0);
imagefilledellipse($imagen, 256, 256, 512, 512, $colorCirculo);
if (isset($_GET['a']))
{
	$angulo = deg2rad($_GET['a']);
}
imageellipse($imagen, 256, 256, 500, 500, $colorBorde);
imagefilledellipse($imagen, 256, 240, 500, 500, $colorCirculo);
imagefilledarc($imagen, 256, 256, 500, 500, rad2deg(deg2rad(0)), rad2deg($angulo), $colorSector, IMG_ARC_PIE);
imagefilledellipse($imagen, 256, 240, 500, 500, $colorCirculo);
imageellipse($imagen, 256, 256, 500, 500, $colorCirculo);
imagefilledarc($imagen, 256, 240, 500, 500, rad2deg(deg2rad(0)), rad2deg($angulo), $colorSector, IMG_ARC_PIE);

// Indicar que el tipo de contenido de la respuesta será una imagen PNG
header('Content-Type: image/png');

// Generar la imagen y enviarla al navegador
imagepng($imagen);

// Liberar memoria
imagedestroy($imagen);
?>
