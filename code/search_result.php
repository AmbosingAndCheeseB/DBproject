<?php	
	include "dbconfig.php";
	
	session_start();
	
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
					
					<th scope="col" class="hosp_addr"> 주소 </th>
					<?php 
					if($_SESSION['authority']==77)
					{
						?>
					<th scope="col" class="hos_modi">수정</th>
					
					<th scope="col" class="hos_dele">삭제</th>
					
					<?php
					}
					?>

				</tr>

			</thead>
			<?php
			if ($_SESSION['authority']==77)
			{?>
				<input type="button" value = "병원정보 추가" onclick = "location.href = 'hospital_add.php'">
			<?
			}
			?>
				
			<tbody>
			
			
			<?php
			
						
						
								while($s_result = $result->fetch_array()){
									
									?><html>
											<body> 
												<tr>
													<td class = 'hosp_id'><?php echo $s_result[0]; ?></td>
													<td class = 'hosp_name'> <a href='detail.php?h_id=<?php echo $s_result[0]; ?>'> <?php echo $s_result[1]; ?></a></td>
													<td class = 'call_num'> <?php echo $s_result[2]; ?>] </td>
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


	</article>

</body>

</html>