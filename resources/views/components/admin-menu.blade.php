<div class="row justify-content-center">
    <img class="avatar avatar-lg" src="/uploads/avatars/{{ Auth::user()->avatar }}">
</div>
<div class="row main-menu">
    <div class="col">
        <a href="{{ route('admin.dashboard') }}" class="row menu-item">
            {{ __('Home') }}
        </a>
        <a href="{{ route('admin.settings') }}" class="row menu-item">
            {{ __('Settings') }}
        </a>
        <a href="{{ route('admin.user') }}" class="row menu-item">
            {{ __('Users') }}
        </a>
        <a href="{{ route('admin.administrators') }}" class="row menu-item">
            {{ __('Administrators') }}
        </a>
        <a href="{{ route('admin.product') }}" class="row menu-item">
            {{  __('Products') }}
        </a>
        <a href="{{ route('admin.messages') }}" class="row menu-item">
            {{ __('Messages') }}
        </a>
    </div>
    
</div>




