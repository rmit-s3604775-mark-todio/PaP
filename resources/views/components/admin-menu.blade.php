<div class="row justify-content-center">
    <img id="menu-avatar" class="avatar" src="/uploads/avatars/{{ Auth::user()->avatar }}">
</div>
<div class="row main-menu">
    <div class="col">
        <a href="{{ route('admin.dashboard') }}" class="row menu-item">
            {{ __('Home') }}
        </a>
        <a href="{{ route('admin.settings') }}" class="row menu-item">
            {{ __('Settings') }}
        </a>
        <a href="{{ route('admin.users') }}" class="row menu-item">
            {{ __('Users') }}
        </a>
        <a href="{{ route('admin.administrators') }}" class="row menu-item">
            {{ __('Administrators') }}
        </a>
        <a href="{{ route('admin.products') }}" class="row menu-item">
            {{  __('Products') }}
        </a>
        <a href="{{ route('admin.messages') }}" class="row menu-item">
            {{ __('Messages') }}
        </a>
    </div>
    
</div>




