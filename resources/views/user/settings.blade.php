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
        
                                <h3>Settings</h3>
                                <form enctype="multipart/form-data" action="{{ route('update') }}" method="post">
                                    @csrf
                                    @method("post")
                                    <h5>Account Details</h5>
                                    <div class="form-group row">
                                        <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar Image</label>

                                        <div class="col-md-5">
                                            <input type="file" name="avatar" id="avatar" class="form-control-file @error('avatar') is-invalid @enderror">
                                            @error('avatar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                        <div class="col-md-5">
                                            <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" autocomplete="username" placeholder="{{ Auth::user()->username }}" value="{{ old('username') }}">
                                        </div>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                        <div class="col-md-5">
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ Auth::user()->email }}" value="{{ old('email') }}" autocomplete="email">
                                            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            
                                        <div class="col-md-5">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="*********">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
            
                                        <div class="col-md-5">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="*********">
                                        </div>
                                    </div>

                                    <h5>Address</h5>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-5">
                                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" autocomplete="name" placeholder="{{ Auth::user()->name }}" value="{{ old('name') }}">
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="address_line_1" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 1') }}</label>
            
                                        <div class="col-md-5">
                                            <input id="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" name="address_line_1" placeholder="{{ Auth::user()->address_line_1 }}" value="{{ old('address_line_1') }}"  autocomplete="address_line_1">
                                            
                                            @error('address_line_1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
            
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="address_line_2" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 2') }}</label>
            
                                        <div class="col-md-5">
                                            <input id="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" name="address_line_2" placeholder="{{ Auth::user()->address_line_2 }}" value="{{ old('address_line_2') }}" autocomplete="address_line_2">
                                            
                                            @if (Auth::user()->address_line_2 == null)
                                                <input type="checkbox" class="form-check-inline" id="blank" name="blank" value="blank" checked>Blank
                                            @else
                                                <input type="checkbox" class="form-check-inline" id="blank" name="blank" value="blank">Blank
                                            @endif
                                            
                                            @error('address_line_2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
            
                                    <div class="form-group row">
                                        <label for="state_province" class="col-md-4 col-form-label text-md-right">{{ __('State/Province') }}</label>
            
                                        <div class="col-md-5">
                                            <input id="state_province" type="text" class="form-control @error('state_province') is-invalid @enderror" name="state_province" placeholder="{{ Auth::user()->state_province }}" value="{{ old('state_province') }}" autocomplete="state_province">
                                            
                                            @error('state_province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
            
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="post_code" class="col-md-4 col-form-label text-md-right">{{ __('Post Code') }}</label>
            
                                        <div class="col-md-5">
                                            <input id="post_code" type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code" placeholder="{{ Auth::user()->post_code }}" value="{{ old('post_code') }}" autocomplete="post_code">
                                            
                                            @error('post_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
            
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
            
                                        <div class="col-md-5">
                                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="{{ Auth::user()->city }}" value="{{ old('city') }}"  autocomplete="city">
                                            
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
            
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
            
                                        <div class="col-md-5">
                                            <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country"placeholder="{{ Auth::user()->country }}" value="{{ old('country') }}"  autocomplete="country">
                                            
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
            
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Update') }}
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