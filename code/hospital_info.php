<?php
	
	require_once("./dbconfig.php");

	$sql = 'select * from hospital';

	$result = $db -> query($sql);




		
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

		<h3>병원정보 관리</h3>

		<table>

			<caption class="readHide">병원정보관리</caption>

			<thead>

				<tr>

					<th scope="col" class="hos_name">병원이름</th>

					<th scope="col" class="hos_addr">주소</th>

					<th scope="col" class="call_num">전화번호</th>
					
					<th scope="col" class="hos_modi">수정</th>
					
					<th scope="col" class="hos_dele">삭제</th>
					
					
																	  
				</tr>

			</thead>
			<input type="button" value = "병원정보 추가" onclick = "location.href = 'hospital_add.php'">

			<tbody>

					<?php

						

						while($row = $result->fetch_assoc())

						{
					
							
							


					?>

				<tr>

					<td class="hos_name">
					 <a href="detail.php?h_id=<?php echo $row['Hospital_ID'];?>"> <?php echo $row['Hospital_Name']; ?></a></td>

					<td class="hos_addr"><?php echo $row['Address']; ?></td>
				
					<td class="call_num"><?php echo $row['Call_Number']?></td>
					
					<td class="hos_modi"><input type="button" value = "병원정보 수정" onclick = "location.href = 'hospital_modify.php?hospital_id=<?php
							echo $row['Hospital_ID'];
						?>'"></td>
					
					<td class="hos_dele"><input type="button" value = "병원정보 삭제" onclick = "location.href = 'hospital_delete.php?hospital_id=<?php
							echo $row['Hospital_ID'];
						?>'"></td>

				

				</tr>

					<?php

						}
					

					?>

			</tbody>

		</table>
							
	</body>
										
										
</html>