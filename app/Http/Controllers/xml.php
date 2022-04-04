<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class xml extends Controller
{
    /**
     * 
     * composer require mtownsend/response-xml
     * php artisan optimize
     * 
     */

    public function index(){
        //return response('xml');
        //$xmlArray=[];
        
        $movies = [];
        
        foreach(Movie::all() as $movie){
            $genres = [];
            foreach($movie->genre as $genre){
                array_push($genres, ['genre' => $genre]);
            }

            $movieObject = [
                //'movie' => json_decode($movie, true)
                'movie' => [
                    '_attributes' => [
                        'id' => $movie->id,
                    ],
                    'title' => [
                        'primary' => $movie->title,
                        'secondary' => $movie->title2,
                    ],
                    'description' => [
                        'primary' => $movie->description,
                        'secondary' => $movie->description2,
                    ],    
                    'genre' => $movie->genre,
                    'language' => $movie->language,
                    'subtitle' => $movie->subtitle,
                    'country' => $movie->country,
                    'rating' => $movie->rating,
                    'score' => $movie->score,
                    'runtime' => $movie->runtime,
                    'director' => $movie->director,
                    'cast' => $movie->cast,
                    'dateRelease' => $movie->dateRelease,
                    'created' => $movie->created_at,
                    'updated' => $movie->updated_at,
                ]
            ];
            //dump($xml);
            array_push($movies, $movieObject);
        }
        
        $xmlArray = ["movies" => $movies];
        
        return response()->xml($xmlArray, 200, [], 'mirui',"UTF-8");
    }
}