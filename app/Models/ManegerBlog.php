<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManegerBlog extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='manager_blogs';
    public function vendor()
    {
        return $this->belongsTo(Admin::class,'vendor_id');
    }
}
