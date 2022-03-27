<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Subcontentnav extends Component
{

    public $subcontentnavVisibilityClass = ' '; 
    protected $subcontentnavVisibleClass = 'active';
    protected $subcontentnavNotVisibleClass = ' ';
    public $subcontentnavDeleteVisibilityClass = '';
    public $subcontentnavSaveVisibilityClass = '';  // unused
    public $subcontentnavEditVisibilityClass = '';
    public $subcontentnavBackVisibilityClass = '';
    public $subcontentnavCartVisibilityClass = '';
    public $subcontentnavWatchVisibilityClass = '';
    public $subcontentnavDeleteSubstateClass = '';
    public $subcontentnavSaveSubstateClass = '';  // unused
    public $subcontentnavEditSubstateClass = '';
    public $subcontentnavBackSubstateClass = '';
    public $subcontentnavCartSubstateClass = '';
    public $subcontentnavWatchSubstateClass = '';
    protected $subcontentnavChildVisibleClass = '';
    protected $subcontentnavChildNotVisibleClass = 'hidden';
    protected $subcontentnavChildSubstateClass = 'disabled';
    protected $subcontentnavChildNotSubstateClass = '';
    public $substateAction = NULL;
    public $isInCart = false;
    // public $isInLibrary = false;
    protected $subcontentnavActions = [
        // 'delete', 
        // 'edit', 
        'back',
        'cart', 
        'watch',
    ];
    protected $subcontentnavActions_SU = [
        'delete', 
        // 'save',
        'edit', 
        // 'back',
        // 'cart', 
        // 'watch',
    ];

    protected $subcontentnav_browse_withSU = ['back', 'cart'];

    // beware that emit is not working from render/mount menthod. 
    // ref: https://github.com/livewire/livewire/issues/598#issuecomment-764947653
    protected $listeners = [
        // 'dashboard.subcontentnav.handler' => 'handler', 
        'dashboard.subcontentnav.itemStateHandler' => 'itemStateHandler', 
        'dashboard.subcontentnav.navStateHandler' => 'navStateHandler',
        'dashboard.subcontentnav.navSubstateHandler' => 'navSubstateHandler',
        'dashboard.subcontentnav.cartStateHandler' => 'cartStateHandler',
    ];

    public function render()
    {
        return view('livewire.dashboard.subcontentnav');
    }

    public function mount(){
        $this->subcontentnavVisibilityClass = $this->subcontentnavNotVisibleClass;
        // $this->subcontentnavEditVisibilityClass = $this->subcontentnavVisibleClass;
        // self::navStateHandler(['back']);
        self::navStateHandler();
    }

    public function handler($type, $data = null){
        if($type == 'back'){
            $this->emit('dashboard.subcontent.viewHandler', null);
            // self::itemStateHandler(false);  // dashboard.subcontent.viewHandler already call this
            self::navSubstateHandler();
            // clear isinCart state
            // $this->isInCart = false;
            // self::cartStateHandler();
        }
        if($type == 'delete'){
            self::navSubstateHandler('state.delete.confirm');
        }
        if($type == 'delete.confirm'){
            self::navSubstateHandler('state.delete.deleting');
            // dump('wow');
            $this->emit('dashboard.subcontent.browseManage.delete');
        }
        if($type == 'edit'){
            // self::navStateHandler(['back', 'save', 'cart', 'delete']);
            self::navSubstateHandler('state.edit.editing');
            $this->emit('dashboard.subcontent.browse.handler');
        }
        if($type == 'save'){
            self::navSubstateHandler('state.edit.saving');
            $this->emit('dashboard.subcontent.browseManage.save');
        }
        if($type == 'cart'){
            if(!$this->isInCart){
                // add to cart
                $this->emit('dashboard.subcontent.browseManage.addToCart');
            }else{
                // remove from cart
                $this->emit('dashboard.subcontent.browseManage.removeFromCart');
            }
            // must manage the cart state from here because emit is not in sequence, hence user might add same movie more than once in their cart
            $this->isInCart = !$this->isInCart;
        }
        // self::navStateHandler();
    }

    public function itemStateHandler($isActive = false){
        if($isActive){
            $this->subcontentnavVisibilityClass = $this->subcontentnavVisibleClass;
        }else{
            $this->subcontentnavVisibilityClass = $this->subcontentnavNotVisibleClass;
        }
    }

    public function navStateHandler($actions = ['back'], $substateAction = NULL){
        if(!is_null($actions)){
            $subcontentnavActions = array_merge($this->subcontentnavActions, $this->subcontentnavActions_SU);
            // dump($subcontentnavActions);
            // dump($actions);
            // $count = 0;
            foreach($subcontentnavActions as $action){
                if(
                    // array_search($action, $this->subcontentnavActions) !== false
                    // || array_search($action, $this->subcontentnavActions_SU) !== false
                    array_search($action, $actions) !== false
                ){
                    // $count++;
                    // dump($actions);
                    // dump(array_search($action, $actions) !== false);
                    // https://stackoverflow.com/questions/9257505/using-braces-with-dynamic-variable-names-in-php
                    $this->{'subcontentnav'.ucfirst($action).'VisibilityClass'} = $this->subcontentnavChildVisibleClass;
                }else{
                    $this->{'subcontentnav'.ucfirst($action).'VisibilityClass'} = $this->subcontentnavChildNotVisibleClass;
                }
            }
        }

        // if(!is_null($substateAction)){
        //     // foreach($substateActions as $substate){
        //         if($substateAction == 'state.saving'){
        //             session()->flash('state.saving');
        //         }
        //     // }
        //     self::render();
        // }

        // dump($count);
        // dump($this->subcontentnavEditVisibilityClass);
        // dump($this->subcontentnavBackVisibilityClass);
    }

    public function navSubstateHandler($substateAction = NULL){
        $subcontentnavActions = array_merge($this->subcontentnavActions, $this->subcontentnavActions_SU);
        foreach($subcontentnavActions as $action){
            $isSubstate = false;
            $isSubstateRequireDismiss = false;
            if(!is_null($substateAction)){
                // dump('wow');
                // session()->flash($substateAction);
                $this->substateAction = $substateAction;
                if($action == 'edit' && $substateAction == 'state.edit.saving'){
                    // if($action == 'edit'){
                        $isSubstate = true;
                        // dump('wow');
                        // $this->{'subcontentnav'.ucfirst($action).'SubstateClass'} = $this->subcontentnavChildSubstateClass;
                    // }else{
                    //     // $this->{'subcontentnav'.ucfirst($action).'SubstateClass'} = $this->subcontentnavChildNotSubstateClass;
                    // }
                }else if($action == 'edit' && $substateAction == 'state.edit.saved'){
                    $isSubstate = true;
                    $isSubstateRequireDismiss = true;
                }else if($action == 'delete' && $substateAction == 'state.delete.deleting'){
                    // this is actually not needed LOL
                    // directly set the disabled class in blade....
                    $isSubstate = true;
                }

                if($isSubstate){
                    $this->{'subcontentnav'.ucfirst($action).'SubstateClass'} = $this->subcontentnavChildSubstateClass;
                // }else{
                //     $this->{'subcontentnav'.ucfirst($action).'SubstateClass'} = $this->subcontentnavChildNotSubstateClass;
                }

                if($isSubstateRequireDismiss){
                    session()->flash('substateActionRequireDismiss');   
                }

                // remark to myself (WP): 
                /// wt* is this??? the substateClass thing is not used in blade??? what the hell?

            }else{
                $this->substateAction = NULL;
                $this->{'subcontentnav'.ucfirst($action).'SubstateClass'} = $this->subcontentnavChildNotSubstateClass;
            }
        }
    }

    public function cartStateHandler($isInCart = false){
        $this->isInCart = $isInCart;
    }

}
