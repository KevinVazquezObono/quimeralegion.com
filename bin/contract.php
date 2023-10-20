<?php
	class System_Web_Contracts
	{
		public string $idctr = "";
		public array $server = array(
			'name' => "",
			'ndoc' => "",
			'addr' => "",
			'telf' => 0
		);
		public array $client = array(
			'name' => "",
			'ndoc' => "",
			'addr' => "",
			'telf' => 0
		);
		public string $type = "";
		public string $content = "";
		public function load_head(string $contract)
		{
			include "tmp/$contract.hctt.php";
			return new Contract_Head();
		}
		public function save_head(string $contract)
		{
			unlink("tmp/$contract.hctt.php");
			$headers = fopen("contracts/$contract.hctt.php", "w");
			fwrite($headers, "<?php\n");
			fwrite($headers, "\tclass Contract_Head\n");
			fwrite($headers, "\t{\n");
			fwrite($headers, "\t\tpublic string \$idctr = '$this->idctr';\n");
			fwrite($headers, "\t\tpublic string \$type = '$this->type';\n");
			fwrite($headers, "\t\tpublic array \$server = array(\n");
			fwrite($headers, "\t\t\t'name' => '".$this->server['name']."';\n");
			fwrite($headers, "\t\t\t'ndoc' => '".$this->server['ndoc']."';\n");
			fwrite($headers, "\t\t\t'telf' => '".$this->server['telf']."';\n");
			fwrite($headers, "\t\t\t'addr' => '".$this->server['addr']."';\n");
			fwrite($headers, "\t\t);\n");
			fwrite($headers, "\t\tpublic array \$client = array(\n");
			fwrite($headers, "\t\t\t'name' => '".$this->client['name']."';\n");
			fwrite($headers, "\t\t\t'ndoc' => '".$this->client['ndoc']."';\n");
			fwrite($headers, "\t\t\t'telf' => '".$this->client['telf']."';\n");
			fwrite($headers, "\t\t\t'addr' => '".$this->client['addr']."';\n");
			fwrite($headers, "\t\t);\n");
			fwrite($headers, "\t}\n");
			fwrite($headers, "?>");
			fclose($headers);

		}

		public function kill_term(int $index, string $contract)
		{
			shell_exec("rm tmp/$contract.$index.tctt.php");
		}

		public function load_term(int $index, string $contract)
		{
			include "tmp/$contract.$index.tctt.php";
			return new Contract_Term();
		}
		public function save_term(int $index, string $contract, string $content, string $tit = null)
		{
			unlink("tmp/$contract.$index.tctt.php");
			$term = fopen("contracts/$contract.$index.tctt.php");
			if (isset($tit))
			{
				fwrite($term, "<?php\n");
				fwrite($term, "\tclass Contract_Term");
				fwrite($term, "\t{");
				fwrite($term, "\t\tpublic string \$content = '<article><h5>$tit</h5><p>$content</p></article>';");
				fwrite($term, "\t}");
				fwrite($term, "?>");
				fclose($term);
			}
			else
			{
				fwrite($term, "<?php\n");
				fwrite($term, "\tclass Contract_Term");
				fwrite($term, "\t{");
				fwrite($term, "\t\tpublic string \$content = '<article><p>$content</p></article>';");
				fwrite($term, "\t}");
				fwrite($term, "?>");
				fclose($term);
			}
		}
		public function add_term(string $contract, string $content, string $tit = null)
		{
			$index = 0;
			while (is_file("tmp/$contract.$index.tctt.php"))
			{
				$index = $index + 1;
			}
			$term = fopen("contracts/$contract.$index.tctt.php");
			if (isset($tit))
			{
				fwrite($term, "<?php\n");
				fwrite($term, "\tclass Contract_Term");
				fwrite($term, "\t{");
				fwrite($term, "\t\tpublic string \$content = '<article><h5>$tit</h5><p>$content</p></article>';");
				fwrite($term, "\t}");
				fwrite($term, "?>");
				fclose($term);
			}
			else
			{
				fwrite($term, "<?php\n");
				fwrite($term, "\tclass Contract_Term");
				fwrite($term, "\t{");
				fwrite($term, "\t\tpublic string \$content = '<article><p>$content</p></article>';");
				fwrite($term, "\t}");
				fwrite($term, "?>");
				fclose($term);
			}
		}

		public function save_contract(string $contract)
		{
			$head = $this->load_head($contract);
			$this->idctr = $head->idctr;
			$this->type = $head->type;
			$this->server['name'] = $head->server['name'];
			$this->server['ndoc'] = $head->server['ndoc'];
			$this->server['addr'] = $head->server['addr'];
			$this->server['telf'] = $head->server['telf'];
			$this->client['name'] = $head->client['name'];
			$this->client['ndoc'] = $head->client['ndoc'];
			$this->client['addr'] = $head->client['addr'];
			$this->client['telf'] = $head->client['telf'];
			$save = fopen("contracts/$contract.ctt.php", "w");
			fwrite($save, "<?php\n");
			fwrite($save, "\tclass Contract\n");
			fwrite($save, "\t{\n");
			fwrite($save, "\t\tpublic string \$idctr = '$this->idctr'\n");
			fwrite($save, "\t\tpublic string \$type = '$this->type'\n");
			fwrite($save, "\t\tpublic array \$server = array(\n");
			fwrite($save, "\t\t\t'name' => '".$this->server['name']."';\n");
			fwrite($save, "\t\t\t'ndoc' => '".$this->server['ndoc']."';\n");
			fwrite($save, "\t\t\t'telf' => '".$this->server['telf']."';\n");
			fwrite($save, "\t\t\t'addr' => '".$this->server['addr']."';\n");
			fwrite($save, "\t\t);\n");
			fwrite($save, "\t\tpublic array \$client = array(\n");
			fwrite($save, "\t\t\t'name' => '".$this->client['name']."';\n");
			fwrite($save, "\t\t\t'ndoc' => '".$this->client['ndoc']."';\n");
			fwrite($save, "\t\t\t'telf' => '".$this->client['telf']."';\n");
			fwrite($save, "\t\t\t'addr' => '".$this->client['addr']."';\n");
			fwrite($save, "\t\t);\n");
			fwrite($save, "\t\tpublic array \$terms = array(\n");
			fwrite($save, "\t\t\n''\t");
			fclose($save);
			unlink("tmp/$contract.hctt.php");
			$i = 0;
			while (is_file("tmp/$contract.$i.tctt.php") === TRUE)
			{
				
				$term = $this->load_term($i, $contract);
				$save = fopen("contracts/$contract.ctt.php", "a");
				fwrite($save, ",\n\t\t\t'".$term->content."'");
				fclose($save);
				unlink("tmp/$contract.$index.tctt.php");
				$i = $i + 1;
			}
			$save = fopen("contracts/$contract.ctt.php", "a");
			fwrite($save, "\t\t);\n");
			fwrite($save, "\t}\n");
			fwrite($save, "?>\n");
			fclose($save);
		}
		public function type()
		{
			$trx = new System_Web_Transaccion();
			$sesion = $trx->start($this->owner, 'quimeralegion', "$this->idctr", "SystemWebContract");
			$html = new System_Web_HTML();
			$html->push($html->form("index.php?CONTRACTS"));
			$html->push($html->label("Tipo de Contrato", "ctpye"));
			$html->push($html->input("ctpye", "text", 'required'));
			$html->push($html->submit("TypeContract"));
			echo ($html->bloq("Generar Contrato",$html->outcome().'</form>', 'contracts'));
			$html->destroy();
		}
		public function server()
		{
			$html = new System_Web_HTML();
			$html->push($html->form("index.php?CONTRACTS"));
			$html->push($html->label("Nombre", "sname"));
			$html->push($html->input("sname", "text", 'required'));
			$html->push($html->label("Documento", "ndoc"));
			$html->push($html->s("tydoc", 'required', ["CIF", "NIF", "PASAPORTE"]));
			$html->push($html->input("ndoc", "text", 'required'));
			$html->push($html->label("Dirección", "addr"));
			$html->push($html->input("addr", "text", 'required'));
			$html->push($html->label("Teléfono", "ntelf"));
			$html->push($html->input("ntelf", "number", 'required'));
			$html->push($html->submit("ServerContract"));
			echo ($html->bloq("Emisor del contrato",$html->outcome().'</form>', 'contracts'));
			$html->destroy();
		}
		public function server()
		{
			$html = new System_Web_HTML();
			$html->push($html->form("index.php?CONTRACTS"));
			$html->push($html->label("Nombre", "sname"));
			$html->push($html->input("sname", "text", 'required'));
			$html->push($html->label("Documento", "ndoc"));
			$html->push($html->s("tydoc", 'required', ["CIF", "NIF", "PASAPORTE"]));
			$html->push($html->input("ndoc", "text", 'required'));
			$html->push($html->label("Dirección", "addr"));
			$html->push($html->input("addr", "text", 'required'));
			$html->push($html->label("Teléfono", "ntelf"));
			$html->push($html->input("ntelf", "number", 'required'));
			$html->push($html->submit("ClientContract"));
			echo ($html->bloq("Cliente del contrato",$html->outcome().'</form>', 'contracts'));
			$html->destroy();
		}
		public function main()
		{
			if (isset($_POST['TypeContract']) && isset($_POST["ctpye"]))
			{
				$this->type = $_POST['ctpye'];
				$this->server();
			}
			elseif(isset($_POST['ServerContract']))
			{
				$this->server = array(
					'name' => $_POST['sname'],
					'ndoc' => $_POST['tydoc']."-".$_POST['ndoc'],
					'addr' => $_POST['addr'],
					'telf' => $_POST['ntelf']
				);
				$this->client();
			}
			elseif (isset($_POST['ClientContract']))
			{
				$this->client = array(
					'name' => $_POST['sname'],
					'ndoc' => $_POST['tydoc']."-".$_POST['ndoc'],
					'addr' => $_POST['addr'],
					'telf' => $_POST['ntelf']
				);
				$this->idctr = date("YmdHis").substr(explode(" ", microtime())[0], 2, 4);
				$this->save_head($this->idctr);
				$trx = new System_Web_Transaccion();
				$head = base64_encode("contracts/$this->idctr.hctt.php");
				$body = base64_encode($this->type);
				$cp = $trx->transaccion($this->idctr, $sesion, "SystemWebContracts", "SystemWebContracts::Contract_Head", $head, $body);
				$sesion = $trx->start("SystemWebContracts","SystemWebContracts", "CTTx", 'SystemWebContracts');
				$html = new System_Web_HTML();
				$html->push($html->form("index.php?LOGIN"));
				$html->push($html->input("ID", "hidden", 'value="'.$sesion.'" required'));
				$html->push($html->input("ID", "text", 'value="'.$sesion.'" disabled required'));
				$html->push($html->label("Usuario", "MAIL"));
				$html->push($html->input("MAIL", "email", 'required'));
				$html->push($html->label("Contraseña", "PASS"));
				$html->push($html->input("PASS", "password", 'required'));
				$html->push($html->captcha($sesion));
				$html->push($html->submit("VoteBlock"));
				echo ($html->bloq("Inicie Sesion", $html->outcome().'</form>', 'explore'));
				$html->destroy();
			}
			elseif (isset($_POST['INICIO']) || isset($_POST['ctpye']) === FALSE)
			{
				$this->type();
			}
		}
	}
?>