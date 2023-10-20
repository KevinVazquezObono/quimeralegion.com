<?php
	class System_Web_Index
	{
		public function dtm()
		{
			return date("His").substr(explode(" ", microtime())[0],2,4);
		}
		public function dns_a(string $str)
		{
			if (dns_get_record($domain, DNS_A) === FALSE)
			{
				return FALSE;
			}
			return TRUE;
		}
		public function dns_ns(string $str)
		{
			if (dns_get_record($domain, DNS_NS) === FALSE)
			{
				return FALSE;
			}
			return TRUE;
		}
		public function dns_mx(string $str)
		{
			if (dns_get_record($domain, DNS_MX) === FALSE)
			{
				return FALSE;
			}
			return TRUE;
		}
		public function dns_soa(string $str)
		{
			if (dns_get_record($domain, DNS_SOA) === FALSE)
			{
				return FALSE;
			}
			return TRUE;
		}
		public function keywords(string $str)
		{
			$time = $this->dtm() + 3000; // 10.000 = 1segundo
			while ($this->dtm() < $t)
			{
				$keywords = get_meta_tags('http://'.$str.'/')['keywords'];
				if (isset($keywords))
				{
					return $keywords;
				}
			}
		}
		public function description(string $str)
		{
			$time = $this->dtm() + 3000; // 10.000 = 1segundo
			while ($this->dtm() < $t)
			{
				$spell = get_meta_tags('http://'.$str.'/')['description'];
				if (isset($spell))
				{
					return $spell;
				}
			}
		}
		public function index(string $str)
		{
			$this->dns_ns($str);
			$this->dns_soa($str);
			$this->dns_a($str);
			$this->dns_mx($str);
		}
		public function form()
		{
			$html = System_Web_HTML();
			$html->push($html->form("https://quimeralegion.com/index.php?SEEK"));
			$html->push($html->input("q", "text", 'pattern="[Aa-Zz]{1}[a-z0-9\-]{1,62}[a-z0-9]{1}" placeholder="max 64 char"'));
			$html->push($html->submit());
		}
	}
?>
