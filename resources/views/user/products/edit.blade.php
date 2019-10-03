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

								{{-- insert code here --}}
								<a class="btn btn-primary" href="{{ route('products.index') }}">Go back</a>
								<h1 class="text-center">Edit {{$item->product_name}}</h1>
								<form action="{{ route('products.update', [$item]) }}" method="post">
									{{csrf_field()}}
									{{method_field('PUT')}}

									<fieldset>
										<div class="form-group">
												<label for="product_name">Product name</label>
												<input type="text" name="product_name" class="form-control" value="{!! $item->product_name !!}">
										</div> 
									
										<div class="form-group">
												<label for="price">Price</label>
												<input type="number" name="price" class="form-control" value={{$item->price}}>
										</div> 

										<div class="form-group">
												<label for="quantity">Quantity</label>
												<input type="number" name="quantity" class="form-control" value={{$item->quantity}}>
										</div> 

										<div class="form-group">
												<label for="quantity">Quantity</label>
												<input type="number" name="quantity" class="form-control" value={{$item->quantity}}>
										</div> 

										<div class="form-group">
											<label for="brand">Brand</label>
											<select name="brand" id="brand">
												<option value="{{ $item->brand }}" selected hidden>{{ $item->brand }}</option>
												@foreach ($brands as $brand)
												<option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label for="condition">Condition</label>
											<select name="condition" id="condition">
												<option value="{{ $item->condition }}" selected hidden>{{ $item->condition }}</option>
												@foreach ($conditions as $condition)
												<option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label for="description">Description</label>
										<textarea rows="4" name="description" class="form-control">{{$item->description}}</textarea>
										</div>

										<div class="col text-center">
											<button type="submit" class="btn btn-success mx-auto">Submit</button>
										</div>
												
									
									<fieldset> 
									
									
								
								
								
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
@endsection