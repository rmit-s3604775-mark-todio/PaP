{{-- this is a comment --}}
{{-- navigation bar --}}
@extends('layouts.app')

@section('content')

<head>
<style>

	

</style>
</head>

	<table style="background-color:yellow;">
		<tr>
			<th>ID</th>
			<th>Product Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Quantity Remaining</th>
			<th>Rating</th>
		</tr>
		
		<!--item name -->
		<tr>
			<td>{{$product->product_name}}</td>
		</tr>
		
		
	</table>
@endsection
