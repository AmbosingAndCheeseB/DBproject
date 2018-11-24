<?php
	session_start();

	require_once("./dbconfig.php");
	
	
	if(isset($_POST['board_num'])) {

		$bNo = $_POST['board_num'];

	}
	

	if(empty($bNo)) {
	
	
	$date = date('Y-m-d H:i:s');

	}
	
	
	
	$title = $_POST['Title'];
	

	$bContent = $_POST['bContent'];

	

	
if(isset($bNo)) {



	$sql = 'select user_id as cnt from board where user_id = "'. $_SESSION['userid'] .'" and board_num = ' . $bNo;

	$result = $db->query($sql);

	$row = $result->fetch_assoc();

	



	if($row['cnt'] == $_SESSION['userid']) {

		$sql = 'update board set title="' . $title . '", b_content="' . $bContent . '" where board_num = ' . $bNo;

		$msgState = '수정';

	//틀리다면 메시지 출력 후 이전화면으로

	} else {

		$msg = '글을 수정할 권한이 없습니다.';

	?>

		<script>

			alert("<?php echo $msg?>");

			history.back();

		</script>

	<?php

		exit;

	}

	

//글 등록

}   
    else {




		$sql = 'insert into board(board_num, title, B_content, b_date, visit, user_id) 
		values(null, "' . $title . '", "' . $bContent . '", "' . $date . '", 0 , "' . $_SESSION['userid']. '")';
		
		$msgState = '등록';

 }
 
 if(empty($msg)) {




	$result = $db->query($sql);

	if($result) { // query가 정상실행 되었다면,
	
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';

		if(empty($bNo)) {

			$bNo = $db->insert_id;

		}



		$replaceURL = './view.php?board_num=' . $bNo;

	} else {

		$msg = '글을 ' . $msgState . '하지 못했습니다.';

?>

		<script>

			alert("<?php echo $msg?>");

			history.back();

		</script>

<?php


	exit;

	}
 }


?>

<script>

	alert("<?php echo $msg?>");

	location.replace("<?php echo $replaceURL?>");

</script>