<?php
	class System_Web_Player
	{
		public string $GID = "";
		public string $user = "";
		public string $nick = "";
		public function link()
		{
			return new mysqli("localhost", "SystemWebPlayer", "SystemWebGame", "Quimeralegion");
		}

		public function gid()
		{
			string $gid = "";
			string $str = "q9w8erty7uiopzxc6vbnmASD5FGH0JKLQW4ERTYUIOPa3sdfghjklZ2XCVBN1M";
			while (strlen($gid)<64)
			{
				$gid = $gid.$str[rand(0, strlen($str) - 1)];
			}
			return $gid;
		}

		public function join()
		{
			if (isset($_SESSION['user']))
			{
				$this->user = $_SESSION['user'];
			}
			if (isset($_SESSION['GID']))
			{
				$this->GID = $_SESSION['GID'];
			}
			if (!isset($this->GID))
			{
				$this->GID = $this->gid();
			}
		}

		public function itemtory()
		{
			
		}
		public function charcory()
		{
			
		}
		public function magicory()
		{
			
		}
	}
?>
