<?php

namespace App;

use Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;

use Overtrue\LaravelFollow\Traits\CanBeFollowed;

use App\Like;
use App\Post;




class User extends Authenticatable
{
    use CanLike, Notifiable, CanFollow, CanBeFollowed;

    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     */
    protected $fillable = [
        'name', 'email','username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected static function boot() { 

        parent::boot(); 

        static::created(function ($user){

            $user->profile()->create([

                'title' => $user->username,
            ]);
        });

    }


    public function posts(){ 

       return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');

    }

    
    Public function profile(){ 

        return $this->hasOne(Profile::class);

    }


    public function likes(){ 

        return $this->hasMany(Like::class);
 
     }  


     public function Post(){ 

        return $this->hasMany(Post::class);
 
     }


     public function following() {
        
        return $this->belongsToMany('App\User', 'followables', 'user_id', 'followable_id');
    }    
    
    public function followers() {
        
        return $this->belongsToMany('App\User', 'followables', 'followable_id', 'user_id');
    }

    

}
