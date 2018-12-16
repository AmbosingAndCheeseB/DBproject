<?php

	session_start();
	require_once("./dbconfig.php");
	
	
	

	if(isset($_GET['board_num'])) {

		$bNo = $_GET['board_num'];

	}

		 

	if(isset($bNo)) {

		$sql = 'select title, b_content, user_id from board where board_num = ' . $bNo;

		$result = $db->query($sql);

		$row = $result->fetch_assoc();

	}
?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>후기 자유게시판</title>
	
	<style>
		body {
			background:#DBF0F8;
		}
	</style>
	<link rel= "stylesheet" href="../css/menubar.css">
	<link rel= "stylesheet" href="../css/write.css">

</head>

<body>

<ul class="menubar">
	<li><a href="../index.php">홈</a></li>
	<li><a href="board.php">게시판</a></li>
	<li><a href="hospital.php">병원 정보</a></li>
	<li style = "float:right"><a href="logout.php">로그아웃</a><li>
	<?php echo '<li style = "float:right"><div id = "nick">'.$_SESSION["nickname"].' 님 환영합니다!</div>'; ?>
</ul>
	
	<section>
		<h1>글쓰기</h1>

			<form action="write_update.php" method="post">
				<?php

					if(isset($bNo)) {

						echo '<input type="hidden" name="board_num" value="' . $bNo . '">';

					}

				?>

							<input type="text" name="Title" id="Title" value = "<?php echo isset($row['title'])?$row['title']:null?>">

							<textarea name="bContent" id="bContent"> <?php echo isset($row['b_content'])?$row['b_content']:null?></textarea>

					<button type="submit" class="btnSubmit btn"> <?php echo isset($bNo)?'수정':'작성'?> </button>
						
					<a href="board.php">목록</a>

			</form>
	</section>
</body>

</html>