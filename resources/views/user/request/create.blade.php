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
                                    <h3>Create new request</h3>
                                    
                                    <form class="form-horizontal" action="{{ route('product-search.store') }}" method="post">
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
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row">Condition:
                                                            <select name="condition" id="condition">
                                                                <option selected disabled hidden>Please Select...</option>
                                                                @foreach ($conditions as $condition)
                                                                <option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection