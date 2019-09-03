<div class="row justify-content-center">
    <img id="menu-avatar" class="avatar" src="/uploads/avatars/{{ Auth::user()->avatar }}">
</div>
<div class="row main-menu">
    <div class="col">
        <a href="{{ route('home') }}" class="row menu-item">
            {{ __('Home') }}
        </a>
        <a href="" class="row menu-item">
            {{ __('Profile') }}
        </a>
        <a href="" class="row menu-item">
            {{ __('Products') }}
        </a>
        <a href="{{ route('product-requests') }}" class="row menu-item">
            {{ __('Product Requests') }}
        </a>
        <a href="" class="row menu-item">
            {{  __('Reviews') }}
        </a>
        <a href="" class="row menu-item">
            {{ __('Messages') }}
        </a>
    </div>
    
</div>