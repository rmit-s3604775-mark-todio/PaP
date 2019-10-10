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
                                Admin Dashboard
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
                            @component('components.admin-menu')
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
										<h3>Products</h3>
									</div>
									<div class="row">
                                        <div class="col justify-content-right">
                                            <form class="searchForm" action="{{ route('admin.product.search') }}" method="post">
                                                @csrf
                                                <div class="col">
                                                    <input id="search" class="input-search @error('search') is-invalid @enderror" type="text" name="search" placeholder="Search for..." required />
                                                    <button type="submit" class="submit-search">Search</button>
                                                    @error('search')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>											
                                            </form>
                                        </div>
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
														<td>
															<a href="{{ url('/details', [$product])}}" data-toggle="tooltip" title="Details">
																<button class="btn btn-secondary" >
																	<i class="fa fa-info"></i>
																</button>
															</a>
														</td>
														
														<td><form action="{{ route('admin.product.destroy', [$product]) }}" method="post">
															<button class="btn btn-danger" type="submit" data-toggle="tooltip" title="Delete">
																<i class="fa fa-trash"></i>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
