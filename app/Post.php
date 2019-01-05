<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
