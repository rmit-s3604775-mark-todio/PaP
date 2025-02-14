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
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col">
                                        <h3>Phone Searches</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row float-right">
                                            <div class="col">
                                                {{-- <form class="searchForm d-inline" action="{{ route('admin.search') }}" method="POST">
                                                    @csrf
                                                    <input id="search" class="input-search @error('search') is-invalid @enderror" type="text" name="search" placeholder="Search for..." required />
                                                    <button type="submit" class="submit-search">Search</button>
                                                    @error('search')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror								
                                                </form> --}}
                                                <a href="{{ route('phone-search.create') }}">
                                                    <button class="fa fa-plus btn btn-create"></button>
                                                </a>
                                            </div>	
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <tr class="table-active">
                                                <th>Phone Name</th>
                                                <th>Brand</th>
                                                <th>Condition</th>
                                                <th>Min Price</th>
                                                <th>Max Price</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            @foreach ($requests as $request)
                                            <tr class="table-default">
                                                <td>{{ $request->product_name }}</td>
                                                <td>{{ $request->brand }}</td>
                                                <td>{{ $request->condition }}</td>
                                                <td>
                                                    @if ($request->min_price != null)
                                                        ${{ $request->min_price }}
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                    @if ($request->max_price != null)
                                                        ${{ $request->max_price }}
                                                    @endif
                                                </td>
    
                                                <td>
                                                    <form action="{{ route('phone-search.results', $request->id) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Results">
                                                            <i class="fa fa-list"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('phone-search.edit', $request->id) }}" method="get">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                
                                                <td>
                                                    <form action="{{route('phone-search.destroy', $request->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        @if ($requests->isEmpty())
                                        <div class="row">
                                            <div class="col text-center">
                                                <h3>No Seaches Found</h3>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row justify-content-center">
                                            <div class="links">
                                                {{ $requests->links() }}
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
</div>
@endsection
