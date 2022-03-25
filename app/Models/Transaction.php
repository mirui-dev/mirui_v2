<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

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
                // dump($value);
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
                // dump($value);
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
}
