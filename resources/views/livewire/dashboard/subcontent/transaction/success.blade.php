<div id="transaction-content-container" class="flex max-width {{ $isBuffering ? 'disabled' : '' }}">

    <div id="transaction-content-checkout-summary" class="flex">
        <span class="lnr lnr-coffee-cup"></span>
        <span id="transaction-content-checkout-summary-text">
            Transaction complete. 
            <br>
            <p>
                Grab some popcorn and watch your favorite movies now!
            </p>
        </span>
    </div>
    <div id="transaction-content-checkout-prompt" class="flex">
        <div class="transaction-content-checkout-prompt-child" wire:click="$emit('dashboard.subcontent.viewHandler')">
            <span>OKIE DOKIE ☆ ～('▽^人)</span>
        </div>
    </div>


    <style>

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-summary{
            max-width: 70%;
            gap: 3rem;
            font-size: 3rem;
            animation: fadein 1s;
            flex-direction: column;
            text-align: center;
        }

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-summary span.lnr{
            font-size: 10rem;
            text-shadow: 0px 0px 10px slategray;
            color: azure;
            opacity: .7;
        }

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-summary span#transaction-content-checkout-summary-text p{
            font-size: 1.5rem;
        }

        div#transaction-content div#transaction-content-container div#transaction-content-checkout-prompt{
            gap: 1rem;
            opacity: .7;
            animation: fadein 1s;
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
