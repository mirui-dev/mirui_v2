<div class="max-width max-height"> <!-- livewire requirement -->
    
    <!-- inherited from browse.php -->
    <div class="flex fill-width browse-float">
        <div id="browse-search" class="flex fill-width">
            <input id="browse-search-input" class="fill-width" type="text" placeholder="search me uwu" oninput="articleSearch();">
        </div>
        <div id="browse-action" class="flex content-width">
            <div id="browse-action-checkout" class="{{$checkoutBtn}}" wire:click="checkoutHandler()">
                <span class="lnr lnr-enter"></span>
                <span>CHECKOUT</span>
            </div>
        </div>
    </div>
    <div id="browse-gallery" class="flex content-height">
    </div>

    <style>
        :root{
            --browse-gallery-node-shade: linear-gradient(rgba(0,0,0,.1), rgba(0,0,0,.2), rgba(0,0,0,.7));
        }

        div.browse-float div#browse-action-checkout{
            color: lightgray;
            height: 4rem;
            border-bottom: 1px solid darkred;
            background: #070707;
            box-shadow: 0px 0px 1.2rem black;
            padding: 0rem 1rem;
            gap: .3rem;
            font-size: .9rem;
            flex-direction: column;
            cursor: pointer;
            user-select: none;
        }

        div.browse-float div#browse-action-checkout span.lnr{
            font-size: 1.5rem;
        }

        div.browse-float div#browse-action-checkout:hover{
            color: azure;
            border-bottom: 1px solid red;
        }

        div.browse-float div#browse-action-checkout:hover:active{
            transform: scale(0.95);
        }

        div#browse-gallery{
            padding: 1rem;
            /* justify-content: flex-start; */
            gap: 1rem;
            flex-wrap: wrap;
        }

        div#browse-gallery div.browse-gallery-node{
            cursor: pointer;
            animation: fadein 1.2s;
            width: 12rem;
            height: 17rem;
            background-image: var(--browse-gallery-node-shade);
            background-size: cover;
            background-position: center;
            box-shadow: 0px 0px 20px rgb(0, 19, 17);
            justify-content: flex-start;
            align-items: flex-end;
            border-radius: 2%;
            padding: .5rem;
            flex-direction: column;
            color: rgba(255,255,255,.9);
            /* border-left: 5px solid rgba(12, 65, 81, 1); */
        }

        div#browse-gallery div.browse-gallery-node:hover{
            transform: scale(1.07);
            filter: brightness(1.2);
            /* border-left: 5px solid rgba(12, 65, 81, .9); */
        }

        div#browse-gallery div.browse-gallery-node:active{
            transform: scale(1.03);
            filter: brightness(.8);
        }

        div#browse-gallery div.browse-gallery-node span{
            background: #0c4151;
            padding: .1rem .2rem;
            border-radius: 20%;
            font-size: .7rem;
            opacity: .9;
        }

        div#browse-gallery div.browse-gallery-node div.browse-gallery-node-details{
            color: rgba(255,255,255,.9);
            justify-content: flex-start;
            align-items: flex-end;
            text-shadow: 0px 0px 10px lightsalmon;
        }

        div#browse-gallery div.browse-gallery-node div.browse-gallery-node-details h1{
            font-family: Roboto-light;
            margin: .5rem .2rem;
        }

    </style>
    <div id="browse-gallery" class="flex content-height">   
        @if(count($cart??[]))
        @foreach($cart as $movie)
        <div id="browse-gallery-node-{{$movie->id}}" class="browse-gallery-node flex">
            <span class="browse-gallery-node-score content-width">{{$movie->score}}</span>
            <div class="browse-gallery-node-details flex max-height fill-width">
                <h1 class="browse-gallery-node-details-title">{{$movie->title}}</h1>
            </div>
        </div>
        <div>
            <button wire:click="removeFromCart({{$movie}})">Remove</button>
        </div>
        @endforeach
        @else
        <div>Cart is empty now</div>
        @endif

    </div>
</div>
