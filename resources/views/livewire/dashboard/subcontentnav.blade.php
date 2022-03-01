<div id="dashboard-content-sub-nav" class="flex {{ $subcontentVisibilityClass }}">
    <div id="dashboard-content-sub-nav-container" class="flex content-height">
        <div id="dashboard-content-sub-nav-childnode-delete" class="hidden flex dashboard-content-sub-nav-childnode" onclick="contentControl(true, true)" style="color:burlywood;">
        <span class="lnr lnr-cross"></span>
        <span>DELETE</span>
        </div>
        <div id="dashboard-content-sub-nav-childnode-edit" class="hidden flex dashboard-content-sub-nav-childnode" onclick="contentControl(true, true)" style="color:burlywood;">
            <span class="lnr lnr-magic-wand"></span>
            <span>EDIT</span>
        </div>
        <div id="dashboard-content-sub-nav-childnode-back" class="flex dashboard-content-sub-nav-childnode" wire:click="handler('back')" style="color:aquamarine;">
            <span class="lnr lnr-frame-contract"></span>
            <span>BACK</span>
        </div>
        <div id="dashboard-content-sub-nav-childnode-cart" class="hidden flex dashboard-content-sub-nav-childnode" style="color:floralwhite;">
            <span class="lnr lnr-cart"></span>
            <span>ADD</span>
        </div>
        <div id="dashboard-content-sub-nav-childnode-watch" class="hidden flex dashboard-content-sub-nav-childnode" style="color:azure;">
            <span class="lnr lnr-film-play"></span>
            <span>WATCH</span>
        </div>
    </div>
</div>