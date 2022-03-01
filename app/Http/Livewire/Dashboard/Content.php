<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Content extends Component
{

    public $isContentVisible = false;
    public $contentVisibilityClass = ' ';
    protected $contentVisibleClass = ' active ';
    protected $contentNotVisibleClass = ' ';
    public $currentContent = NULL;

    // protected $queryString = ['currentContent' => ['as' => 'page']];
    public $view = NULL;
    protected $listeners = ['dashboard.content.viewHandler' => 'viewHandler'];

    public function render()
    {
        // self::contentControl();
        if($this->view){
            $view = $this->view;
            // $this->view = NULL;
            // return view('livewire.dashboard.content.'.$view);
        }
        return view('livewire.dashboard.content');
    }

    public function viewHandler($content = NULL){
        
        $bypass = false;
        if($content != $this->currentContent && $this->currentContent){
            $bypass = true;
        }

        if(!$bypass){
            if($this->isContentVisible){
                $this->isContentVisible = false;
                $content = NULL;
            }else{
                $this->isContentVisible = true;
            }
        }

        // dump($this->currentContent);
        $this->currentContent = $content;

        if($this->isContentVisible){
            self::itemStateHandler(true);
            // $this->contentVisibilityClass = $this->contentVisibleClass;
            $this->emit('dashboard.nav.itemStateHandler', $content, true);
            // if($content == 'library'){
            //     $content = 'browse';
            // }
            $this->view = $content;
        }else{
            self::itemStateHandler(false);
            // $this->contentVisibilityClass = $this->contentNotVisibleClass;
            $this->emit('dashboard.nav.itemStateHandler', $content, false);
            $this->view = NULL;
        }
    }

    public function itemStateHandler($isActive = false){
        if($isActive){
            $this->contentVisibilityClass = $this->contentVisibleClass;
        }else{
            $this->contentVisibilityClass = $this->contentNotVisibleClass;
        }
    }

}
