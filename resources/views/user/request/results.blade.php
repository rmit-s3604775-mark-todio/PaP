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
                                <div class="row">
                                    <div class="col">
                                        <h3>Product Search Matches</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="col" style="border: 1px solid lightgrey">
                                            <h5>Matched Based On:</h5>
                                            
                                                @foreach ($ps->toArray() as $key => $value)
                                                    @if ($value != null & $key != 'id' & $key != 'user_id' & $key != 'created_at' & $key != 'updated_at')
                                                    <div class="row">
                                                        <div class="col-2">
                                                            {{ucwords(str_replace('_', ' ', $key))}}:
                                                        </div>
                                                        <div class="col-2">
                                                            {{$value}}
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                        </div>
                                    </div>               
                                </div>
                                <div class="row">
                                        <div class="col">
                                            <table class="table">
                                                <tr class="table-active">
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Brand</th>
                                                    <th>Condition</th>
                                                    <th>Rating</th>
                                                    <th></th>
                                                </tr>
                                                @if (!$results->isEmpty())
                                                    @foreach($results as $product)
                                                        <tr class="table-default">
                                                            <td>{{$product->product_name}}</td>
                                                            <td>${{$product->price}}</td>
                                                            <td>{{$product->quantity}}</td>
                                                            <td>{{$product->brand}}</td>
                                                            <td>{{$product->condition}}</td>
                                                            <td>{{$product->rating}}</td>
                                                            <td>
                                                                <a href="{{ url('/details', [$product])}}" data-toggle="tooltip" title="Details">
                                                                    <button class="btn btn-secondary" >
                                                                        <i class="fa fa-info"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                    @if ($results->isEmpty())
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>No Products Found</h3>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row justify-content-center">
                                        <div class="links">
                                            {{ $results->links() }}
                                        </div>
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
@endsection