<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Post;

class Like extends Model
{
     public function user(){

         return $this->belongsTo(User::class);

     }


     public function post(){

         return $this->belongsTo(Post::class);

     }
}
