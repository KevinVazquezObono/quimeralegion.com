<?php
	class System_Web_BlockChain
	{
		public array $chain = array(
			'name' => "",
			'localhost' => 'localhost',
			'this_hash' => 0,
			'last_hash' => 0,
			'length' => 0
		);
		public array $block = array(
			'index' => 0,
			'hash' => "",
			'last' => "",
			'timestamp' => "",
			'transactions' => [],
			'proof' => "FALSE"
		);

		public function proof(int $n, int $z = 0)
		{
			$pi = 0;
			$proof = ($n ** 2 + $z ** 2) ** 1/2;
			for ($i = 0; $i < $n; $i++)
			{
				$pi += ((-1) ** $i) / (2 * $i + 1);
			}
			$proof = $proof * $pi;
			return hash("sha256", $proof);
		}

		public function dtm()
		{
			return date("Ymd:His:").substr(explode(" ", microtime())[0], 2, 4);
		}

		public function block(string $chain)
		{
			$this->block['index'] = 0;
			$delete = ['', ' '];
			$html = new System_Web_HTML();
			$trx = new System_Web_Transaccion();
			if (is_dir("blockchain/$chain"))
			{
				$this->block['index'] = 0;
				$this->block['hash'] = $this->proof($this->block['index'], $this->block['index'] - 1);
				$this->block['last'] = $this->proof($this->block['index'] - 1);
				$this->block['timestamp'] = $this->dtm();
				$this->block['transactions'] = [];
				$this->block['proof'] = "TRUE";
				$save_block = fopen("blockchain/$chain/0.block.php", "w");
				fwrite($save_block, "<?php\n");
				fwrite($save_block, "\tclass Block\n");
				fwrite($save_block, "\t{\n");
				fwrite($save_block, "\t\tpublic int \$index = ".$this->block['index'].";\n");
				fwrite($save_block, "\t\tpublic string \$hash = '".$this->block['hash']."';\n");
				fwrite($save_block, "\t\tpublic string \$last = '".$this->block['last']."';\n");
				fwrite($save_block, "\t\tpublic array \$transactions = array();\n");
				fwrite($save_block, "\t\tpublic string \$timestamp = '".$this->block['timestamp']."';\n");
				fwrite($save_block, "\t\tpublic string \$proof = '".$this->block['proof']."';\n");
				fwrite($save_block, "\t}\n?>");
				fclose($save_block);
				$eula = fopen("blockchain/$chain/eula.txt", "w");
				fwrite($eula, "eula=FALSE");
				fclose($eula);
			}
			else
			{
				mkdir("blockchain/$chain");
				$this->block($chain);
			}
			while (is_file("blockchain/$chain/".$this->block['index'].".block.php") === TRUE)
			{
				$this->block['index'] = $this->block['index'] + 1;
				$this->block['hash'] = $this->proof($this->block['index']);
				$this->block['last'] = $this->proof($this->block['index'] - 1);
				$this->block['timestamp'] = $this->dtm();
			}
			$save_block = fopen("blockchain/$chain/".$this->block['index'].".block.php", "w");
			fwrite($save_block, "<?php\n");
			fwrite($save_block, "\tclass Block");
			fwrite($save_block, "\t{");
			fwrite($save_block, "\t\tpublic int index = ".$this->block['index'].";\n");
			fwrite($save_block, "\t\tpublic string hash = '".$this->block['hash']."';\n");
			fwrite($save_block, "\t\tpublic string last = '".$this->block['last']."';\n");
			fwrite($save_block, "\t\tpublic array transactions = array(\n");
			fwrite($save_block, "\t\t\tarray('idqlt' => '' , 'sendtime' => '', 'fixaction' => '', 'fixtime' => '', 'confirmation' => '', 'endtime' => '', 'subject' => '', 'head' => '','body' => '')");
			$link = $trx->link();
			foreach($link->query("SELECT * FROM Quimeralegion.transacciones WHERE idclient = '".$chain."' GROUP BY idclient ORDER BY sendtime ASC LIMIT 500") as $t)
			{
				fwrite($save_block, ",\n");
				fwrite($save_block, "\t\t\tarray('idqlt' => '".$t['idqlt']."', 'sendtime' => '".$t['sendtime']."', 'fixaction' => '".$f['fixaction']."', 'fixtime' => '".$t['fixtime']."', 'confirnation' => '".$t['confirmation']."', 'endtime' => '".$t['endtime']."', 'subject' => '".$t['subject']."', 'head' => '".$t['head']."', 'body' => '".$t['body']."')");
			}
			fwrite($save_block, "\t\t);\n");
			fwrite($save_block, "\t\tpublic string \$timestamp = '".$this->block['timestamp']."';\n");
			fwrite($save_block, "\t\tpublic string \$proof = 'FALSE';\n");
			fclose($save_block);
		}
		public function form()
		{
			$html = new System_Web_HTML();
			$trx = new System_Web_Transaccion();
			$html->push($html->form("https://quimeralegion.com/index.php?BLOCK=1"));
			$chains = [];
			$link = $trx->link();
			foreach ($link->query("SELECT DISTINCT(idclient), COUNT(idclient) AS ammo FROM Quimeralegion.transacciones GROUP BY idclient ORDER BY ammo DESC") as $chain)
			{
				$chains[] = $chain['idclient'];
			}
			$html->push($html->s("chain", null, $chains));
			$html->push($html->submit());
			echo ($html->bloq("Seleccionar cadena de bloques",$html->outcome()."</form>"));
			$html->destroy();
		}
		public function createBlock(string $chain)
		{
			$this->block($chain);
			$i = $this->block['index'];
			include "blockchain\$chain\$i.block.php";
			$block = new Block();
			echo ('<article><h5>'.$chain.' Bloque (#'.$block['index'].')</h5><p>index: '.$block['index'].'<br />hash: '.$block['hash'].'<br />last: '.$block['last'].'<br />timestamp: '.$block['timestamp'].'<br /></p></article>');
			$tab = "<th>pid</th><th>send</th><th>task</th><th>update</th><th>complete</th><th>end</th><th>subject</th><th>head</th><th>body</th>";
			foreach($block['transactions'] as $t)
			{
				$tab = $tab."<tr /><td>".$t['idqlt']."</td><td>".$t['sendtime']."</td><td>".$t['fixaction']."</td><td>".$t['fixtime']."</td><td>".$t['confirmation']."</td><td>".$t['endtime']."</td><td>".$t['subject']."</td>";
			}
			echo ("<article><table>$tab</table></article>");
		}
		public function main()
		{
			$html = new System_Web_HTML();
			if (isset($_POST['chain']))
			{
				$html->push($html->bloq("Espere", "Se estan realizando operaciones en segundo plano por favor espere sin cerrar la ventana."));
				$this->createBlock($_POST['chain']);
				$html->push($html->bloq("Finalizado", "La operacion se ha realizado con éxito, ya puede cerrar esta ventana."));
			}
			else
			{
				$this->form();
			}
		}
	}
?>
