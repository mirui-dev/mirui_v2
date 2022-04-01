<div id="transaction-content" class="flex max-width max-height">
    <div id="transaction-content-progress" class="flex max-width">
        <div id="transaction-content-progress-bar" class=" {{ $isBuffering ? ' isBuffering ' : '' }}">
        </div>
        <span id="transaction-content-progress-label">
            TRANSACTION
        </span>
    </div>
    <!-- <div id="transaction-content-container" class="flex max-width"> -->
        @livewire('dashboard.subcontent.transaction.'.$view, $viewData ?? [], key('dashboard.subcontent.transaction.'.$view))
    <!-- </div> -->

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
</div>

