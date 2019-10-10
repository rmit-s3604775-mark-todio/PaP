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
                                Admin Dashboard
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
                            @component('components.admin-menu')
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
                                        <h3>Administrators</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row float-right">
                                            <div class="col">
                                                <form class="searchForm d-inline" action="{{ route('admin.search') }}" method="POST">
                                                    @csrf
                                                    <input id="search" class="input-search @error('search') is-invalid @enderror" type="text" name="search" placeholder="Search for..." required />
                                                    <button type="submit" class="submit-search">Search</button>
                                                    @error('search')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror								
                                                </form>
                                                <a href="{{ route('admin.register') }}">
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
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Date Registerd</th>
                                                <th></th>
                                            </tr>
                                            @if (!$admins->isEmpty())
                                                @foreach ($admins as $admin)
                                                    <tr>
                                                        <td><img class="avatar avatar-sm" src="/uploads/avatars/{{ $admin->avatar }}"></td>
                                                        <td>{{$admin->name}}</td>
                                                        <td>{{$admin->email}}</td>
                                                        <td>{{$admin->created_at}}</td>
                                                        <td>
                                                            <form action="{{ route('admin.destroy', $admin->id) }}" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </div>
                                @if ($admins->isEmpty())
								<div class="row">
									<div class="col text-center">
										<h3>No Other Administrators Found</h3>
									</div>
								</div>
                                @endif
                                @if (!$admins->isEmpty())
                                <div class="row justify-content-center">
                                    <div class="links">
                                        {{ $admins->links() }}
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
@endsection
