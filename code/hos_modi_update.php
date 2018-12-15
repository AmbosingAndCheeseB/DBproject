<?php

	require_once("./dbconfig.php");
	
	$hospital_id = $_POST['hospital_id'];

	$Address = $_POST['hos_addr'];
	
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
	

	

	



	$sql = 'update hospital set hospital_name="' . $hospital_name . '",
	call_number = "' . $hospital_call . '",
	address = "'. $Address . '",
	monday = "'. $monday .'" ,
	tuesday = "'. $tuesday .'",
	wednesday = "'. $wednesday .'",
	thursday = "'. $thursday .'",
	friday = "'. $friday .'",
	saturday = "'. $saturday .'",
	sunday = "'. $sunday .'",
	public_holiday = "'. $public_day .'" where hospital_id = ' . $hospital_id;
		
		

		
	$result = $db -> query($sql);



	if($result)
	{
		?>
		<script>

			alert("병원정보가 수정되었습니다.");

			location.replace("./hospital_info.php");

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



