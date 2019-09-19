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