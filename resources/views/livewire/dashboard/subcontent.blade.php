<div id="dashboard-content-sub" class=" {{ $subcontentVisibilityClass }} ">
    @if ($view)
        @livewire('dashboard.subcontent.'.$view, $viewData ?? [], key('dashboard.subcontent.'.$view))
    @endif
</div>

