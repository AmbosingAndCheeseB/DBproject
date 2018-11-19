<?php
	include "dbconfig.php";

	$hospital = $_GET['h_id'];
	$sql = 'select * from hospital where Hospital_ID = "'.$hospital.'" ';
	$result = $db->query($sql);
	$info1 = $result->fetch_array();
	
	echo $info1[1], $info1[2], $info1[3], "<br />\n";
	
	$sql = 'select * from time where Hospital_ID = "'.$hospital.'" ';
	$result = $db->query($sql);
	$info2 = $result->fetch_array();
	
	echo $info2[1], " ", $info2[2], " ", $info2[3], " ", $info2[4], " ", $info2[5], " ", $info2[6], " ", $info2[8], " ", $info2[7], "<br />\n";
	
	$sql = 'select Hospital_Name from hospital where Hospital_ID = "'.$hospital.'" ';
	$result = $db->query($sql);
	$temp = $result->fetch_array();
	
	$sql = 'select * from board where B_content like "%'.$temp[0].'%" ';
	$result = $db->query($sql);
	
	while($info3 = $result->fetch_array()){
		echo "<html><body><a href='view.php?board_num=$info3[0]'>$info3[2]</a> | $info3[5]<br/></body></html>";
	}
?>