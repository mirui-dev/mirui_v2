<section class="flex max-width max-height" wire:loading.class="disabled" wire:target="previewHandler">

    @section('header')
        @livewire('landing.navigation', ['isFullPageNav' => true])
    @endsection

    @php
        $db_movie_visual_cover = $movie->visual->cover ?? null;
        $db_movie_visual_cover_path = $db_movie_visual_cover ? 'url('.MiruiFile::getURL($db_movie_visual_cover).')' : null;
    @endphp

    @if(!is_null($db_movie_visual_cover_path))
    <style>
        :root {
            --global-article-background: {{ $db_movie_visual_cover_path }};
        }
    </style>
    @endif

    <!-- <a id="global-section-nav-back" class="flex global-section-nav max-height font-nohover" wire:click="previewHandler()"><</a> -->
    <a id="global-section-nav-next" class="flex global-section-nav max-height font-nohover" wire:click="previewHandler()" href="javascript:;">></a>
    <article id="global-article-parent" class="flex max-width max-height">
        <div id="global-article-container" class="flex">
            <h2 id="global-article-title" class="font-pri max-width">{{ $movie->title ?? '--' }}</h2>
            <h2 id="global-article-subtitle" class="font-pri fill-width">{{ $movie->title2 ?? '--' }}</h2>
            <p id="global-article-body">
                {{ $movie->description ?? '--' }}
            </p>
            <a class="font-pri global-button" href="{{ route('mirui.dashboard') }}"><button>LEARN MORE</button></a>
            <a class="font-pri global-button" href="{{ route('mirui.dashboard') }}"><button>WATCH NOW</button></a>
        </div>
    </article>

</section>