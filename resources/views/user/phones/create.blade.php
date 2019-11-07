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
								<h3>Create new Phone Listing</h3>
								
								<form class="form-horizontal" action="{{route('phones.store')}}" method="post" enctype="multipart/form-data">
									@csrf
									@method('POST')

									<div class="form-group row">
										<label for="product_name" class="col-md-4 col-form-label text-md-right">Phone Name</label>

										<div class="col-md-5">
											<input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" required/>
										</div>
										@error('product_name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group row">
										<label for="brand" class="col-md-4 col-form-label text-md-right">Brand</label>

										<div class="col-md-5">
											<select name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" required>
												<option selected disabled hidden>Please Select...</option>
												@foreach ($brands as $brand)
													@if (old("brand") == $brand->brand)
														<option value="{{ $brand->brand }}" selected>{{ $brand->brand }}</option>
													@else
														<option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
													@endif
												@endforeach
											</select>
										</div>
										@error('brand')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group row">
										<label for="condition" class="col-md-4 col-form-label text-md-right">Condition</label>

										<div class="col-md-5">
											<select name="condition" id="condition" class="form-control @error('condition') is-invalid @enderror" required>
												<option selected disabled hidden>Please Select...</option>
												@foreach ($conditions as $condition)
													@if(old("condition") == $condition->condition)
														<option value="{{ $condition->condition }}" selected>{{ $condition->condition }}</option>
													@else
														<option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
													@endif
												@endforeach
											</select>
										</div>
										@error('condition')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
									</div>

									<div class="form-group row">
										<label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>

										<div class="col-md-5">
											<input type="number" min="1" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required/>
										</div>
										@error('quantity')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group row">
										<label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

										<div class="col-md-5">
											<input type="number" step="any" min="0" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required/>
										</div>
										@error('price')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>



									<div class="form-group row">
										<label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

										<div class="col-md-5">
											<textarea rows="6" name="description" class="form-control @error('description') is-invalid @enderror" required>{{old('description')}}</textarea>
										</div>
										@error('description')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group row">
										<label for="images" class="col-md-4 col-form-label text-md-right">Add New Images</label>

										<div class="col-md-5">
											<input type="file" name="images[]" class="form-control" multiple/>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-5 offset-md-4">
											<button type="submit" class="btn btn-primary">
												{{ __('Submit') }}
											</button>
										</div>
									</div>
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
@endsection