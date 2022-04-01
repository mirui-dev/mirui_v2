<div id="transaction-content-container" class="flex max-width {{ $isBuffering ? 'disabled' : '' }}">

    <div id="transaction-content-checkout-summary" class="flex">
        <span class="lnr lnr-film-play"></span>
        <span id="transaction-content-checkout-summary-text">
            {{ 
                'You have '.$totalMovieCount.' movie'. 
                ($totalMovieCount > 1 ? '(s)' : '') .
                ' in cart' 
            }}
            @if(!$isInsufficientRam)
                {{ 'ready for checkout. ' }}
            @else
                {{ ', however your coins balance is low. ' }}
            @endif
        </span>
    </div>
    <div id="transaction-content-checkout-prompt" class="flex">
        <div class="transaction-content-checkout-prompt-child" wire:click="$emit('dashboard.subcontent.viewHandler')">
            <span>BACK</span>
        </div>
        @if(!$isInsufficientRam)
        <div id="transaction-content-checkout-prompt-next" class="transaction-content-checkout-prompt-child" wire:click="checkout()">
            <!-- <span>PAY</span> -->
            <span>{{ 'PAY WITH '.$totalMovieCoin.' COINS' }}</span>
        </div>
        @else
        <div id="transaction-content-checkout-prompt-next" class="transaction-content-checkout-prompt-child disabled">
            <!-- <span>PAY</span> -->
            <span>{{ 'REQUIRED: '.$totalMovieCoin.' C' }}<br/>{{ 'ADD COIN FIRST ._>' }}</span>
        </div>
        @endif
    </div>

    <style>

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-summary{
            max-width: 70%;
            gap: 3rem;
            font-size: 3rem;
        }

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-summary span.lnr{
            font-size: 10rem;
            text-shadow: 0px 0px 10px slategray;
            color: azure;
            opacity: .7;
        }

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-prompt{
            gap: 1rem;
            opacity: .7;
        }

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-prompt div.transaction-content-checkout-prompt-child{
            padding: .5rem .7rem;
            border-radius: 5px;
            background: none;
            cursor: pointer;
            user-select: none;
        }

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-prompt div.transaction-content-checkout-prompt-child:hover{
            background: #1c1c1c;
            color: azure;
        }

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-prompt div.transaction-content-checkout-prompt-child:hover:active{
            color: unset;
        }

    </style>

</div>
