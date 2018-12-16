<?php   
include "code/dbconfig.php";
session_start();
	

?>

<!DOCTYPE html>
<head>
	<title>메인페이지</title>
	<style>
		body {
			background:#DBF0F8;
		}
	</style>
	<link rel= "stylesheet" href="css/searchbox.css">
	<link rel= "stylesheet" href="css/menubar.css">
	<link rel= "stylesheet" href="css/map.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>

	
<ul class="menubar">
  <li><a href="index.php" style="background: #DBF0F8">홈</a></li>
  <li><a href="code/board.php">게시판</a></li>
  <li><a href="code/hospital.php">병원 정보</a></li>
	
	<?php
		if(!$_SESSION['is_login']){
			echo ' <li style = "float:right"><a href="code/login.php">로그인</a></li>
				<li style = "float:right"><a href="code/signup.php">회원가입</a></li>';
		}
		else if($_SESSION['is_login']){

			if($_SESSION['userid']=='admin'&& $_SESSION['authority']==77){
				echo '<li style = "float:right"><a href="code/user_manage.php">유저 관리 페이지</a><li>';
			}
			
			
			echo '<li style = "float:right"><a href="code/logout.php">로그아웃</a><li>';
			echo '<li style = "float:right"><div id = "nick">'.$_SESSION["nickname"].' 님 환영합니다!</div>';
		}
	?>
	
</ul>
	
<div style="text-align: center">
	<img src="image/logo.png" style="margin: 100px auto 0px auto">
</div>
	
<div id="searchbox" class="container">
	<form method="get" action="code/search_result.php" class = "Search">
	
      <select name="searchColumn" class="select">
        <option value="h_name" selected="selected">병원이름/진료과목</option>
        <option value="h_symptom">증상/내용</option>
		<option value="h_map">지도 검색 (병원 이름)</option>
      </select>
      <button id="sr" class="Search-label" for="Search-box"><i class="fa fa-search"></i></button>
      <input type="text" name="search" class="Search-box" autocomplete="off">
    </form>
</div>
	

<?php 
	if(isset($_GET['map_search']))
	{
		$hospi_name = $_GET['map_search'];
		$hospi_name = preg_replace("/\s+/", "", $hospi_name);
		$sql = 'select * from hospital where Hospital_Name like "%'. $hospi_name .'%"';
		$result = $db->query($sql);

		
		
		?>
	<div id="map" style="margin:40px auto 0px auto; width:1000px;height:600px;"></div>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=f722b2f37d3075fced8b4fa988359be7&libraries=services"></script>
<script>
		var container = document.getElementById('map');
		var options = {
			center: new daum.maps.LatLng(35.8343547, 127.1292019),
			level: 8
		};

		var map = new daum.maps.Map(container, options);
		// 주소-좌표 변환 객체를 생성합니다
		var geocoder = new daum.maps.services.Geocoder();
		
		var count = 0;

	
		<?php
			while($row = $result->fetch_array())
			{
				
		?>
	
		geocoder.addressSearch('<?php echo $row['Address']; ?>', function(result, status) {
			
			
		// 정상적으로 검색이 완료됐으면 
			 if (status === daum.maps.services.Status.OK) {

				var coords = new daum.maps.LatLng(result[0].y, result[0].x);

				// 결과값으로 받은 위치를 마커로 표시합니다
				var marker = new daum.maps.Marker({
					map: map,
					position: coords
				});

				// 인포윈도우로 장소에 대한 설명을 표시합니다
				var overlay = new daum.maps.CustomOverlay({
					map : map,
					position : marker.getPosition(),
					content: '<div class="wrap">' + 
				'    <div class="info">' + 
				'        <div class="title">' + 
				'            <?php echo $row['Hospital_Name']?>' + 
				'        </div>' + 
				'        <div class="body">' +           
				'            <div class="desc">' + 
				'                <div class="ellipsis"><?php echo $row['Address']?></div>' + 
				'                <div class="jibun ellipsis"><?php echo $row['Call_Number']?></div>' + 
				'                <div><a href="./code/detail.php?h_id=<?php echo $row['Hospital_ID']; ?>" target="_blank" class="link">더보기</a></div>' + 
				'            </div>' + 
				'        </div>' + 
				'    </div>' +    
				'</div>'
				});
				overlay.setMap(null);
				 
				
				 daum.maps.event.addListener(marker, 'click', makeClickListener(map, overlay));

				 
			 function makeClickListener(map, overlay) {
					return function() {
							
						if(count == 0)
						{
							overlay.setMap(map);
							count = count + 1;
						}
							
						else{
							overlay.setMap(null);
							count = 0;
						}

					};
				}
			

				}
			 


		});
		
		<?php }?>
	
	</script>
<?php	
	}
	
	else{
		
		$sql = 'select * from hospital';
		$result = $db->query($sql);

		?>
		<div id="map" style="margin:40px auto 0px auto; width:1000px;height:600px;"></div>
	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=f722b2f37d3075fced8b4fa988359be7&libraries=services"></script>
	<script>
		var container = document.getElementById('map');
		var options = {
			center: new daum.maps.LatLng(35.8343547, 127.1292019),
			level: 8
		};
		 
	
		var map = new daum.maps.Map(container, options);
		// 주소-좌표 변환 객체를 생성합니다
		var geocoder = new daum.maps.services.Geocoder();
	
		var count = 0;
		
		<?php
			while($row = $result->fetch_array())
			{
				
		?>

		geocoder.addressSearch('<?php echo $row['Address']; ?>', function(result, status) {
			
			
		// 정상적으로 검색이 완료됐으면 
			 if (status === daum.maps.services.Status.OK) {

				var coords = new daum.maps.LatLng(result[0].y, result[0].x);

				// 결과값으로 받은 위치를 마커로 표시합니다
				var marker = new daum.maps.Marker({
					map: map,
					position: coords
				});

				// 인포윈도우로 장소에 대한 설명을 표시합니다
				var overlay = new daum.maps.CustomOverlay({
					map : map,
					position : marker.getPosition(),
					content: '<div class="wrap">' + 
				'    <div class="info">' + 
				'        <div class="title">' + 
				'            <?php echo $row['Hospital_Name']?>' + 
				'        </div>' + 
				'        <div class="body">' +           
				'            <div class="desc">' + 
				'                <div class="ellipsis"><?php echo $row['Address']?></div>' + 
				'                <div class="jibun ellipsis"><?php echo $row['Call_Number']?></div>' + 
				'                <div><a href="./code/detail.php?h_id=<?php echo $row['Hospital_ID']; ?>" target="_blank" class="link">더보기</a></div>' + 
				'            </div>' + 
				'        </div>' + 
				'    </div>' +    
				'</div>'
				});
				overlay.setMap(null);
				 
				
				 daum.maps.event.addListener(marker, 'click', makeClickListener(map, overlay));

				 
			 function makeClickListener(map, overlay) {
					return function() {
							
						if(count == 0)
						{
							overlay.setMap(map);
							count = count + 1;
						}
							
						else{
							overlay.setMap(null);
							count = 0;
						}

					};
				}
			

				}
			 


		});
		
		<?php }
	}
	?>
	
	
	

	</script>
	<p>마커를 한번 클릭하면 병원 정보가 나타나고, 한번 더 클릭하면 사라집니다.
	</p>

 
</body>
</html>