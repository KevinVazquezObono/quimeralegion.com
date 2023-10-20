<?php
	class System_Web_Cypher
	{
		public function app_send(string $data, string $password, int $iv = 0)
		{
			return openssl_encrypt($data, "aes-128-ecb", $password, $iv);
		}

		public function app_read(string $data, string $password, int $iv = 0)
		{
			return openssl_decrypt($data, "aes-128-ecb", $password, $iv);
		}

		public function send(string $data, string $password)
		{
			return openssl_encrypt($data, 'aes-256-ecb', $password);
		}

		public function read(string $data, string $password)
		{
			return openssl_decrypt($data, 'aes-256-ecb', $password);
		}
	}
?>
