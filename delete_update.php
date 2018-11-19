<?php

	require_once("./dbconfig.php");
	
	$bNo= $_GET['board_num'];







//글 삭제


		$sql = 'delete from board where board_num = '. $bNo;

		$result = $db->query($sql);

		//$row = $result->fetch_assoc();
		
		echo "<script>
				alert(\"글이 삭제되었습니다.\");
				document.location.href = 'http://210.117.181.21/termprj/s201615383/board.php';
				</script>";
		

				
		
		

?>
		
