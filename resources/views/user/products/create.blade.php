@extends('layouts.app')

@section('content')
	
	
	<div>
		<h1>Create new item</h1>
		
		<form class="form-horizontal" action="/products" method="post">
		{{csrf_field()}}
			<fieldset>
				<div class="form-group">
					<div class="col-lg-10">
						Product Name: <input type="text" name="product_name"></input><br>
						Price: <input type="number" name="price"><br>
						Quantity: <input type="number" name="quantity"><br>
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
	
	


@endsection