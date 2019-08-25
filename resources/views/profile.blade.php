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
	
		@include('database');
		
		# temporary username to query specific record
		$username = 'test';
		
		$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
		
		if(mysqli_num_rows($result) > 0) {
			$row=mysqli_fetch_assoc($result))
				
			
		
		// profile picture
		// username, retrieves username depending on id from database
		echo ($row['username']);
		echo ("<br>");
		// state
		echo ($row['state']);
		echo ("<br>");
		// city
		echo ($row['city']);
		echo ("<br>");
		// country
		echo ($row['country']);
		echo ("<br>");
		// profile blurb
		echo ("This is my profile!");
		echo ("<br>");
		}
		else {
			echo "Profile does not exist";
		}
		
		mysqli_close($conn);
	?>
	
	</body>		

</html>
