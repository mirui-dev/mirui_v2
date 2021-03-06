<div id="dashboard-nav-container" class="flex fill-width" wire:loading.delay.class="disabled" wire:target="handler">
    <div id="dashboard-nav-greet" class="flex fill-width">
        <p id="dashboard-nav-greet-message" onclick="window.location = root + ''" style="{{ $isAdmin ? 'color: darkred' : ' ' }}">{{ $greeterContent }}</p>
        <!-- <p id="dashboard-nav-greet-time">23:38</p> -->
    </div>
    <div id="dashboard-nav-menu" class="fill-width">
        <ul class="flex">
            <li id="dashboard-nav-menu-library" wire:click="handler('library')" class=" {{$libraryClass}} ">MY MOVIES</li>
            <li id="dashboard-nav-menu-browse" wire:click="handler('browse')" class=" {{$browseClass}} ">BROWSE MOVIES</li>
            <li id="dashboard-nav-menu-cart" wire:click="handler('cart')" class="flex  {{$cartClass}} ">MY CART<span id="dashboard-nav-menu-cart-number" class="dashboard--cart-number {{ count(auth()->user()->cart) ? ' active ' : '' }}">{{ count(auth()->user()->cart) }}</span></li>
            <li id="dashboard-nav-menu-profile" wire:click="handler('profile')" class=" {{$profileClass}} ">MY PROFILE</li>
            <li onclick="window.location = root + 'auth/logout/'">SIGN OUT</li>
        </ul>
    </div>
</div>