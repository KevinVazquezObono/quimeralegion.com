<?php
	class System_Web_Wallet
	{
		public function check(string $id, string $owner)
		{
			$trx = new System_Web_Transaccion();
			$link = $trx->link();
			if ($link->query("SELECT idwallet FROM Quimeralegion.wallets WHERE idwallet = '".$id."' AND owner = '".$owner."'"))
			{
				return TRUE;
			}
			else
			{
				$link->query("INSERT INTO Quimeralegion.wallets (idwallet, owner, QLS, QLT, status) VALUES ('".$id."', '".$owner."', 0, 0, 'cold')");
				return TRUE;
			}
			return FALSE;
		}
		public function wallet(string $id, string $owner)
		{
			if ($this->check($id, $owner) === FALSE)
			{
				return "";
			}
			$html = new System_Web_HTML();
			$trx = new System_Web_Transaccion();
			$link = $trx->link();
			foreach ($link->query("SELECT idwallet, owner, QLS, QLT FROM Quimeralegion.wallets WHERE idwallet = '".$id."' ORDER BY idwallet DESC LIMIT 1") as $wallet)
			{
				$id = $wallet['idwallet'];
				$owner = $wallet['owner'];
				$QLS = $wallet['QLS'];
				$QLT = $wallet['QLT'];
				$html->push($html->br($id));
				$html->push($html->br("$QLS (QLS)"));
				$html->push($html->br("$QLT (QLT)"));
			}
			echo ($html->bloq("Billetera <i>$owner</i>", $html->p($html->outcome()),"tokkens"));
		}
		public function buyqls()
		{
			$html = new System_Web_HTML();
			$html->push($html->form("https://quimeralegion.com/index.php?BUYCOIN=1"));
			$html->push($html->label("botqls", "10 QLS"));
			$html->push($html->submit("botqls", "precio 9,99 €"));
			$html->push($html->label("lowqls", "20 QLS"));
			$html->push($html->submit("lowqls", "precio 14,99 €"));
			$html->push($html->label("midqls", "50 QLS"));
			$html->push($html->submit("midqls", "precio 29,99 €"));
			$html->push($html->label("topqls", "110 QLS"));
			$html->push($html->submit("topqls", "precio 59,99 €"));
			$html->push($html->p("Los pagos pueden tardar en validarse hasta 24 horas"));
			$html->bloq("Compre QLS", $html->outcome()."</form>", "tienda");
		}
		public function buyqlt()
		{
			$html = new System_Web_HTML();
			$html->push($html->form("https://quimeralegion.com/index.php?BUYCOIN=1"));
			$html->push($html->label("botqlt", "1 QLS"));
			$html->push($html->submit("botqlt", "precio 1000 QLT"));
			$html->push($html->label("lowqlt", "2 QLS"));
			$html->push($html->submit("lowqlt", "precio 2000 QLT"));
			$html->push($html->label("midqlt", "5 QLS"));
			$html->push($html->submit("midqlt", "precio 5000 QLT"));
			$html->push($html->label("topqlt", "10 QLS"));
			$html->push($html->submit("topqlt", "precio 9999 QLT"));
			$html->push($html->p("Los pagos pueden tardar en validarse hasta 24 horas"));
			$html->bloq("Compre QLS", $html->outcome()."</form>", "tienda");
		}
		public function main()
		{
			if (isset($_POST['MKEY']))
			{
				$key = $_POST['MKEY'];
			}
			if (isset($_POST['MAIL']))
			{
				$mail = $_POST['MAIL'];
			}
			if (isset($_POST['PASS']))
			{
				$pass = $_POST['PASS'];
			}
			$trx = new System_Web_Transaccion();
			$link = $trx->link();
			foreach ($link->query("SELECT idql, nick, pass, level FROM Quimeralegion.usuarios WHERE nick = '".$mail."' AND pass = '".$pass."'") as $user)
			{
				$this->wallet($user['idql'], $user['nick']);
			}
		}
	}
?>
