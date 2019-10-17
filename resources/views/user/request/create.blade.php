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

                                <h3>Create New Product Search</h3>
                                <form action="{{ route('product-search.store') }}" method="post">
                                    @csrf
                                    @method("post")

                                    <div class="form-group row">
                                        <label for="product_name" class="col-md-4 col-form-label text-md-right">Product Name</label>

                                        <div class="col-md-5">
                                            <input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" required/>
                                        </div>
                                        @error('product_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="brand" class="col-md-4 col-form-label text-md-right">Brand</label>

                                        <div class="col-md-5">
                                            <select name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror">
                                                <option selected disabled hidden>Please Select...</option>
                                                @foreach ($brands as $brand)
                                                <option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="condition" class="col-md-4 col-form-label text-md-right">Condition</label>

                                        <div class="col-md-5">
                                            <select name="condition" id="condition" class="form-control @error('condition') is-invalid @enderror">
                                                <option selected disabled hidden>Please Select...</option>
                                                @foreach ($conditions as $condition)
                                                <option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('condition')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="min_price" class="col-md-4 col-form-label text-md-right">Min Price</label>

                                        <div class="col-md-5">
                                            <input type="number" step="any" min="0" name="min_price" id="min_price" class="form-control @error('min_price') is-invalid @enderror" value="{{ old('min_price') }}"/>
                                        </div>
                                        @error('min_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="max_price" class="col-md-4 col-form-label text-md-right">Max Price</label>

                                        <div class="col-md-5">
                                            <input type="number" step="any" min="0" name="max_price" id="max_price" class="form-control @error('max_price') is-invalid @enderror" value="{{ old('max_price') }}"/>
                                        </div>
                                        @error('max_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Submit') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection