<?php
	class System_Web_Engine()
	{
		public string $domain;
		public string $fodomain;
		public function main()
		{
			$html = new System_Web_HTML();
			$html->push($html->form("https://quimeralegion.com/index.php?CONNECT=1"));
			$html->push($html->input("query_domain", "text", 'pattern="[A-Za-z]{1}[A-Za-z0-9\-]{62}[A-Za-z0-9]{1}"'))
			$html->push($html->submit());
			echo ($html->bloq("Buscar dominio", $html->outcome().'</form>',"buscar"));
			$html->destroy();
			if ($_POST['query_domain'])
			{
				$this->domain = $_POST['query_domain'];
			}
			elseif (isset($this->domain))
			{
				$this->run();
			}
		}
		public function response()
		{
			$html = new System_Web_HTML();
			$tab = [
				"<td>https://".$this->domain.$this->fodomain."</td>";
			];
			$html->push($html->tab);
		}
		public function dom_com()
		{
			$this->fodomain = '.com';
		}
		public function run()
		{
			
		}
	}
?>
