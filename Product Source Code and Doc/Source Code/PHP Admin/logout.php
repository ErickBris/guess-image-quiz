<?php 
	
	@session_start();
	if(isset($_SESSION['unm']))
	{
		unset($_SESSION['unm']);
		unset($_SESSION);
	} 
	
	session_destroy();
	header('Location:index.php');
	exit;
?>