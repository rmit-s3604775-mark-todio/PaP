@if(Auth::guard('web')->check())   
    Welcome {{ Auth::user()->name }}
@endif

@if(Auth::guard('admin')->check())   
    Welcome {{ Auth::user()->name }}
@endif
