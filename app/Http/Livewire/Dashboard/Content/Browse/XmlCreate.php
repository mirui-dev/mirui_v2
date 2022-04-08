<?php

namespace App\Http\Livewire\Dashboard\Content\Browse;

use Livewire\Component;

use Livewire\WithFileUploads;

use App\Support\Facades\MiruiXML;

class XmlCreate extends Component
{

    use WithFileUploads;

    public $xml_file = null;
    public $preventDefault = false;

    public function render()
    {
        return view('livewire.dashboard.content.browse.xml-create');
    }

    // again, it happens after file uploaded. no use. 
    // public function updatingXmlFile(){
    //     $this->emit('common.notification.new', '<p>Uploading XML file</p>', null, 6000);
    // }

    // https://laravel-livewire.com/docs/2.x/lifecycle-hooks
    public function updatedXmlFile(){
        // $this->emit('common.notification.new', '<p>Parsing XML file for insertion</p>', null, 6000);
        self::createHandler();
    }

    public function createHandler(){
        $insert = MiruiXML::insertMovie($this->xml_file->get());

        if($insert === false){
            $this->emit('common.notification.new', '<p>An error occured while parsing the XML file. Please check your XML file and try again. </p>', null, 8000);
        }else{
            $this->emit('common.notification.new', '<p>Parse successful. '.$insert.' movie record(s) inserted. </p>', null, 6000);
        }

        $this->xml_file = null;
    }

}
