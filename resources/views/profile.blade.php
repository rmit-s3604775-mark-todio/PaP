<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

	<body>

		
		<?php
		#@section('sidebar')
		#echo "<img src="profilepic.png" alt="Profile Picture">";
		#echo "<a href="editprofile">Edit Profile</a>";
		#echo "<a href="products">Products</a>";
		#echo "<a href="requests">Product Requests</a>";
		#echo "<a href="reviews">Reviews</a>";
		#echo "<a href="inbox">Inbox</a>";
		#@show
	
	#@section('content')
		
		echo Form::open(array('url' => 'foo/bar'));
			echo '<br/>';
			echo Form::text('firstname', 'First Name:');
			echo '<br/>';
			echo Form::text('lastname', 'Last Name:');
			echo '<br/>';
			echo Form::text('username', 'Username:');
			echo '<br/>';
			echo Form::email('email', 'Email:');
			echo '<br/>';
			echo Form::password('password');
			echo '<br/>';
			echo Form::text('addressline1');
			echo '<br/>';
			echo Form::text('addressline2');
			echo '<br/>';
			echo Form::select('state', array('NSW' => 'New South Wales', 'QLD' => 'Queensland', 'SA' => 'South Australia', 'TAS' => 'Tasmania', 'VIC' => 'Victoria', 'WA' => 'Western Australia', 'ACT' => 'Australian Capital Territory'));
			echo '<br/>';
			echo Form::text('postcode');
			echo '<br/>';
			echo Form::text('country', 'Australia');
			echo '<br/>';
			echo Form::file('image');
			echo '<br/>';
			echo Form::submit('Submit');
		echo Form::close();
		
	
		?>

	</body>			

</html>
