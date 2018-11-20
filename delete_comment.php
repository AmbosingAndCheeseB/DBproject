<?php

	session_start();

	require_once('./dbconfig.php');

	$c_num = $_POST['c_num'];
	$bNo = $_POST['board_num'];

	$sql1 = 'select user_id from comment where board_num = '. $bNo .', c_num = '.$c_num;
	$result1 = $db -> query($sql1);
	$row1 = $result1 -> fetch_assoc();

	
	if($_SESSION['userid']== $row1['user_id'])
	{
		$sql2 = 'delete from comment where c_num ='. $c_num .', board_num ='.$bNo;

		$result2 = $db -> query($sql2);
		
		echo "<script>
				alert('글이 삭제되었습니.')
				document.location.href = 'http://210.117.181.21:2018/termprj/s201615383/view.php?board_num='.$bNo 
				</script>";
	}
	
	else
	{
		echo "<script>
				alert('글을 삭제할 권한이 없습니다.')
				document.location.href = 'http://210.117.181.21:2018/termprj/s201615383/view.php?board_num='.$bNo 
				</script>";
	}
		?>

	