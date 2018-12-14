<?php
	require_once('./dbconfig.php');

	session_start();

	$userid = $_GET['user_id'];
	   
	$sql = 'delete from user where user_id = "'. $userid .'"';
	
	$result = $db->query($sql);

	if($result)
	{
		?>
		<script>
			alert('해당 유저를 삭제하였습니다.');
		
			location.replace("./user_manage.php");
		
		</script>
	<?php	
	}
	else
	{
		?>
		<script>
			alert('해당 유저를 삭제하였습니다.');
		
			location.replace("./user_manage.php");
		
		</script>
<?php
	}
?>




