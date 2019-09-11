@extends('layouts.app')

@section('content')
	<div>
		<h1>Create new request</h1>
		
		<form class="form-horizontal" action="/products" method="post">
		{{csrf_field()}}
			<fieldset>
				<div class="form-group">
					<div class="col-lg-10">
                        <div class="row">
                            Product Name: <input type="text" name="product_name"/>
                        </div>
                        <div class="row">Brand:
                            <select name="brnad" id="brand">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="row">Condition:
                                <select name="condition" id="condition">
    
                                </select>
                            </div>
                        <div class="row">
                            Max Price: <input type="number" name="max_price"/>
                        </div>
                        <div class="row">
                            Min Price: <input type="number" name="min_price"/>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
						
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
    
@endsection