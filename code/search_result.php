<?php	
	include "dbconfig.php";
	
	$search = $_GET["search"];
	$search = preg_replace("/\s+/", "", $search);

	$searchColumn = $_GET['searchColumn'];
	
	
	if($search == "" ){
                  echo '<script> alert("검색할 항목을 입력하세요."); history.back(); </script>';
               }
               
    else
	{
                  
			if($_GET["searchColumn"]=="h_name"){
                     
                $sql = 'select * from hospital where Hospital_Name like "%'.$search.'%" ';
                     
                $result = $db->query($sql);
                     
                if(!($s_result = $result->fetch_array())){
                        ?>
					<script>
						alert("해당하는 검색 결과가 없습니다.");
						history.back();
						
					</script>
                    
					<?php
                 }
                     
			}
                  
                  
    }
	
	
	
	if(isset($_GET['page'])) {

		$page = $_GET['page'];

	} else {

		$page = 1;

	}
	
	$sql = 'select count(*) as cnt from hospital where Hospital_Name like "%'.$search.'%" ';

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

	

	$paging = '<ul>'; // 페이징을 저장할 변수

	$search_temp = "&amp;searchColumn=".$searchColumn."&amp;search=".$search;

	//첫 페이지가 아니라면 처음 버튼을 생성

	if($page != 1) { 

		$paging .= '<li class="page page_start"><a href="./search_result.php?page=1'.$search_temp.'">처음</a></li>';

	}

	//첫 섹션이 아니라면 이전 버튼을 생성

	if($currentSection != 1) { 

		$paging .= '<li class="page page_prev"><a href="./search_result.php?page=' . $prevPage . $search_temp. '">이전</a></li>';

	}

	

	for($i = $firstPage; $i <= $lastPage; $i++) {

		if($i == $page) {

			$paging .= '<li class="page current">' . $i . '</li>';

		} else {

			$paging .= '<li class="page"><a href="./search_result.php?page=' . $i .$search_temp. '">' . $i . '</a></li>';

		}

	}

	

	//마지막 섹션이 아니라면 다음 버튼을 생성

	if($currentSection != $allSection) { 

		$paging .= '<li class="page page_next"><a href="./search_result.php?page=' . $nextPage . $search_temp.'">다음</a></li>';

	}

	

	//마지막 페이지가 아니라면 끝 버튼을 생성

	if($page != $allPage) { 

		$paging .= '<li class="page page_end"><a href="./search_result.php?page=' . $allPage .$search_temp. '">끝</a></li>';

	}

	$paging .= '</ul>';

	

	/* 페이징 끝 */

	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지

	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	

	$sql = 'select * from hospital where Hospital_Name like "%'.$search.'%" order by Hospital_ID'. $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지

	$result = $db->query($sql);
	
	
?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>후기 게시판</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>

<body>

	<article class="boardArticle">

		<h3>아프니까 병원이다</h3>

		<table>

			<caption class="readHide">검색 결과</caption>

			<thead>

				<tr>
					<th scope="col" class="hosp_id">번호</th>

					<th scope="col" class="hosp_name">병원명</th>

					<th scope="col" class="call_num">전화번호</th>

				</tr>

			</thead>

			<tbody>
			
			
			<?php
			
						
						
								while($s_result = $result->fetch_array()){
									
									echo "<html>
											<body> 
												<tr>
													<td class = 'hosp_id'>$s_result[0] </td>
													<td class = 'hosp_name'> <a href='detail.php?h_id=$s_result[0]'> $s_result[1]</a></td>
													<td class = 'call_num'>  $s_result[2] </td>
												</tr>
											</body>
										</html>";
									
								};
							
						
						
						if($_GET["searchColumn"]=="h_symptom"){
							
							echo "<script>location.href='board.php?searchColumn=b_content&searchText=$search';</script>";
							
						}
					
			?>
						

		

			</tbody>

		</table>

		
		</div>
		<div class="paging">

			<?php echo $paging ?>

		</div>
		
		<div class="searchBox">

				<form action="./board.php" method="get">

					<select name="searchColumn">

						<option <?php echo $searchColumn=='title'?'selected="selected"':null?> value="title">제목</option>

						<option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>

						<option <?php echo $searchColumn=='user_id'?'selected="selected"':null?> value="user_id">작성자</option>

					</select>

					<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">

					<button type="submit">검색</button>

				</form>

			</div>

	</article>

</body>

</html>