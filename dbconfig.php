<?php
	header('Content-Type: text/html; charset=utf-8');
	
	$db = new mysqli('210.117.181.21', 's201615383', 'tjdduswldnjs12!', 's201615383');

	if($db->connect_error) {

		die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

	}



	$db->set_charset('utf8');

?>