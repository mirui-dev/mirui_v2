<div id="transaction-content" class="flex max-width max-height">
    <div id="transaction-content-progress" class="flex max-width">
        <div id="transaction-content-progress-bar">
        </div>
        <span id="transaction-content-progress-label">
            TRANSACTION
        </span>
    </div>
    <div id="transaction-content-container" class="flex max-width">

        <div id="transaction-content-checkout-summary" class="flex">
            <span class="lnr lnr-film-play"></span>
            <span id="transaction-content-checkout-summary-text">
                <div>
                    {{'You have '.$totalMovie.' movie(s) in cart '}}
                    <div>
                        @if($userCoin>=$totalCoin)
                        {{$checkOutMsg}}
                        <button wire:click="checkout()">PAY WITH {{$totalCoin}} COINS</button>
                        @else
                        {{$checkOutMsg}}
                        <button class="{{$payBtn}}">ADD COIN FIRST</button>
                        @endif
                    </div>
                </div>
            </span>
        </div>
        <div id="transaction-content-checkout-prompt" class="flex">
            <div class="transaction-content-checkout-prompt-child">
                <span>BACK</span>
            </div>
            <div id="transaction-content-checkout-prompt-next" class="transaction-content-checkout-prompt-child">
                <span>PAY</span>
            </div>
        </div>

    </div>

    <style>

        div#transaction-content{
            flex-direction: column;
        }

        div#transaction-content div#transaction-content-progress{
            height: 5%;
            background: gainsboro;
        }

        div#transaction-content div#transaction-content-progress div#transaction-content-progress-bar{
            background: white;
            left: 0;
            position: absolute;
            height: 5%;
            width: 0%;
        }

        div#transaction-content div#transaction-content-progress div#transaction-content-progress-bar.isBuffering{
            animation: .4s progress-buffer infinite;
        }

        div#transaction-content div#transaction-content-progress span#transaction-content-progress-label{
            position: absolute;
        }

        div#transaction-content div#transaction-content-container{
            flex-direction: column;
            height: 95%;
            overflow-y: auto;
            gap: 2rem;
            background-color: #070707;
            background-image: url("data:image/svg+xml,%3Csvg width='6' height='6' viewBox='0 0 6 6' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23232323' fill-opacity='0.4' fill-rule='evenodd'%3E%3Cpath d='M5 0h1L0 6V5zM6 5v1H5z'/%3E%3C/g%3E%3C/svg%3E");
        }

        @keyframes progress-buffer{
            10%{
                background: current;
                width: 100%;
            }
            100%{
                background: transparent;
                width: 100%;
            }
        }

    </style>

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

<!-- <div>
    {{'You have '.$totalMovie.' movie(s) in cart '}}

    <div>
        @if($userCoin>=$totalCoin)
        {{$checkOutMsg}}
        <button wire:click="checkout()">PAY WITH {{$totalCoin}} COINS</button>
        @else
        {{$checkOutMsg}}
        <button class="{{$payBtn}}">ADD COIN FIRST</button>
        @endif
    </div>
</div> -->


