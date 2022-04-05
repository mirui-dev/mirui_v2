<div id="dashboard-content-sub-nav" class="flex {{ $subcontentnavVisibilityClass }}" wire:loading.class="disabled" wire:target="handler">
    <div id="dashboard-content-sub-nav-container" class="flex content-height">

        {{-- @if($substateAction ?? false && $substateActionDismiss ?? false) --}}
        @if(($substateAction ?? false) && (session()->has('substateActionRequireDismiss')))
        <script>
            setTimeout(function(){
                @this.substateAction = null;
            }, 3000);
        </script>
        @endif
        
        @if($substateAction == 'state.delete.confirm')
        <div id="dashboard-content-sub-nav-childnode-delete" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavDeleteVisibilityClass }}" wire:click="handler('delete.confirm')" style="color:burlywood;">
            <span class="lnr lnr-cross"></span>
            <span>CONFIRM?</span>
        </div>
        @elseif($substateAction == 'state.delete.deleting')
        <div id="dashboard-content-sub-nav-childnode-delete" class="disabled flex dashboard-content-sub-nav-childnode {{ $subcontentnavDeleteVisibilityClass }}" style="color:burlywood;">
            <span class="lnr lnr-cross"></span>
            <span>DELETING</span>
        </div>
        @else
        <div id="dashboard-content-sub-nav-childnode-delete" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavDeleteVisibilityClass }}" wire:click="handler('delete')" style="color:burlywood;">
            <span class="lnr lnr-cross"></span>
            <span>DELETE</span>
        </div>
        @endif

        <!-- SAVE -->
        @if($substateAction == 'state.edit.editing')
        <div id="dashboard-content-sub-nav-childnode-save" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavEditVisibilityClass }}" wire:click="handler('save')" style="color:crimson;">
            <span class="lnr lnr-magic-wand"></span>
            <span>SAVE</span>
        </div>
        @elseif($substateAction == 'state.edit.saving')
        <div id="dashboard-content-sub-nav-childnode-save" class="disabled flex dashboard-content-sub-nav-childnode {{ $subcontentnavEditVisibilityClass }}" style="color:crimson;">
            <span class="lnr lnr-magic-wand"></span>
            <span>SAVING</span>
        </div>
        @elseif($substateAction == 'state.edit.saved')
        <div id="dashboard-content-sub-nav-childnode-save" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavEditVisibilityClass }}" style="color:deepskyblue;">
            <span class="lnr lnr-magic-wand"></span>
            <span>SAVED</span>
        </div>
        @else
        <div id="dashboard-content-sub-nav-childnode-edit" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavEditVisibilityClass }}" wire:click="handler('edit')" style="color:burlywood;">
            <span class="lnr lnr-magic-wand"></span>
            <span>EDIT</span>
        </div>
        @endif

        <!-- <div id="dashboard-content-sub-nav-childnode-save" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavSaveVisibilityClass }}" wire:click="handler('save')" style="color:crimson;">
            <span class="lnr lnr-magic-wand"></span>
            <span>SAVE</span>
        </div> -->
        <!-- <div id="dashboard-content-sub-nav-childnode-edit" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavEditVisibilityClass }}" wire:click="handler('edit')" style="color:burlywood;">
            <span class="lnr lnr-magic-wand"></span>
            <span>EDIT</span>
        </div> -->
        <div id="dashboard-content-sub-nav-childnode-back" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavBackVisibilityClass }}" wire:click="handler('back')" style="color:aquamarine;">
            <span class="lnr lnr-frame-contract"></span>
            <span>BACK</span>
        </div>
        @if($isInCart)
        <div id="dashboard-content-sub-nav-childnode-cart" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavCartVisibilityClass }}" wire:click="handler('cart')" style="color:floralwhite;">
            <span class="lnr lnr-checkmark-circle"></span>
            <span>ADDED</span>
        </div>
        @else
        <div id="dashboard-content-sub-nav-childnode-cart" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavCartVisibilityClass }}" wire:click="handler('cart')" style="color:floralwhite;">
            <span class="lnr lnr-cart"></span>
            <span>ADD</span>
        </div>
        @endif
        <div id="dashboard-content-sub-nav-childnode-watch" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavWatchVisibilityClass }}" wire:click="handler('watch')" style="color:azure;">
            <span class="lnr lnr-film-play"></span>
            <span>WATCH</span>
        </div>

        <!-- <div id="dashboard-content-sub-nav-childnode-save" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavSaveVisibilityClass }} {{ $subcontentnavSaveSubstateClass }}" wire:click="handler('save')" style="color:crimson;">
            <span class="lnr lnr-magic-wand"></span>
            <span>SAVE</span>
        </div>
        <div id="dashboard-content-sub-nav-childnode-edit" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavEditVisibilityClass }} {{ $subcontentnavEditSubstateClass }}" wire:click="handler('edit')" style="color:burlywood;">
            <span class="lnr lnr-magic-wand"></span>
            <span>EDIT</span>
        </div>
        <div id="dashboard-content-sub-nav-childnode-back" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavBackVisibilityClass }} {{ $subcontentnavBackSubstateClass }}" wire:click="handler('back')" style="color:aquamarine;">
            <span class="lnr lnr-frame-contract"></span>
            <span>BACK</span>
        </div>
        <div id="dashboard-content-sub-nav-childnode-cart" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavCartVisibilityClass }} {{ $subcontentnavCartSubstateClass }}" wire:click="handler('cart')" style="color:floralwhite;">
            <span class="lnr lnr-cart"></span>
            <span>ADD</span>
        </div>
        <div id="dashboard-content-sub-nav-childnode-watch" class="flex dashboard-content-sub-nav-childnode {{ $subcontentnavWatchVisibilityClass }} {{ $subcontentnavWatchSubstateClass }}" wire:click="handler('watch')" style="color:azure;">
            <span class="lnr lnr-film-play"></span>
            <span>WATCH</span>
        </div> -->

    </div>
</div>