<?php

namespace App\Http\Livewire\Dashboard\Subcontent\Transaction;

use Livewire\Component;

use App\Models\Transaction;

class Topup extends Component
{
    public Transaction $transaction;
    
    public $config_conversion = 0;

    public $isBuffering = false;
    protected $subcontentnav_topup_processing = [];

    protected $rules=[
        // https://www.php.net/manual/en/language.types.numeric-strings.php
        // quote: "A PHP string is considered numeric if it can be interpreted as an int or a float. "
        // 'transaction.amount' => 'required|integer|max:1000',
        // 'transaction.cardNumber' => 'required|size:19',
        // 'transaction.expiration' => 'required|size:5',
        // 'transaction.cvv' => 'required|integer|digits:3',
        
        // 'transaction.amount' => '',
        'transaction.coins' => '',
        'transaction.cardNumber' => '',
        'transaction.expiration' => '',
        'transaction.cvv' => '',
    ];

    public function render()
    {
        return view('livewire.dashboard.subcontent.transaction.topup');
    }

    public function mount(){
        $this->transaction = new Transaction;
        $this->config_conversion = config('mirui.defaults.coins.multiplier');
    }

    // https://laravel-livewire.com/docs/2.x/input-validation#real-time-validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function fuiyohhh(){
        // $this->validate();
        // if validation fails, it won't continue below. 

        // prevent escape subcontent view
        $this->emit('dashboard.subcontentnav.navStateHandler', $this->subcontentnav_topup_processing);
        // show processing UI state
        $this->isBuffering = true;
        $this->emit('dashboard.subcontent.transaction.checkout.processing', $this->isBuffering);

        // if we reach here, it means validation is successful. 
        $this->transaction->user_id = auth()->user()->id;
        $addCoins = $this->transaction->coins;
        // calculate to actual amount
        $this->transaction->amount = $this->transaction->coins * $this->config_conversion;
        // these attribs do not exist in model, unset them before saving object to db to prevent failure. 
        unset($this->transaction->coins);
        unset($this->transaction->expiration);
        unset($this->transaction->cvv);        
        // finally, save it :D
        $this->transaction->save();

        // assume is paid
        $this->transaction->is_paid = true;
        $this->transaction->save();

        // now, add coins to user profile
        // $addCoins = $this->transaction->amount / $this->config_conversion;
        auth()->user()->coins += $addCoins;
        auth()->user()->save();  // user is a collection, so need to call save() method to save changes

        // proceed to success page
        $viewData = [
            'isBuffering' => false, 
        ];
        $this->emit('dashboard.subcontent.transaction.viewHandler', 'success', $viewData);
        $this->emit('dashboard.subcontent.transaction.topup.processing', false);
        $this->emit('dashboard.content.profile.refresh');
    }

}
