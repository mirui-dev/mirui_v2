<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'coins' => 0,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // one-to-many: user()->movies
    public function movies(){
        // many-to-many relationship: https://laravel.com/docs/9.x/eloquent-relationships#many-to-many-model-structure
        // specify usage of timestamps on intermediaries: https://laravel.com/docs/9.x/eloquent-relationships#retrieving-intermediate-table-columns
        return $this->belongsToMany(Movie::class)->withTimestamps();
    }

    // one-to-many: user()->cart
    public function cart(){
        // refer to customizing the name of the intermediate table on above link
        return $this->belongsToMany(Movie::class, 'cart_user', 'user_id', 'movie_id')->withTimestamps();
    }

    // one-to-many: user()->transactions
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    // // one-to-many: user()->internalResources
    // public function internalResources(){
    //     return $this->hasMany(InternalStatic::class);
    // }
}
