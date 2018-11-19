<?php
	session_start();

	require_once("./dbconfig.php");

	$bNo = $_GET['board_num'];
	
	
	if(!empty($bNo) && empty($_COOKIE['board_' . $bNo])) {

		$sql = 'update board set visit = visit + 1 where board_num = ' . $bNo;

		$result = $db->query($sql); 

		if(empty($result)) {

			?>

			<script>

				alert('오류가 발생했습니다.');

				history.back();

			</script>

			<?php 

		} else {

			setcookie('board_' . $bNo, TRUE, time() + (60 * 60 * 24), '/');

		}

	}



	$sql = 'select title, b_content, b_date, visit, user_id from board where board_num = ' . $bNo;

	$result = $db->query($sql);

	$row = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>후기 자유게시판</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>

<body>

	<article class="boardArticle">

	<h3>후기 자유게시판 글쓰기</h3>

	<div id="boardView">

		<h3 id="boardTitle"><?php echo $row['title']?></h3>

		<div id="boardInfo">

			<span id="boardID">작성자: <?php echo $row['user_id']?></span>

			<span id="boardDate">작성일: <?php echo $row['b_date']?></span>

			<span id="boardVisit">조회: <?php echo $row['visit']?></span>

		</div>
		<script>
			function del(href)
			{
				if(confirm("정말 삭제하시겠습니까?"))
				{
					document.location.href = href;
				}
			}
			
		</script>

		<div id="boardContent"><?php echo $row['b_content']?></div>
		<div class="btnSet">
		
		
		<?php
		if(isset($_SESSION["userid"]))
		{
			if($_SESSION["userid"] == $row['user_id'])
			{
				?>
				<a href="./board_write.php?board_num=<?php echo $bNo?>">수정</a>
				<?php
			}
		}
		?>
		
		<?php 
		if(isset($_SESSION["userid"]))
		{
			if($_SESSION["userid"] == $row['user_id'])
			{?>

				<a href="javascript:del('delete_update.php?board_num=<?php echo $bNo?>')">삭제</a>
		
			<?php }
		} ?>
		<a href="./board.php">목록</a>

	</div>

	</div>

</article>

</body>

</html>