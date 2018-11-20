<?php
	session_start();

	require_once('./dbconfig.php');
	?>

	<?php
		if(!isset($_SESSION["userid"]))
		{
			?>
			<script>
				alert('로그인 후 이용해 주세요.');
				history.back();
			</script>
			
<?php
			
			
		}

	$c_content = $_POST['c_content'];
	$bNo = $_POST['board_num'];
	

	// 덧글 수정 
	if(isset($c_num)){
		$c_num = $_POST['c_num'];
		$date = date('Y-m-d H:i:s');
		
		$sql = 'update comment 
				set c_content = "'. $c_content .'",
					c_date = '. $date .'
				where c_num = '. $c_num;
		
		$result = $db->query($sql);
		
		
		
		echo "<script>
				alert('덧글이 수정 되었습니다.');
				
				document.location.href = 'http://210.117.181.21:2018/termprj/s201615383/view.php?board_num='.$bNo 
				</script>";
		
		
		
	}
 	//덧글 작성 
	if(!isset($c_num))
	{
		$date = date('Y-m-d H:i:s');
		
		$sql = 'insert into comment values("'. $_SESSION["userid"] .'", $bNo, '. $c_content .', null, '. $date .');';
	
		$result = $db->query($sql);

		
		
		
		
		echo "<script>
				alert('덧글이 작성되었습니다.');
				
				document.location.href = 'http://210.117.181.21:2018/termprj/s201615383/view.php?board_num='.$bNo 
				</script>";
				
		
		
	}
		
	
	
	
	

		
	
	
	
	