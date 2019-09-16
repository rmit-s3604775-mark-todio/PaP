{{-- this is a comment --}}
{{-- navigation bar --}}
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

						
								<div class="row">
									<div class="col">
										<h1>Products</h1>
									</div>
									
									<div class="col">
										<a href="{{ route('products.create') }}" class="float-right" >Add new product</a>
										
										<p>Print icon: <span class="glyphicon glyphicon-print"></span></p>    
									</div>
								</div>
								
								
								
								
								<div>
								
								
								
								<table class="table">
									<div>
										<tr class="table-active">
											<th>ID</th>
											<th>Product Name</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Brand</th>
											<th>Condition</th>
											<th>Rating</th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</div>
									
									<div >
										@foreach($products as $product)
										<tr class="table-default">
											<td>{{$product->id}}</td>
											<td>{{$product->product_name}}</td>
											<td>${{$product->price}}</td>
											<td>{{$product->quantity}}</td>
											<td>{{$product->brand}}</td>
											<td>{{$product->condition}}</td>
											<td>{{$product->rating}}</td>
											<td><button class="btn btn-info btn-xs" href="product/create">details</td>
										<!--	<td><a data-toggle="modal" data-target="#myModal">edit</a></td> -->
											<td><button class="btn btn-warning btn-xs" href="{{ route('products.edit', [$product])}}">edit</button></td>
											
											<td><form action="{{ url('/products', [$product]) }}" method="post">
												<button class="btn btn-danger btn-xs" type="submit" value="Delete">Delete
												</button>
												@method('delete')
												@csrf
											</form>
											
											</td>
						
										</tr>
										@endforeach
									</div>
								</table>
								
								
								
								<div class="container">
								  <!-- Modal -->
								  <div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog">
									
									  <!-- Modal content-->
									  <div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Edit product</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" action="/products" method="post">
											{{csrf_field()}}
												Product Name: <input type="text" name="product_name"></input><br>
												Price: <input type="number" name="product_name"><br>
												Quantity: <input type="number" name="product_name"><br>
												<button type="submit" name="body" class="btn btn-success" value="edit">Submit</button>
											</form>
										</div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									  </div>
									  
									</div>
								  </div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection