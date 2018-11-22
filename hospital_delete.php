<?php

	require_once("./dbconfig.php");
	
	$hospital_id = $_GET['hospital_id'];








//병원 정보 삭제


		$sql = 'delete from hospital where hospital_id = '. $hospital_id;

		$result = $db->query($sql);

		//$row = $result->fetch_assoc();
		
		echo "<script>
				alert(\"병원정보가 삭제되었습니다.\");
				history.go(-2);
				</script>";
		

				
		
		

?>
		
