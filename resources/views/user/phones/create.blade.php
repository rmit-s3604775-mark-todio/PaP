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
								<h1>Create new Phone Listing</h1>
								
								<form class="form-horizontal" action="{{route('phones.store')}}" method="post" enctype="multipart/form-data">
								{{csrf_field()}}
									<fieldset>
										<div class="form-group">
											<label for="product_name">Phone Name</label>
											<input type="text" name="product_name" class="form-control">
										</div>

										<div class="form-group">
												<label for="price">Price</label>
												<input type="decimal" name="price" class="form-control">
										</div>

										<div class="form-group">
												<label for="quanity">Quantity</label>
												<input type="number" name="quantity" class="form-control">
										</div>

										<div class="form-group">
											<label for="brand">Brand</label>
											<select name="brand" id="brand" class="form-control">
												<option value="none" selected disabled hidden>Please Select...</option>
												@foreach ($brands as $brand)
												<option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label for="condition">Condition</label>
											<select name="condition" id="condition" class="form-control">
												<option value="none" selected disabled hidden>Please Select...</option>
												@foreach ($conditions as $condition)
												<option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label for="description">Description</label>
											<textarea rows="4" name="description" class="form-control" ></textarea>
										</div>

										<div class="form-group">
											<label for="images">Images</label>
											<input type="file" name="images[]" class="form-control" multiple/>
										</div>

										<button type="submit" class="btn btn-success">Submit</button>
								
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