<?php

namespace App\Http\Internals;

use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MiruiValidator{

    public function validateCoins($coins){
        $validation = Validator::make(
            [
                'coins' => $coins,
            ], 
            [
                'coins' => 'required|integer|min:5',
            ],
            [
                // 'coins' => 'Invalid coins amount. Please enter again. ', 
                // 'coins.required' => 'Invalid coins amount. Please enter again. ', 

                // https://stackoverflow.com/questions/49824847/combine-validation-errors-and-return-one-single-message
                'coins.*' => 'Invalid coins amount. Minimum topup amount of coin is 5. ',
                'coins.min' => 'Minimum topup amount of coin is 5. ',  // explicit override. works perfect. 
            ]
        );

        if($validation->fails()){
            return $validation;
        }

        return true;
    }

    public function validateCardNumber($cardnumber){

        // because we have mutator, so we need to convert to int first, or else difficult to validate
        $intCardNumber = intval(str_replace(' ', '', $cardnumber));
        //dump($intCardNum);

        $validation = Validator::make(
            [
                'cardNumber' => $intCardNumber
            ],
            [
                // https://laravel.com/docs/9.x/validation#rule-bail
                // here's the deal. If required is present, it acts like bail for required validation. But others won't, have 
                // to explicitly specify. 
                'cardNumber' => 'bail|required|integer|min:1000000000000000|max:9999999999999999'
            ],
            //['intCardNum' => 'required|regex:/[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}$/'],
            //, 'regex' => 'Card Number must have 16 numbers!'
            [
                'cardNumber.*' => 'Invalid card number. Please enter again. ', 
                // 'cardNumber.required' => 'Invalid card number. Please enter again. ', 
                // 'cardNumber.integer' => 'Invalid card number. Please enter again. ', 
                // 'cardNumber.min' => 'Invalid card number. Please enter again. ', 
                // 'cardNumber.max' => 'Invalid card number. Please enter again. ', 
            ],
        );

        if($validation->fails()){
            return $validation; 
        }

        return true;
    }

    public function validateCardExpiry($cardexpiry){

        $genericFailValidator = Validator::make(
            [
                'generic' => null,
            ],
            [
                'generic' => 'bail|required|integer',
            ],
            [
                'generic.*' => 'Invalid card expiry date. Please enter again. ',
            ]
        );

        if (strlen($cardexpiry) == 5){
            $seperator = explode('/', $cardexpiry);
            $month = intval($seperator[0]);
            $year = intval($seperator[1]) + 2000;  // value is only two digits, convert to full 4 digits. Assuming year 20xx. 

            // Carbon
            $currdate = Carbon::now();
            $currMonth = $currdate->month;
            $currYear = $currdate->year;

            $validMonthMin = 1;
            if($year <= $currYear){
                $validMonthMin = $currMonth;
            }
            $validYearMin = $currYear;

            $validator = Validator::make(
                [
                    'month' => $month, 
                    'year' => $year
                ],
                [
                    'month' => 'bail|required|integer|min:'.$validMonthMin.'|max:12', 
                    'year' => 'bail|required|integer|min:'.$validYearMin,
                ],
                [
                    'month.*' => 'Invalid card expiry date. Please enter again. <br>Expiry date must be entered in MM/YY format. ',
                    'year.*' => 'Invalid card expiry date. Please enter again. <br>Expiry date must be entered in MM/YY format. ',
                ],                                   
            );

            if($validator->fails()){
                return $validator; 
            }

            // //Carbon
            // $monthYear = Carbon::now();
            // $monthYear->month = $month;
            // $monthYear->year = $year;

            // // Carbon
            // $currdate = Carbon::now();
            // $currMonth = 

            // if($monthYear->lessThan(Carbon::now())){
            //     $return = ['expiration' => 'Expiration is invalid!'];
            // }
            return true;
        }

        $genericFailValidator->fails();
        return $genericFailValidator;
    }

    public function validateCardCVV($cvv){

        $validation = Validator::make(
            [
                'cvv' => $cvv
            ],
            [
                'cvv' => 'bail|required|digits:3|min:001|max:999'
            ],
            //['intCardNum' => 'required|regex:/[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}$/'],
            //, 'regex' => 'Card Number must have 16 numbers!'
            [
                'cvv.*' => 'Invalid CVV. Please enter again. ', 
            ],
        );

        if($validation->fails()){
            return $validation; 
        }

        return true;
    }

}
