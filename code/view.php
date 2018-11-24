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

				loaction.replace("./board.php");

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
		

		
		
		
		<div id="boardContent"><?php echo $row['b_content']?></div>
		<?php
			
			$sql3 = "select * from comment where board_num = ". $bNo;
			
			$result3 = $db -> query($sql3);
			
			
			while($row3 = $result3 ->fetch_assoc())
			{
				?>
				
			<div id = comment_writer_title">
			<ul>
				<li id = "writer_title1"><?php echo $row3['user_id'];?></li>
				<li id = "writer_title2"><?php echo $row3['c_date'];?></li>
				&nbsp;&nbsp;
		
				<a href = "./delete_comment.php?board_num=<?php echo $bNo;?>&c_num=<?php echo $row3['c_num'];?>"> [삭제]</a>
		
		
					
		
				
			</ul>
			
			</div>
			
			<div id = "comment_content"><?php echo $row3['c_content'];?></div>
			
			<?php
			}
			?>
	
			<form name = "comment_form" method ="post" action = "insert_comment.php?board_num=<?php echo $bNo;?>">
				<div id = "comment_box">
					<li id = "comment_insert"> 덧글쓰기 </li>
				<div id = "comment_box1"><textarea rows="5" cols="65" name="c_content" required></textarea>
				<button type="submit" id="btn" >덧글쓰기</button>
				</div>
			</form>
		
			
		
		
		
		
		
		
		<script>
			function del(href)
			{
				if(confirm("정말 삭제하시겠습니까?"))
				{
					document.location.href = href;
				}
			}
			
		</script>
		
		
		
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
			if($_SESSION["userid"] == $row['user_id'] || $_SESSION["authority"] == 77)
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