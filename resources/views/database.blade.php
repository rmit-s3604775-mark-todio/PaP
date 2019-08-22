<?php

	define("DB_HOST", "35.189.36.51");
	define("DB_NAME", "pap_db");
	define("DB_USER", "root");
	define("DB_PASS", "7hvwaEG7q0jxi3vt");
	
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (!$db) {
		die('Could not connect: ' . mysql_error());
	};
?>