@extends('layouts.app')

@section('content')
	<div>
		<h1>Create new request</h1>
		<!--I modified this blade to make it functional (Ega)-->
        <form class="form-horizontal" action="/product-request" method="post">
		{{csrf_field()}}
			<fieldset>
				<div class="form-group">
					<div class="col-lg-10">
                        <div class="row">
                            Product Name: 
							<input type="text" name="product_name"/>
                        </div>
                        <div class="row">Brand:
                            <select name="brand" id="brand">
                                <option selected disabled hidden>Please Select...</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
								<!--^Apparently I didn't notice that I should have changed id to brand-->
                                @endforeach
                            </select>
                        </div>
                        <div class="row">Condition:
                                <select name="condition" id="condition">
                                    <option selected disabled hidden>Please Select...</option>
                                    @foreach ($conditions as $condition)
                                    <option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
									<!--This too just like above.-->
                                    @endforeach
                                </select>
                        </div>
						<div class="row">
                            Min Price: <input type="number" name="min_price"/>
                        </div>	
                        <div class="row">
                            Max Price: <input type="number" name="max_price"/>
                        </div>
                        
                        <div class="row">
                            <button type="submit" value="Enter" class="btn btn-success">Submit</button>
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