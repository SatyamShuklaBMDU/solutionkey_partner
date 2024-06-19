<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table="comments";

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }

    public function commentUser()
    {
        return $this->belongsTo(Customer::class,'comment_user_id');
    }
}
