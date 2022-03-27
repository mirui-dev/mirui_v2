<div class="max-width max-height"> <!-- livewire requirement -->
   
    {{-- $manageMode ?? null --}}

    <div id="browse-sub-cover" class="flex">
        <div id="browse-sub-cover-imagePrompt">
            <div id="browse-sub-cover-imagePrompt-main">
                <input id="browse-sub-cover-imagePrompt-poster" type="file" accept="image/*" onchange="articleImageControl('poster')">
                <input id="browse-sub-cover-imagePrompt-cover" type="file" accept="image/*" onchange="articleImageControl('cover')">
                <button>
                    <label for="browse-sub-cover-imagePrompt-poster">SELECT POSTER IMAGE</label>
                </button>
                <button>
                    <label for="browse-sub-cover-imagePrompt-cover">SELECT COVER IMAGE</label>
                </button>
            </div>
            <!-- <div id="browse-sub-cover-imagePrompt-preview">
                <div id="browse-gallery-node-preview" class="browse-gallery-node flex" onclick="">
                    <span class="browse-gallery-node-score content-width">-.-</span>
                    <div class="browse-gallery-node-details flex max-height fill-width">
                        <h1 class="browse-gallery-node-details-title">--</h1>
                    </div>
                </div>
            </div> -->
        </div>
        <div id="browse-sub-cover-details" class="content-height fill-max-width">
            <div id="browse-sub-cover-details-top" class="flex">
                <input id="browse-sub-cover-details-rating" class="content-width" type="text" wire:model.debounce.700ms="movie.rating" placeholder="Rating (ie. P13, R18)">
                <input id="browse-sub-cover-details-score" class="content-width" type="number" wire:model.debounce.700ms="movie.score" placeholder="Review Score (0.0 - 10.0)" min="0.0" max="10.0" step="0.1">
            </div>
            <div id="browse-sub-cover-details-main">
                <input id="browse-sub-cover-details-title" class="fill-max-width" type="text" wire:model.debounce.700ms="movie.title" placeholder="Movie Title">
                <br />
                <input id="browse-sub-cover-details-title2" class="fill-max-width" type="text" wire:model.debounce.700ms="movie.title2" placeholder="Secondary Movie Title">
            </div>
            <input id="browse-sub-cover-details-desc" class="font-pri fill-width" type="text" wire:model.debounce.700ms="movie.description" placeholder="This is a short movie description. Click on any of the visible elements to edit the movie details. ">
        </div>
    </div>
    <div id="browse-sub-section" class="flex fill-width">
        <div id="browse-sub-section-sidebar">
            <div id="browse-sub-section-sidebar-details" class="flex">
                <div id="browse-sub-section-sidebar-details-info" class="flex content-width browse-sub-section-box">
                    <div class="browse-sub-section-sidebar-details-info-child" style="margin-right: 0;">
                        <div>DATE</div>
                        <input id="browse-sub-section-sidebar-details-year" class="fill-width" type="date" wire:model.debounce.700ms="movie.dateRelease">
                    </div>
                    <div class="browse-sub-section-sidebar-details-info-child">
                        <div>SCORE</div>
                        <input id="browse-sub-section-sidebar-details-score" class="" type="number" wire:model.debounce.700ms="movie.score" min="0.0" max="10.0" step="0.1" placeholder="6.3">
                    </div>
                    <div class="browse-sub-section-sidebar-details-info-child">
                        <div>LANG</div>
                        <input id="browse-sub-section-sidebar-details-language" class="fill-width" type="text" wire:model.debounce.700ms="movie.language" placeholder="EN, JP">
                    </div>
                    <div class="browse-sub-section-sidebar-details-info-child">
                        <div>SUB</div>
                        <input id="browse-sub-section-sidebar-details-subtitle" class="fill-width" type="text" wire:model.debounce.700ms="movie.subtitle" placeholder="EN, ZH">
                    </div>
                    <div class="browse-sub-section-sidebar-details-info-child">
                        <div>DUR</div>
                        <input id="browse-sub-section-sidebar-details-runtime" class="fill-width" type="text" wire:model.debounce.700ms="movie.runtime" placeholder="160">
                    </div>
                </div>
                <div id="browse-sub-section-sidebar-details-full" class="flex fill-width browse-sub-section-box-2">
                    <div class="flex browse-sub-section-sidebar-details-full-child fill-width">
                        <div>GENRE</div>
                        <input id="browse-sub-section-sidebar-details-genre" class="fill-width" type="string" wire:model.debounce.700ms="movie.genre" placeholder="DRAMA, THRILLER, ROMANCE">
                    </div>
                    <div class="flex browse-sub-section-sidebar-details-full-child fill-width">
                        <div>COUNTRY</div>
                        <input id="browse-sub-section-sidebar-details-country" class="fill-width" type="string" wire:model.debounce.700ms="movie.country" placeholder="NEVERLAND">
                    </div>
                    <div class="flex browse-sub-section-sidebar-details-full-child fill-width">
                        <div>DIRECTOR</div>
                        <input id="browse-sub-section-sidebar-details-director" class="fill-width" type="string" wire:model.debounce.700ms="movie.director" placeholder="AH KEONG">
                    </div>
                    <div class="flex browse-sub-section-sidebar-details-full-child fill-width">
                        <div>CAST</div>
                        <textarea id="browse-sub-section-sidebar-details-cast" class="fill-width" wire:model.debounce.700ms="movie.cast" placeholder="ALI BIN ABU BAKAR [enter]&#13;&#10;PAK SAMAD [enter]&#13;&#10;AH BIN"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div id="browse-sub-section-main" class="fill-width">
            <div id="browse-sub-section-main-details" class="browse-sub-section-box">
                <div>STORYLINE</div>
                <textarea id="browse-sub-section-main-details-desc2" class="fill-width" wire:model.debounce.700ms="movie.description2" rows="5" placeholder="This is a case-sensitive movie description area. &#13;&#10;Some input fields will be auto-formatted upon input completion. "></textarea>
            </div>
        </div>
    </div>

    <style>

        /* div#browse-sub-cover-imagePrompt-preview{
            margin: 1rem;
        } */

        div#browse-sub-cover{
            height: 100%;
            background-image: var(--browse-gallery-node-shade), var(--global-background-default);
            background-size: cover;
            background-position: center;
            color: whitesmoke;
            font-family: Roboto-thin;
            align-items: flex-end;
            justify-content: flex-start;
        }




        div#browse-sub-cover div#browse-sub-cover-imagePrompt{
            top: 0;
            right: 0;
            position: absolute;
            margin: 2rem;
        }

        div#browse-sub-cover div#browse-sub-cover-imagePrompt input{
            opacity: 0;
            pointer-events: none;
            user-select: none;
            width: 0;
            padding: 0;
            margin: 0;
        }

        div#browse-sub-cover div#browse-sub-cover-imagePrompt button{
            padding: 7px 0px;
        }

        div#browse-sub-cover div#browse-sub-cover-imagePrompt button label{
            padding: 7px 14px;
            cursor: pointer;
        }



        
        div#browse-sub-cover div#browse-sub-cover-details{
            /* padding: 10vh 4rem; */
            margin: 10vh 4rem;
        }

        div#browse-sub-cover div#browse-sub-cover-details input{
            font-size: 1rem;
            /* margin: 1rem 0rem; */
            text-shadow: 0px 0px 2rem rgba(0,0,0,.7);
            color: whitesmoke;
            /* font-family: Roboto-thin; */
            border-radius: unset;
        }

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-top{
            font-family: Roboto-light;
            opacity: 0.7;
            text-transform: uppercase;
            justify-content: flex-start;
        }

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-top input{
            border: 1px solid whitesmoke;
            /* border-radius: 7%; */
            margin: .1rem .2rem;
            padding: .2rem .5rem;
            display: block;
            min-width: .5rem;
            min-height: 2rem;
        }

        /* div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-top span[contenteditable="true"]:hover, 
        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-top span[contenteditable="true"]:focus{
            transform: scale(1.05);
        } */

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-main{
            margin: 1rem;
            text-shadow: 0px 0px 2rem rgba(0,0,0,.7);
        }

        /* div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-main h1{
            font-size: 5rem;
            margin: 1rem 0rem;
        } */

        /* div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-main input#browse-sub-cover-details-title{
            font-size: 5rem;
            margin: 1rem 0rem;
            text-shadow: 0px 0px 2rem rgba(0,0,0,.7);
            color: whitesmoke;
            font-family: Roboto-thin;
        } */

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-main input#browse-sub-cover-details-title{
            font-size: 5rem;
            margin: 1rem 0rem;
            font-family: Roboto-thin;
            font-weight: 700;
        }

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-main input#browse-sub-cover-details-title2{
            font-style: italic;
            font-size: 2rem;
            margin: 1rem 0rem;
            font-weight: 700;
        }

        div#browse-sub-cover div#browse-sub-cover-details input#browse-sub-cover-details-desc{
            margin: 3rem 1rem;
            border-left: 2px solid #f5f5f5d4;
            padding: 1rem 1rem;
            text-shadow: 0px 0px 2rem rgba(0,0,0,.7);
        }

        div#browse-sub-section{
            justify-content: flex-start;
            align-items: flex-start;
            gap: 1rem;
            margin: 1rem;
            max-width: 1600px;
        }

        div#browse-sub-section div#browse-sub-section-sidebar-details{
            /* margin: 1rem; */
            /* margin: 1rem 0 0 1rem; */
            flex-direction: column;
            gap: 1rem;
            justify-content: flex-start;
            align-items: flex-start;
            text-transform: uppercase;
        }

        div#browse-sub-section div.browse-sub-section-box{
            padding: 1rem 1rem;
            font-size: 1.2rem;
            color: darkslategray;
            border-bottom: 4px solid currentColor;
            /* background: black; */
            box-shadow: 0px 0px .5rem black;

            background-color: #070707;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%23212121' fill-opacity='0.4' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
        }

        div#browse-sub-section div.browse-sub-section-box#browse-sub-section-sidebar-details-info{
            padding: 1rem 0rem;
            color: darkslategray;
            border-bottom: 4px solid currentColor;
            background-color: #070707;
            background-image: url("data:image/svg+xml,%3Csvg width='64' height='64' viewBox='0 0 64 64' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M8 16c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm0-2c3.314 0 6-2.686 6-6s-2.686-6-6-6-6 2.686-6 6 2.686 6 6 6zm33.414-6l5.95-5.95L45.95.636 40 6.586 34.05.636 32.636 2.05 38.586 8l-5.95 5.95 1.414 1.414L40 9.414l5.95 5.95 1.414-1.414L41.414 8zM40 48c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm0-2c3.314 0 6-2.686 6-6s-2.686-6-6-6-6 2.686-6 6 2.686 6 6 6zM9.414 40l5.95-5.95-1.414-1.414L8 38.586l-5.95-5.95L.636 34.05 6.586 40l-5.95 5.95 1.414 1.414L8 41.414l5.95 5.95 1.414-1.414L9.414 40z' fill='%23212121' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        
        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child{
            /* margin: 0rem 1rem; */
        }

        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child div{
            font-size: 0.7rem;
        }

        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child input{
            color: teal;
            min-height: 1rem;
            display: block;
            /* margin: 0;
            padding: 0.2rem;
            color: teal; */

        }

        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child input#browse-sub-section-sidebar-details-score, 
        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child input#browse-sub-section-sidebar-details-language, 
        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child input#browse-sub-section-sidebar-details-subtitle,
        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child input#browse-sub-section-sidebar-details-runtime
        {
            width: 3rem;
        }

        /* div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child span[contenteditable="true"]:hover, 
        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child span[contenteditable="true"]:focus{
            box-shadow: 0px 1px 0px darkslategray;
        } */

        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child span#browse-sub-section-sidebar-details-runtime{
            text-transform: none;
        }
        

        div#browse-sub-section div.browse-sub-section-box #browse-sub-section-sidebar-details-full{
            padding: 1rem 0rem;
        }

        div#browse-sub-section div.browse-sub-section-box-2{
            gap: 1rem;
            padding: 1rem;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            border-bottom: 4px solid rgba(245, 222, 186, 0.7);
            box-shadow: 0px 0px .5rem black;
            color: wheat;
            backgound-color: #070707;
            background: linear-gradient(300deg, rgba(7,7,7,.2), rgba(7,7,7,.6), rgba(7,7,7,.9)),url("data:image/svg+xml,%3Csvg width='6' height='6' viewBox='0 0 6 6' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='wheat' fill-opacity='0.4' fill-rule='evenodd'%3E%3Cpath d='M5 0h1L0 6V5zM6 5v1H5z'/%3E%3C/g%3E%3C/svg%3E");
        }

        div#browse-sub-section div.browse-sub-section-box-2 .browse-sub-section-sidebar-details-full-child{
            opacity: .7;
            gap: .4rem;
            flex-direction: column;
            text-align: center;
        }

        div#browse-sub-section div.browse-sub-section-box-2 .browse-sub-section-sidebar-details-full-child div{
            font-size: .7rem;
            opacity: .6;
            margin-bottom: .05rem;
            font-style: italic;
        }

        div#browse-sub-section div.browse-sub-section-box-2 .browse-sub-section-sidebar-details-full-child input,
        div#browse-sub-section div.browse-sub-section-box-2 .browse-sub-section-sidebar-details-full-child textarea
        {
            word-wrap: break-word;
            min-height: 1rem;
            display: inline-block;
            text-align: center;
            font-size: 1rem;
        }

        div#browse-sub-section div.browse-sub-section-box-2 .browse-sub-section-sidebar-details-full-child input#browse-sub-section-sidebar-details-genre{
            word-spacing: .4rem;
        }


        div#browse-sub-section div.browse-sub-section-box#browse-sub-section-main-details{
            /* margin: 1rem 0 0 1rem; */
            color: #645938;
            padding-right: 2rem;
        }

        div#browse-sub-section div.browse-sub-section-box#browse-sub-section-main-details div{
            font-size: 0.7rem;
        }

        div#browse-sub-section div.browse-sub-section-box#browse-sub-section-main-details textarea{
            color: #97885b;
            margin: .8rem 0 .5rem;
            font-size: 1.1rem;
            line-height: 1.4rem;
        }


    </style>

</div>
