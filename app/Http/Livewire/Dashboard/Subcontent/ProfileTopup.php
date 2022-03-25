<?php

namespace App\Http\Livewire\Dashboard\Subcontent;

use Livewire\Component;

use App\Models\Transaction;

class ProfileTopup extends Component
{
    public Transaction $transaction;

    protected $rules=[
        'transaction.amount' => 'required|integer|max:500',
        'transaction.cardnumber' => 'required|string|size:19',
        'transaction.expiration' => 'required|string|size:5',
        'transaction.cvv' => 'required|numeric|digits:3',
    ];
    
    // protected $messages = [
    //     'transaction.card_number.required' => 'The Cart Number cannot be empty.',
    //     'transaction.card_number.size' => 'The Cart Number must have 16 numbers.',
    //     'transaction.expiration.size' => 'The Expiration cannot be empty.',
    // ];

    public function render()
    {
        return view('livewire.dashboard.subcontent.profile-topup');
    }

    public function mount(){
        $this->transaction = new Transaction();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function payCoin(){
        $this->validate();
        $this->transaction->user_id = auth()->user()->id;
        unset($this->transaction->expiration);
        unset($this->transaction->cvv);
        $this->transaction->ispaid = true;
        $this->transaction->save();
    }
}
