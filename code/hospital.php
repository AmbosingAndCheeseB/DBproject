<?php
	
	require_once("./dbconfig.php");

	$sql = 'select * from hospital';

	$result = $db -> query($sql);

	$sql1 = 'select * from hospital';

	$result1 = $db -> query($sql1);

	
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

	

	$sql = 'select count(*) as cnt from hospital' . $searchSql;
	


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

	

	$paging = '<ul>'; // 페이징을 저장할 변수

	

	//첫 페이지가 아니라면 처음 버튼을 생성

	if($page != 1) { 

		$paging .= '<li class="page page_start"><a href="./board.php?page=1' . $subString . '">처음</a></li>';

	}

	//첫 섹션이 아니라면 이전 버튼을 생성

	if($currentSection != 1) { 

		$paging .= '<li class="page page_prev"><a href="./board.php?page=' . $prevPage . $subString . '">이전</a></li>';

	}

	

	for($i = $firstPage; $i <= $lastPage; $i++) {

		if($i == $page) {

			$paging .= '<li class="page current">' . $i . '</li>';

		} else {

			$paging .= '<li class="page"><a href="./board.php?page=' . $i . $subString . '">' . $i . '</a></li>';

		}

	}

	

	//마지막 섹션이 아니라면 다음 버튼을 생성

	if($currentSection != $allSection) { 

		$paging .= '<li class="page page_next"><a href="./board.php?page=' . $nextPage . $subString . '">다음</a></li>';

	}

	

	//마지막 페이지가 아니라면 끝 버튼을 생성

	if($page != $allPage) { 

		$paging .= '<li class="page page_end"><a href="./board.php?page=' . $allPage . $subString .'">끝</a></li>';

	}

	$paging .= '</ul>';

	

	/* 페이징 끝 */

	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지

	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	

	$sql = 'select * from board' . $searchSql . ' order by board_num desc' . $sqlLimit;//원하는 개수만큼 가져온다. (0번째부터 20번째까지

	$result = $db->query($sql);
	}
?>
		
?>




<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>병원정보 페이지</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>

<body>
	<h3>병원 정보</h3>

	<article class="boardArticle">

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

		<table>

			

			<thead>

				<tr>

					<th scope="col" class="hos_name">병원이름</th>

					<th scope="col" class="hos_addr">주소</th>

					<th scope="col" class="call_num">전화번호</th>
																	  
				</tr>

			</thead>

			<tbody>

					<?php

						

						while($row = $result->fetch_assoc())

						{
					
							$row1 = $result1->fetch_array();
							


					?>

				<tr>

					<td class="hos_name">
					 <a href="detail.php?h_id=<?php echo $row['Hospital_ID'];?>"> <?php echo $row['Hospital_Name']; ?></a></td>

					<td class="hos_addr"><?php echo $row['Address']; ?></td>
				
					<td class="call_num"><?php echo $row['Call_Number']?></td>

					
				</tr>

					<?php

						}
					

					?>

			</tbody>

		</table>
							
	</body>
										
										
</html>