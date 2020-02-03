<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $guarded = [];

    public function profileImage(){

        $imagePath = ($this->image) ? $this->image : 'profile/imagesavatar.jpg';

        return '/storage/'. $imagePath;

    }

    Public function user() { 

        return $this->belongsTo(User::class);

    }
}
