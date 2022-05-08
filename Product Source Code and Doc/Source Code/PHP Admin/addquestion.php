<?php
	
 include("header.php");
if(isset($_GET['id']) &&  $_GET['id'] != '')
{
	$sql = 'select * from ique_bank where Que_ID='.$_GET['id'];	
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$action="action.php?action=update";
}
else
{
	$action="action.php";
}
?>
<style>
#leftdiv, #rightdiv {
       float: left;
    
    
}
#leftdiv {
     width:550px;
     
}
#rightdiv {
     width:450px;
	 float:right;
   
}
#tbl1 { 
 color: #333; /* Lighten up font color */
font-family: 'Droid Sans', sans-serif; /* Nicer font */
 width:800px; 
 border-collapse: 
 collapse; border-spacing: 0; 
 
}
 
td, th { border: 1px solid #CCC; height: 30px;	color:#999999;vertical-align:middle;} /* Make cells a bit taller */
 
th {
 background: #F3F3F3; /* Light grey background */
 font-weight: bold; /* Make sure they're bold */
	
}
 
td {
 background: #FAFAFA; /* Lighter grey background */
 text-align: center; /* Center our text */
 padding-right:1.2em;

}
.imagePreview {
    width: 120px;
    height: 120px;
 /*  background-position: center right;*/
   /* background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);*/
    display: inline-block;
	border:1px solid #CCCCCC;
	margin-top:-2.5em!important;
	margin-left:85%;
}

</style>
<div class="wrap">
	<?php include("include/menu.php"); ?>
    <div id="content">
    	 <fieldset class="frame">
   		 <legend>Add Question</legend>
        
         <div id="leftdiv">
    	<form id="addque" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">        	
        	<div class="tbl">    
            
            	<div class="inner-frame">
                	<label class="control-label2" for="input01" id="input011" >Question</label>
                     <div class="controls"> 
                     			<textarea id="input01" name="ques" required><?php echo $row['Question']; ?></textarea>
                     			<input type="hidden" name="id" value="<?php echo $row['Que_ID']; ?>"/>      
                     			                
            		 </div>
                </div>
                <div class="inner-frame">
                	<label class="control-label2" for="input01" id="input011" >Uplaod Image</label>
                     <div class="controls"> 
                   		<input type="file" name="uploadFile"  id="uploadFile" onchange="readURL(this);" accept="image/jpeg, image/png" <?php if($action !='action.php?action=update'){ ?> required <?php } ?> /> 
                  <br/>    <span style="color:#FF0000;font-size:12px;margin-left:37%;">*Image size must be 300px X 300px</span>
            		
                      <div class="imagePreview">
                 			 <img id="quepic" src="image/<?php if($row['queimage']==""){ echo "noimage.jpg";}else{ echo 'quizimage/'.$row['queimage']; }?>" alt="quiz image" 
                             height="120px" width="120px" />
                		</div>
                     </div>
                </div> 
                <div class="inner-frame">
                	<label class="control-label2" for="Qlevel">Quiz Level</label>
                     <div class="controls"> 
                     	      <select name="Qlevel" id="Qlevel" >                             
                        	 <option selected="selected" value="0" >-- Select Quiz Level --</option>
                             <?php 
							 	$level_sql= 'select * from ique_level';
								$level_res= mysql_query($level_sql);
								while($level_row=mysql_fetch_array($level_res))
								{		
								 ?>
                                <option <?php if($row['quiz_level']==$level_row['Level_id']){ ?> selected <?php } ?> value="<?php echo $level_row['Level_id']; ?>">
                                <?php echo  $level_row['Level_id']." - ".$level_row['Level_name']; ?>
                                </option>
                                
                                  <?php } ?>
        						
                        </select>
            		 </div>
                </div>
                
                <div class="inner-frame">
                	<label class="control-label2" for="optA">Option[A]</label>
                     <div class="controls"> 
                     	<input type="text" id="optA" name="optA" value="<?php echo $row['OptionA']; ?>" required />                        	 
            		 </div>
                </div>
                <div class="inner-frame">
                	<label class="control-label2" for="optB">Option[B]</label>
                     <div class="controls"> 
                     	<input type="text" id="optB" name="optB" value="<?php echo $row['OptionB']; ?>" required />                        	 
            		 </div>
                </div>
                <div class="inner-frame">
                	<label class="control-label2" for="optC">Option[C]</label>
                     <div class="controls"> 
                     	<input type="text" id="optC" name="optC" value="<?php echo $row['OptionC']; ?>" required />                        	 
            		 </div>
                </div>
                <div class="inner-frame">
                	<label class="control-label2" for="optD">Option[D]</label>
                     <div class="controls"> 
                     	<input type="text" id="optD" name="optD" value="<?php echo $row['OptionD']; ?>" required />                        	 
            		 </div>
                </div>
                
                <div class="inner-frame">
                	<label class="control-label2" for="input03" id="input031">RightAns.</label>
                     <div class="controls">
                     	<select id="input03" name="Rightans">
                        	<!--<option value="-">-- Select Answer --</option>-->
                            <option <?php if($row['RightAns']=='A'){ ?> selected <?php } ?> value="A">A</option>
                            <option <?php if($row['RightAns']=='B'){ ?> selected <?php } ?> value="B">B</option>
                            <option <?php if($row['RightAns']=='C'){ ?> selected <?php } ?> value="C">C</option>
                            <option <?php if($row['RightAns']=='D'){ ?> selected <?php } ?> value="D">D</option>
                        </select>
                     	                                                 
            		 </div>
                </div>
                <div class="inner-frame"><!--onclick="alert('Only administrators have permission.');"-->
                	<div class="btnspace">
                	         <input type="submit" value="Add/Edit" class="btnimage" name="btnaddque" />
               				<a href="question.php"><input type="button" value="Cancel" id="btncancel"  class="btnimage"/></a>
              			</div>
        		 </div>
            </div> <!--div tbl end	-->
        </form>
        </div>
         <div id="rightdiv">
         	</div>
            </fieldset>
     </div> <!--main content end	-->
     
     
   	 <div id="footer">     
       <?php include('include/footer.php'); ?> 
      </div> 
	</div>
<script type="text/javascript">
function readURL(input) {
	//var _URL = window.URL || window.webkitURL;

	var fileName = document.getElementById("uploadFile").value;
	var Extension=fileName.split(".")[1].toUpperCase();
    if (input.files && input.files[0]) {
		
		if (Extension== "PNG" || Extension == "JPG" )//check image type
		{
			var reader = new FileReader();
			reader.readAsDataURL(input.files[0]);	
			
			// ======================= check image height and width=========================
			reader.onload = function (e) {
			var imagepath=e.target.result;
			var imgUpload=document.getElementById("quepic");	
			var img=new Image();
					img.onload = function ()
					{		
						if(this.width >301 && this.height >301)
						{
							document.getElementById("uploadFile").value="";
							imgUpload.src="image/noimage.jpg";
							alert("The image you attempted to upload is too large...");									
						}
				};	
				img.src=imagepath;	
				imgUpload.src=imagepath;		
				
			};
			
			
		}//check file type end  
		else{ 
			document.getElementById("uploadFile").value="";
			alert("File with " + fileName.split(".")[1] + " is invalid. Upload a validfile with png extensions");
			}
    }
}
</script>
