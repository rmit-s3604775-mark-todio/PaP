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

						  <div>
								<a href="{{ route('products.index') }}">Go back</a>
								<h1>Create new item</h1>
								
								<form class="form-horizontal" action="/products" method="post" enctype="multipart/form-data">
								{{csrf_field()}}
									<fieldset>
										<div class="form-group">
											<div class="col-lg-10">
												Product Name: <input type="text" name="product_name"></input><br>
												Price: <input type="number" name="price"><br>
												Quantity: <input type="number" name="quantity"><br>
												

												
												<div class="row">Brand:
													<select name="brand" id="brand">
														<option value="none" selected disabled hidden>Please Select...</option>
														@foreach ($brands as $brand)
														<option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
														@endforeach
													</select>
												</div>
												<div class="row">Condition:
													<select name="condition" id="condition">
														<option value="none" selected disabled hidden>Please Select...</option>
														@foreach ($conditions as $condition)
														<option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
														@endforeach
													</select>
												</div>

												<div>
													<input type="file" name="images[]" class="form-control" multiple required/>
												</div>
												
												<button type="submit" class="btn btn-success">Submit</button>
											</div>
										</div>
									</fieldset>
							</form>
							@if (count($errors)>0)
								<div class="alert alert-danger">
								@foreach($errors->all() as $error)
									<pre>{{$error}}</pre>
								@endforeach
								</div>
							@endif
							
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