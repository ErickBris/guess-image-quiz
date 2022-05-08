<?php 
include("include/config.php");
$username=$_POST['uname'];
$password=$_POST['password'];
$res=mysql_query("select * from userlogin  where Email='$username' and password='$password'");
$data=mysql_fetch_array($res);

if($data[0]==""){
	header("location:index.php");
}else{
	@session_start();
	
	$_SESSION['uID']=$data['userID'];	
	$_SESSION['unm']=$data['userName'];
    header("location:question.php");
}
?>