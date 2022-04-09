<div class="max-width max-height"> <!-- livewire requirement -->

    @php
        $db_movie_visual_cover = $movie->visual->cover ?? null;
        $db_movie_visual_cover_path = $db_movie_visual_cover ? 'var(--browse-gallery-node-shade), url('.MiruiFile::getURL($db_movie_visual_cover).')' : null;
    @endphp

    @if(!is_null($db_movie_visual_cover_path))
    <div id="browse-sub-cover" class="flex" style="background-image: {{ $db_movie_visual_cover_path }}">
    @else
    <div id="browse-sub-cover" class="flex">
    @endif
        <div id="browse-sub-cover-imagePrompt" class="hidden">
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
        <div id="browse-sub-cover-details" class="content-height">
            <div id="browse-sub-cover-details-top" class="flex">
                <span id="browse-sub-cover-details-rating" class="content-width">{{ $movie->rating ?? '--' }}</span>
                <span id="browse-sub-cover-details-score" class="content-width">{{ $movie->score ?? '--' }}</span>
            </div>
            <div id="browse-sub-cover-details-main">
                <h1 id="browse-sub-cover-details-title">{{ $movie->title ?? '--' }}</h1>
                <h2 id="browse-sub-cover-details-title2">{{ $movie->title2 ?? '--' }}</h2>
            </div>
            <div id="browse-sub-cover-details-desc" class="font-pri">{{ $movie->description ?? '--' }}</div>
        </div>
    </div>
    <div id="browse-sub-section" class="flex fill-width">
        <div id="browse-sub-section-sidebar">
            <div id="browse-sub-section-sidebar-details" class="flex">
                <div id="browse-sub-section-sidebar-details-info" class="flex content-width browse-sub-section-box">
                    <div class="browse-sub-section-sidebar-details-info-child">
                        <div>YEAR</div>
                        <span id="browse-sub-section-sidebar-details-year" class="fill-width">{{ $movie->dateRelease ?? '--' }}</span>
                    </div>
                    <div class="browse-sub-section-sidebar-details-info-child">
                        <div>RATE</div>
                        <span id="browse-sub-section-sidebar-details-rating" class="fill-width">{{ $movie->score ?? '--' }}</span>
                    </div>
                    <div class="browse-sub-section-sidebar-details-info-child">
                        <div>LANG</div>
                        <span id="browse-sub-section-sidebar-details-lang" class="fill-width">{{ $movie->language ?? '--' }}</span>
                    </div>
                    <div class="browse-sub-section-sidebar-details-info-child">
                        <div>SUB</div>
                        <span id="browse-sub-section-sidebar-details-subtitle" class="fill-width">{{ $movie->subtitle ?? '--' }}</span>
                    </div>
                    <div class="browse-sub-section-sidebar-details-info-child">
                        <div>DUR</div>
                        <span id="browse-sub-section-sidebar-details-duration" class="fill-width">{{ $movie->runtime ?? '--' }}</span>
                    </div>
                </div>
                <div id="browse-sub-section-sidebar-details-full" class="flex fill-width browse-sub-section-box-2">
                    <div class="flex browse-sub-section-sidebar-details-full-child fill-width">
                        <div>GENRE</div>
                        <span id="browse-sub-section-sidebar-details-genre"  class="fill-width">{{ $movie->genre ?? '--' }}</span>
                    </div>
                    <div class="flex browse-sub-section-sidebar-details-full-child fill-width">
                        <div>COUNTRY</div>
                        <span id="browse-sub-section-sidebar-details-country" class="fill-width">{{ $movie->country ?? '--' }}</span>
                    </div>
                    <div class="flex browse-sub-section-sidebar-details-full-child fill-width">
                        <div>DIRECTOR</div>
                        <span id="browse-sub-section-sidebar-details-director" class="fill-width">{{ $movie->director ?? '--' }}</span>
                    </div>
                    <div class="flex browse-sub-section-sidebar-details-full-child fill-width">
                        <div>CAST</div>
                        <span id="browse-sub-section-sidebar-details-cast" class="fill-width">{{ $movie->cast ?? '--' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div id="browse-sub-section-main">
            <div id="browse-sub-section-main-details" class="browse-sub-section-box">
                <div>STORYLINE</div>
                <p id="browse-sub-section-main-details-desc2">{!! $movie->description2 ?? '--' !!}</p>
            </div>
        </div>
    </div>

    <style>

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

        div#browse-sub-cover div#browse-sub-cover-imagePrompt.hidden{
            display: none;
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

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-top{
            font-family: Roboto-light;
            opacity: 0.7;
            text-transform: uppercase;
            justify-content: flex-start;
        }

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-top span{
            border: 1px solid whitesmoke;
            border-radius: 7%;
            margin: .1rem .2rem;
            padding: .2rem .5rem;
            display: block;
            min-width: .5rem;
            min-height: 1rem;
        }

        /* div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-top span[contenteditable="true"]:hover, 
        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-top span[contenteditable="true"]:focus{
            transform: scale(1.05);
        } */

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-main{
            margin: 1rem;
            text-shadow: 0px 0px 2rem rgba(0,0,0,.7);
        }

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-main h1{
            font-size: 5rem;
            margin: 1rem 0rem;
        }

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-main h2{
            font-style: italic;
            font-size: 2rem;
            margin: 1rem 0rem;
        }

        div#browse-sub-cover div#browse-sub-cover-details div#browse-sub-cover-details-desc{
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
            margin: 0rem 1rem;
        }

        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child div{
            font-size: 0.7rem;
        }

        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child span{
            color: teal;
            min-height: 1rem;
            display: block;
        }

        /* div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child span[contenteditable="true"]:hover, 
        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child span[contenteditable="true"]:focus{
            box-shadow: 0px 1px 0px darkslategray;
        } */

        div#browse-sub-section div.browse-sub-section-box .browse-sub-section-sidebar-details-info-child span#browse-sub-section-sidebar-details-duration{
            text-transform: none;
        }
        

        div#browse-sub-section div.browse-sub-section-box #browse-sub-section-sidebar-details-full{
            padding: 1rem 0rem;
        }

        div#browse-sub-section div.browse-sub-section-box#browse-sub-section-main-details{
            /* margin: 1rem 0 0 1rem; */
            color: #645938;
            padding-right: 2rem;
        }

        div#browse-sub-section div.browse-sub-section-box#browse-sub-section-main-details div{
            font-size: 0.7rem;
        }

        div#browse-sub-section div.browse-sub-section-box#browse-sub-section-main-details p{
            color: #97885b;
            margin: .8rem 0 .5rem;
            font-size: 1.1rem;
            line-height: 1.4rem;
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

        div#browse-sub-section div.browse-sub-section-box-2 .browse-sub-section-sidebar-details-full-child span{
            word-wrap: break-word;
            min-height: 1rem;
            display: inline-block;
        }

        div#browse-sub-section div.browse-sub-section-box-2 .browse-sub-section-sidebar-details-full-child span#browse-sub-section-sidebar-details-genre{
            word-spacing: .4rem;
        }


    </style>

</div>
