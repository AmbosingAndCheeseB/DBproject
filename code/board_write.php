<?php

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

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>

<body>

	<article class="boardArticle">

		<h3>후기 자유게시판 글쓰기</h3>

		<div id="boardWrite">

			<form action="./write_update.php" method="post">
				<?php

					if(isset($bNo)) {

						echo '<input type="hidden" name="board_num" value="' . $bNo . '">';

					}

				?>

				<table id="boardWrite">

					<caption class="readHide">후기 자유게시판 글쓰기</caption>

					<tbody>

						


						<tr>

							<th scope="row"><label for="Title">제목</label></th>

							<td class="title"><input type="text" name="Title" id="Title" value = "<?php echo isset($row['title'])?$row['title']:null?>"></td>

						</tr>

						<tr>

							<th scope="row"><label for="bContent">내용</label></th>

							<td class="content"><textarea name="bContent" id="bContent"> <?php echo isset($row['b_content'])?$row['b_content']:null?></textarea></td>

						</tr>

					</tbody>

				</table>

				<div class="btnSet">

					<button type="submit" class="btnSubmit btn"> <?php echo isset($bNo)?'수정':'작성'?> </button>
						

					<a href="./board.php" class="btnList btn">목록</a>

				</div>

			</form>

		</div>

	</article>

</body>

</html>