<?php

namespace App\Http\Livewire\Dashboard\Subcontent;

use Livewire\Component;

class Transaction extends Component
{
    // public $mode = null;
    // derived from app/Http/Livewire/Dashboard/Subcontent
    public $view = null;
    public $viewData = null;
    // public $transactionProgressBarBufferClass = '';
    // public $isInsufficientRam = false;  // isInsufficientCoin
    // protected $transactionProgressBarBufferingClass = ' isBuffering ';
    // protected $transactionProgressBarNotBufferingClass = '';
    // protected $movieCoin = 5;
    public $isBuffering = false;

    protected $listeners = [
        'dashboard.subcontent.transaction.viewHandler' => 'viewHandler',
        'dashboard.subcontent.transaction.checkout.processing' => 'bufferingHandler',
    ];

    // erm. it gets confusing now. okay. 
    // okay, so. Cart.php calls subcontent viewHandler to bring up Transaction.php with [$view => 'checkout'] as $viewData. 
    // subcontent viewHandler bring up Transaction.php and pass $viewData to Transaction.php, 
    // and directly assign values inside $viewData to Transaction.php corresponding variables, because passing as parameter data to Transaction.php. 
    // 
    // after that, for child components (ie. checkout/checkout-success views), we shall emit to viewHandler with what $view and what $viewData. 
    // so child component is being replaced, and $viewData is, like previous case, passed on to the component (ie. Transaction/Checkout.php). 

    public function render()
    {
        // if($this->view){
        //     $view = $this->view;
        //     $viewData = $this->viewData;
        // }
        return view('livewire.dashboard.subcontent.transaction');
    }

    public function viewHandler($view = null, $viewData = null){
        $this->view = $view;
        $this->viewData = $viewData;
    }

    public function bufferingHandler($isBuffering = null){
        if(!is_null($isBuffering)){
            $this->isBuffering = $isBuffering;
        }else{
            $this->isBuffering = !$this->isBuffering;
        }
    }
}
