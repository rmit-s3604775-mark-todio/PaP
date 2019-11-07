{{-- this is a comment --}}
{{-- navigation bar --}}
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
                                @if (Auth::guard('web')->check())
                                    Dashboard
                                @elseif(Auth::guard('admin')->check())
                                    Admin Dashboard
                                @endif
                            </span>
                            <span class="col-6 text-right">
                            @auth
                                @if (Auth::guard('web')->check() || Auth::guard('admin')->check())
                                    Welcome {{ Auth::user()->name }}
                                @endif
                            @endauth
                            </span>
                        </div> 
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        @if (Auth::guard('web')->check())
                            <div class="col-3 nav-menu justify-content-center">
                                @component('components.user-menu')
                                @endcomponent
                            </div>
                        @elseif(Auth::guard('admin')->check())
                            <div class="col-3 nav-menu justify-content-center">
                                @component('components.admin-menu')
                                @endcomponent
                            </div>
                        @endif
                        <div class="col">
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header">
                                        <h1>{{$item->product_name}}</h1>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div id="phoneIndicators" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @foreach (json_decode($item->images) as $image)
                                                    @if ($loop->first)
                                                        <li data-target="#phoneIndicators" data-slide-to="{{$loop->index}}" class="active"></li>
                                                    @else
                                                        <li data-target="#phoneIndicators" data-slide-to="{{$loop->index}}"></li>
                                                    @endif
                                                @endforeach
                                            </ol>
                                            <div class="carousel-inner">
                                                @foreach (json_decode($item->images) as $image)
                                                    @if ($loop->first)
                                                        <div class="carousel-item active product-container text-center">
                                                            <img style="max-height:300px" class="product-item" src="/uploads/products/{{ $image }}" alt="{{$loop->iteration}} slide">
                                                        </div>
                                                    @else
                                                        <div class="carousel-item product-container text-center">
                                                            <img style="max-height:300px" class="product-item" src="/uploads/products/{{ $image }}" alt="{{$loop->iteration}} slide">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#phoneIndicators" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#phoneIndicators" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer">
                                        <div class="justify-content-between d-flex flex-wrap align-items">
                                            <div class="justify-content-left d-flex align-items px-2">
                                                <p class="font-weight-bold my-2">Brand:&nbsp;</p>
                                                <p class="inline font-italic my-2">{{$item->brand}}</p>
                                            </div>
                                            <div class="justify-content-left d-flex align-items px-2">
                                                <p class="font-weight-bold my-2">Condition:&nbsp;</p>
                                                <p class="inline font-italic my-2">{{$item->condition}}</p>
                                            </div>
                                            <div class="justify-content-left d-flex align-items px-2">
                                                <p class="font-weight-bold my-2">Quantity:&nbsp;</p>
                                                <p class="inline font-italic my-2">{{$item->quantity}}</p>
                                            </div>
                                            
                                            <div class="justify-content-left d-flex align-items px-2">
                                                <p class="font-weight-bold my-2">Price:&nbsp;</p>
                                                <p class="inline font-italic my-2">${{$item->price}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col justify-content-end d-flex flex-wrap align-items">
                                                <div class="justify-content-end d-flex align-items mt-1">
                                                    @if (Auth::guard('web')->check())
                                                        @if ($item->user_id == Auth::user()->id)
                                                            <a href="{{ route('phones.edit', [$item])}}" data-toggle="tooltip" title="Edit" style="z-index: 1">
                                                                <button class="btn btn-secondary">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                            </a>
                                                            
                                                            <form action="{{ route('phones.destroy', [$item]) }}" method="post" style="z-index: 1">
                                                                @csrf
                                                                @method('delete')
                                                                
                                                                <button class="btn btn-danger btn-xs" type="submit" value="Delete" data-toggle="tooltip" title="Delete" style="z-index: 1">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @elseif(Auth::guard('admin')->check())
                                                        <form action="{{ route('phones.destroy', [$item]) }}" method="post" style="z-index: 1">
                                                            @csrf
                                                            @method('delete')
                                                        
                                                            <button class="btn btn-danger btn-xs" type="submit" value="Delete" data-toggle="tooltip" title="Delete" style="z-index: 1">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jumbotron">
                                            <h4>Description</h4>
                                            <p class="font-italic text-muted mb-0 small">{!! nl2br(e($item->description)) !!}</p>
                                        </div>
                                    </div>
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