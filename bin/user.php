<?php
	class System_Web_User
	{
		public array $user = [
			'idql' => "",
			'cpt' => "",
			'user' => ""
		];
		public function info()
		{
			$html = new System_web_HTML();
			$user = $this->user;
			$nick = $user['user'];
			$wallet = $user['idql'];
			echo ($html->bloq("Session", $html->p($html->br("Billetera: $wallet")."usuario: $nick"), 'sesion'));
		}
		public function balance()
		{
			if (isset($this->user['idql']))
			{
				$idql = $this->user['idql'];
				$trx = new System_Web_Transaccion();
				$link = $trx->link();
				foreach ($link->query("SELECT * FROM Quimeralegion.wallets WHERE idwallet = '".$idql."'") as $wallet)
				{
					$qls = $wallet['QLS'];
					$qlt = $wallet['QLT'];
					echo($html->bloq("Billetera", $html->p($html->br("$qls (QLS)")."$qlt (QLT)"), 'usuario'));
				}
			}
		}
		public function main(string $user, string $pass, string $k)
		{
			$n = base64_decode($user);
			$p = base64_decode($pass);
			$trx = new System_Web_Transaccion();
			$link = $trx->link();
			foreach ($link->query("SELECT * FROM Quimeralegion.usuarios WHERE nick = '".$n."' AND pass = '".$p."' AND captcha = '".$k."' ORDER BY level DESC LIMIT 1") as $log)
			{
				$this->user = [
					'idql' => $log['idql'],
					'cpt' => $log['captcha'],
					'user' => $log['nick']
				];
			}
			$this->info();
			$this->balance();
		}
	}
?>