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

	$bNo = $_GET['board_num'];
	$url = './view.php?board_num=' . $bNo;
	

	
 	//덧글 작성 
	
		$date = date('Y-m-d H:i:s');
		
		$sql1 = 'insert into comment(user_id, board_num, c_content, c_num, c_date) 
		values("'. $_SESSION['userid'] .'", '. $bNo .', "'. $c_content .'", null, "'. $date .'")';
	
		$result1 = $db->query($sql1);
		echo $c_content. " ". $bNo." ".$_SESSION['userid']." ". $date;
		
		if($result1)  // query가 정상실행 되었다면,
	
		 echo "글이 정상적으로 작성";

		else
			echo "에러";
		
		?>

		<script>
				//alert('덧글이 작성되었습니다.'); 사용자의 입장에서 불편할 것 같음.
				
				location.replace("<?php echo $url?>");
				</script>;
		

		
	
	
	
	

		
	
	
	
	