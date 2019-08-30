@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <div class="row justify-content-center">
                            <span class="col-6 text-left">
                                Profile Page
                            </span>
                            <span class="col-6 text-right">
                               
                            </span>
                        </div> 
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-3 nav-menu justify-content-center">
                            @component('components.profile-menu')
                            @endcomponent
                        </div>
                        <div class="col-9">
                            <div class="card-body">
                                	<?php
	
									# session ID
									
									define("DB_HOST", "localhost");
									define("DB_NAME", "pap_db");
									define("DB_USER", "root");
									define("DB_PASS", "");
									
									$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
									
									if (!$conn) {
										die('Could not connect: ' . mysql_error());
									};
									
										# temporary username to query specific record
										$username = 'testuser';
										
										$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
										
										if(mysqli_num_rows($result) > 0) {
											$row=mysqli_fetch_assoc($result);
															
										// username, retrieves username depending on id from database
										// name
										echo ("<h1>");
										echo $row['username'];
										echo ("</h1><br>");
										// state
										echo $row['state'];
									
										echo (", <br>");
										// city
										echo $row['city'];
										echo (", <br>");
										// country
										echo $row['country'];
										echo ("<br>");
										// profile blurb; unsure if it should be on user table or another table
										echo ("This is my profile!");
										echo ("<br> <br>");
										}
										else {
											echo "Profile does not exist";
										}
										
										mysqli_close($conn);
									?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

	



