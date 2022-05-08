<?php
header('Content-type: application/json');
require_once('include/config.php');
$res = array();

if($_GET['levelid'] != ''){
	
	
	$check_sql = mysql_query("select * from ique_bank where  quiz_level = '" . $_GET['levelid'] . "'ORDER BY RAND() LIMIT 10");
	
	if(mysql_num_rows($check_sql) > 0)
	{
		while($row = mysql_fetch_array($check_sql)){
		$res[] = array('question' => $row['Question'],
						'qimage' => $row['queimage'],
						'quizlevel' => $row['quiz_level'],
						'optiona' => $row['OptionA'],
						'optionb' => $row['OptionB'],
						'optionc' => $row['OptionC'],
						'optiond' => $row['OptionD'],						
						'rightans' => $row['RightAns']
						
						);					
                }
	}
	
	else{
			$sql = mysql_query("select * from ique_bank ORDER BY RAND() LIMIT 10");
			while($row = mysql_fetch_array($sql)){
			$res[] = array('question' =>$row['Question'],
							'qimage' => $row['queimage'],
							'quizlevel' => $row['quiz_level'],
						'optiona' => $row['OptionA'],
						'optionb' => $row['OptionB'],
						'optionc' => $row['OptionC'],
						'optiond' => $row['OptionD'],						
						'rightans' => $row['RightAns']							
							);
					}
	}	
		
}
	
echo json_encode($res);

?>