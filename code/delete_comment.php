<?php

	session_start();

	require_once('./dbconfig.php');

	$c_num = $_GET['c_num'];
	$bNo = $_GET['board_num'];
	$url = './view.php?board_num=' . $bNo;



	$sql1 = 'select user_id from comment where board_num = '. $bNo .' and c_num = '.$c_num;
	$result1 = $db -> query($sql1);
	$row1 = $result1 -> fetch_assoc();

	
	if($_SESSION['userid']== $row1['user_id'] || $_SESSION['authority'] == 77)
	{
		$sql2 = 'delete from comment where c_num ='. $c_num .' and board_num ='.$bNo;

		$result2 = $db -> query($sql2);
		?>
		
		<script>
				alert('글이 삭제되었습니다.');
				location.replace("<?php echo $url?>");
				</script>
<?php
	}
	
	else
	{
		?>
		<script>
				alert('글을 삭제할 권한이 없습니다.');
				location.replace("<?php echo $url?>");
				</script>
<?php
	}
		?>

	