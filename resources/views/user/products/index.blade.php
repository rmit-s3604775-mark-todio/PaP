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
									<div class="col float-left">
										<h1>Products</h1>
									</div>
									<div class="col float-end">
										<form action="{{ route('product.search') }}" method="post">
											@csrf
											<div class="row">
												<input id="search" class="form-controll @error('search') is-invalid @enderror" type="text" name="search" required>
												<button type="submit" class="btn btn-primary">Search</button>
												@error('search')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>											
										</form>
									</div>
									<div class="col float-right">
										<a href="{{ route('products.create') }}"><button>Add new product</button></a>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<table class="table">
											<tr class="table-active">
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
											@if (!$products->isEmpty())
												@foreach($products as $product)
													<tr class="table-default">
														<td>{{$product->product_name}}</td>
														<td>${{$product->price}}</td>
														<td>{{$product->quantity}}</td>
														<td>{{$product->brand}}</td>
														<td>{{$product->condition}}</td>
														<td>{{$product->rating}}</td>
														<td><a href="{{ url('/details', [$product])}}"><button class="btn btn-info btn-xs" >details</button></a></td>
														<td><a href="{{ route('products.edit', [$product])}}"><button class="btn btn-warning btn-xs">edit</button></a></td>
														
														<td><form action="{{ url('/products', [$product]) }}" method="post">
															<button class="btn btn-danger btn-xs" type="submit" value="Delete">Delete
															</button>
															@method('delete')
															@csrf
															</form>
														
														</td>
													</tr>
												@endforeach
											@endif
										</table>
									</div>
								</div>
								@if ($products->isEmpty())
								<div class="row">
									<div class="col text-center">
										<h3>No Products Found</h3>
									</div>
								</div>
								@endif
								<div class="row justify-content-center">
									<div class="links">
										{{ $products->links() }}
									</div>
								</div>

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