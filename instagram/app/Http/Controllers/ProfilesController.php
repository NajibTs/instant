<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function search(Request $request){
        $s = $request->get('search');
        $user = User::where('username','like', '%' . $s . '%')->get();
        $count = User::where('username','like', '%' . $s . '%')->count();
        return view('search',compact('user', 'count'));
    }

    public function index(\App\User $user)
    {   
        
        return view('profiles.index', compact('user'));
    }

    public function edit(\App\User $user){

        $this->authorize('update', $user->profile);
        
        return view('profiles.edit', compact('user'));

    }


    public function update(User $user){

        $this->authorize('update', $user->profile);

      $data = request()->validate([

        'title' => '',
        'description' => '',
        'url' => '',
        'image' => '',

      ]);  

    

     if(request('image')){

        $imagePath = request('image')->store('profile','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);

        $image->save();

        $imageArray = ['image' => $imagePath ];

     }

     

     auth()->user()->profile->update(array_merge(

        $data,

        $imageArray ?? []
     ));

     return redirect("/profile/{$user->id}");

    }



}
