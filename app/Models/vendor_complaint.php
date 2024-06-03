<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor_complaint extends Model
{
    use HasFactory;
    protected $table = "vendor_complaints";
    protected $guarded=[];
}
