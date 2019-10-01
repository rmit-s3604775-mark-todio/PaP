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
                                        <h3>Users</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row float-right">
                                            <div class="col">
                                                <form class="searchForm d-inline" action="{{ route('admin.user.search') }}" method="POST">
                                                    @csrf
                                                    <input id="search" class="input-search @error('search') is-invalid @enderror" type="text" name="search" placeholder="Search for..." required />
                                                    <button type="submit" class="submit-search">Search</button>
                                                    @error('search')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror								
                                                </form>
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
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Date Registerd</th>
                                                <th></th>
                                            </tr>
                                            @if (!$users->isEmpty())
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td><img class="avatar avatar-sm" src="/uploads/avatars/{{ $user->avatar }}"></td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->username}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->created_at}}</td>
                                                        <td>
                                                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </div>
                                @if ($users->isEmpty())
								<div class="row">
									<div class="col text-center">
										<h3>No Users Found</h3>
									</div>
								</div>
                                @endif
                                @if (!$users->isEmpty())
                                <div class="row justify-content-center">
                                    <div class="links">
                                        {{ $users->links() }}
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
