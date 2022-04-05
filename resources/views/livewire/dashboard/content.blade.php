<div id="dashboard-content" class="fill-width {{ $contentVisibilityClass }} ">
    @if ($view)
        @livewire('dashboard.content.'.$view, key('dashboard.content.'.$view))
    @endif
</div>
