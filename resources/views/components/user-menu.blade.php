<div class="row justify-content-center">
    <img class="avatar avatar-lg" src="/uploads/avatars/{{ Auth::user()->avatar }}">
</div>
<div class="row main-menu">
    <div class="col">
        <a href="{{ route('home') }}" class="row menu-item">
            {{ __('Home') }}
        </a>
        <a href="{{ route('settings') }}" class="row menu-item">
            {{ __('Settings') }}
        </a>
        <a href="{{ route('phones.index') }}" class="row menu-item">
            {{ __('Phones') }}
        </a>
        <a href="{{ route('phone-search.index') }}" class="row menu-item">
            {{ __('Phone Searches') }}
        </a>
        {{-- <a href="" class="row menu-item">
            {{  __('Reviews') }}
        </a> --}}
        {{-- <a href="" class="row menu-item">
            {{ __('Messages') }}
        </a> --}}
    </div>
    
</div>