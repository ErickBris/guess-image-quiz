<?php 
	include("include/config.php");
	
//*****************************Insert question details**************************************//
if(isset($_POST['btnaddque']))
{ 
	if($_POST['Qlevel']!="0")
	{
	
	
	function GetImageExtension($imagetype)
   	 	{
		   if(empty($imagetype)) return false;
		   switch($imagetype)
		   {         
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
      	 }
     }
	
	if(isset($_POST['ques']) && $_GET['action'] != 'update' )
	{	
		
		if (!empty($_FILES["uploadFile"]["name"]))
		{		
			$file_name=$_FILES["uploadFile"]["name"];
			$temp_name=$_FILES["uploadFile"]["tmp_name"];
			$imgtype=$_FILES["uploadFile"]["type"];
			$ext= GetImageExtension($imgtype);
			
			if($ext!=false)
			{
			
				$target_path = 'image'.'/'.'quizimage'.'/'.$file_name;
				
				if(move_uploaded_file($temp_name, $target_path)==FALSE)
				{
					 echo "<h1>Error in Uploading Image...</h1>";
				}
				else{
			
					$sql ='insert into  ique_bank(Question,queimage,OptionA,OptionB,OptionC,OptionD,RightAns,quiz_level)values("'.$_POST['ques'].'","'.$file_name.'",
					"'.$_POST['optA'].'","'.$_POST['optB'].'","'.$_POST['optC'].'","'.$_POST['optD'].'","'.$_POST['Rightans'].'","'.$_POST['Qlevel'].'")';				
					
					$result= mysql_query($sql);
					
					if($result){header('location:question.php');}						
					else{echo mysql_error();}
					exit();	
				}
				
			}
			else{echo "<h1>The Image you attempted to upload is not allowed...</h1>";}
		}
	}
	//**************update question details****************//
	if($_GET['action']=='update' && isset($_POST['id']) &&  $_POST['id'] != '')
	{
	
		if (!empty($_FILES["uploadFile"]["name"]))
		{		
			$file_name=$_FILES["uploadFile"]["name"];
			$temp_name=$_FILES["uploadFile"]["tmp_name"];
			$imgtype=$_FILES["uploadFile"]["type"];
			$ext= GetImageExtension($imgtype);
			
			if($ext!=false)
			{
			
				$target_path = 'image'.'/'.'quizimage'.'/'.$file_name;
				
				if(move_uploaded_file($temp_name, $target_path)==FALSE)
				{
					 echo "<h1>Error in Uploading Image...</h1>";
				}
				else
				{
					$sql_img = 'select queimage from ique_bank where Que_ID='.$_POST['id'];	
					$result_nm = mysql_query($sql_img);
					$row = mysql_fetch_array($result_nm);
					$imgname='image'.'/'.'quizimage'.'/'.$row['queimage'];					
					
					if(file_exists($imgname))
					{
						unlink($imgname);
						$sql = mysql_query('update ique_bank set 
						Question = "'.$_POST['ques'].'",queimage = "'.$file_name.'",quiz_level="'.$_POST['Qlevel'].'",OptionA="'.$_POST['optA'].'",OptionB="'.$_POST['optB'].'",
						OptionC="'.$_POST['optC'].'",OptionD="'.$_POST['optD'].'",RightAns="'.$_POST['Rightans'].'" where Que_ID ='.$_POST['id']);				
						if($sql){header('location:question.php');}					
						else{echo mysql_error();}
					}
					else{echo 'Could not delete '.$row['queimage'].', image does not exist';}
					
				}
				
			}
			else{echo "<h1>The Image you attempted to upload is not allowed...</h1>";}
		}
		else
		{
			$sql = mysql_query('update ique_bank set 
						Question = "'.$_POST['ques'].'",quiz_level="'.$_POST['Qlevel'].'",OptionA="'.$_POST['optA'].'",OptionB="'.$_POST['optB'].'",
						OptionC="'.$_POST['optC'].'",OptionD="'.$_POST['optD'].'",RightAns="'.$_POST['Rightans'].'" where Que_ID ='.$_POST['id']);				
						if($sql){header('location:question.php');}					
						else{echo mysql_error();}
		}
		
			
		
	}
	}
	else{echo "<h1>Please select quiz_level</h1>";
		}
}

	//*****************************Delete question details**************************************//
	if($_GET['action'] == 'question_delete' && isset($_GET['id']) &&  $_GET['id'] != '')
	{
		//first delete image
		$sql_img = 'select queimage from ique_bank where Que_ID='.$_GET['id'];	
		$result_nm = mysql_query($sql_img);
		$row = mysql_fetch_array($result_nm);
		$imgname='image'.'/'.'quizimage'.'/'.$row['queimage'];					
		if(file_exists($imgname))
		{
			unlink($imgname);
		}else{echo 'Error in delete '.$row['queimage'].', image does not exist';}
	
	
		$sql ='delete  from   ique_bank  where Que_ID = '.$_GET['id'];	
		$result= mysql_query($sql);
		header('location:question.php');
		exit();
	}
if(isset($_POST['btnaddlevel']))
{ 
	
	if(isset($_POST['levelnm']) && $_GET['action'] != 'update' )
	{
		$sql ='insert into  ique_level(Level_name)values("'.$_POST['levelnm'].'")';	
		$result= mysql_query($sql);
		
		if($result){
			header('location:addlevel.php');			
			}
		else{
			echo mysql_error();
			}
		
		exit();
	}
	//**************update LEVEL details****************/
	if($_GET['action']=='update' && isset($_POST['id']) &&  $_POST['id'] != '')
	{
		
		$sql = mysql_query('update ique_level set Level_name = "'.$_POST['levelnm'].'"	where Level_id ='.$_POST['id']);
		
		if($sql){
			header('location:addlevel.php');			
			}
		else{
			echo mysql_error();
			}
			
			
	}
}
if($_GET['action'] == 'level_delete' && isset($_GET['id']) &&  $_GET['id'] != '')
	{
		$sql ='delete from ique_level  where Level_id = '.$_GET['id'];	
		$result= mysql_query($sql);
		//first delete image
		$sql_img = 'select queimage from ique_bank where quiz_level='.$_GET['id'];
			
		$result_nm = mysql_query($sql_img);
		while($row = mysql_fetch_array($result_nm))
		{
		
			$imgname='image'.'/'.'quizimage'.'/'.$row['queimage'];					
			if(file_exists($imgname))
			{
				unlink($imgname);
			}else{echo 'Error in delete '.$row['queimage'].', image does not exist';}
		}
		$sql2 ='delete  from   ique_bank  where quiz_level = '.$_GET['id'];	
		$result2= mysql_query($sql2);
		header('location:addlevel.php');
		exit();
	}
	
	
if(isset($_POST['btnprofile']))
{
	
	if($_GET['action']=='update' && isset($_GET['id']) &&  $_GET['id'] != '')
	{
		
		$sql = mysql_query('update userlogin set userName = "'.$_POST['unm1'].'",password="'.$_POST['pwd'].'",Email="'.$_POST['email'].'"
		where userID ='.$_GET['id']);
		
		if($sql){
			header('location:profile.php');			
			}
		else{
			echo mysql_error();
			}
	}
	
}

?>