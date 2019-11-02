<div class="row">
    <div class="col-lg-12 mx-auto">
        <ul class="list-group shadow">
            @if (!$phones->isEmpty())
                @foreach ($phones as $phone)
                    <li class="list-group-item">
                        <div class="media align-items-lg-center flex-column flex-lg-row p-3" id="phone">
                            <div>
                                <img src="/uploads/products/{{array_values(json_decode($phone->images))[0]}}" alt="phone-{{$phone->id}}-image" class="mr-lg-5" style="max-height: 200px">
                            </div>
                            <div class="media-body">
                                <a href="{{ route('phone.details', [$phone])}}" class="stretched-link">
                                    <h5 class="mt-0 font-weight-bold mb-2">{{$phone->product_name}}</h5>
                                </a>
                                <p class="font-italic text-muted mb-0 small">{{$phone->description}}</p>
                                <div class="justify-content-left d-flex align-items mt-1">
                                    <p class="font-weight-bold my-2">Brand:&nbsp;</p>
                                    <p class="inline font-italic my-2">{{$phone->brand}}</p>
                                </div>
                                <div class="justify-content-left d-flex align-items mt-1">
                                    <p class="font-weight-bold my-2">Condition:&nbsp;</p>
                                    <p class="inline font-italic my-2">{{$phone->condition}}</p>
                                </div>
                                
                                <div class="justify-content-between d-flex align-items mt-1">
                                    <h6 class="font-weight-bold my-2">${{$phone->price}}</h6>
                                </div>
                            </div>
                            @auth
                                @if ($phone->user_id == Auth::user()->id)
                                    <div class="justify-content-right d-flex align-items mt-1">
                                        <a href="{{ route('phones.edit', [$phone])}}" data-toggle="tooltip" title="Edit" style="z-index: 1">
                                            <button class="btn btn-secondary">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                        
                                        <form action="{{ route('phones.destroy', [$phone]) }}" method="post" style="z-index: 1">
                                            @csrf
                                            @method('delete')
                                            
                                            <button class="btn btn-danger btn-xs" type="submit" value="Delete" data-toggle="tooltip" title="Delete" style="z-index: 1">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            
                                        </form>
                                    </div>
                                @endif
                            @endauth
                            
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
@if ($phones->isEmpty())
<div class="row">
    <div class="col text-center">
        <h3>No Phones Found</h3>
    </div>
</div>
@endif
@if($phones instanceof \Illuminate\Pagination\LengthAwarePaginator)
<div class="row justify-content-center">
    <div class="links">
        {{ $phones->links() }}
    </div>
</div>
@endif