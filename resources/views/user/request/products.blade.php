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

                                <h3>Product Request</h3>
                                <a href="{{ route('product-request.create') }}" class="float-right">Create Request</a>

                                <table class="table">
                                    <div>
                                        <tr class="table-active">
                                            <th>Product Name</th>
                                            <th>Brand</th>
                                            <th>Condition</th>
                                            <th>Min Price</th>
                                            <th>Max Price</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </div>
                                    <div>
                                        @foreach ($requests as $request)
                                        <tr class="table-default">
                                            <td>{{ $request->product_name }}</td>
                                            <td>{{ $request->brand }}</td>
                                            <td>{{ $request->condition }}</td>
                                            <td>${{ $request->min_price }}</td>
                                            <td>${{ $request->max_price }}</td>

                                            <td><button>Results</button></td>
                                            <td><button data-toggle="modal" data-target="#myModal">Edit</button></td>
                                            {{--<td><button name="post">Delete</button></td>--}}
                                            
                                            
											<td>
                                                <form action="{{route('product-request.destroy', $request->id)}}" method="POST">
                                                @csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
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
