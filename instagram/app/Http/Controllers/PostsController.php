<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Like;

use Auth;


class PostsController extends Controller
{

   Public function __construct(){

      $this->middleware('auth');

   }


   Public function index(){

      $users = auth()->user()->followings()->pluck('profile.id');
      $user = auth()->user();

      $posts = Post::whereIn('user_id', $users)->OrwhereIn('user_id', $user)->with('user')->latest()->get();        
      
      return view('welcome' , compact('posts'));

   }



   Public function create(){

    return view('posts.create');

   }

   Public function store() {

    $data = request()->validate([

       'caption' => 'required' ,
       'image' => 'required|image', 

    ]);


    $imagePath = request('image')->store('uploads', 'public');
    // dd($data['caption']);

    auth()->user()->posts()->create([

      'caption' => $data['caption'],
      'image' => $imagePath,

    ]);

   return redirect('/profile/'. auth()->user()->id );

        
   }


   public function show(Post $post) { 

      return view('posts.show',compact('post'));


   }


   public function postLikePost(Request $request)
   {
       $post_id = $request['postId'];
       $is_like = $request['isLike'] === 'true';
       $update = false;
       $post = Post::find($post_id);
       if (!$post) {
           return null;
       }

      
       $user = Auth::user();
       $like = $user->likes()->where('post_id', $post_id)->first();
       if ($like) {
           $already_like = $like->like;
           $update = true;
           if ($already_like == $is_like) {
               $like->delete();
               $count_like = $post->likes()->where('like', '1')->count();
               return $count_like;
           }
       } else {
           $like = new Like();
       }
       $like->like = $is_like;
       $like->user_id = $user->id;
       $like->post_id = $post->id;
       if ($update) {
           $like->update();
       } else {
           $like->save();
       }
       $count_like = $post->likes()->where('like', '1')->count();

       if($count_like >  0) {
        return response()->json($count_like);
       }
       return response()->json(0);
   }


   public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        $user = Auth::User()->id;
        // dd($user);
        $post->delete();
        return redirect(route('profile.show', $user));
    }


}
