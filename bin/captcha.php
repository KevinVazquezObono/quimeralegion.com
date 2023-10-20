<?php
	class System_Web_Captcha
	{
		public $id;
		
		public function captcha($id, $app = null)
		{
			include '../class/trans.php';
			$trx = new System_Web_Transaccion();
			$code = rand(1,9) * 10;
			$hash = base64_encode($code);
			$idqlt = $trx->start($id, 'SystemHumanValidator', 'HVx', $app);
			$trx->run($id, 'HUMANVALIDATION', 'HUMANVALIDATION GENERATED CAPTCHA CARBONE PROVE', $hash);
			return $code * 10;
		}
	}
	$load = new System_Web_Captcha();
	$captcha = $load->captcha($_GET['idql'], $_GET['app']);
	header("Content-Type: image/png");
	$img = imagecreatetruecolor(1000, 16);
	$background_color = imagecolorallocate($img, 254, 0, 0);
	$range = imagecolorallocate($img, 254, 128, 0);
	$i = 1; $line = [];
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	$line[] = imageline($img, 0, $i, $captcha, $i, $range); $i = $i + 1;
	imagepng($img);
	imagedestroy($img);
?>
