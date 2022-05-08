<?php
	
	 include("header.php");
	 
if($_SESSION['uID']!= '')
{
	
	$sql = 'select * from userlogin where userID='.$_SESSION['uID'];	
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);	
	$action="action.php?id=".$_SESSION['uID']."&action=update";
}
else
{
	//header("location:login.php");
}
?>

<div class="wrap">
	<?php include("include/menu.php"); ?>
    <div id="content">
    	 <fieldset class="frame">
   		
    	<form id="updateprofile" method="post" action="<?php echo $action; ?>">
        	<div class="tbl"> 
            	<div class="inner-frame">
                	<label class="control-label" for="unm1" id="unm1">User Name</label>
                     <div class="controls"> 
                     			<input type="text" id="unm1" name="unm1" value="<?php echo $row['userName']; ?>" required />                    			                     		              
            		 </div>
                </div>
                
                <div class="inner-frame">
                	<label class="control-label" for="pwd" id="pwd">Password</label>
                     <div class="controls"> 
                     			<input type="text" id="pwd" name="pwd" value="<?php echo $row['password']; ?>" required />        
            		 </div>
                </div>
                
                <div class="inner-frame">
                	<label class="control-label" for="email" id="email">Email Address</label>
                     <div class="controls"> 
                     			<input type="text" id="email" name="email" value="<?php echo $row['Email']; ?>" required />            
            		 </div>
                </div>
                
                <div class="inner-frame">
                	<div class="btnspace">
                	         <input type="submit" value="Update Profile" class="btnimage" name="btnprofile" id="btnprofile"/>
               				
              			</div>
        		 </div>
     		</div> 
            
         </form>
         
      </fieldset>
     
      </div><!--// content end-->
     
     
   	 <div id="footer">
   
       <?php include('include/footer.php'); ?> 
      </div> 
	
</div>