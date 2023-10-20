<?php
	class System_Web_Hosting
	{
		public string $id;
		public string $pag;
		public string $user;
		public string $pass;
		public function update()
		{
			if (isset($_POST['MAIL']))
			{
				$this->user = $_POST['MAIL'];
			}
			if (isset($_POST['PASS']))
			{
				$this->pass = $_POST['PASS'];
			}
			$trx = new System_Web_Transaccion();
			$link = $trx->link();
			$this->id = $link->query("SELECT idql FROM Quimeralegion.usuarios WHERE nick = '".$this->user."' AND pass = '".$this->pass."'");
		}
		public function new_webhost()
		{
			$html = new System_Web_HTML();
			$html->push($html->form("https://quimeralegion.com/index.php?CONNECT=1"));
			$html->push($html->label("title", "Escriba un título:"));
			$html->push($html->input("title", "text", 'required'));
			$html->push($html->label("domain", "Nombre de dominio:"));
			$html->push($html->input("domain", "text", 'required'));
			$html->push($html->submit());
			echo ($html->bloq("Nueva Pagina",$html->outcome()."</form>","editor"));
		}
		public function edit(string $domain)
		{
			$trx = new System_Web_Transaccion();
			$link = $trx->link();
			$html = new System_Web_HTML();
			$html->push($html->form("https://quimeralegion.com/index.php?CONNECT=1"));
			$html->push($html->label("title", "Titulo de su página:"));
			$title = $link->query("SELECT title FROM Quimeralegion.qlpages WHERE iduser = '".$this->id."' AND domain = '".$domain."'");
			$html->push($html->input("title", "text", 'value="'.$title.'" required'));
			$html->push($html->label("domain", "Nombre de dominio:"));
			$html->push($html->input("domain", "text", 'value="'.$domain.'" required'));
			$title = base64_decode($link->query("SELECT head FROM Quimeralegion.qlpages WHERE iduser = '".$this->id."' AND domain = '".$domain."'"));
			$html->push('<textarea name="head" value="'.$head.'"></textarea>');
			$title = base64_decode($link->query("SELECT body FROM Quimeralegion.qlpages WHERE iduser = '".$this->id."' AND domain = '".$domain."'"));
			$html->push('<textarea name="body" value="'.$body.'"></textarea>');
			$html->push($html->submit());
			echo ($html->bloq("Editor html", $this->outcome()."</form>", "editor"));
		}
		public function save(string $domain = null)
		{
			$trx = new System_Web_Transaccion();
			$link = $trx->link();
			if (isset($_POST['title'])) { $title = $_POST['title']; }
			if (isset($_POST['head']))
			{
				$head = base64_encode($_POST['head']);
				$link->query("UPDATE Quimeralegion.qlpages SET head = '".$head."' WHERE iduser = '".$this->id."' AND domain = '".$domain."'");
 			}
			if (isset($_POST['body']))
			{
				$body = base64_encode($_POST['body']);
				$link->query("UPDATE Quimeralegion.qlpages SET body = '".$body."' WHERE iduser = '".$this->id."' AND domain = '".$domain."'");
			}
		}
		public function create(string $title, string $domain = null)
		{
			$str = "qwer6ty8uiopas7dfghjklzx5cvbnmQW4ERTYU9IOPAS3DFGHJKLZ2XCVBN1M";
			$pag = "";
			while (strlen($pag)<64)
			{
				$r = rand(0, strlen($str) - 1);
				$pag = $pag.$str[$r];
			}
			$trx = new System_Web_Transaccion();
			$link = $trx->link();
			$link->query("INSERT INTO Quimeralegion.qlpages (idpag, iduser, title, domain) VALUES ('".$pag."', '".$this->id."', '".$title."', '".$domain."')");
		}
	}
?>
