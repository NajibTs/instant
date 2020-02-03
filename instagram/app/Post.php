<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

use App\Like;

class Post extends Model
{    
    use CanBeLiked;
    use SoftDeletes;


    protected $guarded = [];   

    protected $fillable = ['title','caption','image','likes_count'];
    
    public function user() {       
        
    return $this->belongsTo(User::class);
    
}

public function likes() {

    return $this->hasMany(Like::class);

}


    public function comments()    
    
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
