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

                                {{-- insert code here --}}
                                <div class="card">
                                <h1 class="card-header">{{$item->product_name}}</h1>

                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach (json_decode($item->images) as $image)
                                                @if ($loop->first)
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="active"></li>
                                                @else
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}"></li>
                                                @endif
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach (json_decode($item->images) as $image)
                                                @if ($loop->first)
                                                    <div class="carousel-item active product-container text-center">
                                                        <img class="product-item" src="/uploads/products/{{ $image }}" alt="{{$loop->iteration}} slide">
                                                    </div>
                                                @else
                                                    <div class="carousel-item product-container text-center">
                                                        <img width="450" height="300" class="product-item" src="/uploads/products/{{ $image }}" alt="{{$loop->iteration}} slide">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

                                    <h5 class="card-header">Description</h5>
                                    <div class="card-body">
                                         {!! nl2br(e($item->description)) !!}
                                        <div>
                                            <span>Price: ${{$item->price}} </span>
                                        </div>

                                        <div>
                                            <span>Quantity: {{$item->quantity}}  </span>
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
        </div>
    </div>
</div>
@endsection