<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalStatic extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'internal_static';  // weird that it cannot auto identify since it is intermediary table. Need to extend as Pivot?

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'disk' => 'mirui-static',
    ];

    public function scopeStatic($query){
        return $query->where('disk', 'mirui-static');
    }

    public function scopeStaticPriv($query){
        return $query->where('disk', 'mirui-static-priv');
    }

    public function scopeTmp($query){
        return $query->where('disk', 'tmp');
    }

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

    // public function movie(){
    //     return $this->belongsTo(Movie::class);
    // }

    // // local scopes: https://laravel.com/docs/9.x/eloquent#local-scopes
    // // user profile picture
    // public function scopeProfilePicture($query){
    //     $type = config('mirui.defaults.db.internal_resources.types.user.profile_picture');
    //     return $query->whereNotNull('user_id')->firstWhere('type', $type);
    // }

    // // movie poster image (aka Thumbnail)
    // public function scopePoster($query){
    //     $type = config('mirui.defaults.db.internal_resources.types.movie.thumbnail');
    //     return $query->whereNotNull('movie_id')->firstWhere('type', $type);
    // }

    // // movie cover image
    // public function scopeCoverImage($query){
    //     $type = config('mirui.defaults.db.internal_resources.types.movie.cover_image');
    //     return $query->whereNotNull('movie_id')->firstWhere('type', $type);
    // }

    // // movie gallery images
    // public function scopeGallery($query){
    //     $type = config('mirui.defaults.db.internal_resources.types.movie.gallery');
    //     return $query->whereNotNull('movie_id')->where('type', $type);
    // }

}
