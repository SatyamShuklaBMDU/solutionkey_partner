<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = "posts";

    public function vendor()
    {
        return $this->belongsTo(Admin::class,'vendor_id');
    }
}
