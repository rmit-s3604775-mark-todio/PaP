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
        
                                <h3>Settings</h3>

                                <h4>{{ Auth::user()->name }}'s Profile Settings</h4>
                                <form enctype="multipart/form-data" action="{{ route('admin.avatar') }}" method="post">
                                    @csrf

                                    <label for="avatar-file">Update Avatar Image</label>
                                    <input type="file" name="avatar-file">
                                    <p>Max image size is 5 Mb</p>
                                    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>

                                    


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