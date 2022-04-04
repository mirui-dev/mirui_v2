<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_visible' => false,
        'genre' => '{"tags":[]}',
        'language' => '{"lang":[]}',
        'subtitle' => '{"lang":[]}',
        // 'rating' => 'P13',  // prevent set default because will be set automatically as value in model binding on livewire component
        // 'score' => 6.2, 
        'cast' => '{"cast":[]}', 
        'visual' => '{"poster":"","cover":"","gallery":[]}',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //     'language' => 'array',
    //     'subtitle' => 'array',
    //     'genre' => 'array',
    // ];

    /**
     * // https://laravel.com/docs/9.x/eloquent-mutators#defining-a-mutator
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function language(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => implode(', ', json_decode($value)->language),
            // set: fn ($value) => json_encode(['language' => explode(', ', explode(',', $value))]),
            get: function($value){
                $preliminary = json_decode($value);
                $return = strtoupper(implode(' ', $preliminary->language ?? []));
                return $return;
            },
            set: function($value){
                // dump($value);
                // $return = json_encode(['language' => explode(',', str_replace(', ', ',', strtoupper(trim($value, ' '))))]);
                $return = json_encode(['language' => explode(' ', str_replace([', ', ','], ' ', strtoupper(trim($value ?? ''))))]);
                // dump($return);
                return $return;
            }
        );
    }

    protected function subtitle(): Attribute
    {
        return Attribute::make(
            get: function($value){
                $preliminary = json_decode($value);
                $return = strtoupper(implode(' ', $preliminary->language ?? []));
                return $return;
            },
            set: function($value){
                $return = json_encode(['language' => explode(' ', str_replace([', ', ','], ' ', strtoupper(trim($value ?? ''))))]);
                return $return;
            }
        );
    }

    protected function runtime(): Attribute
    {
        return Attribute::make(
            get: function($value){
                $return = strval($value)."m";
                return $return;
            },
            set: function($value){
                // https://www.delftstack.com/howto/php/how-to-extract-numbers-from-a-string-in-php/#use-filter-var-function-to-extract-numbers-from-a-string-in-php
                $return = intval(filter_var($value, FILTER_SANITIZE_NUMBER_INT));
                return $return;
            }
        );
    }

    protected function genre(): Attribute
    {
        return Attribute::make(
            get: function($value){
                $preliminary = json_decode($value);
                $return = strtoupper(implode(' ', $preliminary->tags ?? []));
                return $return;
            },
            set: function($value){
                $return = json_encode(['tags' => explode(' ', str_replace([', ', ','], ' ', strtoupper(trim($value ?? ''))))]);
                // dump($return);
                return $return;
            }
        );
    }

    protected function country(): Attribute
    {
        return Attribute::make(
            get: function($value){
                $return = strtoupper(trim($value ?? ''));
                return $return;
            },
            set: function($value){
                $return = strtoupper(trim($value ?? ''));
                // dump($return);
                return $return;
            }
        );
    }

    protected function director(): Attribute
    {
        return Attribute::make(
            get: function($value){
                $return = strtoupper(trim($value ?? ''));
                return $return;
            },
            set: function($value){
                $return = strtoupper(trim($value ?? ''));
                // dump($return);
                return $return;
            }
        );
    }

    protected function cast(): Attribute
    {
        return Attribute::make(
            get: function($value){

                // ok. big issue solved after so many hours. 
                // so initial problem is either self appended \n or <br> keep echoing out in the HTML side. 
                // turns out we have to use PHP_EOL. 
                // refer to the comment in this answer: https://stackoverflow.com/a/48525297

                // dump($value);
                $preliminary = json_decode($value);
                $return = strtoupper(implode(PHP_EOL, $preliminary->cast ?? []));
                // $return = strtoupper(implode(' &#13;&#10; ', $preliminary->cast ?? []));
                // $return = nl2br($return);
                // dump($return);
                return $return;
            },
            set: function($value){
                // dump($value);
                // $return = json_encode(trim($value, ''));
            $return = json_encode(['cast' => explode(PHP_EOL, str_replace([/*', ', ','*/], PHP_EOL, strtoupper(trim($value ?? ''))))]);
                // dump($return);
                return $return;
            }
        );
    }
    
}
