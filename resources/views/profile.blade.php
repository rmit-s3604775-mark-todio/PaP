<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

	<body>
	
	<div id="profilesidebar">
		@include('profilesidebar')
	</div>
	
	<?php
	
	define("DB_HOST", "35.189.36.51");
	define("DB_NAME", "pap_db");
	define("DB_USER", "root");
	define("DB_PASS", "7hvwaEG7q0jxi3vt");
	
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (!$db) {
		die('Could not connect: ' . mysql_error());
	};
	
	
	//@section('content')
		// profile picture
		// username, retrieves username depending on id from database
		echo ("<h1>SampleUserName</h1>");
		echo ("<br>");
		// state
		echo ("Victoria");
		echo ("<br>");
		// city
		echo ("Melbourne");
		echo ("<br>");
		// country
		echo ("Australia");
		echo ("<br>");
		// profile blurb
		echo ("This is my profile!");
		echo ("<br>");

	?>
	
	</body>		

</html>
