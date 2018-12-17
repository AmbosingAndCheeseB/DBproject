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

<html><head>

	<meta charset="utf-8" />

	<title>후기 자유게시판</title>
	<link rel= "stylesheet" href="../css/menubar.css">
	<link rel= "stylesheet" href="../css/detail.css">
	
	<style>
		body {
			background:#DBF0F8;
		}
	</style>
</head>

	
<body>

<ul class="menubar">
  <li><a href="../index.php">홈</a></li>
  <li><a href="board.php">게시판</a></li>
	<li><a href="hospital.php">병원 정보</a></li>
	
	<?php
		if(!$_SESSION['is_login']){
			echo ' <li style = "float:right"><a href="login.php">로그인</a></li>
				<li style = "float:right"><a href="signup.php">회원가입</a></li>';
		}
		else if($_SESSION['is_login']){

			if($_SESSION['userid']=='admin'&& $_SESSION['authority']==77){
				echo '<li style = "float:right"><a href="user_manage.php">유저 관리 페이지</a><li>';
			}
			
			
			echo '<li style = "float:right"><a href="logout.php">로그아웃</a><li>';
			echo '<li style = "float:right"><div id = "nick">'.$_SESSION["nickname"].' 님 환영합니다!</div>';
		}
	?>
	
</ul>
	
	
	<table class="jbtable">
		
		<tr>
			<th scope="row">제목</th>
			<td><?php echo $row['title']?></td>
		</tr>
		
		<tr>
			<th scope="row">작성자</th>
			<td><?php echo $row['user_id']?></td>
		</tr>
		
		<tr>
			<th scope="row">작성일</th>
			<td><?php echo $row['b_date']?></td>
		</tr>
		
		<tr>
			<th scope="row">조회</th>
			<td><?php echo $row['visit']?></td>
		</tr>

		<tr>
			<th scope="row">내용</th>
			<td><?php echo nl2br($row['b_content']);?></td>
		</tr>

		<tr>
			<th scope="row">댓글</th>
			<td><?php
			
			$sql3 = "select * from comment where board_num = ". $bNo;
			
			$result3 = $db -> query($sql3);
			
			
			while($row3 = $result3 ->fetch_assoc())
			{
				?>
				
				<p style= "text-align: left">작성자 : <?php echo $row3['user_id'];?>  </p>
				<p style = "text-align: right"> 날짜 : <?php echo $row3['c_date'];?></p>
				&nbsp;&nbsp;
				<p>내용 : <?php echo $row3['c_content'];?></p>
		
				<a href = "./delete_comment.php?board_num=<?php echo $bNo;?>&c_num=<?php echo $row3['c_num'];?>"> [삭제]</a>

			
			<?php
			}
			?></td>
			</tr>
		
		</table>
	
			<form name = "comment_form" method ="post" action = "insert_comment.php?board_num=<?php echo $bNo;?>">
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

</body>

</html>