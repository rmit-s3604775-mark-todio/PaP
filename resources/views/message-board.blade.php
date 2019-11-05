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
                                Message Board
                            </span>
                            <span class="col-6 text-right">
                                Welcome {{Auth::user()->name}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body align-content-center">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                
                                

                                <form action="{{ route('message-board.submit') }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <div class="form-group row-10">
                                        <div class="col inline d-flex">
                                            <input type="text" name="message" class="form-control">

                                            <label for="message">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-send"></i>
                                                </button>
                                            </label>
                                        </div>
                                    </div>
                                </form>


                                <div class="row-10">
                                    <div class="col mx-auto">
                                        @if (!$messages->isEmpty())
                                        <ul class="list-group list-unstyled border">
                                            @foreach ($messages as $message)
                                                <li class="list-goup-item">
                                                    <div class="media align-items-lg-center flex-column flex-sm-row p-3">
                                                        <div class="pr-3">
                                                            <img class="avatar avatar-sm" src="/uploads/avatars/{{ $message->user->avatar }}" alt="{{$message->user->name}}">
                                                        </div>
                                                        <div class="media-body">
                                                            <h5 class="mt-0 font-weight-bold mb-2">{{$message->user->name}}</h5>
                                                            <p class="font-italic text-muted mb-0 small">{{$message->message}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        @else
                                            <h3>Be the first to post a message!</h3>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="row-10">
                                    <div class="col inline d-flex justify-content-center">
                                        <div class="links pt-3">
                                            {{ $messages->links() }}
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