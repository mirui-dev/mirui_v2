<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'isVisible' => false,
        'genre' => '{"tags":[]}',
        'language' => '{"lang":[]}',
        'subtitle' => '{"lang":[]}',
        'rating' => 'P13',
        'score' => 00.0, 
        'cast' => '{"cast":[]}', 
        'visual' => '{"poster":"","cover":"","gallery":""}',
    ];
    
}
