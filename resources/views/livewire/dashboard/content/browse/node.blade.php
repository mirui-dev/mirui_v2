<div id="browse-gallery" class="flex content-height" wire:loading.delay.class="disabled" wire:target="handler">
    @foreach($movies as $movie)

    @php
        $db_movie_visual_poster = $movie->visual->poster;
        $db_movie_visual_poster_path = $db_movie_visual_poster ? 'var(--browse-gallery-node-shade), url('.MiruiFile::getURL($db_movie_visual_poster).')' : null;
    @endphp

    @if(!is_null($db_movie_visual_poster_path))
    <div id="browse-gallery-node-{{$movie->id}}" class="browse-gallery-node flex" wire:click="handler({{ $movie->id }})" style="background-image: {{ $db_movie_visual_poster_path }}" >
    @else
    <div id="browse-gallery-node-{{$movie->id}}" class="browse-gallery-node flex" wire:click="handler({{ $movie->id }})">
    @endif

    <!-- <div id="browse-gallery-node-{{$movie->id}}" class="browse-gallery-node flex" wire:click="handler({{ $movie->id }})" style="background-image: " > -->
        <span class="browse-gallery-node-score content-width">{{$movie->score}}</span>
        <div class="browse-gallery-node-details flex max-height fill-width">
            <h1 class="browse-gallery-node-details-title">{{$movie->title}}</h1>
        </div>
    </div>
    @endforeach
</div>
