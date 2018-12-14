<?php
	include "dbconfig.php";
	session_start();

	$hospital = $_GET['h_id'];
	$sql1 = 'select * from hospital where Hospital_ID = "'.$hospital.'" ';
	$result1 = $db->query($sql1);
	$info1 = $result1->fetch_array();
	
	
	
	$sql2 = 'select * from time where Hospital_ID = "'.$hospital.'" ';
	$result2 = $db->query($sql2);
	$info2 = $result2->fetch_array();
	
	
	
	$sql3 = 'select Hospital_Name from hospital where Hospital_ID = "'.$hospital.'" ';
	$result3 = $db->query($sql3);
	$temp = $result3->fetch_array();

	
	$sql4 = 'select * from board where B_content like "%'.$temp[0].'%" ';
	$result4 = $db->query($sql4);
	
	
?>
<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>병원 상세정보</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>
	<script>
		function back()
		{
			history.back();
		}
	</script>
	<body>
		<h2>병원 상세정보</h2>
		<br>
		<br>
		<hr>


		<h3>병원 이름</h3>
		<p>

		<p> 

			<br><br>
			<?php echo $info1[1];?></p>
		
		<br>
		<br>
		<br>
		<hr>

	
		<h3>전화번호</h3>

		<p>
			<br><br><?php echo $info1[2];?></p>
			<br>
		
			<hr>
		<h3>주소</h3>

			<br><br><?php echo $info1[3];?> </p>
		

		<br>
		<hr>

		<h3>병원 진료시간</h3>
		<table style = "width=100%">
			<tr>

					<th scope="col" class="hos_mon">월요일</th>

					<th scope="col" class="hos_tue">화요일</th>

					<th scope="col" class="hos_wed">수요일</th>
				
					<th scope="col" class="hos_thr">목요일</th>
				
					<th scope="col" class="hos_fri">금요일</th>
				
					<th scope="col" class="hos_sat">토요일</th>
				
					<th scope="col" class="hos_sun">일요일</th>
				
					<th scope="col" class="hos_holi">공휴일</th>
																	  
				</tr>
			
			<tr>
				
				<td class = "hos_mon"><?php echo " ".$info2[1]." ";?></td>
				
				<td class = "hos_tue"><?php echo " ".$info2[2]." ";?></td>
				
				<td class = "hos_wed"><?php echo " ".$info2[3]." ";?></td>
				
				<td class = "hos_thr"><?php echo " ".$info2[4]." ";?></td>
				
				<td class = "hos_fri"><?php echo " ".$info2[5]." ";?></td>
				
				<td class = "hos_sat"><?php echo " ".$info2[6]." ";?></td>
				
				<td class = "hos_sun"><?php echo " ".$info2[7]." ";?></td>
				
				<td class = "hos_holi"><?php echo " ".$info2[8]." ";?></td>
		
			</tr>
			</table>


		
		<br>
		<br>
		<br>
		<hr>

		<h3>병원 위치 정보</h3>

	

		
	<div id="map" style="width:100%;height:350px;"></div>
		<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=f722b2f37d3075fced8b4fa988359be7&libraries=services"></script>
<script>
	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
		mapOption = {
			center: new daum.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
			level: 3 // 지도의 확대 레벨
		};  

	// 지도를 생성합니다    
	var map = new daum.maps.Map(mapContainer, mapOption); 

	// 주소-좌표 변환 객체를 생성합니다
	var geocoder = new daum.maps.services.Geocoder();

	// 주소로 좌표를 검색합니다
	geocoder.addressSearch('<?php echo $info1[3];?>', function(result, status) {

    // 정상적으로 검색이 완료됐으면 
     if (status === daum.maps.services.Status.OK) {

        var coords = new daum.maps.LatLng(result[0].y, result[0].x);

        // 결과값으로 받은 위치를 마커로 표시합니다
        var marker = new daum.maps.Marker({
            map: map,
            position: coords
        });

        // 인포윈도우로 장소에 대한 설명을 표시합니다
        var infowindow = new daum.maps.InfoWindow({
            content: '<div style="width:150px;text-align:center;padding:6px 0;"><?php echo $info1[1]."<br>".$info1[2];?></div>'
        });
        infowindow.open(map, marker);

        // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
        map.setCenter(coords);
	
    }
	
});    
</script>
		
		<br>
		<br>
		<hr>
		<h3>해당 병원 후기 게시판</h3>
		<table style = "width=100%">
			<tr>

					<th scope="col" class="num">번호</th>

					<th scope="col" class="title">제목</th>

					<th scope="col" class="author">작성자</th>
				
					<th scope="col" class="hits">조회수</th>
				
					<th scope="col" class="date">작성날짜</th>
				
																	  
				</tr>
			
			<tr><?php 
					$i = 0;
					while($info3 = $result4->fetch_array()){
					$i = $i + 1;
					
				?>
				<td class = "num"><?php echo " ".$i." ";?></td>
				
				<td class = "title"><a href='view.php?board_num=<?php echo $info3[0];?>'><?php echo $info3[2]; ?></a></td>
				
				<td class = "author"><?php echo " ".$info3[1]." ";?></td>
				
				<td class = "hits"><?php echo " ".$info3[4]." ";?></td>
				
				<td class = "date"><?php echo " ".$info3[5]." ";?></td>
				
		
			</tr>
			</table>

				
		
		<?php
					}
				?>
		
		
		<div class="btnSet">


				<?php
				if(isset($_SESSION['authority']))
				{
					if($_SESSION["authority"] == 77)
					{
						?>
						<a href="./hospital_modify.php?hospital_id=<?php echo $hospital?>">수정</a>
			
			
						<a href="./hospital_delete.php?hospital_id=<?php echo $hospital?>">삭제</a>
						<?php
					}
				}
				?>
		
			
			<INPUT type="button" name="back_btn" value="목록" onclick = 'back()'>
			
			
			
		</body>

</html>
	