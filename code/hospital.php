<?php	
	include "dbconfig.php";
	session_start();
	
	
	
	if(isset($_GET['page'])) {

		$page = $_GET['page'];

	} else {

		$page = 1;

	}
	
	$sql = 'select count(*) as cnt from hospital';

	$result = $db->query($sql);

	$row = $result->fetch_assoc();
	
	$allPost = $row['cnt']; //전체 게시글의 수
	
	
	$onePage = 15; // 한 페이지에 보여줄 게시글의 수.

	$allPage = ceil($allPost / $onePage); //전체 페이지의 수

	

	if($page < 1 || ($allPage && $page > $allPage)) {

?>

		<script>

			alert("존재하지 않는 페이지입니다.");

			history.back();

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

		$paging .= '<li class="blocks"><a href="./hospital.php?page=1">처음</a></li>';

	}

	//첫 섹션이 아니라면 이전 버튼을 생성

	if($currentSection != 1) { 

		$paging .= '<li class="blocks"><a href="./hospital.php?page=' . $prevPage .'">이전</a></li>';

	}

	

	for($i = $firstPage; $i <= $lastPage; $i++) {

		if($i == $page) {

			$paging .= '<li class="blocks active">' . $i . '</li>';

		} else {

			$paging .= '<li class="blocks"><a href="./hospital.php?page='. $i .'">' . $i . '</a></li>';

		}

	}

	

	//마지막 섹션이 아니라면 다음 버튼을 생성

	if($currentSection != $allSection) { 

		$paging .= '<li class="blocks"><a href="./hospital.php?page=' . $nextPage .'">다음</a></li>';

	}

	

	//마지막 페이지가 아니라면 끝 버튼을 생성

	if($page != $allPage) { 

		$paging .= '<li class="blocks"><a href="./hospital.php?page=' . $allPage . '">끝</a></li>';

	}

	$paging .= '</ul>';

	

	/* 페이징 끝 */

	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지

	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	

	$sql = 'select * from hospital order by Hospital_ID'. $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지

	$result = $db->query($sql);
	
	
?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

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
 	 <li><a href="board.php">게시판</a></li>
	<li><a href="hospital.php" style = "background: #DBF0F8">병원 정보</a></li>
	
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
	
<div style="text-align: center">
	<img src="../image/logo.png" style="width: 50%; margin: 100px auto 0px auto">
</div>
	
		<table class="jbtable" cellspacing="0" cellpadding="0" >

				<tr>
					<th scope="col">번호</th>

					<th scope="col">병원명</th>

					<th scope="col">전화번호</th>
					
					<th scope="col"> 주소 </th>
					
					<?php 
					if($_SESSION['authority']==77)
					{
						?>
					<th scope="col">수정</th>
					
					<th scope="col">삭제</th>
					
					<?php
					}
					?>

				</tr>

		
			
			
			<?php
			
						
						
								while($s_result = $result->fetch_array()){
									
									?><html>
											<body> 
												<tr>
													<td class = 'hosp_id'><?php echo $s_result[0]; ?></td>
													<td class = 'hosp_name'> <a href='detail.php?h_id=<?php echo $s_result[0]; ?>'> <?php echo $s_result[1]; ?></a></td>
													<td class = 'call_num'> <?php echo $s_result[2]; ?> </td>
													<td class = 'hosp_addr'><?php echo $s_result[3]; ?> </td>
											 <?php
													if($_SESSION['authority']==77)
													{
														?>
														<td class="hos_modi"><input type="button" value = "병원정보 수정" onclick = "location.href = 'hospital_modify.php?hospital_id=<?php
														echo $s_result[0];
														?>'"></td>

														<td class="hos_dele"><input type="button" value = "병원정보 삭제" onclick = "location.href = 'hospital_delete.php?hospital_id=<?php
															echo $s_result[0];
														?>'"></td>
											<?php
													}
										?>

												</tr>
											</body>
										</html>
								<?php	
								};
							
						
						
						
					
			?>
						

		

		</table>

		
		<div id="wrap">

			<?php echo $paging ?>

		</div>
			<?php
			if ($_SESSION['authority']==77)
			{?>
				<input type="button" value = "병원정보 추가" onclick = "location.href = 'hospital_add.php'">
			<?php
			}
			?>
		
		<div id="searchbox" class="container">
			<form method="get" action="search_result.php" class = "Search">

			  <select name="searchColumn" class="select">
				<option value="h_name" selected="selected">병원이름/진료과목</option>
				<option value="h_symptom">증상/내용</option>
			  </select>
			  <button id="sr" class="Search-label" for="Search-box"><i class="fa fa-search"></i></button>
			  <input type="text" name="search" class="Search-box" autocomplete="off">
			</form>
		</div>


</body>

</html>