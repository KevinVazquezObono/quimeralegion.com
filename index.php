<?php
	include 'class/trans.php';
	$trx = new System_Web_Transaccion();
	include 'bin/cyph3r.php';
	$cry = new System_Web_Cypher();
	include 'bin/user.php';
	$user = new System_Web_User();
	include 'bin/block.php';
	$block = new System_Web_BlockChain();
	include 'class/root.php';
	$menu = new System_Web_Root();
	include 'class/webmsg.php';
	$wmsg = new System_Web_Mensajes();
	include 'class/monitor.php';
	$mono = new System_Web_Monitor();
	include 'class/cloud.php';
	$files = new System_Web_Cloud();
	include 'class/qlnote.php';
	$notes = new System_Web_TextNote();
	include 'class/yavero.php';
	$keys = new System_Web_Yavero();
	include 'class/prod.php';
	$prod = new System_Web_Producto();
	include 'class/sign.php';
	$sign = new System_Web_Sign();
	include 'class/login.php';
	$log = new System_Web_Login();
	include 'bin/wallet.php';
	$wallet = new System_Web_Wallet();

	$menu->header('index');
	$menu->desk();

	if (isset($_GET['MINER']))
	{
		$block->form();
	}
	if (isset($_GET['LOGIN']))
	{
		$log->main();
	}
	elseif(isset($_GET['QUIT']))
	{
		$log->quit();
	}
	elseif (isset($_GET['SIGN']))
	{
		$sign->main();
	}
	elseif (isset($_GET['INFO']))
	{
		include 'legal/info.php';
	}
	elseif (isset($_GET['WEBMSG']))
	{
		$wmsg->run();
	}
	elseif (isset($_GET['SendWebMsg']))
	{
		$wmsg->webmsg();
	}
	elseif (isset($_GET['ReadWebMsg']))
	{
		$wmsg->start($_GET['ReadWebMsg']);
	}
	elseif (isset($_GET['CryMsg']))
	{
		$wmsg->main($_POST['ID'], $_POST['PASS']);
	}
	elseif (isset($_GET['NOSOTROS']))
	{
		include 'legal/producto.php';
	}
	elseif (isset($_GET['SHARE']))
	{
		$files->main();
	}
	elseif (isset($_GET['DOWNFILE']))
	{
		$files->dwform();
	}
	elseif (isset($_GET['NOTES']))
	{
		$notes->main();
	}
	elseif (isset($_GET['KEYS']))
	{
		$keys->main();
	}
	elseif (isset($_GET['PROD']))
	{
		$prod->main();
	}
	elseif (isset($_GET['BLOCK']))
	{
		$block->main();
	}
	if (isset($_GET['CONNECT']))
	{
		$menu->webmap();
		$wallet->main();
		$mono->main();
	}
	else
	{
		$menu->webmap();
		$menu->inicio();
		$mono->main();
		$mono->explore();
	}
	$menu->footer();
?>
