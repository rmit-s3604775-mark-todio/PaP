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
                                Dashboard
                            </span>
                            <span class="col-6 text-right">
                                Welcome {{ Auth::user()->name }}
                            </span>
                        </div> 
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-3 nav-menu justify-content-center">
                            @component('components.user-menu')
                            @endcomponent
                        </div>
                        <div class="col-9">
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <h3>Product Request</h3>
       
								This is your product request.
								<br>
								<br>
								I wish to buy this product:
								<br>
								(Show the product table.)
								<table style="background-color:yellow;">
									<tr>
										<th>Product Name</th>
										<th>Brand</th>
										<th>Condition</th>
										<th>Min. Price</th>
										<th>Max. Price</th>
									</tr>
									
									<!--item name -->
									<tr>
										<td>{{$requests->brand}}</td>
									</tr>
								
								
								</table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
