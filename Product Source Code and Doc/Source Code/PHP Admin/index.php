<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
	<link href="css/login.css" rel="stylesheet" type="text/css" />
</head>

<style>

</style>
<body>
<div class="wrap1">
	<div class="innerrec">
        <div id="content">
            <div class="loginlogo" id="logo"><img src="image/logo.png" alt="imagequiz" width="200px"  /></div>
            <div class="frmlogin">
            	<h2 class="logintxt">Please Login</h2>
            <form id="login" method="post" action="login_db.php">
            	<input type="text" id="uname" name="uname" placeholder="Email Address" /><br/>
                <input type="password" id="password" name="password" placeholder="Password"/><br/>
               
                <input type="submit" name="btnlogin" value="login" class="btnimage" />
            </form>
            </div>
            
         </div> 
    </div>
	</div>
</body>
</html>