<?php
	include("include/loginsession.php");
	 include("loadcss.php");
	include("include/config.php");
	
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Guess Image Quiz</title>
<style>
	
	.head{		
		width:70%;
		/*margin: 1em auto;*/
		margin:0.5em auto 0em;
	}
.welcomeuser{
	font-family:"Century Gothic";
	float:right;	
	color:#666666;
	padding-right:0.5em;	
}	
</style>
</head>

<body>
	<div class="head">
    	<div><img src="image/logo.png" alt="imagequiz" class="logo" /></div>
      <div class="welcomeuser">
	  			<?php 
					@session_start(); 
					if(isset($_SESSION['unm']))
						echo "Welcome&nbsp;&nbsp;&nbsp;".$_SESSION['unm'];
					else
						header("location:index.php");
				 ?>
     </div>
   </div>     
    
</body>
</html>
