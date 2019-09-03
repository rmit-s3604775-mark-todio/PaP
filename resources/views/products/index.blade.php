{{-- this is a comment --}}
{{-- navigation bar --}}
@extends('layouts.app')

@section('content')
	<h1>Products</h1>
	<a href="products/create" class="float-right" >Add new product</a>
	
	<table class="table">
		<div>
			<tr class="table-active">
				<th>ID</th>
				<th>Product Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Quantity Remaining</th>
				<th>Rating</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</div>
		
		<div >
			@foreach($products as $product)
			<tr class="table-default">
				<td>{{$product->id}}</td>
				<td>{{$product->product_name}}</td>
				<td>${{$product->price}}</td>
				<td>{{$product->quantity}}</td>
				<td>{{$product->quantity_remaining}}</td>
				<td>{{$product->rating}}</td>
				<td><a href="product/create">details</a></td>
				<td><a data-toggle="modal" data-target="#myModal">edit</a></td>
				<td>delete</td>
			</tr>
			@endforeach
		</div>
	</table>
	
	
	
	<div class="container">
	  <!-- Modal -->
	  <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit product</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="/products" method="post">
				{{csrf_field()}}
					Product Name: <input type="text" name="product_name" class="float-right"></input><br>
					Price: <input type="number" name="product_name"><br>
					Quantity: <input type="number" name="product_name"><br>
					<button type="submit" name="body" class="btn btn-success">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		  
		</div>
	  </div>
	</div>

	


@endsection
