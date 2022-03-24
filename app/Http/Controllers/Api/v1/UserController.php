<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\v1\UserResource;
use App\Http\Resources\v1\UserCollection;
use Storage;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        return new UserCollection(User::where('id',$user_id)->get());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user_id)
    {
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->user_desc = $request->user_desc;
        
        if($request->user_avatar){
            $image1 = $request->user_avatar;
            $extensions = $image1->getClientOriginalExtension();
            $name1 = time().'_'.$image1->getClientOriginalName();
            Storage::disk('public')->put($name1, File::get($image1));
            $user->user_avatar = $name1;
        }
        if($request->user_background){
            $image2 = $request->user_background;
            $extensions = $image2->getClientOriginalExtension();
            $name2 = time().'_'.$image2->getClientOriginalName();
            Storage::disk('public')->put($name2, File::get($image2));
            $user->user_background = $name2;
        }
        $user->save();
        // return new UserResource($user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
