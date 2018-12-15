<?php
	
	require_once("./dbconfig.php");

	$sql = 'select * from hospital';

	$result = $db -> query($sql);

	$sql1 = 'select * from hospital';

	$result1 = $db -> query($sql1);


		
?>




<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>병원정보 관리 페이지</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>

<body>

	<article class="boardArticle">

		<h3>병원정보 관리 페이지</h3>

		<table>

			<caption class="readHide">병원정보관리</caption>

			<thead>

				<tr>

					<th scope="col" class="hos_name">병원이름</th>

					<th scope="col" class="hos_addr">주소</th>

					<th scope="col" class="call_num">전화번호</th>

					<th scope="col" class="hos_time">진료 시간</th>
					
					<input type="button" value = "병원정보 추가" onclick = "location.href = 'hospital_add.php'">
																	  
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

					<td class="hos_time"><?php 
									for($i =4; $i < 12; $i++)
									{
										echo $row1[$i]." ";
						
									}?></td>

				</tr>

					<?php

						}
					

					?>

			</tbody>

		</table>
							
	</body>
										
										
</html>