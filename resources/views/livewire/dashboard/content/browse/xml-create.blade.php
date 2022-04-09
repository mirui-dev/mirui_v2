<div id="browse-action" class="flex content-width">
    <div id="browse-action-xml-insert" class="flex" wire:loading.class="disabled" wire:target="xml_file" onclick="document.getElementById('xml-upload-input').click()">
        <span class="lnr lnr-file-add"></span>
        <span>XML CREATE</span>
        <!-- https://stackoverflow.com/questions/7053436/showing-only-xml-files-in-html-file-input-element -->
        <input id="xml-upload-input" wire:model="xml_file" type="file" accept=".xml" style="opacity: 0;">
    </div>
    <div id="browse-action-xml-sample" class="flex" wire:loading.class="disabled" wire:target="sampleHandler" wire:click="sampleHandler()">
        <span class="lnr lnr-enter-down"></span>
        <span>XML SAMPLE</span>
    </div>

    <style>

        div.browse-float div#browse-action-xml-insert,
        div.browse-float div#browse-action-xml-sample{
            color: lightgray;
            height: 4rem;
            /* border-bottom: 1px solid darkviolet; */
            border-bottom: 1px solid darkgoldenrod;
            background: #070707;
            box-shadow: 0px 0px 1.2rem black;
            padding: 0rem 1rem;
            gap: .3rem;
            font-size: .9rem;
            flex-direction: column;
            cursor: pointer;
            user-select: none;
            width: max-content;
        }
        /* div.browse-float div#browse-action-xml-sample{
            border-bottom: 1px solid coral;
        } */

        div.browse-float div#browse-action-xml-insert span.lnr,
        div.browse-float div#browse-action-xml-sample span.lnr{
            font-size: 1.5rem;
        }

        div.browse-float div#browse-action-xml-insert:hover,
        div.browse-float div#browse-action-xml-sample:hover{
            color: azure;
            border-bottom: 1px solid red;
        }

        div.browse-float div#browse-action-xml-insert:hover:active,
        div.browse-float div#browse-action-xml-sample:hover:active{
            transform: scale(0.95);
        }

        div.browse-float div#browse-action-xml-insert input#xml-upload-input{
            display: none;
        }

    </style>

</div>
