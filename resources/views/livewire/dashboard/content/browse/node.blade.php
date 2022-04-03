<div id="browse-gallery" class="flex content-height" wire:loading.delay.class="disabled" wire:target="handler">
    @foreach($movies as $movie)
    <div id="browse-gallery-node-{{$movie->id}}" class="browse-gallery-node flex" wire:click="handler({{ $movie->id }})" >
        <span class="browse-gallery-node-score content-width">{{$movie->score}}</span>
        <div class="browse-gallery-node-details flex max-height fill-width">
            <h1 class="browse-gallery-node-details-title">{{$movie->title}}</h1>
        </div>
    </div>
    @endforeach
</div>
