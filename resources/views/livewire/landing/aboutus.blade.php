<main class="flex fill-width">
    
    @section('styles')
    <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui-aboutus.css') }}">
    @endsection

    @section('body-class', 'flex fill-width')

    @section('header')
        @livewire('landing.navigation', ['isFullPageNav' => false])
    @endsection

    <div class="flex fill-width fill-height">
        <h2 class="fill-width">About mirui</h2>
        <p>
            <strong>MIRUI Media Corporation (Asia)</strong> is the sole distributor of japanese animation films (commonly known as 'anime') across the Asia Pacific region, since establishment in 2016. In 2020, <strong>mirui</strong> has started to provide premium online movie streaming services to users directly as part of their commitment in expanding their service coverage directly to the consumers. 
            <br><br>
            <strong>mirui</strong> has been in direct partnership with well-established anime production studios in Japan, primarily Kyoto Animation, CoMix Wave Films, Madhouse, White Fox and Square Enix. 
            <br><br>
            <strong>mirui</strong> was honoured to be the sole authorized distributor of produced japanese animation films in the Asia Pacific region, ie. Singapore, Malaysia, Indonesia, Thailand, China, and South Korea. 
            This allows <strong>mirui</strong> to deliver original movie content from Japan directly to users in the Asia Pacific region, which has a majority of Japanese film audience. 
            <br><br>
            <strong>mirui</strong>-distributed films are available in all IMAX and THX certified theaters across the Asia Pacific region. 
        </p>
        <div style="padding:0; opacity: .9;">
            <!-- https://stackoverflow.com/questions/43815086/laravel-mix-generates-relative-paths -->
            <img src="{{ mix('src/mirui/img/partners/imax.png') }}" style="filter:invert(.7)">
            <img src="{{ mix('src/mirui/img/partners/thx.png') }}" style="filter:invert(.7)">
        </div>
        <div class="flex disabled flex-wrap">
            <img src="{{ mix('src/mirui/img/partners/white-fox.png') }}" style="filter:invert(.7)">
            <img src="{{ mix('src/mirui/img/partners/square-enix.png') }}" style="filter:invert(.7)">
            <img src="{{ mix('src/mirui/img/partners/madhouse.png') }}" style="filter:invert(.7)">
            <img src="{{ mix('src/mirui/img/partners/kyoto-animation.png') }}">
            <img src="{{ mix('src/mirui/img/partners/comix-wave-films.png') }}" style="filter:invert(1)">
        </div>
    </div>

</main>
