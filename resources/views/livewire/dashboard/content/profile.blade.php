<div class="max-width max-height"> <!-- livewire requirement -->

    @php
        // https://stackoverflow.com/questions/28105113/laravel-urlto-port-number-for-localhost-not-included-in-db-seed-files
        $db_profile_picture = auth()->user()->profile_picture_id ?? false;
        $db_profile_picture_path = $db_profile_picture ? 'url('.Storage::disk(\App\Models\InternalStatic::find($db_profile_picture)->disk)->url(\App\Models\InternalStatic::find($db_profile_picture)->path).')' : '';
    @endphp

    <div id="profile-overview" class="flex max-width max-height">
        <div id="profile-overview-usercard" class="flex content-height content-width" wire:loading.class="disabled" wire:target="profile_picture, topupHandler">
            <div id="profile-overview-usercard-details" class="flex fill-width">
                <label for="profile-overview-usercard-details-avatar-core">
                    <div id="profile-overview-usercard-details-avatar" style="background-image: {{ $profile_picture ? 'url('.$profile_picture->temporaryUrl().')' : $db_profile_picture_path }} ">
                    <input id="profile-overview-usercard-details-avatar-core" type="file" wire:model="profile_picture" accept="image/*">
                    </div>
                </label>
                <div id="profile-overview-usercard-details-greeter" class="flex fill-width">
                    <div>
                        Welcome,  
                    </div>
                    <span id="profile-overview-usercard-details-greeter-username">{{ auth()->user()->name }}</spam>
                </div>
            </div>
            @if(!is_null($profile_picture))
            <div id="profile-overview-usercard-prompt-avatar-save" class="fill-width" wire:click="profilePictureHandler()">
                Save Profile Picture
            </div>
            <div id="profile-overview-usercard-prompt-avatar-cancel" class="fill-width" wire:click="$set('profile_picture', null)">
                Cancel
            </div>
            @else
            <div id="profile-overview-usercard-details-coin" class="fill-width" wire:click="topupHandler()">
                You have {{ auth()->user()->coins }} coin(s) remaining. Click here to add coins. 
            </div>
            @endif
        </div>
    </div>

    <style>

        div#profile-overview{
            /**/
        }

        div#profile-overview div#profile-overview-usercard{
            padding: 1.5rem;
            border-radius: .4rem;
            /* box-shadow: 0px 0px 29px #00000059; */
            /* box-shadow: 0px 0px 19px #00000059; */
            box-shadow: 0px 0px 29px #00000080;
            gap: 1.5rem;
            min-width: 43rem;
            flex-direction: column;
            animation: 1s flyin;
        }

        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-details{
            gap: 4rem;
        }

        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-details label[for="profile-overview-usercard-details-avatar-core"]{
            cursor: pointer;
        }

        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-details div#profile-overview-usercard-details-avatar{
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23232323' fill-opacity='0.4'%3E%3Cpath fill-rule='evenodd' d='M11 0l5 20H6l5-20zm42 31a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM0 72h40v4H0v-4zm0-8h31v4H0v-4zm20-16h20v4H20v-4zM0 56h40v4H0v-4zm63-25a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM53 41a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-30 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-28-8a5 5 0 0 0-10 0h10zm10 0a5 5 0 0 1-10 0h10zM56 5a5 5 0 0 0-10 0h10zm10 0a5 5 0 0 1-10 0h10zm-3 46a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM21 0l5 20H16l5-20zm43 64v-4h-4v4h-4v4h4v4h4v-4h4v-4h-4zM36 13h4v4h-4v-4zm4 4h4v4h-4v-4zm-4 4h4v4h-4v-4zm8-8h4v4h-4v-4z'/%3E%3C/g%3E%3C/svg%3E");
            min-width: 15rem;
            min-height: 21rem;
            border-radius: 0.5rem;
            background-size: cover;
            background-position: center;
            opacity: .8;
            background-color: #070707;
        }

        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-details div#profile-overview-usercard-details-avatar input{
            opacity: 0;
            pointer-events: none;
            user-select: none;
            width: 0;
            padding: 0;
            margin: 0;
        }

        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-details div#profile-overview-usercard-details-greeter{
            flex-direction: column;
            align-items: flex-start;
            font-size: 2rem;
            font-family: Roboto-light;
        }
        
        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-details div#profile-overview-usercard-details-greeter span#profile-overview-usercard-details-greeter-username{
            font-size: 4rem;
            font-family: Roboto-thin;
        }

        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-details-coin{
            padding: .7rem;
            background: #00000061;
            font-size: .9rem;
            text-align: center;
            cursor: pointer;
            user-select: none;
        }

        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-prompt-avatar-save, 
        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-prompt-avatar-cancel{
            padding: .7rem;
            background: #150303;
            font-size: .9rem;
            text-align: center;
            cursor: pointer;
            user-select: none;
        }

        div#profile-overview div#profile-overview-usercard div#profile-overview-usercard-prompt-avatar-cancel{
            margin-top: -1rem;
            background: #00000061;
        }

    </style>
    
</div>
