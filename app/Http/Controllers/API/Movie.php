<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Movie as MovieModel;

class Movie extends Controller
{

    private $ret = [
        'status' => 'unknown',
        'data' => [],
        'timestamp' => null,
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = MovieModel::all();
        $ret = [
            'movies' => $movies
        ];
        $this->ret['data'] = $ret;
        $this->ret['timestamp'] = now();
        $this->ret['status'] = 'ok';

        return response()->json($this->ret);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = MovieModel::find($id);
        $ret = [
            'movie' => $movie
        ];
        $this->ret['data'] = $ret;
        $this->ret['timestamp'] = now();
        $this->ret['status'] = 'ok';

        return response()->json($this->ret);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
