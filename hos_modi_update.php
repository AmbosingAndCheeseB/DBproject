<?php

	require_once("./dbconfig.php");
	
	$hospital_id = $_GET['hostpital_id'];
	
	$hospital_name = $_POST['hos_name'];

	$hospital_call = $_POST['call'];

	$monday = $_POST['hos_mon'];

	$tuesday = $_POST['hos_tue'];

	$wednesday = $_POST['hos_wed'];

	$thursday = $_POST['hos_thr'];

	$friday = $_POST['hos_fri'];

	$saturday = $_POST['hos_sat'];

	$sunday = $_POST['hos_sun'];

	$public_day = $_POST['hos_pub'];

	



	$sql = 'update hospital set hospital_name="' . $hosiptal_name . '", call_number = "' . $hospital_call . '" where hospital_id = ' . $hospital_id;
		
	$sql2 = 'update time set monday = "'. $monday .'" , tuesday = "'. $tuesday .'", wednesday = "'. $wednesday .'", thursday = "'. $thursday .'", friday = "'. $friday .'", saturday = "'. $saturday .'", sunday = "'. $sunday .'", public_holiday = "'. $public_day .'" where hospital_id = '.$hospital_id;
		

		
	$result = $db -> query($sql);

	$result2 = $db -> query($sql2);


	if($result && $result2)
	{
		?>
		<script>

			alert("병원정보가 수정되었습니다.");

			history.back();

		</script>
<?php
	}
	else
	{
		?>
		<script>

			alert("병원정보를 수정하지 못했습니다.");

			history.back();

		</script>
<?php
	}
?>	



