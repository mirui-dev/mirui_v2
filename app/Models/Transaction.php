<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    // protected $table = 'transactions';

    // /**
    //  * The model's default values for attributes.
    //  *
    //  * @var array
    //  */
    // protected $attributes = [
    //     'user_id' => 1,
    //     'cardNumber' => '12345', 
    //     'amount' => 1.23,
    //     'isPaid' => false,
    // ];

    protected function cardnumber(): Attribute{
        return Attribute::make(
            //out: retrieve object to display
            get: function($value){
                //return 'www';
                // dump($value);
                $count=0;
                $return = "";
                $strval = strval($value == 0 ? '': $value);
                do{
                    $return .= substr($strval, $count, 4);
                    $return .= ' ';
                    $count += 4;
                }while($count < 16 && $count < strlen($strval));
                $return = trim($return);
                return $return;
            },
            //in: from user input
            set: function($value){
                dump($value);
                dump(self::cardNumValidator(['cardnumber' => $value]));
                $return = intval(filter_var($value, FILTER_SANITIZE_NUMBER_INT));
                // dump($return);
                return $return;
            }
        );
    }

    protected function expiration(): Attribute{
        return Attribute::make(
            //out: retrieve object to display
            get: function($value){
                //return 'www';
                // dump($value);
                return $value;
            },
            //in: from user input
            set: function($value){
                dump($value);
                dump(self::expValidator(['expiration' => $value]));
                
                $input = intval(filter_var($value, FILTER_SANITIZE_NUMBER_INT));
                // dump($return);
                $count=0;
                $return = "";
                $strval = strval($input == 0 ? '': $input);
                while($count < 2 && $count < strlen($strval)){
                    $return .= substr($strval, $count, 2);
                    $return .= '/';
                    $count += 2;
                }
                $return .= substr($strval, $count, 2);

                //$seperator = explode('/', $return);
                // if(intval($seperator[0]) > 12){
                //     $seperator[0] = 12;
                // }
                // if(intval($seperator[1]) > 27){
                //     $seperator[1] = 27;
                // }
                //$return = implode('/', $seperator);
                return $return;
            }
        );
    }

    /**
     * Security Class
     * 
     * PHP Library: composer.phar require jlorente/php-credit-cards
     * 
     * https://stripe.com/docs/testing#cards
     */

    //public function amountValidator($amount){
    //    $validatedAmount = Validator::make(
    //        ['amount' => $amount],
    //        ['amount' => 'required|integer|max:500|min:10'],
    //        ['required' => 'Amount is required!'],
    //    );
    //}

    public function cardNumValidator($cardnumber){
        $return = [];

        //$intCardNum = intval(trim($cardnumber['cardnumber'], ' '));
        
        $intCardNum = intval(str_replace(' ', '', $cardnumber['cardnumber']));
        //dump($intCardNum);

        $validatedCardNum = Validator::make(
            ['intCardNum' => $intCardNum],
            ['intCardNum' => 'min:1000000000000000|max:9999999999999999'],
            //['intCardNum' => 'required|regex:/[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}$/'],
            ['min' => 'Invalid card number!', 'max' => 'Invalid card number!'], //, 'regex' => 'Card Number must have 16 numbers!'
        );
        if($validatedCardNum->fails()){
            return $validatedCardNum; 
        }

        return $return;
    }

    public function expValidator($expiration){
        $return = [];

        if (strlen($expiration['expiration']) == 5){
            $seperator = explode('/', $expiration['expiration']);
            $month = intval($seperator[0]);
            $year = intval($seperator[1]) + 2000;

            $validatedExp = Validator::make(
                ['month' => $month, 'year' => $year],
                ['month' => 'integer|max:12|min:1', 'year' => 'integer'],
                ['integer' => 'Only integer is acceptable!', 'min' => 'Minimum month is 1!', 'max' => 'Maximum month is 12!'],                                   
            );
            if($validatedExp->fails()){
                return $validatedExp; 
            }
            //Carbon
            $monthYear = Carbon::now();
            $monthYear->month = $month;
            $monthYear->year = $year;

            if($monthYear->lessThan(Carbon::now())){
                $return = ['expiration' => 'Expiration is invalid!'];
            }
        }
        return $return;
    }

    public function cvvValidator($cvv){
        $return = [];
        $validatedCvv = Validator::make(
            ['cvv' => $cvv],
            ['cvv' => 'required|digits:3|min:001|max:999'],
            ['required' => 'CVV is required!', 'digits' => 'Only 3 digits for CVV!'],
        );
        return $validatedCvv;
    }
}
