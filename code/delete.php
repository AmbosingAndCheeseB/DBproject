<?php

	require_once("./dbconfig.php");



	//$_GET['bno']이 있어야만 글삭제가 가능함.

	if(isset($_GET['board_num'])) {

		$bNo = $_GET['board_num'];

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

		<h3>후기 자유게시판 글삭제</h3>

		<?php

			if(isset($bNo)) {

				$sql = 'select count(board_num) as cnt from board where board_num = ' . $bNo;

				$result = $db->query($sql);

				$row = $result->fetch_assoc();

				if(empty($row['cnt'])) {

		?>

		<script>

			alert('글이 존재하지 않습니다.');

			history.back();

		</script>

		<?php

			exit;

				}

				

				$sql = 'select title from board where board_num = ' . $bNo;

				$result = $db->query($sql);

				$row = $result->fetch_assoc();

		?>

		<div id="boardDelete">

			<form action="./delete_update.php" method="post">

				<input type="hidden" name="bno" value="<?php echo $bNo?>">

				<table>

					<caption class="readHide">자유게시판 글삭제</caption>

					<thead>

						<tr>

							<th scope="col" colspan="2">글삭제</th>

						</tr>

					</thead>

					<tbody>

						<tr>

							<th scope="row">글 제목</th>

							<td><?php echo $row['title']?></td>

						</tr>

						<tr>

							<th scope="row"><label for="bPassword">비밀번호</label></th>

							<td><input type="password" name="bPassword" id="bPassword"></td>

						</tr>

					</tbody>

				</table>



				<div class="btnSet">

					<button type="submit" class="btnSubmit btn">삭제</button>

					<a href="./board.php" class="btnList btn">목록</a>

				</div>

			</form>

		</div>

	<?php

		//$bno이 없다면 삭제 실패

		} else {

	?>

		<script>

			alert('정상적인 경로를 이용해주세요.');

			history.back();

		</script>

	<?php

			exit;

		}

	?>

	</article>

</body>

</html>
