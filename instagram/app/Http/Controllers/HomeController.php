<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Like;
use App\Post; 



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function posts()

    {

        $posts = Post::get();

        return view('posts', compact('posts'));

    }

    public function users()

    {

        $users = User::get();

        return view('profiles.index', compact('users'));

    }


    /**

     * Show the application of itsolutionstuff.com.

     *

      * @return \Illuminate\Http\Response

      */

public function user($id)

     {

        $user = User::find($id);

        return view('profiles.index', compact('user'));

 }





    // /**

    //  * Show the application of itsolutionstuff.com.

    //  *

    //  * @return \Illuminate\Http\Response

     

    public function ajaxRequest(Request $request){


        $user = User::find($request->user_id);

        $response = auth()->user()->toggleFollow($user);


        return response()->json(['success'=>$response]);

    }

    public function ajaxRequest2(Request $request){


        $post = Post::find($request->id);

        $response = auth()->user()->toggleLike($post);


        return response()->json(['success'=>$response]);

    }


    public function LikePost(Request $request){

        // dd('teeeeeeeeeeest');
       $post_id = $request->post_id;
       $post = Post::findOrFail($post_id);
        $user_id=auth()->user()->id;
        if(Like::where('user_id','=',$user_id)->where('post_id',"=", $post_id)->count()>0 ){
            $like=Like::where('user_id','=',$user_id)->where('post_id',"=", $post_id)->firstOrFail();
            if($like->like==true)
            {   
                $like->like=false;
                $post->likes_count--;
            }
            else{
                $like->like=true;
                $post->likes_count++;
            }
            $like->save();
            $post->save();
        }
        else{
            $like = new Like();
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->like=true;
            $like->save();
    
            $post->likes_count++;
            $post->save();
        }

        

        $likes_count = $post->likes_count;
         return $likes_count;


        $post = Post::find($request->id);
        $response = auth()->user()->toggleLike($post);

        return response()->json(['success'=>$response]);
    }
}
