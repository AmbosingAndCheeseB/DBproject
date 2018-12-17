<?php
	
	session_start();
	unset($REQUEST_METHOD);


	require_once("./dbconfig.php");
	
	/* 페이징 시작 */

	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.

	if(isset($_GET['page'])) {

		$page = $_GET['page'];

	} else {

		$page = 1;

	}
	
	/* 검색 시작 */

	

	if(isset($_GET['searchColumn'])) {

		$searchColumn = $_GET['searchColumn'];

		$subString .= '&amp;searchColumn=' . $searchColumn;

	}

	if(isset($_GET['searchText'])) {

		$searchText = $_GET['searchText'];

		$subString .= '&amp;searchText=' . $searchText;

	}

	

	if(isset($searchColumn) && isset($searchText)) {

		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';

	} else {

		$searchSql = '';

	}

	

	/* 검색 끝 */


	$sql = 'select count(*) as cnt from board' . $searchSql;
	

	$result = $db->query($sql);

	$row = $result->fetch_assoc();

	

	$allPost = $row['cnt']; //전체 게시글의 수
	
	
	if(empty($allPost)) {

		$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';

	} else {

	

	$onePage = 15; // 한 페이지에 보여줄 게시글의 수.

	$allPage = ceil($allPost / $onePage); //전체 페이지의 수

	

	if($page < 1 || ($allPage && $page > $allPage)) {

?>

		<script>

			alert("존재하지 않는 페이지입니다.");

			location.replace("./board.php");

		</script>

<?php

		exit;

	}

	

	$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)

	$currentSection = ceil($page / $oneSection); //현재 섹션

	$allSection = ceil($allPage / $oneSection); //전체 섹션의 수

	

	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

	

	if($currentSection == $allSection) {

		$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.

	} else {

		$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지

	}

	

	$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.

	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

	

	$paging = '<ul id="pagination">'; // 페이징을 저장할 변수

	

	//첫 페이지가 아니라면 처음 버튼을 생성

	if($page != 1) { 

		$paging .= '<li class="blocks"><a href="./board.php?page=1' . $subString . '">처음</a></li>';

	}

	//첫 섹션이 아니라면 이전 버튼을 생성

	if($currentSection != 1) { 

		$paging .= '<li class="blocks"><a href="./board.php?page=' . $prevPage . $subString . '">이전</a></li>';

	}

	

	for($i = $firstPage; $i <= $lastPage; $i++) {

		if($i == $page) {

			$paging .= '<li class="blocks active">' . $i . '</li>';

		} else {

			$paging .= '<li class="blocks"><a href="./board.php?page=' . $i . $subString . '">' . $i . '</a></li>';

		}

	}

	

	//마지막 섹션이 아니라면 다음 버튼을 생성

	if($currentSection != $allSection) { 

		$paging .= '<li class="blocks"><a href="./board.php?page=' . $nextPage . $subString . '">다음</a></li>';

	}

	

	//마지막 페이지가 아니라면 끝 버튼을 생성

	if($page != $allPage) { 

		$paging .= '<li class="blocks"><a href="./board.php?page=' . $allPage . $subString .'">끝</a></li>';

	}

	$paging .= '</ul>';

	

	/* 페이징 끝 */

	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지

	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	

	$sql = 'select * from board' . $searchSql . ' order by board_num desc' . $sqlLimit;//원하는 개수만큼 가져온다. (0번째부터 20번째까지

	$result = $db->query($sql);
	}
?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />
	<title>자유게시판</title>

	<link rel= "stylesheet" href="../css/menubar.css">
	<link rel="stylesheet" href="../css/board.css" />
	<link rel= "stylesheet" href="../css/board_search.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<style>
		body {
			background:#DBF0F8;
		}
	</style>
	
</head>

<body>

<ul class="menubar">
	<li><a href="../index.php">홈</a></li>
	<li><a href="board.php" style="background: #DBF0F8">게시판</a></li>
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

	
<div style="text-align: left">
	<img src="../image/logo.png" style="width:  600px; margin: 100px auto 0px auto">
</div>
	
			<table class="jbtable" cellspacing="0" cellpadding="0" >

				<tr>

					<th scope="col">번호</th>

					<th scope="col" >제목</th>

					<th scope="col">작성자</th>

					<th scope="col">작성일</th>

					<th scope="col">조회</th>

				</tr>


					<?php
					if(isset($emptyData)) {

							echo $emptyData;

						} else {

						

						while($row = $result->fetch_assoc())

						{
							$sql2 = "select count(*) as cnt from comment where board_num =".$row['board_num'];
							$result2 = $db ->query($sql2);
							$row2 = $result2->fetch_assoc();
							

							$datetime = explode(' ', $row['b_date']);

							$date = $datetime[0];

							$time = $datetime[1];

							if($date == Date('Y-m-d'))

								$row['b_date'] = $time;

							else

								$row['b_date'] = $date;

					?>

				<tr>

					<td class="no"><?php echo $row['board_num']; ?></td>

					<td class="title">
					<a href="./view.php?board_num=<?php echo $row['board_num']?>">
					<?php echo $row['title']." ";
					 if($num_comment)
									{
										print "[<font color=red><b>$num_comment</b></font>]";
									}?></td> </a>

					<td class="author"><?php echo $row['user_id']?></td>

					<td class="date"><?php echo $row['b_date']?></td>

					<td class="hit"><?php echo $row['visit']?></td>

				</tr>

					<?php

						}
					}

					?>

		</table>
	
		<?php
		if(isset($_SESSION["userid"]))
		{
			?>

			<button type = "button" onclick="location.href='board_write.php' " class="btn" style = "margin-left: 1600px">글쓰기</button>
		<?php
		}
		?>
	
	
		<div class="paging">

			 <?php echo $paging ?>

		</div>
	
		<div id="searchbox" class="container">

				<form action="board.php" method="get" class = "Search">

					<select name="searchColumn" class="select">

						<option <?php echo $searchColumn=='title'?'selected="selected"':null?> value="title">제목</option>

						<option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>

						<option <?php echo $searchColumn=='user_id'?'selected="selected"':null?> value="user_id">작성자</option>

					</select>

					<input type="text" name="searchText" class="Search-box" autocomplete="off" value="<?php echo isset($searchText)?$searchText:null?>">

					<button type="submit" id="sr" class="Search-label" for="Search-box"><i class="fa fa-search"></i></button>

				</form>

			</div>

</body>

</html>