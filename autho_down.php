<?php
	include "dbconfig.php";

	$userid = $_GET['user_id'];
	
	$sql1 = 'update user set authority = 1 where user_id = "'.$userid. '"' ;
	
	$result1 = $db -> query($sql1);
?>
	<script>
		alert('권한이 변경되었습니다.');
		
		location.replace("./user_manage.php");
		
	</script>
	


?>