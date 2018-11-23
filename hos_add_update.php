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

	

	



	$sql = 'insert into hospital(Hospital_ID, Hospital_Name, Call_Number, Address)
			values(null, "'. $hospital_name .'", "'. $hospital_call. '", "'. $Address .'")';

	$sql2 = 'insert into time(Hospital_ID, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Public_Holiday, sunday) 
			 values(null, "'. $monday .'", "'. $tuesday .'", "'. $wednesday .'", "'. $thursday .'", "'. $wednesday .'", "'. $thursday .'", "'. $friday .'", "'. $saturday  .'", "'. $sunday .'", "'. $public_day .'")';
		

		
	$result = $db -> query($sql);

	$result2 = $db -> query($sql2);


	if($result)
	{
		?>
		<script>

			alert("병원정보를 추가하였습니다.");

			location.replace("./hospital_info.php");

		</script>
<?php
	}
	else
	{
		?>
		<script>

			alert("병원정보를 추가하지 못했습니다.");

			history.back();

		</script>
<?php
	}
?>	



