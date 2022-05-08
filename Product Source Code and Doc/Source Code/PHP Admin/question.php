<?php
	
	 include("header.php");
?>
<meta charset="utf-8" />

<div class="wrap">
	<?php
			
		 include("include/menu.php"); ?>
    <div id="content">
    	<fieldset class="frame">
   		 <legend>Question List</legend>
         		<div id="srchMain">
                	<div id="leftpan">
                    <form id="srchlevel" method="post" action="<?php echo $action; ?>">
                    	<select name="qlevel" id="qlevel" onchange='show_state();'>
                        	 <option selected="selected" value="-">-- Select Quiz Level --</option>
                             <?php 
							 	$level_sql= 'select * from ique_level';
								$level_res= mysql_query($level_sql);
								while($level_row=mysql_fetch_array($level_res))
								{		$lvl=$level_row['Level_id'];
								 ?>
                                	
                                    
                                <option <?php if($_POST['qlevel'] ==$lvl) echo 'selected'; ?> value="<?php echo $level_row['Level_id']; ?>">
                                <?php echo $level_row['Level_id']; ?> - <?php echo $level_row['Level_name']; ?>
                                </option>
                                
                                  <?php } ?>
        						
                        </select>
                        <input type="submit" value="Search" class="btnimage" name="btnsearch"/>
                      </form>
                    </div>
                    <div id="rightpan" style="text-align:right;margin-left:-27%">
                    	<a href="addquestion.php" ><input type="button" value="Add Question" id="btnadd"  class="btnimage"/></a>
                    </div>
                </div> <!--div *srchMain* end here-->
         		
                <br/>
        	<div class="CSSTableGenerator">
         	 <table>
              <tbody>
              <tr><td>Sr. No.</td>
                 <td>Question</td>
                 <td>Image</td>
                 <td style="text-align:left">OptionA</td>
                 <td style="text-align:left">OptionB</td>
                 <td style="text-align:left">OptionC</td>
                 <td style="text-align:left">OptionD</td>  
                 <td >RightAns</td>               
                 <td>Quiz Level</td> 
                   <td>Action</td>
               </tr>
              
                 <?php 
				 
			if(isset($_POST['btnsearch'])&& $_POST['qlevel'] !='-')				
		   {		   		
		   		$sql="select * from ique_bank where quiz_level=".$_POST['qlevel'];
				
		   }
		
		else
			 {
			 	 $sql="select * from ique_bank";
			 }
	$rows = mysql_query($sql);	 
	$nr = mysql_num_rows($rows); 
	if (isset($_GET['pn'])) 
	{ 
    	$pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); 
		
    } else {
    $pn = 1;
}
$itemsPerPage =10;
$lastPage = ceil($nr / $itemsPerPage);
if ($pn < 1) { 
    $pn = 1; 
} else if ($pn > $lastPage) { 
    $pn = $lastPage; 
}
$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
if ($pn == 1) {
    $centerPages .= '&nbsp; <span class="pagNumActive pagenum">' . $pn . '</span> ';
    $centerPages .= ' <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '" class="pagenum">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '" class="pagenum">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive pagenum">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '" class="pagenum">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '" class="pagenum">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive pagenum">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '" class="pagenum">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '" class="pagenum">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '" class="pagenum">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive pagenum">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '" class="pagenum">' . $add1 . '</a> &nbsp;';
}

$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage;
$sql2 = mysql_query("$sql $limit");
//******************Sr. No.**************************/
	$Srno=($pn - 1) * $itemsPerPage;
//**************************************************/
$paginationDisplay = ""; 
if ($lastPage != "1"){
 $paginationDisplay .= '<form action="' . $_SERVER['PHP_SELF'].'?pn=' . $previous .'style=display:inline"> 
	 <input type=text name=pn size=1 class="txtbox"/>
	 <input type=submit value=Go class=btngo />
	 </form></br>';
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '
	 
	 &nbsp; ';
    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '" class=centerno> Prev</a>';
    }
		$paginationDisplay .= '<label id="paginationNumbers" class=centerno>' . $centerPages . '</label>';
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '" class=centerno> Next</a>';
    }
}	
			
	while($row = mysql_fetch_array($sql2))
    { 		
				$Srno++;
	?> 
              <tr>
                  <td><?php echo $Srno; ?></td>
                <td style="width:400px;"><?php echo $row['Question']; ?></td>
                <td style="text-align:center"><img src="image/quizimage/<?php echo $row['queimage']; ?>" alt="imagequiz" height="25px" width="25px;"/></td> 
                <td><?php echo $row['OptionA']; ?></td> 
                <td><?php echo $row['OptionB']; ?></td> 
                <td><?php echo $row['OptionC']; ?></td> 
                <td><?php echo $row['OptionD']; ?></td> 
                <td style="text-align:center"><?php echo $row['RightAns']; ?></td> 
                <td style="text-align:center"><?php echo $row['quiz_level']; ?></td> 
                
                             				
				<td  style="width:100px;text-align:center">
                		<a href="addquestion.php?id=<?php echo $row['Que_ID'];?>&action=update" class="link">Edit</a> /
                         <a href="action.php?id=<?php echo $row['Que_ID'];?>&action=question_delete" class="link" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                      
               </td>
             </tr>
            
<?php  } ?>
                        </tbody>
                    </table></div>
                <div class="count"><b>Total Records: <?php echo $nr; ?></b>
                	<div align="right"><?php if($nr!='0'){echo $paginationDisplay;} ?>
                    
                    </div>
                    </div>
         </fieldset>
     </div> 
   
     
   	 <div id="footer">
     
       <?php include('include/footer.php'); ?> 
      </div> 

	</div>
