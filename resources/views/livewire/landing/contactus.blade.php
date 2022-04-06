<main class="flex fill-width">
    
    @section('styles')
    <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui-contactus.css') }}">
    @endsection

    @section('body-class', 'flex fill-width')

    @section('header')
        @livewire('landing.navigation', ['isFullPageNav' => false])
    @endsection

    <div class="flex fill-width fill-height">
        <h2 class="fill-width">Contact Us</h2>
        <p>
            <strong>MIRUI Media Corporation (Asia)</strong>
            <br>
            597, Jalan Merak, 
            <br>
            Iping Garden, 
            <br>
            11960 Bayan Lepas, 
            <br>
            Pulau Pinang, Malaysia
            <br><br>
            hello@mirui.io
        </p>
        <iframe class="fill-width fill-height" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31781.422084687667!2d100.24555697707262!3d5.312869802120468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304abfdc16a86cd3%3A0x62916eeda71a89b0!2sBayan%20Lepas%2C%20Penang!5e0!3m2!1sen!2smy!4v1600233978685!5m2!1sen!2smy" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="flex disabled flex-wrap">
            <img src="{{ mix('src/mirui/img/partners/white-fox.png') }}" style="filter:invert(.7)">
            <img src="{{ mix('src/mirui/img/partners/square-enix.png') }}" style="filter:invert(.7)">
            <img src="{{ mix('src/mirui/img/partners/madhouse.png') }}" style="filter:invert(.7)">
            <img src="{{ mix('src/mirui/img/partners/kyoto-animation.png') }}">
            <img src="{{ mix('src/mirui/img/partners/comix-wave-films.png') }}" style="filter:invert(1)">
        </div>
    </div>

</main>
