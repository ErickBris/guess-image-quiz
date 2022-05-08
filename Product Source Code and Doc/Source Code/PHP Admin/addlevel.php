<?php
	
 include("header.php");
 if(isset($_GET['id']) &&  $_GET['id'] != '')
{
	$sql = 'select * from  ique_level where Level_id='.$_GET['id'];	
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$action="action.php?action=update";
}
else
{
	$action="action.php";
}
?>
<div class="wrap">
	<?php include("include/menu.php"); ?>
    <div id="content">
    	 <fieldset class="frame">
   		 <legend>Add Level</legend>
    	<form id="addque" method="post" action="<?php echo $action; ?>">
        	<div class="tbl"> 
            
            
            	<div class="inner-frame">
                	<label class="control-label" for="levelnm" id="levelnm">Level Name</label>
                     <div class="controls"> 
                     		 <input type="text" name="levelnm" id="levelnm" value="<?php echo $row['Level_name']; ?>" required />
                     		<input type="hidden" name="id" value="<?php echo $row['Level_id']; ?>"/>     	                
            		 </div>
                </div>
                
               
                <div class="inner-frame">
                	<div class="btnspace">
                	         <input type="submit" value="Add/Edit" class="btnimage" name="btnaddlevel"/>
               				<a href="addlevel.php"><input type="button" value="Cancel" id="btncancel"  class="btnimage"/></a>
              			</div>
        		 </div>
            </div> <!--div tbl end	-->
        </form>
        <div class="CSSTableGenerator">
         	 <table>
              <tbody>
              <tr><td>Level ID</td>
                 <td>Level Name</td>
                
                   <td>Action</td>
               </tr>
                 <?php 
				 
			
			 	 $sql="select * from ique_level";
			
	$rows = mysql_query($sql);	 
	$nr = mysql_num_rows($rows); 
	if (isset($_GET['pn'])) 
	{ 
    	$pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); 
		
    } else {
    $pn = 1;
}
$itemsPerPage =50;
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
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
}

$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage;
$sql2 = mysql_query("$sql $limit");

$paginationDisplay = ""; 
if ($lastPage != "1"){
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '"> Prev</a> ';
    }
		$paginationDisplay .= '<span id="paginationNumbers">' . $centerPages . '</span>';
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '"> Next</a> ';
    }
}	
			
	while($row = mysql_fetch_array($sql2))
    { 		
				$Srno++;
	?> 
    		
              <tr>
              	
                <td><?php echo $row['Level_id']; ?></td>
                <td><?php echo $row['Level_name']; ?></td> 
               
                             				
				<td  style="width:100px;text-align:center">
                		<a href="addlevel.php?id=<?php echo $row['Level_id'];?>&action=update" class="link">Edit</a> /                        
           				 <a href="action.php?id=<?php echo $row['Level_id']; ?>&action=level_delete" class="link" onclick="return confirm('Delete the level will remove that level questions?');">Delete</a>
                       
               </td>
             </tr>
            
<?php  } ?>
                        </tbody>
                    </table></div>
                <div class="count"><b>Total Records: <?php echo $nr; ?></b><div align="right"><?php if($nr!='0'){echo $paginationDisplay;} ?></div></div>
    	</fieldset>
     </div> <!--main content end	-->
     
     
   	 <div id="footer">     
       <?php include('include/footer.php'); ?> 
      </div> 
       
	</div>
