<?php
	include "dbconfig.php";
	session_start();

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
<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>상세정보 페이지</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>
	<body>
		
		<script>
			function back()
			{
				history.go(-1);
			}
		
		</script>
		
		
		
		<div class="btnSet">


				<?php
				if(isset($_SESSION['authority']))
				{
					if($_SESSION["authority"] == 77)
					{
						?>
						<a href="./hospital_modify.php?hospital_id=<?php echo $hospital?>">수정</a>
			
			
						<a href="./hospital_delete?hospital_id=<?php echo $hospital?>')">삭제</a>
						<?php
					}
				}
				?>
		
			
			<INPUT type="button" name="back_btn" value="목록" onclick = 'back()'>
			
			
			
		</body>

</html>
	