<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Subcontent extends Component
{

    public $subcontentVisibilityClass = ' '; 
    protected $subcontentVisibleClass = 'active';
    protected $subcontentNotVisibleClass = ' ';
    public $view = NULL;
    public $viewData = NULL;
    // public $urlParam = NULL;

    // protected $queryString = ['view' => ['as' => 'subpage'], 'urlParam' => ['as' => 'id']];
    protected $listeners = ['dashboard.subcontent.viewHandler' => 'viewHandler'];

    public function render()
    {
        if($this->view){
            $view = $this->view;
            $viewData = $this->viewData;
            // dump('wow');
            // $this->view = NULL;
            // $this->viewData = NULL;
            // return Subcontent::render();
            // $this->emit('dashboard.subcontent.'.$view.'.contentHandler', $viewData);
            // return view('livewire.dashboard.subcontent.'.$view, $viewData);
        }
        // return view('livewire.dashboard.subcontent', $viewData ?? []);
        return view('livewire.dashboard.subcontent');
    }

    public function viewHandler($subcontent = NULL, $data = NULL){
        $this->view = $subcontent;
        $this->viewData = $data;
        // $this->urlParam = $urlParam;

        // dump('wow');

        $this->emit('dashboard.subcontentnav.itemStateHandler', $subcontent);
        // $this->emit('dashboard.subcontentnav.navStateHandler', ['back']);
        self::itemStatehandler($subcontent);

        // self::viewStatehandler(true);
        // return view('livewire.dashboard.subcontent.'.$subcontent, $data);
    }

    public function itemStatehandler($isActive = false){
        if($isActive){
            $this->subcontentVisibilityClass = $this->subcontentVisibleClass;
        }else{
            $this->subcontentVisibilityClass = $this->subcontentNotVisibleClass;
        }
    }

}
