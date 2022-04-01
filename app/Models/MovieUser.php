<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class MovieUser extends Model
{
    use HasFactory;
    use SoftDeletes;


    // here: remove this!!!

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movie_user';  // weird that it cannot auto identify since it is intermediary table. Need to extend as Pivot?

}
