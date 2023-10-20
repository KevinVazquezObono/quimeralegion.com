<?php
	class System_Web_Pi
	{
		public function c(int $n)
		{
			$pi = 0;
			for ($i = 0; $i < $n; $i++) {
			    $termino = ((-1) ** $i) / (2 * $i + 1);
			    $pi += $termino;
			}
			$pi *= 4;
			return hash("sha256", $pi);
		}
	}
?>