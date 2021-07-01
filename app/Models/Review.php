<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'comment',
        'rating',
        'post_id',
        'user_id'
    ];

     public function post()
    {
        return $this->belongsTo(Post::class);
    }
     public function post()
    {
        return $this->belongsTo(User::class);
    }
}
