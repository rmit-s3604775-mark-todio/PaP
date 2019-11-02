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
                                        <h3>Phones</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row float-right">
                                            <div class="col">
                                                <form class="searchForm d-inline" action="{{ route('phone.search') }}" method="POST">
                                                    @csrf
                                                    <input id="search" class="input-search @error('search') is-invalid @enderror" type="text" name="search" placeholder="Search for..." required />
                                                    <button type="submit" class="submit-search">Search</button>
                                                    @error('search')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror								
                                                </form>
                                                <a href="{{ route('phones.create') }}">
                                                    <button class="fa fa-plus btn btn-create"></button>
                                                </a>
                                            </div>	
                                        </div>
                                    </div>
								</div>
								
								<div class="row">
									<div class="col">
										<table class="table">
											<tr class="table-active">
												<th>Phone Name</th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Brand</th>
												<th>Condition</th>
												<th>Rating</th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
											@if (!$phones->isEmpty())
												@foreach($phones as $phone)
													<tr class="table-default">
														<td>{{$phone->product_name}}</td>
														<td>${{$phone->price}}</td>
														<td>{{$phone->quantity}}</td>
														<td>{{$phone->brand}}</td>
														<td>{{$phone->condition}}</td>
														<td>{{$phone->rating}}</td>
														<td>
															<a href="{{ route('phones.show', [$phone]) }}" data-toggle="tooltip" title="Details">
																<button class="btn btn-secondary" >
																	<i class="fa fa-info"></i>
																</button>
															</a>
														</td>
														<td>
															<a href="{{ route('phones.edit', [$phone])}}" data-toggle="tooltip" title="Edit">
																<button class="btn btn-secondary">
																	<i class="fa fa-edit"></i>
																</button>
															</a>
														</td>
														
														<td><form action="{{ route('phones.destroy', [$phone]) }}" method="post">
															@csrf
															@method('delete')
															
															<button class="btn btn-danger btn-xs" type="submit" value="Delete" data-toggle="tooltip" title="Delete">
																<i class="fa fa-trash"></i>
															</button>
															
															</form>
														
														</td>
													</tr>
												@endforeach
											@endif
										</table>
									</div>
								</div>
								@if ($phones->isEmpty())
								<div class="row">
									<div class="col text-center">
										<h3>No Phones Found</h3>
									</div>
								</div>
								@endif
								<div class="row justify-content-center">
									<div class="links">
										{{ $phones->links() }}
									</div>
								</div>

								<div class="container">
								  <!-- Modal -->
								  <div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog">
									
									  <!-- Modal content-->
									  <div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Edit Phone</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" action="{{route('phones.store')}}" method="post">
											{{csrf_field()}}
												Phone Name: <input type="text" name="product_name"><br>
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