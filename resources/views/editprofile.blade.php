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

									echo Form::open(array('url' => 'foo/bar'));
										echo '<br/>';
										echo 'First Name: ';
										echo Form::text('firstname', $row['firstname']);
										echo '<br/>';
										echo 'Last Name: ';
										echo Form::text('lastname', $row['lastname']);
										echo '<br/>';
										echo 'Email: ';
										echo Form::email('email', $row['email']);
										echo '<br/>';
										echo 'Address: ';
										echo Form::text('addressline1', $row['addressline1']);
										echo '<br/>';
										echo Form::text('addressline2', $row['addressline2']);
										echo '<br/>';
										echo 'City: ';
										echo Form::text('state', $row['city']);
										echo '<br/>';
										echo 'State: ';
										echo Form::text('state', $row['state']);
										echo '<br/>';
										echo 'Postcode: ';
										echo Form::text('postcode', $row['postcode']);
										echo '<br/>';
										echo 'Country: ';
										echo Form::text('country', $row['country']);
										echo '<br/>';
										# echo Form::file('image');
										echo '<br/>';
										echo Form::submit('Submit');
									echo Form::close();
									
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