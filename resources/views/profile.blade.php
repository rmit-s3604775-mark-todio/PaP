@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Test Profile</div>
					<div class="container">
						<div class="row">
							<div class="col-3 nav-menu justify-content-center">
								@component('components.profile-menu')
								@endcomponent
							</div>		
	
	<?php
	
	# session ID
	
	define("DB_HOST", "35.189.36.51");
	define("DB_NAME", "pap_db");
	define("DB_USER", "root");
	define("DB_PASS", "7hvwaEG7q0jxi3vt");
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	};
	
		# temporary username to query specific record
		//$username = 'test';
		
		//$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
		
		//if(mysqli_num_rows($result) > 0) {
		//	$row=mysqli_fetch_assoc($result);
							
		// profile picture
		// username, retrieves username depending on id from database
		// state
		//echo $row['state'];
		echo ("Victoria");
		echo ("<br>");
		// city
		//echo $row['city'];
		echo ("Melbourne");
		echo ("<br>");
		// country
		//echo $row['country'];
		echo ("Australia");
		echo ("<br>");
		// profile blurb
		echo ("This is my profile!");
		echo ("<br>");
		//}
		//else {
		//	echo "Profile does not exist";
		//}
		
		mysqli_close($conn);
		?>
			</div>
		</div>
	</div>
</div>
@endsection


