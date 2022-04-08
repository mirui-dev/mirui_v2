<?php

namespace App\Http\Livewire\Dashboard\Subcontent\Transaction;

use Livewire\Component;

use Illuminate\Validation\Validator;

use App\Support\Facades\MiruiValidator;
use App\Models\Transaction;

class Topup extends Component
{
    public Transaction $transaction;

    public $coins = '';
    public $cardExpiry = '';
    public $cardCVV = '';

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
        // 'transaction.coins' => '',
        'transaction.cardNumber' => '',
        // 'transaction.expiration' => '',
        // 'transaction.cvv' => '',
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
        // dump($propertyName);
        self::formatter($propertyName);
        // $this->validateOnly($propertyName);
    }

    public function fuiyohhh(){
        // $this->validate();

        $validateCoins = MiruiValidator::validateCoins($this->coins);
        $validateCardNumber = MiruiValidator::validateCardNumber($this->transaction->cardNumber);
        $validateCardExpiry = MiruiValidator::validateCardExpiry($this->cardExpiry);
        $validateCardCVV = MiruiValidator::validateCardCVV($this->cardCVV);

        if(
            $validateCoins === true
            && $validateCardNumber === true
            && $validateCardExpiry === true
            && $validateCardCVV === true
        ){

            // prevent escape subcontent view
            $this->emit('dashboard.subcontentnav.navStateHandler', $this->subcontentnav_topup_processing);
            // show processing UI state
            $this->isBuffering = true;
            $this->emit('dashboard.subcontent.transaction.checkout.processing', $this->isBuffering);

            // if we reach here, it means validation is successful. 
            $this->transaction->user_id = auth()->user()->id;
            $addCoins = $this->coins;
            // calculate to actual amount
            $this->transaction->coins = $this->coins;
            $this->transaction->amount = $this->coins * $this->config_conversion;
            // these attribs do not exist in model, unset them before saving object to db to prevent failure. 
            // unset($this->transaction->coins);
            // unset($this->transaction->expiration);
            // unset($this->transaction->cvv);        
            // finally, save it :D
            $this->transaction->save();

            // assume is paid
            $this->transaction->is_paid = true;
            $transaction = $this->transaction->save();

            if($transaction){

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

            }else{
                $this->emit('common.notification.new', '<p>Topup failed. Please try again later. </p>', null, 6000);
            }
        }else if(
            $validateCoins instanceof Validator
            || $validateCardNumber instanceof Validator
            || $validateCardExpiry instanceof Validator
            || $validateCardCVV instanceof Validator
        ){

            // if($validateCoins instanceof Validator){
            //     foreach($validateCoins->errors()->all() as $errors){
            //         $this->emit('common.notification.new', '<p>'.$errors.'</p>', 'darkorange', 10000);
            //     }    
            // }

            // if($validateCardNumber instanceof Validator){
            //     foreach($validateCardNumber->errors()->all() as $errors){
            //         $this->emit('common.notification.new', '<p>'.$errors.'</p>', 'darkorange', 10000);
            //     }    
            // }

            // if($validateCardExpiry instanceof Validator){
            //     foreach($validateCardExpiry->errors()->all() as $errors){
            //         $this->emit('common.notification.new', '<p>'.$errors.'</p>', 'darkorange', 10000);
            //     }    
            // }

            // if($validateCardCVV instanceof Validator){
            //     foreach($validateCardCVV->errors()->all() as $errors){
            //         $this->emit('common.notification.new', '<p>'.$errors.'</p>', 'darkorange', 10000);
            //     }                
            // }

            if($validateCardCVV instanceof Validator){
                foreach($validateCardCVV->errors()->all() as $errors){
                    $this->emit('common.notification.new', '<p>'.$errors.'</p>', 'darkorange', 15000);
                }                
            }

            if($validateCardExpiry instanceof Validator){
                foreach($validateCardExpiry->errors()->all() as $errors){
                    $this->emit('common.notification.new', '<p>'.$errors.'</p>', 'darkorange', 15000);
                }    
            }

            if($validateCardNumber instanceof Validator){
                foreach($validateCardNumber->errors()->all() as $errors){
                    $this->emit('common.notification.new', '<p>'.$errors.'</p>', 'darkorange', 15000);
                }    
            }
            
            if($validateCoins instanceof Validator){
                foreach($validateCoins->errors()->all() as $errors){
                    $this->emit('common.notification.new', '<p>'.$errors.'</p>', 'darkorange', 15000);
                }    
            }

        }else{
            $this->emit('common.notification.new', '<p>Invalid payment details. Ensure that payment details are correct. </p>', null, 6000);
        }
    }

    public function formatter($input = null){
        // if($input == 'coins'){
        //     $this->coins = trim($this->coins);
        // }else if($input == 'transaction.cardNumber'){
        if($input == 'transaction.cardNumber'){
            $this->transaction->cardNumber = substr(trim(str_replace(' ', '', $this->transaction->cardNumber)), 0, 16);
            
            $workbench = str_split($this->transaction->cardNumber, 4);
            $this->transaction->cardNumber = implode(' ', $workbench);

            // if(
            //     strlen($this->transaction->cardNumber) == 4
            //     || strlen($this->transaction->cardNumber) == 9
            //     || strlen($this->transaction->cardNumber) == 14
            // ){
            //     $this->transaction->cardNumber .= ' ';
            // }
        }else if($input == 'cardExpiry'){
            $this->cardExpiry = substr(trim(str_replace('/', '', $this->cardExpiry)), 0, 4);
            
            $workbench = str_split($this->cardExpiry, 2);
            $this->cardExpiry = implode('/', $workbench);
            
            // if(strlen($this->cardExpiry) == 2){
            //     $this->cardExpiry .= '/';
            // }
        }else{
            $this->coins = trim($this->coins);
            $this->cardCVV = trim($this->cardCVV);
        }
    }

}
