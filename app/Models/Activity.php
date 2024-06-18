<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = "activities";
    protected $guarded = ['id'];

    public function vendor(){
        return $this->belongsTo(Admin::class,'vendor_id');
    }

    public function target()
    {
        return $this->belongsTo(Customer::class,'target_id');
    }

}
