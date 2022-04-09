<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User as UserModel;

class User extends Controller
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

        if(auth()->user()->is_admin){
            $users = UserModel::all();
        }else{
            $users = auth()->user();
        }

        $ret = [
            'users' => $users ?? null,
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
        if(auth()->user()->is_admin){
            $user = UserModel::find($id);
        }else if($id == auth()->user()->id){
            $user = auth()->user();
        }

        $ret = [
            'user' => $user ?? null,
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
