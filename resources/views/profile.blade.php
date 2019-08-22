<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

	<body>
	
	<div id="profilesidebar">
		@include('includes.sidebar')
	</div>
	
	<?php
	//@section('content')
		// profile picture
		// name
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
